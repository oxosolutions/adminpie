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
use App\Model\Organization\UsersMeta;
use Illuminate\Support\Facades\Schema;
use App\Model\Organization\Visualization;

class DatasetController extends Controller
{
    public function importDataset(){
        return view('organization.dataset.import');
    }
    public function listDataset(Request $request){
        $search = $this->saveSearch($request);
        if($search != false && is_array($search)){
            $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
        }
        if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 10;
          }
        $sortedBy = @$request->orderby;
        $order = $request->order;
        if($request->orderby == null || $request->orderby == ''){
          $sortedBy = 'created_at';
          $order = 'desc';
        }
        if($request->has('search')){
            if($sortedBy != ''){
                $datasetList = Dataset::where('dataset_name','like','%'.$request->search.'%')->orderBy($sortedBy,$order)->paginate($perPage);
            }else{
                $datasetList = Dataset::where('dataset_name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $datasetList = Dataset::orderBy($sortedBy,$order)->paginate($perPage);
            }else{
                 $datasetList = Dataset::paginate(3);
            }
        }
        $dataset =  [
                        'datalist'=>$datasetList,
                        'showColumns' => ['dataset_name'=>'Title','dataset_table'=>'Dataset Table','description'=>'Description','created_at'=>'Created'],
                        'actions' => ['view'=>['route'=>'view.dataset','title'=>'View'],'delete'=>['route'=>'delete.dataset','title'=>'Delete']]
                    ];
    	return view('organization.dataset.list',$dataset);
    }


