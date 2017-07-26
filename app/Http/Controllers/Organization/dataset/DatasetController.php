<?php

namespace App\Http\Controllers\Organization\Dataset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Dataset;
use Session;
use File;
use DB;
use MySQLWrapper;
use Excel;
use Auth;
class DatasetController extends Controller
{
    public function importDataset(){
        return view('organization.dataset.import');
    }
    public function listDataset(Request $request){
        $sortedBy = @$request->sort_by;
        if($request->has('search')){
            if($sortedBy != ''){
                $datasetList = Dataset::where('dataset_name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate(3);
            }else{
                $datasetList = Dataset::where('dataset_name','like','%'.$request->search.'%')->paginate(3);
            }
        }else{
            if($sortedBy != ''){
                $datasetList = Dataset::orderBy($sortedBy,$request->desc_asc)->paginate(3);
            }else{
                 $datasetList = Dataset::paginate(3);
            }
        }
        $dataset =  [
                        'datalist'=>$datasetList,
                        'showColumns' => ['dataset_name'=>'Name','dataset_table'=>'Dataset Table','description'=>'Description','created_at'=>'Created At'],
                        'actions' => ['view'=>['route'=>'view.dataset','title'=>'View']]
                    ];
    	return view('organization.dataset.list',$dataset);
    }


    function uploadDataset(Request $request){
        if($request->import_source == 'file'){
           
             if($request->file('file')->getClientOriginalExtension()=='sql' )
             {
                    $path = 'sql'; 
             }else{
                    $path = 'datasets_files';
                }
            try {
                 if(!in_array($request->file('file')->getClientOriginalExtension(),['csv','sql','xlsx','xls'])){
                    return ['status'=>'error','records'=>'File type not allowed!'];
                }
            } catch (Exception $e) {
                return ['status'=>'error','records'=>'Please Select a File to Upload'];
            }
            $file = $request->file('file');
            if($file->isValid()){

                $filename = date('Y-m-d-H-i-s')."-".$request->file('file')->getClientOriginalName();
                $uploadFile = $request->file('file')->move($path, $filename);
                $filePath = $path.'/'.$filename;
            }
        }
        
        if($request->import_source == 'file_server'){
            $filePath = $request->filepath;
            $filep = explode('/',$filePath);
            $filename = $filep[count($filep)-1];
        }

        if($request->import_source == 'url'){
            $filePath = $request->fileurl;
            $filep = explode('/',$filePath);
            $filename = $filep[count($filep)-1];
        }
        if($request->import_source != 'import_survey'){
            if(@$request->add_replace == 'new'){
                $result = $this->storeInDatabase($filePath, $request->datasetName, $request->import_source, $filename);
            }elseif(@$request->add_replace == 'append'){
                $result = $this->appendDataset($request->dataset_name, $request->import_source, $filename, $filePath, $request);
            }elseif(@$request->add_replace == 'replace'){
                $result = $this->replaceDataset($request, $request->dataset_name, $filePath);
            }
        }

        if($request->import_source == 'import_survey'){

            $result = $this->exportSurveyToDataset($request->survey, $request->dataset_name);
            $response = ['status'=>'success','message'=>'Dataset created successfully!','id'=>$result['dataset_id']];
            return $response;
        }
        return back();

    }
    protected function validateRequst($request){
        $errors = [];
        if($request->has('source') && $request->source != ''){
            switch($request->source){
                case'file':
                    if($request->file('file') == '' || empty($request->file('file')) || $request->file('file') == null){
                        $errors['message'] = 'File field should not empty!';
                    }
                break;
                case'file_server':
                    if(!$request->has('filepath') || $request->filepath == ''){
                        $errors['message'] = 'File path should not empty!';
                    }
                break;
                case'url':
                    if(!$request->has('fileurl') || $request->fileurl == ''){
                        $errors['message'] = 'File url should not empty!';
                    }
                break;
                case'import_survey':
                    $errors = '';
                break;
            }
        }else{
            $errors['message'] = 'Required fields are missing!';
        }
        
        /*if($request->format == 'undefined' || empty($request->format) || $request->format  == null){
            $errors['format'] = 'Please select file format';
        }*/

    	if($request->add_replace == 'undefined' || empty($request->add_replace) || $request->add_replace  == null){
    		$errors[] = 'Please select file format!';
    	}
    	if($request->add_replace == 'replace' || $request->add_replace == 'append'){
    		if($request->with_dataset == '' || $request->with_dataset == 'undefined' || empty($request->with_dataset)){
    			$errors['message'] = 'Please select dataset to '.$request->add_replace;
    	   }
    	}
        if($request->source == 'import_survey'){
            $return = ['status' => 'true','errors'=>[]];
            return $return;
        }
    	if(count($errors) >= 1){
    		$return = ['status' => 'false','errors'=>$errors];
    		return $return;
    	}else{
    		$return = ['status' => 'true','errors'=>[]];
    		return $return;
    	}
    }

    public function runSqlFile($filepath ,$name ,$origName){
           
        $sql =  file_get_contents($filepath);
        $lines = explode("\n", $sql); 
        $create_table = $status = $output = ""; 
        $linecount = count($lines); 
        $create=$next=0;
        for($i = 0; $i < $linecount; $i++){

            if(starts_with($lines[$i], "CREATE")){

                $create_table .= $lines[$i];
                $table = explode(' ', $lines[$i]); 
                $tableName = str_replace('`', '', $table[2]); 
                $status .=1;
                $create=$i;
            }
            if(starts_with($lines[$i],'--')){
                $create =0;
            }
            if($create>0 && $create<$i){
                $create_table .= $lines[$i];
            }
            if(starts_with($lines[$i], "INSERT") ){

                $output .= $lines[$i];
                $next = $i;
                $status .=2;
            }
            if($next>0 && $i>$next){
                if(str_contains($lines[$i], ['--','ALTER','ADD','/*','MODIFY'])){ 
                    $next=0;
                }
                else{
                    $output .= $lines[$i];
                }
            } 
        }            
        try{
            DB::select($create_table);

        }catch(\Exception $e){

            if($e->getCode() =="42S01"){

            }
        }
        if($status !='12'){
            return ['status'=>'false','id'=>'','message'=>'Not exist create & Inset'];
        } 
        else{   
            try{                    
                                
                DB::select($output);
                $model = new DL;
                $model->dataset_table = $tableName;
                $model->dataset_name = $name;
                $model->dataset_file = $filepath;
                $model->dataset_file_name = $origName;
                $model->user_id = Auth::user()->id;
                $model->uploaded_by = Auth::user()->name;
                $model->save();   
                return ['status'=>'true','id'=>'','message'=>'Sql File  Import successfully!'];

             }catch(\Exception $e){ 
                if($e->getCode()==23000){

                    return ['status'=>'false','id'=>'','message'=>'Duplicate entry'];                                           
                }  
            }
        }       
    }

    protected function storeInDatabase($filename, $origName, $source, $orName, $tableNameFrom = null){
        
        $filePath = $filename;
        $org_id =  Session::get('organization_id');


        if($source == 'url'){
            $randName = 'downloaded_dataset_'.time().'.'.File::extension($filename);
            $path = 'datasets/';
            copy($filename, $path.$randName);
            $filePath = 'datasets/'.$randName;
        }
        if(!File::exists($filePath)){
            return ['status'=>'false','id'=>'','message'=>'File not found on given path!'];
        }
        if(File::extension($filename)=="xlsx" || File::extension($filename)=="xls"){
            $tableName = DB::getTablePrefix().$org_id.'_data_table_'.time();
            $columns = [];
            $assoc = [];
            $finalArray = [];
            $headers = [];
            $sheetCount = 0;
            $data = Excel::load($filePath, function($reader) use (&$sheetCount){ 
                $sheetCount = $reader->getSheetCount();
            })->get();
            if($sheetCount > 1){
                foreach($data[0] as $key => $value){
                    $FileData[] = $value->all();
                }
            }else{
                foreach($data as $key => $value){
                    $FileData[] = $value->all();
                }
            }
            $i = 1;
            foreach($FileData[0] as $key  => $value){
                $headers[] = $key;
                $c = 'column_' . $i++;
                $assoc[] = $c;
                $columns[] = "`{$c}` TEXT NULL";
            }
            
            foreach($FileData as $values){
                try{
                    $finalArray[] = array_combine($assoc, array_values($values));
                }catch(\Exception $e){
                    continue;
                }
            }
            // dd($tableName);
            $headers = array_combine($assoc, array_values($headers));
            if($tableNameFrom == null){
                DB::select("CREATE TABLE `{$tableName}` ( " . implode(', ', $columns) . " ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                DB::select("ALTER TABLE `{$tableName}` ADD `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID' FIRST");
            }
            if($tableNameFrom != null){
                $tableName = str_replace('ocrm_', '', $tableNameFrom);
            }else{
                $tableName = str_replace('ocrm_', '', $tableName);
            }
            DB::table($tableName)->insert($headers);
            DB::connection()->disableQueryLog();
            DB::table($tableName)->insert($finalArray);
            if($tableNameFrom == null){
                $model = new Dataset;
                $model->dataset_table = 'ocrm_'.$tableName;
                $model->dataset_name = $origName;
                $model->dataset_file = $filePath;
                $model->dataset_file_name = $orName;
                $model->user_id = Auth::guard('org')->user()->id;
                $model->uploaded_by = Auth::guard('org')->user()->name;
                $model->save();
            }
            return ['status'=>'true','id'=>@$model->id,'message'=>'Dataset upload successfully!'];
        }else{

            DB::beginTransaction();
            $model = new MySQLWrapper();
            $tableName = DB::getTablePrefix().$org_id.'_data_table_'.time();
            
            $result = $model->wrapper->createTableFromCSV($filePath,$tableName,',','"', '\\', 0, array(), 'generate','\n');
            if($result){
                $model = new Dataset;
                $model->dataset_table = $tableName;
                $model->dataset_name = $origName;
                $model->dataset_file = $filePath;
                $model->dataset_file_name = $orName;
                $model->user_id = Auth::guard('org')->user()->id;
                $model->uploaded_by = Auth::guard('org')->user()->name;
                $model->save();
                DB::commit();
                Session::flash('message','Dataset upload successfully!');
                return back();
            }else{
                DB::rollback();
                return ['status'=>'false','id'=>'','message'=>$result['error']];
            }
        }
    }

    protected function replaceDataset($request, $origName, $filename){
        // dd($request->all());
        ini_set('memory_limit', '2048M');
        $model = Dataset::find($request->replace_or_append);
        DB::select('TRUNCATE TABLE ocrm_'.$model->dataset_table);
        //dd($model->dataset_table);
        $this->storeInDatabase($filename, $origName, $request->import_source, $orName = '', $model->dataset_table);
        if($model){
            return ['status'=>'true','id'=>$model->id,'message'=>'Dataset replaced successfully!'];
        }else{
            return ['status'=>'false','message'=>'unable to replace dataset!'];
        }
    }

    protected function appendDataset($datasetName, $source, $filename, $filePath, $request){
        if($source == 'url'){
            $randName = 'downloaded_dataset_'.time().'.csv';
            $path = 'datasets_file/';
            copy($filename, $path.$randName);
            $filePath = 'datasets_files/'.$randName;
        }

        if(!File::exists($filePath)){
            return ['status'=>'false','id'=>'','message'=>'File not found on given path!'];
        }

        $tableName = 'table_temp_'.rand(5,1000);
        $model_DL = Dataset::find($request->replace_or_append);
        $oldTable = DB::table($model_DL->dataset_table)->get();
        
        if(File::extension($filePath)=="xlsx" || File::extension($filePath)=="xls"){
            $assoc = [];
            $finalArray = [];
            $headers = [];
            $data = Excel::load($filePath, function($reader){ })->get();
            foreach($data as $key => $value){
                $FileData[] = $value->all();
            }
            $i = 1;
            foreach($FileData[0] as $key  => $value){
                $headers['column_'.$i] = $key;
                $c = 'column_' . $i;
                $assoc[] = $c;
                $i++;
            }
            
            foreach($FileData as $values){
                $finalArray[] = array_combine($assoc, array_values($values));
            }
            unset($oldTable[0]->id);
            $new = (array)$headers;
            $old = (array)$oldTable[0];
            $new = preg_replace("/[^a-zA-Z 0-9]+/", "", $new );
            $old = preg_replace("/[^a-zA-Z 0-9]+/", "", $old );
            if($new != $old){
                return ['status'=>'false','message'=>'File columns are note same!'];
            }
            DB::table($model_DL->dataset_table)->insert($finalArray);
        }else{
            $model = new MySQLWrapper;
            $result = $model->wrapper->createTableFromCSV($filePath,$tableName,',','"', '\\', 0, array(), 'generate','\r\n');
            $tempTableData = DB::table($tableName)->get();
            
            $oldColumns = [];
            unset($oldTable[0]->id);
            unset($tempTableData[0]->id);
            $new = (array)$tempTableData[0];
            $old = (array)$oldTable[0];
            $new = preg_replace("/[^a-zA-Z 0-9]+/", "", $new );
            $old = preg_replace("/[^a-zA-Z 0-9]+/", "", $old );
            if($new != $old){
                DB::select('DROP TABLE '.$tableName);
                return ['status'=>'false','message'=>'File columns are note same!'];
            }
            unset($new['id']);

            $appendColumns = implode(',', array_keys($new));
            DB::select('INSERT INTO `'.$model_DL->dataset_table.'` ('.$appendColumns.') SELECT '.$appendColumns.' FROM '.$tableName.' WHERE id != 1;');
            DB::select('DROP TABLE '.$tableName);
        }
        
        return ['status'=>'true','message'=>'Dataset updated successfully!!', 'id'=>$model_DL->id];
    }

    protected function validateStoreRequest($request){

        $rules = [

            'dataset_name' => 'required',
            'dataset_description' => 'required'
        ];

        $this->validate($request, $rules);
    }

    public function store(Request $request){

        $this->validateStoreRequest($request);
        try{
            $model = new Dataset;
            $model->dataset_name = $request->dataset_name;
            $model->description = $request->dataset_description;
            $model->save();
            Session::flash('message','Dataset created successfully!');
            return back();
        }catch(\Exception $e){
            Session::flash('message','Unable to create dataset!');
            throw $e;
        }
    }
    public function viewDataset()
    {
       return view('organization.dataset.view');
    }

    public function updateRecords(Request $request){
        dd($request->all());
    }
}
