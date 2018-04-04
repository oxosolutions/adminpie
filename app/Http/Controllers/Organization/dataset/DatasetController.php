<?php

namespace App\Http\Controllers\Organization\Dataset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Dataset;
use App\Model\Organization\DatasetMeta;
use Session;
use File;
use DB;
use MySQLWrapper;
use Excel;
use Auth;
use App\Model\Organization\UsersMeta;
use Illuminate\Support\Facades\Schema;
use App\Model\Organization\Visualization;
use App\Model\Organization\Collaborator;
use App\Model\Admin\GlobalOrganization;
class DatasetController extends Controller
{

    protected $GoogleSpreadsheet = 'https://docs.google.com/spreadsheet/pub?key=<sheetCode>&single=true&gid=<gridid>&output=csv';

   /**
     * apiDataset
     * @param  Request $request [posted data]
     * @return [route]           [will redirect back]
     by paljinder Singh, rahul
     */
     protected function get_columns($data){
        $columns =null;
        foreach ($data as $key => $value) {
            if(!empty($value['children'])){
                if(!empty($this->get_columns($value['children']))){
                    $another  = $this->get_columns($value['children']);
                    for($i =0; $i < count($another); $i++){
                        $columns[] = $another[$i];
                    }
                }
            }else{
                if(!empty($value['blank'])){
                }else{
                    $columns[] = $value['id'];
                }
            }
        } 
        return $columns;
        // static $columns = [];
        // foreach($data as $fieldKey => $field){
        //     if(!array_key_exists('blank',$field)){
        //         if(array_key_exists('children',$field)){
        //             $columns[] = $field['id'];
        //             $columns = $this->get_columns($field['children']);
        //         }else{
        //             $columns[] = $field['id'];
        //         }
        //     }else{
        //         if(array_key_exists('children',$field)){
        //             $columns = $this->get_columns($field['children']);
        //         }
        //     }
        // }
        // return $columns;
     }

     /*
     $columns =null;
        foreach ($data as $key => $value) {
            if(isset($value['children'])){
                if(!empty($this->get_columns($value['children']))){
                    $another  = $this->get_columns($value['children']);
                    for($i =0; $i < count($another); $i++){
                        $columns[] = $another[$i];
                    }
                }
            }else{
                if(isset($value['blank'])){
                }else{
                    $columns[] = $value['id'];
                }
            }
        } 
         return $columns;
      */

     protected function dataset_table_column($dataset_table){
        $check_columns =   DB::table($dataset_table);
        if($check_columns->exists()) {
           $columns =  (array)$check_columns->first();
           if(isset($columns['id'])){
            unset($columns['id'], $columns['status'] ,$columns['parent'] );
           }
        return $columns;
        }
        return null;
    }

    public function apiDataset($id , Request $request)
    {
        if(!$this->validateUser($id)){
            return redirect()->route('list.dataset');
        }
        $data['id'] = $id;
        $data_set = Dataset::where('id', $id)->first();
        $table_name = str_replace('ocrm_','',$data_set->dataset_table);
        if(Schema::hasTable($table_name)==false){
            Session::flash('warning','<i class="fa fa-exclamation-triangle"></i> Dataset Table does not exist!');
            return redirect()->route('list.dataset');
        }
        if(!empty($data_set->dataset_table)){
            $dataset_table = str_replace('ocrm_', '', $data_set->dataset_table);
            $meta_fields = get_meta('Organization\DatasetMeta',$id, $key = 'api_fields', $column = 'dataset_id', $array = true);
            $data['columns'] = $this->dataset_table_column($dataset_table);
            $go  = GlobalOrganization::find(get_organization_id());
            $organization_slug = $go->slug;
            $active_code =  $go->active_code;
            $token = get_meta('Organization\DatasetMeta',$id, $key = 'token', $column = 'dataset_id', $array = false); 

            if($meta_fields){
                $data['meta_fields']   =  json_decode($meta_fields,true);
                
                $select_fields = $this->get_columns($data['meta_fields']);


                $result =  $this->api_data_result($select_fields, $dataset_table);
                $res = $this->manipulation_data($result, $data['meta_fields'], $data);
                $data['response'] = response()->json($res);
                $data['link'] = url('/api/dataset/'.$active_code.'/'.$token);
               // $data['res'] = $this->api_response('123456',$token );
            }

            if(!empty($data['columns'])) {
                if($request->isMethod('post')){
                    $fields = json_decode($request->data, true);
                    if(empty($fields)){
                        $data['error'] = 'Fields not set to build api.';
                        return $data;
                    }
                    $sel_fields =  $this->get_columns($fields);
                    http_response_code(500);
                    // dd($fields);
                     // dd($fields , $sel_fields);
                   
                    if(!$token){
                        update_meta('App\Model\Organization\DatasetMeta', ['token'=>str_random(25)], ['dataset_id'=>$id], false);
                        $token = get_meta('Organization\DatasetMeta',$id, $key = 'token', $column = 'dataset_id', $array = false);
                    }
                    update_meta('App\Model\Organization\DatasetMeta', ['api_fields'=>json_encode($fields)], ['dataset_id'=>$id]);
                    $result =  $this->api_data_result($sel_fields, $dataset_table);
                    $res = $this->manipulation_data($result, $fields, $data);

                    $data['response'] = json_encode($res);
                    $go  = GlobalOrganization::find(get_organization_id());
                    $organization_slug = $go->slug;
                    $active_code =  $go->active_code;
                    $data['link'] = url('/api/dataset/'.$active_code.'/'.$token);
                    return $data;
                }

            }else{
                 Session::flash('warning','<i class="fa fa-exclamation-triangle"></i> Dataset table columns does not exist!');
                return redirect()->route('list.dataset');
            }
        }else{
              Session::flash('warning','<i class="fa fa-exclamation-triangle"></i> Dataset table empty!');
            return redirect()->route('list.dataset');
        }
        return view('organization.dataset.api', compact('data'));
    }
    protected function api_data_set($query_data , $field_value, $column , $next_column_name=null){
        $new = [];
         
         if(array_key_exists('blank', $field_value)) {
            // if(!empty($next_column_name)){
                $new[] = $this->api_data_set($query_data, $field_value['children'],  $column, $field_value['id']);
            // }else{
            //     $new[$field_value['id']] = $this->api_data_set($query_data, $field_value['children'],  $column);
            // }
           
         }elseif(array_key_exists('children', $field_value)){
            // if(!empty(@$blank)){
            //     $new[$blank][$column[$field_value['id']]] = $this->api_data_set($query_data, $field_value['children'],  $column);
            // }else{
           
                $new[] = $this->api_data_set($query_data, $field_value['children'],  $column, $column[$field_value['id']]);
            // }
         }else{

            foreach($field_value as $key => $value){
                $new[$column[$value['id']]] = $query_data[$value['id']];
            }
            
         }

          if(!empty($next_column_name)){
            $new[$next_column_name] = $new;
          }

         return $new;
    }

    protected function check_child($field_val){
        if(!empty($field_val['children']) ){
            return True;
        }
        return False;
    }   