    function uploadDataset(Request $request){
        $orgID = Session::get('organization_id');
        if($request->import_source == 'file'){
           
             if($request->file('file')->getClientOriginalExtension()=='sql' )
             {
                    $path = 'sql'; 
             }else{
                    $path = env('USER_FILES_PATH').'_'.$orgID.'/dataset_import_files';
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
                $result = $this->storeInDatabase($filePath, $request->datasetname, $request->import_source, $filename);
            }elseif(@$request->add_replace == 'append'){
                $result = $this->appendDataset($request->dataset_name, $request->import_source, $filename, $filePath, $request);
            }elseif(@$request->add_replace == 'replace'){
                $result = $this->replaceDataset($request, $request->dataset_name, $filePath);
            }
        }

        if($request->import_source == 'import_survey'){

            $result = $this->exportSurveyToDataset($request->survey, $request->dataset_name);
            
            Session::flash('success','Successfully imported!');
            return redirect()->route('view.dataset',$result['dataset_id']);
        }
        

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

            $headers[] = 'status';
            $assoc[] = 'status';
            $columns[] = "`status` VARCHAR(255) DEFAULT '1'";
            $headers[] = 'parent';
            $assoc[] = 'parent';
            $columns[] = "`parent` VARCHAR(255) DEFAULT '0'";
            foreach($FileData as $values){
                $values['status'] = 1;
                $values['parent'] = 0;
                try{
                    $finalArray[] = array_combine($assoc, array_values($values));
                }catch(\Exception $e){
                    continue;
                }
            }
            //dd($finalArray);
            $headers = array_combine($assoc, array_values($headers));
            if($tableNameFrom == null){
                DB::select("CREATE TABLE `{$tableName}` ( " . implode(', ', $columns) . " ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                DB::select("ALTER TABLE `{$tableName}` ADD `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID' FIRST");
                DB::select("UPDATE `{$tableName}` SET `status` = 1");
            }
            if($tableNameFrom != null){
                $tableName = str_replace('ocrm_', '', $tableNameFrom);
            }else{
                $tableName = str_replace('ocrm_', '', $tableName);
            }
            DB::table($tableName)->insert($headers);
            DB::connection()->disableQueryLog();
            DB::table($tableName)->insert($finalArray);
            DB::select("UPDATE `ocrm_{$tableName}` SET status = 'status' , parent = 'parent' WHERE id = 1 ");

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
                DB::select("UPDATE `{$tableName}` SET `status` = 1");
                DB::select("UPDATE `{$tableName}` SET `status` = 'status' , `parent` = 'parent' WHERE `id` = 1 ");
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
        DB::select('TRUNCATE TABLE ocrm_'.str_replace('ocrm_','',$model->dataset_table));
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

        $tableName = 'ocrm_table_temp_'.rand(5,1000);
        $model_DL = Dataset::find($request->replace_or_append);
        $oldTable = DB::table(str_replace('ocrm_','',$model_DL->dataset_table))->get();
        
        if(File::extension($filePath)=="xlsx" || File::extension($filePath)=="xls"){
            $assoc = [];
            $finalArray = [];
            $headers = [];
            //$data = Excel::load($filePath, function($reader){ })->get();
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
                $headers['column_'.$i] = $key;
                $c = 'column_' . $i;
                $assoc[] = $c;
                $i++;
            }
            //dd($assoc);
            
            foreach($FileData as $values){
                try{
                    /*dump($assoc);
                    dump(array_values($values));*/
                    $finalArray[] = array_combine($assoc, array_values($values));
                }catch(\Exception $e){
                }
            }
            unset($oldTable[0]->id);
            $new = (array)$headers;
            $old = (array)$oldTable[0];
            $new = preg_replace("/[^a-zA-Z 0-9]+/", "", $new );
            $old = preg_replace("/[^a-zA-Z 0-9]+/", "", $old );
            if($new != $old){
                return ['status'=>'false','message'=>'File columns are note same!'];
            }
            DB::table(str_replace('ocrm_','',$model_DL->dataset_table))->insert($finalArray);
        }else{
            $model = new MySQLWrapper;
            $result = $model->wrapper->createTableFromCSV($filePath,$tableName,',','"', '\\', 0, array(), 'generate','\r\n');
            $tempTableData = DB::table(str_replace('ocrm_','',$tableName))->get();
            
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
            $org_id =  Session::get('organization_id');
            $tableName = DB::getTablePrefix().$org_id.'_data_table_'.time();
            DB::select("CREATE TABLE `{$tableName}` ( id INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID', `status` VARCHAR(255) DEFAULT '1', `parent` VARCHAR(255) DEFAULT '0' ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            DB::table(str_replace('ocrm_','',$tableName))->insert(['status'=>'status','parent'=>'parent']);
            $model = new Dataset;
            $model->dataset_name = $request->dataset_name;
            $model->description = $request->dataset_description;
            $model->dataset_table = $tableName;
            $model->save();
            $newDatasetId = $model->id;
            Session::flash('success','Dataset created successfully!');
            
            return redirect()->route('view.dataset',$newDatasetId);
        }catch(\Exception $e){
            Session::flash('success','Unable to create dataset!');
            throw $e;
        }
    }
    public function viewDataset(Request $request, $id, $action, $record_id = null){
        $viewRecord = [];
        $history = [];
        $dataset = Dataset::find($id);
        $datasetTable = Dataset::find($id)->dataset_table;
        $records = DB::table(str_replace('ocrm_', '', $datasetTable))->where('id','!=',1)->where('status' , 1)->paginate(100);
        $tableHeader = DB::table(str_replace('ocrm_', '', $datasetTable))->where('id',1)->first();
        if($action != null){
            if($action == 'view' || $action == 'edit'){
                if($record_id != null){
                    $viewRecord = array_values($records->where('id',$record_id)->toArray());
                }
            }
            if($action == 'rivisions'){
                if($record_id != null){
                    $history = $this->ViewHistoryRecord($id, $record_id);
                }
            }
        }
        return view('organization.dataset.view',['tableheaders'=>$tableHeader , 'dataset' => $dataset,'records'=>$records,'viewrecords'=>$viewRecord,'history'=>$history]);
    }

    public function createNewfunction(Request $request){
        
    }
    public function createDatasetRows(Request $request)
    {
        $datasetTable = Dataset::find($request['dataset_id'])->dataset_table;

        $datasetHeaders = (array)DB::table(str_replace('ocrm_','',$datasetTable))->first();
        unset($datasetHeaders['id']);
        unset($datasetHeaders['status']);
        unset($datasetHeaders['parent']);
        foreach($request->data as $key => $record){
            unset($record[0]);
            $recordArray = array_combine(array_keys($datasetHeaders), $record);
            if($recordArray != null){
                DB::table(str_replace('ocrm_','',$datasetTable))->insert($recordArray);
            }
        }
        // $model = DB::table($datasetTable)->insert();
    }
    public function updateRecords(Request $request, $id){
        dump($id);
        dd($request->all());
        $dataset = Dataset::find($id);
        $datasetHeaders = (array)DB::table(str_replace('ocrm_','',$dataset->dataset_table))->first();
        foreach($request->records as $key => $record){
            $recordArray = array_combine(array_keys($datasetHeaders), $record);
            $isRecordExists = DB::table(str_replace('ocrm_','',$dataset->dataset_table))->where('id',$recordArray['id'])->first();
            if($isRecordExists != null){
                DB::table(str_replace('ocrm_','',$dataset->dataset_table))->where('id',$recordArray['id'])->update($recordArray);
            }else{
                DB::table(str_replace('ocrm_','',$dataset->dataset_table))->insert($recordArray);
            }
        }
    }

    public function createColumn(Request $request, $id){
        $this->validateRequiredColumns($request);
        $datasetTable = Dataset::find($id)->dataset_table;
        $columnName = 'column_'.rand(111,999);
        DB::select('ALTER TABLE '.$datasetTable.' ADD COLUMN `'.$columnName.'` TEXT AFTER `'.$request->after_column.'`');
        $ifRecordsExist = DB::table(str_replace('ocrm_','',$datasetTable))->where('id',1)->first();
        if($ifRecordsExist != null){
            DB::table(str_replace('ocrm_','',$datasetTable))->where('id',1)->update([$columnName=>$request->column_name]);
        }else{
            DB::table(str_replace('ocrm_','',$datasetTable))->insert([$columnName=>$request->column_name]);
        }
        return back();
    }

    protected function validateRequiredColumns($request){

        $rules = [
            'column_name' => 'required',
            'after_column' => 'required'
        ];

        $this->validate($request, $rules);
    }

    protected function saveSearch($request){
        $search = $request->except(['page']);
        $model = UsersMeta::where(['key'=>$request->route()->uri,'user_id'=>Auth::guard('org')->user()->id])->first();
        if($model != null){
            if(!empty($request->except(['page']))){
              $model->value = json_encode($request->except(['page']));
              $model->save();
            }
            $savedSearch = json_decode($model->value, true);
            return $savedSearch;
        }else{
            $model = new UsersMeta;
            $model->user_id = Auth::guard('org')->user()->id;
            $model->key = $request->route()->uri;
            $model->value = json_encode(@$request->except(['page']));
            $model->save();
            return false;
        }
    }

    public function deleteDataset($id){
        $model = Dataset::find($id);
        if(!empty($model['dataset_table'])){
            if(Schema::hasTable($model['dataset_table'])){
                $datsetTable = $model->dataset_table;
                DB::select('DROP TABLE IF EXISTS '.$datsetTable);
            }
        }
        $model->delete();
        Session::flash('success','Successfully deleted!');
        return back();
    }

    public function craeteDataset(){

        return view('organization.dataset.create');
    }
     public function editDataset($id){
        $dataset = Dataset::find($id);
        return view('organization.dataset.edit',['dataset'=>$dataset]);
    }
     public function defineDataset(Request $request, $id){
        $dataset = Dataset::find($id);
        if($request->isMethod('post')){
            $defined = $request->except(['_token']);
            $dataset->defined_columns = json_encode($defined);
            $dataset->save();
            Session::flash('success','Successfully defined!');
        }
        $datasetTable = Dataset::find($id)->dataset_table;
        $headers = DB::table(str_replace('ocrm_','',$datasetTable))->where('id',1)->first();
        $columns = collect($headers)->except(['id','status','parent']);
        return view('organization.dataset.define',['columns'=>$columns,'dataset'=>$dataset]);
    }
    public function filterDataset(Request $request, $id){
        $records = collect([]);
        $headers = [];
        // dd($request->all());
        $dataset = Dataset::find($id);
        if($request->has('select_column')){
            
            $datasetTable = Dataset::find($id)->dataset_table;
            $headers = DB::table(str_replace('ocrm_','',$datasetTable))->where('id',1)->first();
            $records = DB::table(str_replace('ocrm_', '', $datasetTable))->select($request->select_column)->where('id','!=',1)->where('status' , 1);
            $headers = collect($headers)->except(['id','status','parent'])->toArray();
            if(isset($request->horizontal_filtration[0]['column'])){
                $records->where(function($query) use ($request){
                    foreach($request->horizontal_filtration as $key => $filter){
                        $query->where($filter['column'],$filter['operation'],$filter['value']);
                    }
                });
                $records = $records->paginate(50);
            }else{
                $records = $records->paginate(50);
            }
        }
        return view('organization.dataset.filter',['records'=>$records,'headers'=>$headers,'dataset'=>$dataset]);
    }

    public function createSubset(Request $request, $id){
        $dataset = Dataset::find($id);
        $where = [];
        $datasetTable = Dataset::find($id)->dataset_table;
        $filterDara = unserialize($request->filter_data);
        $headers = DB::table(str_replace('ocrm_','',$datasetTable))->select($filterDara['select_column'])->where('id',1)->first();
        $tableName = DB::getTablePrefix().get_organization_id().'_data_table_'.time();
        $newTableColumns = [];
        $newTableColumns[] = "`id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID'";
        foreach($filterDara['select_column'] as $key => $val){
            $newTableColumns[] = '`'.$val.'` TEXT NULL';
        }
        $newTableColumns[] = "`status` BOOLEAN NOT NULL DEFAULT TRUE";
        $newTableColumns[] = "`parent` INT NOT NULL DEFAULT '0'";
        foreach($filterDara['horizontal_filtration'] as $key => $filter){
            $where[] = $filter['column'].' '.$filter['operation'].' "'.$filter['value'].'"';
        }
        
        DB::beginTransaction();
        try{
            DB::select('CREATE TABLE '.$tableName.' ('.implode(',',$newTableColumns).')');
            $insertData = collect($headers)->toArray();
            DB::table(str_replace('ocrm_','',$tableName))->insert($insertData);
            DB::select('INSERT INTO '.$tableName.' ('.implode(',',$filterDara['select_column']).', status, parent) SELECT '.implode(',',$filterDara['select_column']).', status, parent FROM '.$datasetTable.' WHERE status = 1 AND ('.implode(' AND ',$where).')');
            $model = new Dataset;
            $model->dataset_table = 'ocrm_'.$tableName;
            $model->dataset_name = $request->name;
            $model->dataset_file = '';
            $model->dataset_file_name = '';
            $model->user_id = Auth::guard('org')->user()->id;
            $model->uploaded_by = Auth::guard('org')->user()->name;
            $model->save();
            Session::flash('success','Subset created successfully!!');
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        /*$tableName = DB::getTablePrefix().get_organization_id().'_data_table_'.time();
         DB::select('CREATE TABLE '.$tableName.' AS SELECT '.implode(',',$filterDara['select_column']).', status, parent FROM '.$datasetTable.' WHERE status = 1 AND ('.implode(' AND ',$where).')');
        DB::select("ALTER TABLE `{$tableName}` ADD `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID' FIRST");*/
        return back();
    }

    public function validateDataset(Request $request, $id){
        $dataset = Dataset::find($id);
        $definedColumns = $dataset->defined_columns;
        if($definedColumns != ''){
            $definedColumns = json_decode($definedColumns,true);
        }
        $errorInfo = [];
        $datasetTable = Dataset::find($id)->dataset_table;
        $headers = DB::table(str_replace('ocrm_','',$datasetTable))->where('id',1)->first();
        $records = DB::table(str_replace('ocrm_', '', $datasetTable))->where('id','!=',1)->where('status' , 1)->paginate(50);
        $recordsArray = [];
        $row = 1;
        if($definedColumns != ''){
            foreach($records as $key => $record){
                $col = 1;
                $columnsArray = [];
                $record = collect($record)->except(['id','status','parent'])->toArray();
                foreach ($record as $colKey => $columnValue) {
                    $testData = preg_match($definedColumns[$colKey], $columnValue);
                    if($testData){
                        $columnsArray[$colKey] = $columnValue;
                    }else{
                        $errorInfo[] = ['row'=>$row,'col'=>$colKey];
                        $columnsArray[$colKey] = '<span class="dataset-validate-error">'.$columnValue.'</span>';
                    }
                    $col++;
                }
                $recordsArray[] = $columnsArray;
                $row++;
            }
        }
        
        $errors = collect($errorInfo)->groupBy('row')->toArray();
        return view('organization.dataset.validate',['headers'=>$headers,'records'=>$recordsArray,'errors'=>$errors,'paginate'=>$records,'dataset'=>$dataset]);
    }
     public function visualizeDataset($dataset_id){
        $model = Dataset::find($dataset_id);
        $visualize = Visualization::where('dataset_id',$dataset_id)->get();
        return view('organization.dataset.visualize',['dataset'=>$model,'visualizations'=>$visualize]);
    }
     public function collaborateDataset()
    {
        return view('organization.dataset.collaborate');
    }
    public function customizeDataset()
    {
        return view('organization.dataset.customize');
    }

    public function updateDataset(Request $request)
    {
        $dataset_id = $request['dataset_id'];
        $model = Dataset::find($dataset_id);
        
        $dataset_table_name = $model['dataset_table'];
        $dataset_table_array = explode('_',$dataset_table_name);
        unset($dataset_table_array[0]);
        $dataset_table = implode('_',$dataset_table_array);

        $select = DB::table($dataset_table)->where('id',$request['id'])->get();
        $copyData = [];
        foreach ($select as $key => $value) {
            foreach ($value as $k => $v) {
                $data[$k] = $v;
            }
        }
        $data['status'] = 0;
        $data['parent'] = $request['id'];
        unset($data['id']);
        $allData = $request->all();
        $newData = [];
        foreach ($allData as $key => $value) {
            if($key != '_token' && $key != 'dataset_id' && $key != 'id' && $key != 'update_data'){
                $newData[$key] = $value;
            }
        }
        $insertClone = DB::table($dataset_table)->insert($data);
        $update = DB::table($dataset_table)->where('id',$request['id'])->update($newData);
        return back();
    }
    public function deleteDatasetRecord($id , $record_id)
    {
        $model = Dataset::find($id);
        $dataset_table_name = $model['dataset_table'];
        $dataset_table_array = explode('_',$dataset_table_name);
        unset($dataset_table_array[0]);
        $dataset_table = implode('_',$dataset_table_array);

        $update = DB::table($dataset_table)->where('id',$record_id)->update(['status' => 0]);
        return back();
    }
    public function ViewHistoryRecord($id , $record_id)
    {
        $model = Dataset::find($id);
        $dataset_table_name = $model['dataset_table'];
        $dataset_table_array = explode('_',$dataset_table_name);
        unset($dataset_table_array[0]);
        $dataset_table = implode('_',$dataset_table_array);

            $history = DB::table($dataset_table)->where('parent',$record_id)->get();
            return $history;
    }

    public function exportDataset($id,$type){
        $model = Dataset::find($id);
        $table_name = str_replace('ocrm_','',$model->dataset_table);
        if(Schema::hasTable($table_name))
        {
            $name  =  str_replace(" ","-", $model->dataset_name); 
            $datas =   DB::table($table_name)->get()->toArray();
            $model =   json_decode(json_encode($datas),true);
            
            $headers = $model[0];

            foreach ($model as $key =>  $value) {

                  $model[$key] = array_combine($headers, $value);
                  unset($model[$key][1]);
                  unset($model[0]);
              }
            Excel::create($name, function($excel) use($model) {
                $excel->sheet('Sheetname', function($sheet) use($model) {
                $sheet->fromArray($model);
                });
            })->store($type);
            $path = storage_path('exports/'.$name.'.'.$type);
            return response()->download($path,$name.'.'.$type,['Content-Type: text/cvs']);
        }
    }

    public function creaetClone($datasetId){

        $model = Dataset::where('id',$datasetId)->first();
        $orgID = get_organization_id();
        $newTableName = 'ocrm_'.$orgID.'_data_table_'.time();
        DB::select('CREATE TABLE '.$newTableName.' as SELECT * FROM `'.$model->dataset_table.'`');
        DB::select('ALTER TABLE '.$newTableName.' MODIFY `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY');

        DB::select('CREATE TABLE cloning_dataset as SELECT * FROM `ocrm_'.$orgID.'_datasets` WHERE id = '.$datasetId);
        DB::update('UPDATE cloning_dataset SET dataset_table = "'.$newTableName.'"');

        $newSurveyID = DB::select('SELECT MAX(id) maxId FROM `ocrm_'.$orgID.'_datasets`');
        $newSurveyID = $newSurveyID[0]->maxId + 1;
        DB::update('UPDATE cloning_dataset SET id = '.$newSurveyID);
        DB::select('INSERT into `ocrm_'.$orgID.'_datasets` SELECT * FROM cloning_dataset');
        DB::select('DROP TABLE cloning_dataset');
        return back();
    }
   
}