    protected function set_datas($query_data, $fields, $columns , $new_key=null){
        $data = [];
        if($this->check_child($fields)){
                foreach ($fields['children'] as $nextKey =>$nextValue) {
                   if($this->check_child($nextValue)){
                    $new = $nextValue['id'];
                    if(!empty($columns[$nextValue['id']])){
                            $new = $columns[$nextValue['id']];
                    }
                           
                            $data[$new_key] = $this->set_datas($query_data, $nextValue, $columns , $new);

                        // $data[$nextValue['id']] = $this->set_datas($query_data, $fields, $columns , $nextValue['id']);
                   }else{
                    $col_name = $nextValue['id'];
                    if(!empty($columns[$nextValue['id']])){
                        $col_name = $columns[$nextValue['id']];
                    }
                    $data[$new_key][$col_name] =  $query_data[$nextValue['id']];

                    // foreach($nextValue as $key => $value){
                    //     if(!empty($new_key)){
                    //         $data[$new_key][$columns[$value['id']]] = $query_data[$value['id']];
                    //     }
                    // }

                   }
                }
            }
            // else{
            //     foreach($fields as $key => $value){
            //         if(!empty($new_key)){
            //             $data[$new_key][$columns[$value['id']]] = $query_data[$value['id']];
            //         }
            //     }
            // }
            
            return $data;
    } 
    protected function manipulation_data($query_data, $fields, $data){
        http_response_code(500);
       
        foreach (json_decode($query_data, true) as $rKey => $rValue) {
            foreach ($fields as $fKey => $fValue) {
                // $res[$rKey] = $set_data = $this->api_data_set($rValue, $fValue, $data['columns']);
               
                
                if(empty($fValue['children']) && empty($fValue['blank'])) {
                    $col_val = $data['columns'][$fValue['id']];
                    $res[$rKey][$col_val] =  $rValue[$fValue['id']];
                }elseif(!empty($fValue['children']) ) {
                   $col = $fValue['id'];
                    if(!empty($data['columns'][$fValue['id']])){
                       $col = $data['columns'][$fValue['id']];
                    }

                   foreach ($fValue['children'] as $cKey =>$cValue) {
                        if($this->check_child($cValue)) {
                            $children = $cValue['id'];
                            if(!empty($data['columns'][$cValue['id']])){
                                $children = $data['columns'][$cValue['id']];
                            }
                            $res[$rKey][$col] = $d = $this->set_datas($rValue, $cValue, $data['columns'] , $children);
                           // dd($d);
                        }else{
                            $child_col = @$data['columns'][$cValue['id']];
                           $res[$rKey][$col][$child_col] = @$rValue[$cValue['id']];
                        }
                        // if($this->check_child($cValue)){
                        //     @$child_col = $data['columns'][$cValue['id']];
                        //        $res[$rKey][$col][@$child_col] =  $this->set_datas($rValue, $cValue ,$data['columns'] , @$child_col );
                        // // if(isset($cValue['children']) && !isset($cValue['blank'])) {
                        // //         foreach ($cValue['children'] as $nextKey =>$nextValue) {
                        // //             $next_child_col = $data['columns'][$nextValue['id']];
                        // //             $res[$rKey][$col][$child_col][$next_child_col] = $rValue[$nextValue['id']];
                        // //         }
                        // }else{
                        //     $res[$rKey][$col][$child_col] = $rValue[$cValue['id']];
                        // }
                    }
                }
                // elseif(isset($fValue['children']) && isset($fValue['blank'])){
                //    $col = $fValue['id'];
                //    foreach ($fValue['children'] as $cKey =>$cValue) {
                //         $child_col = $data['columns'][$cValue['id']];
                //         $res[$rKey][$col][$child_col] = $rValue[$cValue['id']];
                //     }
                // }
            }
           
        }
       
    return $res; 

        // $preparedData = [];
        // foreach (json_decode($query_data, true) as $rKey => $datasetData) {
        //     foreach ($fields as $fieldKey => $field) {
        //         $preparedData[] = $this->recursiveData($datasetData,$field);
        //     }
        // }
        // return $preparedData;
    }

    protected function recursiveData($datasetData,$field, $prepareField = []){
        
        if(!array_key_exists('blank',$field)){
            try{
                $prepareField[$field[0]['id']] = $datasetData[$field[0]['id']];
            }catch(\Exception $e){
                $prepareField[$field['id']] = $datasetData[$field['id']];
            }
            if(array_key_exists('children',$field)){

                array_push($prepareField, $this->recursiveData($datasetData,$field['children'],$prepareField));
            }
        }else{
            if(array_key_exists('children',$field)){
                foreach($field['children'] as $cKey => $children){
                    $prepareField[$field['id']][] = $this->recursiveData($datasetData,$children,$prepareField);
                }
            }else{
                try{
                    $prepareField[$field[0]['id']] = $datasetData[$field[0]['id']];
                }catch(\Exception $e){
                    $prepareField[$field['id']] = $field['id'];
                }
            }
        }
        return $prepareField;
    }
    /*
    foreach (json_decode($query_data, true) as $rKey => $rValue) {
        foreach ($fields as $fKey => $fValue) {
            if(!isset($fValue['children']) && !isset($fValue['blank'])) {
                $col_val = $data['columns'][$fValue['id']];
                $res[$rKey][$col_val] =  $rValue[$fValue['id']];
            }elseif(isset($fValue['children']) && !isset($fValue['blank'])){
               $col = $data['columns'][$fValue['id']];
              
               foreach ($fValue['children'] as $cKey =>$cValue) {
                    $child_col = $data['columns'][$cValue['id']];
                    $res[$rKey][$col][$child_col] = $rValue[$cValue['id']];
                }
            }elseif(isset($fValue['children']) && isset($fValue['blank'])){
               $col = $fValue['id'];
               foreach ($fValue['children'] as $cKey =>$cValue) {
                    $child_col = $data['columns'][$cValue['id']];
                    $res[$rKey][$col][$child_col] = $rValue[$cValue['id']];
                }
            }
        }
    }
    return $res; 
     */

     protected function api_data_result($fields , $dataset_table){
        $data =  DB::table($dataset_table)->select($fields)->where('status',1);
        if($data->exists()){
            return $data->take(5)->get()->toJson();
        }
        return null;
     }
/**
     * apiDataset
     * @param  Request $request [posted data]
     * @return [route]           [will redirect back]
     paljinder Singh
     */
     public function api_response($active_code, $token ){
        $check = GlobalOrganization::select('id')->where('active_code',$active_code);
        if($check->exists()){
          Session::put('organization_id',$check->first()->id);
        }
        $token = DatasetMeta::where(['key'=>'token' ,'value'=>$token]);
        if($token->exists()){
            $dataset_id = $token->first()->dataset_id;
            $get_fields = get_meta('Organization\DatasetMeta',$dataset_id, $key = 'api_fields', $column = 'dataset_id', $array = false);
            $fields =json_decode($get_fields,true);
        }
        $sel_fields = $this->get_columns($fields);
        $data_set = Dataset::where('id',$dataset_id)->first();
        if(!empty($data_set->dataset_table)){
            $dataset_table = str_replace('ocrm_', '', $data_set->dataset_table);
            $data['columns'] = $this->dataset_table_column($dataset_table);
            $result = DB::table($dataset_table)->select($sel_fields)->where('status',1)->get();
            $res = $this->manipulation_data($result , $fields,  $data);
            return response()->json($res); 
        }
        return null;
     }
// PALJINDER SINGH CODE END HERE.
	protected function validateUser($id, $collaborate = false){
		$user_id = Auth::guard('org')->user()->id;
		$model = Dataset::with(['collaborate','dataset_meta'])->find($id);
        if($model == null){
            Session::flash('warning','<i class="fa fa-exclamation-triangle"></i> Dataset id does not exist!');
            return false;
        }
		if($model->user_id != $user_id){
            if($collaborate == false){
                $share_status = $model->dataset_meta->where('key','share_status')->first();
                if($share_status != null){
                    if($share_status->value == 'public'){
                        return true;
                    }
                }
            }
			return false;
		}else{
			return true;
		}
	}

    public function importDataset(){
        return view('organization.dataset.import');
    }
   

    public function listDataset(Request $request){
    	$user_id = Auth::guard('org')->user()->id;
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
            $perPage = get_items_per_page();
          }
        $sortedBy = @$request->orderby;
        $order = $request->order;
        if($request->orderby == null || $request->orderby == ''){
          $sortedBy = 'created_at';
          $order = 'desc';
        }
        if($request->has('search')){
            if($sortedBy != ''){
                $datasetList = Dataset::where('dataset_name','like','%'.$request->search.'%')->where('user_id',$user_id)->orderBy($sortedBy,$order)->paginate($perPage);
            }else{
                $datasetList = Dataset::where('dataset_name','like','%'.$request->search.'%')->where('user_id',$user_id)->paginate($perPage);

            }
        }else{
            // where('user_id',$user_id)
            if($sortedBy != ''){
                $datasetList = Dataset::with(['dataset_meta'])->whereHas('dataset_meta', function($query){
                    $query->where('key','share_status')->where('value','=','public')->where('value','!=','only_me');
                })->orwhereHas('collaborate', function($query){
                    $query->whereHas('dataset_meta', function($query){
                        $query->where('key','share_status')->where('value','=','public')->where('value','!=','only_me')->orWhere('value','specific');
                    });
                })->orWhere('user_id',$user_id)->orderBy($sortedBy,$order)->paginate($perPage);
                
            }else{
                $datasetList = Dataset::with(['dataset_meta'])->whereHas('dataset_meta', function($query){
                        $query->where('key','share_status')->where('value','=','public')->where('value','!=','only_me');
                    })->orwhereHas('collaborate', function($query){
                        $query->whereHas('dataset_meta', function($query){
                            $query->where('key','share_status')->where('value','=','public')->where('value','!=','only_me')->orWhere('value','specific');
                        });
                    })->orWhere('user_id',$user_id)->orderBy($sortedBy,$order)->paginate($perPage);
            }

        }

        $dataset =  [
                        'datalist'=>$datasetList,
                        'showColumns' => ['dataset_name'=>'Title','dataset_table'=>'Dataset Table','description'=>'Description','created_at'=>'Created'],
                        'actions' => [
                                        'view'=>['route'=>'view.dataset','title'=>'View'],
                                        'edit'=>['route'=>'edit.dataset','title'=>'Edit'],
                                        'structure'=>['route'=>'structure.dataset','title'=>'Structure'],
                                        // 'define'=>['route'=>'define.dataset','title'=>'Define'],
                                        'filter'=>['route'=>'filter.dataset','title'=>'Filter'],
                                        // 'api'=>['route'=>'api.dataset','title'=>'API'],
                                        'validate'=>['route'=>'validate.dataset','title'=>'Validate'],
                                        // 'visualize'=>['route'=>'visualize.dataset','title'=>'Visualization'],
                                        'operations'=>['route'=>'options.dataset','title'=>'Operations'],
                                        'collaborate'=>['route'=>'collaborate.dataset','title'=>'Collaborate'],
                                        'customize'=>['route'=>'customize.dataset','title'=>'Customize'],
                                        'delete'=>['route'=>'delete.dataset','title'=>'Delete','class'=>'red']
                                    ]
                    ];
    	return view('organization.dataset.list',$dataset);
    }


    protected function validateImportDatasetRequest($request){
        $rules = [
            'add_replace' => 'required',
            'import_source' => 'required'
        ];
        if($request->add_replace == 'new'){
            $rules['datasetname'] = 'required';
        }
        if($request->add_replace == 'append' || $request->add_replace == 'replace'){
            $rules['replace_or_append'] = 'required';
        }
        if($request->import_source == 'file'){
            $request->request->add(['extension'=>strtolower($request->file->getClientOriginalExtension())]);
            $rules['file'] = 'required';
            $rules['extension'] = 'required|in:csv,xlsx,xls';
            if(!in_array(strtolower($request->file->getClientOriginalExtension()),['csv','xlsx','xls'])){
                Session::flash('error','Uploaded dataset file should be type of: csv,xlsx,xls');
            }
        }
        if($request->import_source == 'url'){
            $rules['url'] = 'required|url';
        }
        if($request->import_source == 'from_survey'){
            $rules['select_survey'] = 'required';
        }
        if($request->import_source == 'file_on_server'){
            $rules['file_path'] = 'required';
        }
        if($request->import_source == 'from_api'){
            $rules['api_url'] = 'required';
        }
        if($request->import_source == 'google'){
            $rules['uri'] = 'required';
            $rules['grid_id'] = 'required';
        }
        $this->validate($request,$rules);
    }

    public function uploadDataset(Request $request){
        if($request['import_source'] == 'file'){
            $rule = [
                        'file' => 'required'
                    ];
            $this->validate($request , $rule);
        }
        $this->validateImportDatasetRequest($request);
        $organization_id = get_organization_id();
        $filePath = upload_path('dataset_import_files');
        DB::beginTransaction();
        
        try{
            switch($request->import_source){

                case'file':
                    $fileExt = $request->extension;
                    $filename = date('Y-m-d-H-i-s')."-".$request->file('file')->getClientOriginalName();
                    $request->file('file')->move($filePath, $filename);
                    switch($request->add_replace){
                        case'new':
                            $dataset_id = $this->insertNewDatasetRecord($request,$filePath,$filename);
                            $fileimportStatus = $this->processFileImport($filePath,$filename,$fileExt,$dataset_id);
                        break;
                        case'append':
                            $dataset_id = $this->appendDataset($request,$fileExt,$filename,$filePath);
                        break;
                        case'replace':
                            $dataset_id = $this->replaceDataset($request,$fileExt,$filename,$filePath);
                        break;
                    }
                    
                break;

                case'file_on_server':
                case'url':
                case'google':
                case'from_api':
                    if($request->import_source == 'file_on_server'){
                        $filename = explode('/',$request->file_path);
                        //$dowunloadLink = $filename;
                        $dowunloadLink = $request->file_path;
                    }elseif($request->import_source == 'google'){
                        $prepareGoogleSheetResult = $this->prepareCSVFromGoogleSpreadSheet($request,$filePath);
                        if(!$prepareGoogleSheetResult){
                            return back();
                        }
                        $filename =explode('/',$filePath.'/google_spread_sheet.csv');
                        $dowunloadLink = $filePath.'/'.'google_spread_sheet.csv';

                    }elseif($request->import_source == 'from_api'){

                        $prepareApiResult = $this->prepareApiResponseToCSV($request,$filePath);
                        $filename = explode('/',$filePath.'api_dataset_file.csv');
                        $dowunloadLink = $filePath.'/'.'api_dataset_file.csv';
                    }else{
                        $filename = explode('/',$request->url);
                        $dowunloadLink = $request->url;
                    }
                    $filename = $filename[count($filename)-1];
                    $newFilename = 'downloaded_dataset_'.time().'.'.File::extension($filename);
                    $fileExt = File::extension($filename);
                    copy($dowunloadLink, $filePath.'/'.$newFilename);
                    switch($request->add_replace){
                        case'new':
                            $dataset_id = $this->insertNewDatasetRecord($request,$filePath,$newFilename);
                            $fileimportStatus = $this->processFileImport($filePath,$newFilename,$fileExt,$dataset_id);
                        break;
                        case'append':
                            $dataset_id = $this->appendDataset($request,$fileExt,$newFilename,$filePath);
                        break;
                        case'replace':
                            $dataset_id = $this->replaceDataset($request,$fileExt,$newFilename,$filePath);
                        break;
                    }
                    
                break;
                case'from_survey':
                    switch($request->add_replace){
                        case'new':
                            $filePath = 'from_survey';
                            $newFilename = 'survey';
                            $dataset_id = $this->insertNewDatasetRecord($request,$filePath,$newFilename);
                            $fileimportStatus = $this->processSurveyToDataset($request->select_survey,$dataset_id);
                            if(!$fileimportStatus){
                                DB::rollback();
                                Session::flash('error','No survey results found!');
                                return back();
                            }
                        break;
                        case'append':
                            $dataset_id = $this->appendSurveyDataset($request);
                            if($dataset_id == false){
                                Session::flash('error','Columns are not same ');
                                return back();
                            }
                        break;
                        case'replace':
                            $dataset_id = $this->replaceSurveyDataset($request);
                        break;
                    }
                break;

            }
            DB::commit();
            Session::flash('success','Successfully imported!');
            return redirect()->route('view.dataset',$dataset_id);
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        
    }

    protected function prepareApiResponseToCSV($request,$filePath){
        $api_url = $request->api_url;
        $content = file_get_contents($api_url);
        if(json_decode($content,true) != null){
            $arrayData = json_decode($content,true);
            $result = $this->getRecursiveApiData($arrayData);
            Excel::create('api_dataset_file',function($excel) use ($result){
                $excel->sheet('Sheetname', function($sheet) use ($result){
                    $sheet->fromArray($result);
                });
            })->store('csv',$filePath);
        }
        return true;
    }

    protected function getRecursiveApiData($arrays, $index = 0){
        static $simpleArray = [];
        foreach($arrays as $key => $array){
            if(is_array($array)){
                foreach ($array as $inKey => $elements) {
                    if(is_array($elements)){
                        $this->getRecursiveApiData($elements,$index);
                    }else{
                        $simpleArray[$index][$inKey] = $elements;
                    }
                }
            }else{
                $simpleArray[$index][$key] = $array;
            }
            $index++;
        }
        return array_values($simpleArray);
    }

    protected function prepareCSVFromGoogleSpreadSheet($request, $filePath){
        $link = str_replace('<sheetCode>',$request->uri,$this->GoogleSpreadsheet);
        $link = str_replace('<gridid>',$request->grid_id,$link);
        $spreadsheet_data = [];
        if (($handle = fopen($link, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000000, ",")) !== FALSE) {
                if(empty($data) || $data[0] == null){ // in case if there is no data or un-published sheet
                    Session::flash('error','Unable to access google sheet!');
                    return false;
                }
                $spreadsheet_data[] = $data;
            }
            fclose($handle);
        }
        Excel::create('google_spread_sheet',function($excel) use ($spreadsheet_data){
            $excel->sheet('Sheetname', function($sheet) use ($spreadsheet_data) {
                    $sheet->fromArray($spreadsheet_data,null,'A1',false,false);
                });
        })->store('csv',$filePath);
        return true;
    }

    protected function processSurveyToDataset($survey_id,$dataset_id){

        $prefix = DB::getTablePrefix();
        $organization_id = get_organization_id();
        $surveyTable = $prefix.$organization_id.'_survey_results_'.$survey_id;
        $tableExists = Schema::hasTable($organization_id.'_survey_results_'.$survey_id);
        if($tableExists){
            $datasetTable = $prefix.$organization_id.'_data_table_'.$dataset_id;
            $datasetTableWithoutPrefix = $organization_id.'_data_table_'.$dataset_id;
            $describeTable = DB::select("DESCRIBE ".$surveyTable);
            $columnsArray = [];
            $headers = [];
            $index = 0;
            $columnsArray[] = "id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID'";
            foreach($describeTable as $key => $column){
                if($index != 0){
                    $headers['column_'.$index] = $column->Field;
                    $columnsArray[] = 'column_'.$index.' text NULL';
                }
                $index++;
            }
            $columnsArray[] = "status varchar(200) DEFAULT '1'";
            $columnsArray[] = "parent varchar(200) DEFAULT '0'";
            
            $surveyData = DB::table(str_replace($prefix,'',$surveyTable))->get()->toArray();
            $recordsArray = [];
            foreach($surveyData as $key => $value){
                unset($value->id);
                $recordsArray[] = array_combine(array_keys($headers), (array)$value);
            }
            $headers['status'] = 'status';
            $headers['parent'] = 'parent';
            $createDatsetTable = DB::statement("CREATE TABLE IF NOT EXISTS ".$datasetTable."(".implode(',',$columnsArray).")");
            $insertHeaders = DB::table($datasetTableWithoutPrefix)->insert($headers);
            $insertRecords = DB::table($datasetTableWithoutPrefix)->insert($recordsArray);
            $this->updateDatsetFileName($datasetTable,$dataset_id);
            return true;
        }else{
            return false;
        }

    }

    protected function appendSurveyDataset($request){

        $prefix = DB::getTablePrefix();
        $organization_id = get_organization_id();
        $datasetTableWithoutPrefix =$organization_id.'_data_table_'.$request->replace_or_append;
        $datasetTable = $prefix.$datasetTableWithoutPrefix;
        $surveyTableWithoutPrefix = $organization_id.'_survey_results_'.$request->select_survey;
        $surveyTable = $prefix.$surveyTableWithoutPrefix;
        $describeSurveyTable = DB::select("DESCRIBE ".$surveyTable);
        $surveyHeaders = [];
        foreach($describeSurveyTable as $key => $column){
            if($column->Field != 'id'){
                $surveyHeaders[] = $column->Field;
            }
        }
        $datasetTableHeaders = (array)DB::table($datasetTableWithoutPrefix)->first();
        unset($datasetTableHeaders['id']);
        unset($datasetTableHeaders['status']);
        unset($datasetTableHeaders['parent']);
        $datasetColumns = $datasetTableHeaders;
        $datasetTableHeaders = array_values($datasetTableHeaders);
        if($surveyHeaders == $datasetTableHeaders){

            $recordsToInsert = [];
            $surveyDataRecords = DB::table($surveyTableWithoutPrefix)->get();
            foreach($surveyDataRecords as $key => $record){
                $record = (array)$record;
                unset($record['id']);
                $recordsToInsert[] = array_combine(array_keys($datasetColumns), array_values($record));
            }
            DB::table($datasetTableWithoutPrefix)->insert($recordsToInsert);
            return $request->replace_or_append;
        }else{
            return false;
        }
    }

    protected function replaceSurveyDataset($request){
        $survey_id = $request->select_survey;
        $dataset_id = $request->replace_or_append;
        $prefix = DB::getTablePrefix();
        $organization_id = get_organization_id();
        DB::statement('DROP TABLE '.$prefix.$organization_id.'_data_table_'.$dataset_id);
        $this->processSurveyToDataset($survey_id,$dataset_id);
        return $dataset_id;
    }

    protected function appendDataset($request,$fileExt,$filename,$filePath){
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '3000000');
        $model = Dataset::find($request->replace_or_append);
        $prefix = DB::getTablePrefix();
        $oldTable = DB::table(str_replace($prefix,'',$model->dataset_table))->first();
        $oldTableColumns = (array)$oldTable;
        unset($oldTableColumns['id']);
        unset($oldTableColumns['status']);
        unset($oldTableColumns['parent']);
        switch($fileExt){
            case'xls':
            case'xlsx':
                $tableName = $this->processExcelFile($filePath, $filename, 'temp');
            break;

            case'csv':
                $tableName = $this->processCSVFile($filePath.'/'.$filename,'temp');
            break;
        }
        $newTableColumns = DB::table(str_replace($prefix, '', $tableName))->first();
        $newTableColumns = (array)$newTableColumns;
        unset($newTableColumns['id']);
        unset($newTableColumns['status']);
        unset($newTableColumns['parent']);
        $newTableColumns = preg_replace('/\s/', "", $newTableColumns );
        $oldTableColumns = preg_replace('/\s/', "", $oldTableColumns );
        if(array_values($oldTableColumns) != array_values($newTableColumns)){
            DB::statement("DROP TABLE ".$tableName);
            Session::flash('error','Columns of new file not mached with old dataset!');
            return $model->id; // having dataset id
        }else{
            $newTableColumns = implode(',',array_keys($newTableColumns));
            $oldTableColumns = implode(',',array_keys($oldTableColumns));
            DB::select('INSERT INTO `'.$model->dataset_table.'` ('.$oldTableColumns.') SELECT '.$newTableColumns.' FROM '.$tableName.' WHERE id != 1;');
            DB::statement("DROP TABLE ".$tableName);
            return $model->id;
        }
    }

    protected function replaceDataset($request, $ext, $filename, $filePath){
        ini_set('memory_limit', '2048M');
        $model = Dataset::find($request->replace_or_append);
        DB::select('RENAME TABLE '.$model->dataset_table.' TO '.$model->dataset_table.'_'.get_timestamp());
        $processDataset = $this->processFileImport($filePath,$filename,$ext,$model->id);
        return $model->id;
        
    }

    protected function processFileImport($filePath,$filename,$fileExt,$datasetId){

        $fullPath = $filePath.'/'.$filename;
        DB::beginTransaction();
        try{
            switch($fileExt){

                case'xls':
                case'xlsx':
                    $tableName = $this->processExcelFile($filePath,$filename,$datasetId);
                    $this->updateDatsetFileName($tableName,$datasetId);
                break;

                case'csv':
                    $tableName = $this->processCSVFile($fullPath,$datasetId);
                    $this->updateDatsetFileName($tableName,$datasetId);
                break;
            }
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
            throw new \Exception("Error Processing Request", 1);
            
        }
    }

    protected function processCSVFile($filePath,$datasetId){
        $organization_id = get_organization_id();
        $prefix = DB::getTablePrefix();
        DB::beginTransaction();
        try{
            ini_set('memory_limit', '2048M');
            ini_set('max_execution_time', '3000000');
            $tableName = $prefix.$organization_id."_data_table_".$datasetId;
            $model = new MySQLWrapper();
            $model->wrapper->createTableFromCSV($filePath,$tableName,',','"', '\\', 0, array(), 'generate','\r\n');
            DB::update('UPDATE '.$tableName.' SET status = 1, parent = 0 WHERE id != 1');
            DB::update('UPDATE '.$tableName.' SET status = "status", parent = "parent" WHERE id = 1');
            DB::commit();
            return $tableName;
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    protected function processExcelFile($filePath,$filename,$datasetId){
        DB::beginTransaction();
        try{
            ini_set('memory_limit', '2048M');
            ini_set('max_execution_time', '3000000');
            $csvFile = explode('.',$filename);
            $csvFileExt = $csvFile[count($csvFile)-1];
            unset($csvFile[count($csvFile)-1]);
            $withoutExtensionFileName = implode('.',$csvFile);
            Excel::load($filePath.'/'.$filename, function($file) {
            })->store('csv',$filePath);
            $tableName = $this->processCSVFile($filePath.'/'.$withoutExtensionFileName.'.csv',$datasetId);
            DB::commit();
            return $tableName;
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
            throw new \Exception("Error Processing Excel file", 1);
        }
    }

    protected function updateDatsetFileName($tableName,$datasetId){
        $model = Dataset::find($datasetId);
        $model->dataset_table = $tableName;
        $model->save();
        return true;
    }

    protected function createDatasetTable($datasetId,$columns){
        $organization_id = get_organization_id();
        $columnsToCreate = [];
        $headersToInsert = [];
        $columnsForInsertRecords = [];
        $colIndex = 1;
        $columnsToCreate[] = "id int(100) PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Row ID'";
        foreach ($columns as $key => $value) {
            $columnsToCreate[] = 'column_'.$colIndex.' TEXT NULL';
            $headersToInsert['column_'.$colIndex] = $key;
            $columnsForInsertRecords[] = 'column_'.$colIndex;
            $colIndex++;
        }
        $columnsToCreate[] = "status varchar(255) DEFAULT '1'";
        $columnsToCreate[] = "parent varchar(255) DEFAULT '0'";
        $prefix = DB::getTablePrefix();
        DB::beginTransaction();
        try{
            $tableName = $prefix.$organization_id."_data_table_".$datasetId;
            DB::statement("CREATE TABLE IF NOT EXISTS ".$tableName." ( " . implode(', ', $columnsToCreate) . " ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            DB::table(str_replace($prefix, '', $tableName))->insert($headersToInsert);
            DB::commit();
            return ['table'=>$tableName,'columns'=>$columnsForInsertRecords];
        }catch(\Exception $e){
            DB::rollback();
            throw new Exception("Error Creating Table", 1);
        }

    }

    /**
     * Insert new dataset record in dataset table
     * @param  [type] $request  having all the posted data
     * @param  [type] $filepath havinf uploaded dataset path
     * @param  [type] $filename having filename
     * @return [type]           will return record id
     */
    protected function insertNewDatasetRecord($request,$filepath,$filename){

        $model = new Dataset;
        $model->dataset_table = 'to_be_update_soon';
        $model->dataset_name = $request->datasetname;
        $model->dataset_file = $filepath.'/'.$filename;
        $model->dataset_file_name = $filename;
        $model->user_id = Auth::guard('org')->user()->id;
        $model->uploaded_by = Auth::guard('org')->user()->name;
        $model->save();
        $this->insertNewMetaDetails($request,$model->id);
        return $model->id;
    }


    protected function insertNewMetaDetails($request,$dataset_id){
        if(in_array($request->import_source,['from_survey','google','from_api','file','url','file_on_server'])){
            $exceptedArray = ['_token','add_replace','replace_or_append','datasetname','file'];
            foreach($request->except($exceptedArray) as $key => $field){
                $model = DatasetMeta::firstOrNew(['dataset_id'=>$dataset_id,'key'=>$key]);
                $model->dataset_id = $dataset_id;
                $model->key = $key;
                $model->value = $field;
                $model->save();
            }
        }
        return true;
    }


    protected function validateStoreRequest($request){

        $rules = [

            'dataset_name' => 'required',
            // 'dataset_description' => 'required'
        ];

        $this->validate($request, $rules);
    }

    /**
     * Save new dataset
     * @param  Request $request [posted data]
     * @return [route]           [will redirect back]
     */
    public function store(Request $request){

        $this->validateStoreRequest($request);
        try{
            $org_id =  Session::get('organization_id');
            $nextId = @Dataset::orderBy('id','desc')->first()->id + 1;
            $tableName = DB::getTablePrefix().$org_id.'_data_table_'.$nextId;
            $model = new Dataset;
            $model->id = $nextId;
            $model->dataset_name = $request->dataset_name;
            $model->description = ($request->dataset_description == null)?'':$request->dataset_description;
            $model->dataset_table = $tableName;
            $model->user_id = Auth::guard('org')->user()->id;
            $model->save();
            DB::select("CREATE TABLE `{$tableName}` ( id INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID', `status` VARCHAR(255) DEFAULT '1', `parent` VARCHAR(255) DEFAULT '0' ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            DB::table(str_replace('ocrm_','',$tableName))->insert(['status'=>'status','parent'=>'parent']);
            $newDatasetId = $model->id;
            Session::flash('success','Dataset created successfully!');
            
            return redirect()->route('view.dataset',$newDatasetId);
        }catch(\Exception $e){
            Session::flash('success','Unable to create dataset!');
            throw $e;
        }
    }
    public function viewDataset(Request $request, $id, $action, $record_id = null){

    	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
        $viewRecord = [];
        $history = [];
        $dataset = Dataset::with(['dataset_meta'])->find($id);
        $dataset_type = @get_meta_array($dataset->dataset_meta)['dataset_type'];
        $datasetTable = Dataset::find($id)->dataset_table;
        if(empty(Schema::hasTable($datasetTable))){
                $data['error'] = "Dataset table not exist."; 
            }
        try{
            $tableHeader = DB::table(str_replace('ocrm_', '', $datasetTable))->first();
            $records = DB::table(str_replace('ocrm_', '', $datasetTable))->where('id','!=',$tableHeader->id)->where('status' , 1)->paginate(100);
            if($action != null){
                if($action == 'view' || $action == 'edit'){
                    if($record_id != null){
                        $viewrecords = DB::table(str_replace('ocrm_', '', $datasetTable))->where('id',$record_id)->where('status' , 1)->first();
                        if($viewrecords != null){
                            $viewRecord = $viewrecords;
                        }else{
                            Session::flash('warning' , '<i class="fa fa-exclamation-triangle"></i> Record Does not exist!');
                            return redirect()->route('view.dataset',$id);
                        }
                    }
                }
                if($action == 'rivisions'){
                    if($record_id != null){
                        $history = $this->ViewHistoryRecord($id, $record_id);
                    }
                }
            }
        }catch(\Exception $e){
            $tableHeader = [];
            $dataset = [];
            $records = [];
            $viewRecord = [];
            $history = [];
        }
        return view('organization.dataset.view',['tableheaders'=>$tableHeader , 'dataset' => $dataset,'records'=>$records,'viewrecords'=>$viewRecord,'history'=>$history,'dataset_type'=>$dataset_type]);
    }

    public function createNewfunction(Request $request){
        
    }
    public function createDatasetRows(Request $request)
    {
        $datasetTable = Dataset::find($request['dataset_id'])->dataset_table;
        echo $datasetTable;
        $datasetHeaders = (array)DB::table(str_replace('ocrm_','',$datasetTable))->first();
        unset($datasetHeaders['id']);
        unset($datasetHeaders['status']);
        unset($datasetHeaders['parent']);

            $recordArray = array_combine(array_keys($datasetHeaders), $request->data);
            $recordArray['status'] = 1;
            DB::table(str_replace('ocrm_','',$datasetTable))->insert($recordArray);
    }
    public function updateRecords(Request $request, $id){
        http_response_code(500);
        $dataset = Dataset::find($id);
        $datasetHeaders = (array)DB::table(str_replace('ocrm_','',$dataset->dataset_table))->first();
        unset($datasetHeaders['status']);
        unset($datasetHeaders['parent']);
        foreach($request->records as $key => $record){
           
            $recordArray = array_combine(array_keys($datasetHeaders), $record);
            $isRecordExists = (array)DB::table(str_replace('ocrm_','',$dataset->dataset_table))->where('id',$recordArray['id'])->first();
            $lastInserted = (array)DB::table(str_replace('ocrm_','',$dataset->dataset_table))->orderby('id','desc')->first();
            $lastInsertedId = $lastInserted['id'];
            
            if($isRecordExists != null){
                $id = $isRecordExists['id'];
                unset($isRecordExists['id']);
                $isRecordExists['id'] = $lastInsertedId+1 ;

                /*********Code by : Amrit ***********/
                $isRecordExists['status'] = 0;
                $isRecordExists['parent'] = $recordArray['id'];
                /*********Code by : Amrit  END***********/

                DB::table(str_replace('ocrm_','',$dataset->dataset_table))->insert($isRecordExists);
                DB::table(str_replace('ocrm_','',$dataset->dataset_table))->where('id',$recordArray['id'])->update($recordArray);
            }else{
                DB::table(str_replace('ocrm_','',$dataset->dataset_table))->insert($recordArray);
            }
        }
    }

    
    /**
     * Replace columns headers with name form
     * formula
     *
     * @return array
     */
    protected function replaceColumnHeadersTokey(Array $columnsArray, $formula){
        $columnsDetected = [];
        $excelHeaderMap = array("A","B","C","D","E","F","G","H","I","J","k","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        $index = 0;
        unset($columnsArray['id']);
        foreach($columnsArray as $column => $header){
            if(!in_array($column,['status','parent'])){
                $formula = str_replace($header,$excelHeaderMap[$index].'$',$formula,$count);
                if($count > 0){
                    $columnsDetected[] = $column;
                    $index++;
                }

            }
        }
        return ['formula'=>$formula,'detected'=>$columnsDetected];
    }

    /**
     * Create Dataset Column function
     * @param  Request $request having posted data
     * @param  [type]  $id      integer type
     * @return [type]           will return back to same page
     */
    public function createColumn(Request $request, $id){

        $this->validateRequiredColumns($request);
        $datasetTable = Dataset::find($id)->dataset_table;
        $columnName = 'column_'.rand(111,999);
        $compareDataset = $request->select_dataset;
        $compareFrom_datasetTable = $request->select_column;
        $compareWith_compareDataset = $request->dataset_column;
        $fillValueWith_compareDataset = $request->replace_with;
        DB::beginTransaction();
        try{
            DB::select('ALTER TABLE '.$datasetTable.' ADD COLUMN `'.$columnName.'` TEXT AFTER `'.$request->after_column.'`');
            $ifRecordsExist = DB::table(str_replace('ocrm_','',$datasetTable))->first();
            $columnHeader= $request->column_name;
            
            if($request->column_action == 'static_value'){
                $this->putStaticValueinColumn($datasetTable, $columnName, $request->static_value);
            }
            if($request->column_action == 'value_with_refrence'){
                $this->putvalueByRefference($datasetTable, $compareDataset, $compareFrom_datasetTable, $compareWith_compareDataset, $fillValueWith_compareDataset, $columnName);
            }
            if($request->column_action == 'formula'){
                // dd($request->all());
                $this->putValueWithFormula($datasetTable, $columnName, $request->completed_formula);
            }
            if($ifRecordsExist != null){
                DB::table(str_replace('ocrm_','',$datasetTable))->where('id',$ifRecordsExist->id)->update([$columnName=>$columnHeader]);
            }else{
                DB::table(str_replace('ocrm_','',$datasetTable))->insert([$columnName=>$columnHeader,'status'=>'Status','parent'=>'Parent']);
            }
            Session::flash('success','Column created successfully!');
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return back();
    }

    /**
     * To execute excel formula and update
     * records
     *
     * @param [string] $datasetTable
     * @param [string] $newColumn
     * @param [string] $formula
     * @return boolean
     */
    protected function putValueWithFormula($datasetTable, $newColumn, $formula){
        $excelHeaderMap = array("A","B","C","D","E","F","G","H","I","J","k","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        $dbModel = DB::table(str_replace('ocrm_','',$datasetTable));
        $getHeaders = clone $dbModel;
        $columnsArray = (array)$getHeaders->first();
        $formulaAndColumnsDetected = $this->replaceColumnHeadersTokey($columnsArray,$formula);
        $dbModel->where('id','!=',1)->update([$newColumn=>$formulaAndColumnsDetected['formula']]);
        $createExcel = Excel::create('Filename', function($excel) use ($newColumn,$formulaAndColumnsDetected, $datasetTable, $excelHeaderMap) {
            $excel->sheet('Data Sheet', function($sheet) use ($newColumn, $formulaAndColumnsDetected, $datasetTable, $excelHeaderMap){
                array_push($formulaAndColumnsDetected['detected'],'id');
                array_push($formulaAndColumnsDetected['detected'],$newColumn);
                $datasetData = DB::table(str_replace('ocrm_','',$datasetTable))->select($formulaAndColumnsDetected['detected'])->where('id','!=',1)->get();
                foreach($datasetData as $key => $record){
                    $rowData = array_values((array)$record);
                    $operationColumnIndex = count($rowData)-1;
                    $rowData[$operationColumnIndex] = '='.str_replace('$',$key+1,$rowData[$operationColumnIndex]);
                    unset($rowData['id']);
                    $sheet->row($key+1,$rowData);
                    $calcValue = $sheet->getCell($excelHeaderMap[$operationColumnIndex].($key+1))->getCalculatedValue();
                    DB::table(str_replace('ocrm_','',$datasetTable))->where('id',$record->id)->update([$newColumn=>$calcValue]);
                }
            }); 
        });
        return true;
    }


    /**
     * To put the static value in newsly created column
     * @param  [string] $table  haveing table name
     * @param  [string] $column having column name 
     * @param  [string/integer] $value  having the value which one have to fill
     * @return [boolean]        will return boolean
     */
    protected function putStaticValueinColumn($table, $column, $value){
        $table = str_replace('ocrm_','',$table);
        $dbModel = DB::table($table);
        if($dbModel->count() > 1){
            $dbModel->update([$column=>$value]);
        }else{
            $dbModel->insert([$column=>$value]);
        }
        return true;
    }

    /**
     * To put value in dataset table with reffernce of 
     * another dataset column
     *
     * @param [string] $currentDataset
     * @param [string] $compareDataset
     * @param [string] $selectedColumn
     * @param [string] $compareWithColumn
     * @param [string] $fillWithColumn
     * @param [string] $newColumnName
     * @return boolean
     */
    protected function putvalueByRefference($currentDataset, $compareDataset, $selectedColumn, $compareWithColumn, $fillWithColumn, $newColumnName){
        $currentDatasetCount = DB::table(str_replace('ocrm_','',$currentDataset));
        $compareDatasetCount = DB::table(str_replace('ocrm_','',$compareDataset));
        if($currentDatasetCount->count() > 1 && $compareDatasetCount->count() > 1){
            $updateQuery = DB::update("UPDATE ".$currentDataset." AS first_table LEFT JOIN ".$compareDataset." AS sec_table 
                                        ON sec_table.".$compareWithColumn." = first_table.".$selectedColumn." 
                                        SET first_table.".$newColumnName." = sec_table.".$fillWithColumn." where first_table.id != 1");
        }
        return true;
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
    	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
        $model = Dataset::find($id);
        if(!empty($model['dataset_table'])){
            if(Schema::hasTable(str_replace('ocrm_','', $model['dataset_table']))){
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
    	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
        $dataset = Dataset::find($id);
        $dataset->dataset_description = $dataset->description;
        $datasetTable = Dataset::find($id)->dataset_table;
        try{
            $headers = DB::table(str_replace('ocrm_','',$datasetTable))->first();
            $columns = collect($headers)->except(['id','status','parent']);
        }catch(\Exception $e){
            $columns = [];
            $dataset = [];
        }
        return view('organization.dataset.edit',['columns'=>$columns,'dataset'=>$dataset]);
    }
     public function defineDataset(Request $request, $id){
     	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
        $dataset = Dataset::find($id);
        $datasetTable = Dataset::find($id)->dataset_table;
        try{
            $headers = DB::table(str_replace('ocrm_','',$datasetTable))->first();
            if($request->isMethod('post')){
                $defined = $request->except(['_token']);
                $dataset->defined_columns = json_encode($defined);
                $dataset->save();
                DB::table(str_replace('ocrm_','',$datasetTable))->where('id',$headers->id)->update($request->header);
                $headers = DB::table(str_replace('ocrm_','',$datasetTable))->first();
                Session::flash('success','Successfully defined!');
            }
            $columns = collect($headers)->except(['id','status','parent']);
        }catch(\Exception $e){
            $columns = [];
            $dataset = [];
        }
        return view('organization.dataset.define',['columns'=>$columns,'dataset'=>$dataset]);
    }
    public function filterDataset(Request $request, $id){
    	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
        $records = collect([]);
        $headers = [];
        $dataset = Dataset::find($id);
        if($request->has('select_column')){
            
            $datasetTable = Dataset::find($id)->dataset_table;
            $headers = DB::table(str_replace('ocrm_','',$datasetTable))->first();
            $records = DB::table(str_replace('ocrm_', '', $datasetTable))->select($request->select_column)->where('id','!=',$headers->id)->where('status' , 1);
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
        $rules = [
            'name' => 'required'
        ];
        $this->validate($request,$rules);

    	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
        $dataset = Dataset::find($id);
        $where = [];
        $datasetTable = Dataset::find($id)->dataset_table;

        $filterDara = unserialize($request->filter_data);
        if(empty($filterDara)){
            Session::flash('error','Please apply filter after select columns!');
            return back();
        }
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
            if($filter['column'] != null && $filter['operation'] != null && $filter['value'] != null){
                $where[] = $filter['column'].' '.$filter['operation'].' "'.$filter['value'].'"';
            }
        }
        
        DB::beginTransaction();
        try{
            DB::select('CREATE TABLE '.$tableName.' ('.implode(',',$newTableColumns).')');
            $insertData = collect($headers)->toArray();
            DB::table(str_replace('ocrm_','',$tableName))->insert($insertData);
            if(!empty($where)){
                DB::select('INSERT INTO '.$tableName.' ('.implode(',',$filterDara['select_column']).', status, parent) SELECT '.implode(',',$filterDara['select_column']).', status, parent FROM '.$datasetTable.' WHERE status = 1 AND ('.implode(' AND ',$where).')');
            }else{
                DB::select('INSERT INTO '.$tableName.' ('.implode(',',$filterDara['select_column']).', status, parent) SELECT '.implode(',',$filterDara['select_column']).', status, parent FROM '.$datasetTable.' WHERE status = 1');
            }
            $model = new Dataset;
            $model->dataset_table = $tableName;
            $model->dataset_name = $request->name;
            $model->dataset_file = '';
            $model->dataset_file_name = '';
            $model->user_id = Auth::guard('org')->user()->id;
            $model->uploaded_by = Auth::guard('org')->user()->name;
            $model->save();
            Session::flash('success','Subset created successfully!!');
            DB::commit();
        }catch(\Exception $e){
            throw $e;
            DB::rollback();
        }
        /*$tableName = DB::getTablePrefix().get_organization_id().'_data_table_'.time();
         DB::select('CREATE TABLE '.$tableName.' AS SELECT '.implode(',',$filterDara['select_column']).', status, parent FROM '.$datasetTable.' WHERE status = 1 AND ('.implode(' AND ',$where).')');
        DB::select("ALTER TABLE `{$tableName}` ADD `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID' FIRST");*/
        return back();
    }

    /**
     * [validateDataset validate uploaded dataset records]
     * @param  Request $request [posted data]
     * @param  [type]  $id      [dataset id]
     * @return [type]           [view]
     */
    public function validateDataset(Request $request, $id){
        $dataset = Dataset::find($id);
        $definedColumns = $dataset->defined_columns;
        if($definedColumns != ''){
            $definedColumns = json_decode($definedColumns,true);
        }
        $errorInfo = [];
        $datasetTable = Dataset::find($id)->dataset_table;
        try{
            $headers = DB::table(str_replace('ocrm_','',$datasetTable))->first();
            $records = DB::table(str_replace('ocrm_', '', $datasetTable))->where('id','!=',$headers->id)->where('status' , 1)->paginate(50);
            $recordsArray = [];
            $row = 1;
            if($definedColumns != ''){
                foreach($records as $key => $record){
                    $col = 1;
                    $columnsArray = [];
                    $record = collect($record)->except(['id','status','parent'])->toArray();

                    foreach ($record as $colKey => $columnValue) {
                        if(array_key_exists($colKey, $definedColumns)){

                            $testData = preg_match($definedColumns[$colKey], $columnValue);
                            if($testData){
                                $columnsArray[$colKey] = $columnValue;
                            }else{
                                $errorInfo[] = ['row'=>$row,'col'=>$colKey];
                                $columnsArray[$colKey] = '<span class="dataset-validate-error">'.$columnValue.'</span>';
                            }
                            $col++;
                        }
                    }
                    $recordsArray[] = $columnsArray;
                    $row++;
                }
            }
            $errors = collect($errorInfo)->groupBy('row')->toArray();
        }catch(\Exception $e){
            throw $e;
            $headers = [];
            $recordsArray = 'error';
            $errors = [];
            $records = [];
            $dataset = [];
        }
        
        return view('organization.dataset.validate',['headers'=>$headers,'records'=>$recordsArray,'errors'=>$errors,'paginate'=>$records,'dataset'=>$dataset]);
    }
     public function visualizeDataset($dataset_id){
     	if(!$this->validateUser($dataset_id)){
        	return redirect()->route('list.dataset');
        }
        $model = Dataset::find($dataset_id);
        $visualize = Visualization::where('dataset_id',$dataset_id)->get();
        return view('organization.dataset.visualize',['dataset'=>$model,'visualizations'=>$visualize]);
    }
     public function collaborateDataset($id)
    {	if(!$this->validateUser($id,true)){
        	return redirect()->route('list.dataset');
        }
        $model = Dataset::with(['dataset_meta'])->find($id);
        if($model != null){
        	foreach ($model->dataset_meta as $key => $value) {
	        	$model->{$value->key} = $value->value;
	        }
        }
        $collaborate = Collaborator::where(['type'=>'dataset','relation_id'=>$id])->get();
        return view('organization.dataset.collaborate',compact('model'))->with(['collaborate'=>$collaborate]);
    }
    public function customizeDataset($id)
    {
    	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
        $model = Dataset::with(['dataset_meta'])->find($id);
        if($model->dataset_meta != null){
            foreach ($model->dataset_meta as $key => $value) {
                $model->{$value->key} = $value->value;
            }
        }
        return view('organization.dataset.customize',compact('model'));
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
    	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
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
    	if(!$this->validateUser($id)){
        	return redirect()->route('list.dataset');
        }
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '3000000');
        $model = Dataset::find($id);
        $table_name = str_replace('ocrm_','',$model->dataset_table);
        if(Schema::hasTable($table_name))
        {
           
            $name  =   parse_slug($model->dataset_name).'_'.generate_filename();
            $datas =   DB::table($table_name)->where('status' , 1)->where('parent' ,  0)->get()->toArray();
            // $datas =   DB::table($table_name)->where('status' , 1)->get()->toArray();
            $model =   json_decode(json_encode($datas),true);
            $headers = (array)DB::table($table_name)->first();
            if(!empty($headers)){
                unset($headers['status']);
                unset($headers['parent']);
                unset($headers['id']);
            }
            foreach ($model as $key =>  $value) {
                  unset($value['status']);
                  unset($value['parent']);
                  unset($value['id']);
                  $model[$key] = array_combine($headers, $value);
                  
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
    	if(!$this->validateUser($datasetId)){
        	return redirect()->route('list.dataset');
        }
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '3000000');
        $model = Dataset::where('id',$datasetId)->first();
        $tableName = str_replace('ocrm_', '', $model->dataset_table);
        $orgID = get_organization_id();
        $prefix = DB::getTablePrefix();
        $newTableName = $prefix.$orgID.'_data_table_'.time();

        $removeOXO = str_replace('oxo_', '', $model->dataset_table);
        DB::select('CREATE TABLE '.$newTableName.' as SELECT * FROM `ocrm_'.$tableName.'`');
        DB::select('ALTER TABLE '.$newTableName.' MODIFY `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY');

        DB::select('CREATE TABLE cloning_dataset as SELECT * FROM `'.$prefix.$orgID.'_datasets` WHERE id = '.$datasetId);
        DB::update('UPDATE cloning_dataset SET dataset_table = "'.$newTableName.'"');

        $newSurveyID = DB::select('SELECT MAX(id) maxId FROM `ocrm_'.$orgID.'_datasets`');
        $newSurveyID = $newSurveyID[0]->maxId + 1;
        DB::update('UPDATE cloning_dataset SET id = '.$newSurveyID);
        DB::select('INSERT into `'.$prefix.$orgID.'_datasets` SELECT * FROM cloning_dataset');
        DB::select('DROP TABLE cloning_dataset');
        $renameTable = $prefix.$orgID.'_data_table_'.$newSurveyID;
        DB::statement('UPDATE '.$prefix.$orgID.'_datasets SET `dataset_name` = concat(dataset_name,"_clone"), `dataset_table` = "'.$renameTable.'" WHERE id = '.$newSurveyID);
        DB::statement('RENAME TABLE '.$newTableName.' TO '.$renameTable);
        Session::flash('success','Clone created successfully!');
        return redirect()->route('list.dataset');
    }

    public function updateDetails(Request $request, $id){
        $rules = [
            'dataset_name' => 'required'
        ];
        $this->validate($request,$rules);
        $model = Dataset::find($id);
        $model->dataset_name = $request->dataset_name;
        $model->description = $request->dataset_description;
        $model->save();
        Session::flash('success','Successfully updated!');
        return back();
    }

    /**
     * update dataset share status
     * @param  $request instance of Request class having all posted data
     * @return string
     * @author Rahul 
     **/
    public function changeCollaborateStatus(Request $request){
    	$model = DatasetMeta::firstOrNew(['key'=>'share_status','dataset_id'=>$request->dataset_id]);
        $model->dataset_id = $request->dataset_id;
        $model->key = 'share_status';
        $model->value = $request->share_status;
        $model->save();
        return 'Success';
    }

    protected function validateCollaborateRequest($request){

        $rules = [
            'email' => 'required|email',
            'share' => 'required'
        ];
        $this->validate($request,$rules);
    }
    
    public function saveCollaborate(Request $request){
        $this->validateCollaborateRequest($request);
        $model = Collaborator::where(['email'=>$request->email,'type'=>'dataset'])->first();
        if($model != null){
            Session::flash('error','Email id already exists!');
            return back();
        }
        $model = new Collaborator;
        $model->type = 'dataset';
        $model->relation_id = $request->dataset_id;
        $model->email = $request->email;
        $model->userid = Auth::guard('org')->user()->id;
        $model->access = json_encode($request->share);
        $model->save();
        Session::flash('success','Successfully shared!');
        return back();
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function deleteCollaborate($id){
        $model = Collaborator::find($id);
        $model->delete();
        Session::flash('success','Successfully deleted!');
        return back();
    }

    /**
     * save custom js and css of dataset
     * @param  Request $request having posted data 
     * @return back to same view
     */
    public function saveCustomCode(Request $request,$id){
        foreach($request->except(['_token']) as $key => $value){
            $model = DatasetMeta::firstOrNew(['key'=>$key,'value'=>$value]);
            $model->dataset_id = $id;
            $model->key = $key;
            $model->value = $value;
            $model->save();
        }
        Session::flash('success','Successfully updated!');
        return back();
    }
    public function deleteColumn($datasetId , $columnKey)
    {
        $dataset = Dataset::where('id',$datasetId)->first();
        $dataset_table = $dataset->dataset_table;
        DB::select('ALTER TABLE '.$dataset_table.' DROP COLUMN '.$columnKey);
        return back();
    }

    /**
     * Get Selected Dataset columns
     * By Rahul
     */
    Public function getDatasetColumns(Request $request){
        if($request->has('status')){
            $datasetModel = Dataset::find($request->dataset);
            $dataset = $datasetModel->dataset_table;
        }else{
            $dataset = $request->dataset;
        }
        $table = str_replace('ocrm_','',$dataset);
        $data = DB::table($table)->first();
        $columns = '<option>Select Column</option>';
        foreach($data as $key => $column){
            if(!in_array($key,['id','status','parent'])){
                $columns .= '<option value="'.$key.'">'.$column.'</option>';
            }
        }
        return $columns;
    }

    public function refreshDataset($id){
        $model = Dataset::with(['dataset_meta'])->find($id);
        $request = new Request;
        if($model != null){
            $dataset_type = getMetaValue($model->dataset_meta,'dataset_type');
            if($dataset_type == 'continues'){
                $import_source = getMetaValue($model->dataset_meta,'import_source');
                switch($import_source){
                    case'google':
                        $uri = getMetaValue($model->dataset_meta,'uri');
                        $grid_id = getMetaValue($model->dataset_meta,'grid_id');
                        $request->replace(['import_source'=>'google','uri'=>$uri,'grid_id'=>$grid_id,'add_replace'=>'replace','replace_or_append'=>$id]);
                        $this->uploadDataset($request);
                        Session::flash('success','Dataset updated successfully!');
                        return back();
                    break;
                    case'from_api':
                        $api_url = getMetaValue($model->dataset_meta,'api_url');
                        $request->replace(['import_source'=>'from_api','api_url'=>$api_url,'add_replace'=>'replace','replace_or_append'=>$id]);
                        $this->uploadDataset($request);
                        Session::flash('success','Dataset updated successfully!');
                        return back();
                    break;
                }
            }else{
                Session::flash('warning','Dataset is not continues!');
                return back();
            }
        }else{
            Session::flash('warning','Dataset does not exist!');
            return back();
        }
    }

    public function datasetOperations()
    {
        return view('organization.dataset.operations');
    }

    public function structureDataset($id)
    {
        if(!$this->validateUser($id)){
            return redirect()->route('list.dataset');
        }
        $dataset = Dataset::find($id);
        $dataset->dataset_description = $dataset->description;
        $datasetTable = Dataset::find($id)->dataset_table;
        try{
            $headers = DB::table(str_replace('ocrm_','',$datasetTable))->first();
            $columns = collect($headers)->except(['id','status','parent']);
        }catch(\Exception $e){
            $columns = [];
            $dataset = [];
        }
        return view("organization.dataset.structure",['columns'=>$columns,'dataset'=>$dataset]);
    }
   
}
