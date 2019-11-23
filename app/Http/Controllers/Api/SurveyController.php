<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\forms;
use App\Model\Organization\FormsMeta;
use App\Model\Organization\User;
use App\Model\Admin\GlobalOrganization as GO;
use Session;
use Illuminate\Support\Facades\Schema;
use DB;
use App\Model\Organization\FieldMeta;
use App\Model\Organization\FormBuilder;
Use Carbon\carbon;
use App\Model\Organization\OrganizationSetting;
use App\Model\Group\GroupUsers;
use App\Model\Organization\Dataset;

class SurveyController extends Controller
{
  public function organization_users(Request $request){
    if(empty($request['_token']) || $request['_token'] != 'd1a2r3l4i5c6o7x8o9s10o11l12o13u14t15i16o17n18s'){

            return response()->json(["errors"=>['status'=>'error', "title"=> "Activation code error", 'message'=>"you have n't access."]],401);
   
        }

        $org = GO::where('active_code',$request['activation_code']);
        if(!$org->exists()){
            return ['status'=>'error', 'message'=>'active code not exist'];
        }
        $org_id = $org->first()->id;
        $group_id = $org->first()->group_id;
        Session::put('organization_id',$org_id);
        Session::put('group_id',$group_id);
        $users = GroupUsers::with('organization_user.user_role_rel.roles')->has('organization_user')->get()->toArray();
        foreach ($users as $key => $value) {
           $users[$key]['org_id'] = $org_id; 
           $users[$key]['user_roles'] =  array_column(array_column($users[$key]['organization_user']['user_role_rel'], 'roles'), 'slug');
           unset($users[$key]['organization_user']);
        }
        return response()->json(['status'=>'success', 'users'=>$users],200);
    }

    /**
     * Will send all survey questions in API for android application
     * @param  Request $request have all posted dat
     * @return [type]           json of array
     */
    public function surveys(Request $request){
        $org = GO::where('active_code',$request['activation_key']);

        
        dd( $org );
        
        if(!$org->exists()){
            return ['status'=>'error', 'message'=>'active code not exist'];
        }
        $org_id = $org->first()->id;
        $group_id = $org->first()->group_id;
        Session::put('organization_id',$org_id);
        Session::put('group_id',$group_id);
        $users = GroupUsers::with('organization_user.user_role_rel.roles')->has('organization_user')->get()->toArray();

        foreach ($users as $key => $value) {
           $users[$key]['org_id'] = $org_id; 
           $users[$key]['user_roles'] =  array_column(array_column($users[$key]['organization_user']['user_role_rel'], 'roles'), 'slug');
           unset($users[$key]['organization_user']); 
        }

 
        $form  =  forms::with(['formsMeta','section'=>function($query){
                                        $query->orderBy('order','asc');
                                    },
                                'section.sectionMeta',
                                'section.fields' =>function($query){
                                        $query->orderBy('order','asc');
                                },'section.fields.fieldMeta'] )->where('type','survey')->get();
        $smeta  =  forms::with(['section.sectionMeta'] )->where('type','survey')->get();
        $data["status"]= "success";
        $data["media"]= "";
        $question = [];
        $surveys =[];
        $groups =[];
        $repeater = [];
        $survey_meta = [];
        foreach ($form as $key => $value) 
        {
            foreach ($value['formsMeta'] as $form_meta_key => $form_meta_value) {
                if($form_meta_value['value']==null){
                        $form_meta_value['value'] ="";
                }
                $survey_meta[] = $form_meta_value;
            }
            

            $form_id = $value['id']; 
            $temp_form = ["id"=>$value['id'], "survey_table"=>'', "name"=>$value['form_title'], "created_by"=>'', "description"=>$value['form_description'], "status"=>'',"created_by"=>$value['created_by'], "created_at"=>date('Y-m-d',strtotime($value->created_at)), "updated_at"=>date('Y-m-d',strtotime($value->updated_at)), "deleted_at"=>'']; 
            array_push($surveys,$temp_form);
            if(!empty($value['section']))
            {
               $section[] = $value['section'];
               foreach ($value['section'] as $sectionKey => $sectionValue) 
               {
                
                $section_type = $sectionValue['sectionMeta']->where('key','section_type')->first();
                $section_type_value ="";
                if(!empty($section_type['key'])){
                    $section_type_value = $section_type['value'];
                }
                $section_id = $sectionValue['id']; 
                $temp_section =  ["id"=>$sectionValue['id'], "survey_id"=>$sectionValue['form_id'], "title"=>$sectionValue['section_name'], "description"=>$sectionValue['section_description'], "group_order"=>$sectionValue['order'],'section_type'=>$section_type_value, "created_at"=>date('Y-m-d',strtotime($sectionValue['created_at'])), "updated_at"=>date('Y-m-d',strtotime($sectionValue['updated_at'])), "deleted_at"=>''];

                    array_push($groups,$temp_section);
                    if(!empty($sectionValue['fields']))
                    {
                        $index=0;
                        $repeater_check =0;
                       
                        foreach ($sectionValue['fields'] as $fieldKey => $fieldValue) 
                        {

                            $field_id  =$fieldValue['id'];
/*below code is for  Add Question id which have not*/                           
                            $field_add_question = FieldMeta::where(['form_id'=>$form_id , 'section_id'=>$section_id, 'field_id'=>$field_id,  'key'=>'question_id']);
                            if(!$field_add_question->exists()){
                                $field_meta = new FieldMeta();
                                $field_meta->form_id = $form_id;
                                $field_meta->section_id = $section_id;
                                $field_meta->field_id = $field_id;
                                $field_meta->key = 'question_id';
                                $field_meta->value = "SID".$form_id."_GID".$section_id."_QID".$field_id;
                                $field_meta->save();
                                }
                            $index++;
                            if(!empty($fieldValue['fieldMeta']))
                            {

                                $collect = collect($fieldValue['fieldMeta']);
                                $form_meta =  $collect->mapWithKeys(function($item){
                                    return [$item['key'] => $item['value']];
                                });
                                
                                $form_fields =   ['question_text'=>$fieldValue['field_title'], 'question_type'=>$fieldValue['field_type'], 'question_key'=>'', "question_id"=> $fieldValue['id'], "question_message"=> '', "required"=> '', "pattern"=> '', "otherPattern"=>'', "survey_id"=> $fieldValue['form_id'], "group_id"=> $fieldValue['section_id'],
                                            "question_order"=>$fieldValue["order"], "question_desc"=> $fieldValue["field_description"], "created_at"=>$fieldValue['created_at'], "updated_at"=>$fieldValue['updated_at'], "deleted_at"=>'', "answers"=>[[]], "fields"=>"", "question_repeater" => @$form_meta['question_repeater'] ]; 
                                if(!empty($form_meta['question_id'])){
                                    $form_fields['question_key'] = $form_meta['question_id'];
                                } 
                                if(!empty($form_meta['field_validations'])){
                                    $form_fields['field_validations'] = json_decode($form_meta['field_validations'], true);
                                }else{
                                    $form_fields['field_validations'] ="";

                                } 
                                if(!empty($form_meta['field_conditions'])){
                                    $form_fields['field_conditions'] = json_decode($form_meta['field_conditions'], true);
                                }else{
                                    $form_fields['field_conditions'] ="";

                                }

                                $options = json_decode(@$form_meta['field_options'],true);
                                $form_fields['next_question_key'] ="";
                                if($fieldValue['field_type']=='select' ||  $fieldValue['field_type']=='multi_select' || $fieldValue['field_type']== 'radio' || $fieldValue['field_type'] == 'checkbox')
                                {   $option = null;
                                    if(!empty($options)){
                                        for($i=0; $i < count($options); $i++){
                                           $option[$i]['option_type']= $fieldValue['field_type'];
                                           $option[$i]['option_value']= @$options[$i]['key'];
                                           $option[$i]['option_text']= @$options[$i]['value'];
                                           $option[$i]['option_next'] = "";
                                           if(!empty($options[$i]['go_to_question'])){
                                                $option[$i]['option_next']= @$options[$i]['go_to_question'];
                                           }
                                           $option[$i]['option_prompt']= '';
                                       }
                                    }
                                    $form_fields['answers'] = [$option];
                                    $form_fields = $this->checkPrefilledWith($form_meta, $form_fields);
                                }
                                 
                                    if($section_type_value =='repeater' && $repeater_check ==0 )
                                        {   $repeater_check = 1;
                                            
                                            $repeater_section =  ['question_text'=>'Fill the repeater', 'question_type'=>'repeater', 'question_key'=>$sectionValue['section_slug'], "question_id"=> $sectionValue['id'], "question_message"=> '', "required"=> '', "pattern"=> '', "otherPattern"=>'', "survey_id"=> $sectionValue['form_id'], "group_id"=> $sectionValue['id'],
                                                        "question_order"=>' ', "question_desc"=> 'repeted', "created_at"=>date('Y-m-d',strtotime($sectionValue['created_at'])), "updated_at"=>date('Y-m-d',strtotime($sectionValue['updated_at'])), "deleted_at"=>'', "answers"=>[[]],'fields'=>[],'field_conditions'=>[],'field_validations'=>[],'next_question_key'=>'', "question_repeater" => @$sectionValue['question_repeater'] ];                                
                                                array_push($repeater_section['fields'] ,  $form_fields);
                                        }elseif($section_type_value =='repeater'){
                                                array_push($repeater_section['fields'] ,  $form_fields);  
                                        }else{
                                            array_push($question,$form_fields);
                                        }
                            }
                        }
                            if($section_type_value =='repeater'){
                                array_push($question,$repeater_section );
                            }
                    }
               }
            }
        }
        
         // dump(array_collpase($survey_meta));
            $data['questions']      = $question;
            $data['surveys']     = $surveys;  
            $data['survey_meta'] = $survey_meta;         
            $data['groups']      = $groups;
            $data["users"]       = $users;//GroupUsers::all();
            $data['settings'] = OrganizationSetting::where('type','app')->pluck('value','key');
            $mediaArray = [];
            if(isset($data['settings']['android_application_logo'])){
                $mediaArray['android_application_logo'] = $data['settings']['android_application_logo'];
            }
            $data['media'] = $mediaArray;
            return $data;   
    }

    /**
     * Check and fill answer of specific question with dataset 
     * or survey values
     * @param  [array] $form_meta   having meta data of form field
     * @param  [array] $form_fields havind array with generated data for fields
     * @return [array]              will return array of form_fields with append answers
     * @author Rahul
     */
    protected function checkPrefilledWith($form_meta, $form_fields){
        if($form_meta->has('prefilled_with')){
            switch($form_meta['prefilled_with']){

                case'dataset':
                    $datasetColumnsResult = Dataset::getDatasetColumnRecords($form_meta,true);
                    $options = [];
                    $i = 0;
                    foreach($datasetColumnsResult as $key => $option){
                        $options[$i]['option_type'] = $form_fields['question_type'];
                        $options[$i]['option_value'] = $key;
                        $options[$i]['option_text'] = $option;
                        $options[$i]['option_next'] = "";
                        $i++;
                    }
                    $form_fields['answers'] = [$options];
                    return $form_fields;
                break;

                case'survey':
                    $surveyColumnsResult = forms::getSurveyResultRecords($form_meta,true);
                    $options = [];
                    $i = 0;
                    foreach($surveyColumnsResult as $key => $option){
                        $options[$i]['option_type'] = $form_fields['question_type'];
                        $options[$i]['option_value'] = $key;
                        $options[$i]['option_text'] = $option;
                        $options[$i]['option_next'] = "";
                        $i++;
                    }
                    $form_fields['answers'] = [$options];
                    return $form_fields;
                break;

                case'model':
                    $modelAssoc = $form_meta['choice_model'];
                    try{
                        if($modelAssoc != null && $modelAssoc != ''){
                            $modelAssoc = explode('@',$modelAssoc);
                            $functionName = str_replace('()','',$modelAssoc[1]);
                            $modelObject = new $modelAssoc[0];
                            $modelResult = $modelObject->{$functionName}();
                            $options = [];
                            $i = 0;
                            foreach($modelResult as $key => $option){
                                $options[$i]['option_type'] = $form_fields['question_type'];
                                $options[$i]['option_value'] = $key;
                                $options[$i]['option_text'] = $option;
                                $options[$i]['option_next'] = "";
                                $i++;
                            }
                            $form_fields['answers'] = [$options];
                            return $form_fields;
                        }
                    }catch(\Exception $e){
                        return $form_fields;
                    }
                break;

                case'static':
                    return $form_fields;
                break;
            }
        }
        return $form_fields;
    }



    public function surveyPerview($form_id)
    {

    }

    public function save_app_survey_filled_data(Request $request){

        
        /* -------------TEMP CODE Delete this---------------*/


        
        $path = public_path().'/files/organization_256/survey-data-export/';

        $activation_code    = $request['activation_code'];
        $survey_id          = $request['survey_id'];
        $datetime           = date("YmdHis");

        $file = $path.'survey_data_'.$activation_code.'_'.$survey_id.'_'.$datetime.'.txt';
        $logfile = $path.'survey_data_synchronization_log.txt';


        if (!file_exists($file)) {
            $content = "\r\r ".date("M,d,Y h:i:s A")." File Created =====================================\r\r";
            file_put_contents($file, $content);
        }
        if (!file_exists($logfile)) {
            $content .= "\r".date("M,d,Y h:i:s A")." Data synchronized for survey ". $survey_id.' of organization '.$activation_code;
            file_put_contents($logfile, $content);
        } else{
            $content = file_get_contents($logfile);
            $content .= "\r".date("M,d,Y h:i:s A")." Data synchronized for survey ". $survey_id.' of organization '.$activation_code;
            file_put_contents($logfile, $content);

        }

        //dd($request);

        $content = file_get_contents($file);

        $content .= "\r\r ".date("M,d,Y h:i:s A")." Request =====================================\r\r";
        $content .= $request; 

        $content .= "\r\r ".date("M,d,Y h:i:s A")." Variables =====================================\r\r";
        $content .= "\rapp_version" . " \t"       . $request['app_version']; 
        $content .= "\ractivation_code" . " \t"   . $request['activation_code'];
        $content .= "\rsurvey_id" . " \t"         . $request['survey_id'];
        $content .= "\r_token" . " \t"            . $request['_token'];
        $content .= "\rform_id" . " \t"           . $request['form_id'];
        $content .= "\rform_slug" . " \t"         . $request['form_slug'];
        $content .= "\rform_title" . " \t"        . $request['form_title'];

        $content .= "\r\r ".date("M,d,Y h:i:s A")." Survey data =====================================\r\r";
        $content .= $request['survey_data']; 


        file_put_contents($file, $content);


        /*

        $result = array();
        $result['success'] = 'Data Saved';

        return $result;

        */
        

        /* ----------------------------*/
        

        $app_version =   $request['app_version'];
         $organization = GO::where('active_code',$request['activation_code']);
         if($organization->exists()){
            $org_id = $organization->first()->id;
         }else{
            return $error['org_id_not_exist'] =  "Error: Organization Not Exist";
         }
        Session::put('organization_id',$org_id);
        $form_query = forms::where('id',$request['survey_id']);
        if($form_query->exists()) {
           $form = $form_query->first();
         }else{
            return $error['survey_id_not_exist'] =  "Error: Survey  Not Exist";
         }
        $form_id = $request['survey_id'];
        unset($request['_token'],$request['form_id'],$request['form_slug'],$request['form_title'] );
        $survey_data = json_decode($request['survey_data'],true);  
        $records = 0;
        $fix_field = ['record_type', 'survey_sync_status', 'incomplete_name', 'survey_status', 'completed_groups', 'last_group_id', 'last_field_id', 'created_at', 'created_by', 'device_detail', 'unique_id', 'imei', 'mac_address', 'survey_submitted_from', 'survey_submitted_by', 'survey_completed_on', 'survey_started_on', 'ip_address'];
       
     foreach ($survey_data as $key => $value) {
            unset($colums, $values, $keys);
           $value = array_filter($value);
           if(!$value){
           }else{
            
            $value['app_version'] = $app_version;
            $collect_data =  collect($value)->except('record_type', 'survey_sync_status', 'incomplete_name', 'survey_status', 'completed_groups', 'last_group_id', 'last_field_id', 'created_at', 'created_by', 'device_detail', 'unique_id', 'imei', 'mac_address', 'survey_submitted_from', 'survey_submitted_by', 'survey_completed_on', 'survey_started_on', 'ip_address');
            if(array_filter($collect_data->toArray())){
                $return = $this->create_alter_insert_survey_table($org_id, $form_id , $value);
                if($return){
                        $records++;
                    }
            }
                // $return = [];
           }
        }
        return ['sucess'=>"$records Import successfully!"];
    }

    public function create_alter_insert_survey_table($org_id, $form_id,$data){
        
        $form_id    =   intval($form_id);
        $question   =   FormBuilder::with(['fieldMeta'=>function($query){
                            $query->where('key','question_id');
                        }])->where('form_id',$form_id)->get()->toArray();
        $questionId_slug = collect($question)->mapWithKeys(function($items){
            return [$items['field_meta'][0]['value']=>$items['field_slug']];
        })->toArray();
        $table_name = 'ocrm_'.$org_id.'_survey_results_'.$form_id;
        $form_meta = FormsMeta::where(['form_id'=>$form_id,'key'=>'survey_data_table', 'value'=>$table_name]);
        if(!$form_meta->exists() || $form_meta->count() >1){
            if($form_meta->count() >1 ){
                $form_meta->delete();
            }
            $formMeta = new FormsMeta();
            $formMeta->form_id = $form_id;
            $formMeta->key = 'survey_data_table';
            $formMeta->value = $table_name;
            $formMeta->save();
        }
        $prefix_field = ['ip_address', 'survey_started_on', 'survey_completed_on', 'survey_status','survey_submitted_by','survey_submitted_from','mac_address','imei','device_detail','created_by', 'created_at', 'deleted_at'];
        // $pr_field = ['record_type', 'survey_sync_status', 'incomplete_name', 'last_group_id', 'last_field_id', 'completed_groups', 'unique_id'];

        foreach ($data as $dataKey => $dataValue){
                    if($dataKey !="id" && !in_array($dataKey, $prefix_field)){
                        if(!empty($questionId_slug[$dataKey])) {
                            $dataKey = $questionId_slug[$dataKey];
                            $dataKey = str_replace('-', '_', $dataKey);
                        }

                        $dataKey = substr($dataKey, 0,62);

                        $colums[] =   "`$dataKey` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL";
                         if(is_array($dataValue)) {
                            $dataValue = json_encode($dataValue);
                         }
                         if($dataKey=='accident_date'){
                            $dataValue =  carbon::parse($dataValue)->format('Y-m-d');
                         }
                         if($dataKey=='created_at'){
                            $date = explode('-',$dataValue);
                            $formatedDate = $date[0]."-".$date[1]."-".$date[2];
                            $dataValue =  carbon::parse($formatedDate)->format('Y-m-d');
                         }
                         $newDataKey = str_replace('-', '_', $dataKey);
                         $keys[] = $newDataKey;
                }
                if($dataKey=='created_at'){
                    $date = explode('-',$dataValue);
                    $formatedDate = $date[0]."-".$date[1]."-".$date[2];
                    $dataValue =  carbon::parse($formatedDate)->format('Y-m-d');
                 }
                 if(is_array($dataValue)) {
                            $dataValue = json_encode($dataValue);
                         }
                if($dataKey=='accident_date'){
                            $dataValue =  carbon::parse($dataValue)->format('Y-m-d');
                         }

                if($dataKey !="id"){
                    $newKey = str_replace('-', '_', $dataKey);
                    $values[$newKey] = $dataValue;
                }
             }
            
            $colums = array_unique($colums);
            $newTableName = str_replace('ocrm_', '', $table_name);
        if(Schema::hasTable($newTableName)){
            $keys = array_unique($keys);
            $keys = array_map('strtolower', $keys);
            $table_column = Schema::getColumnListing($newTableName);
            $columnsdata  = collect($keys);
            $table_column_lower_case = array_map('strtolower', $table_column);
            //$table_column_lower_case =  $table_column;

            $new_columns   = $columnsdata->diff($table_column_lower_case)->toArray();
         

          //  $new_columns = array_unique($new_columns);
           
            if(!empty($new_columns)){
                foreach ($new_columns as $key => $value) {
                   

                    if(!in_array($value, $table_column)){
                     DB::statement("ALTER TABLE `{$table_name}` ADD `{$value}` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ");
                    // echo $value."<br>"; 
                    }
                }
            }
      }else{ 
        
            $colums[] =    "`ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT  NULL";
            $colums[] =    "`survey_started_on` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT  NULL";
            $colums[] =    "`survey_completed_on` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT  NULL";
            $colums[] =    "`survey_status` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL";
            $colums[] =    "`survey_submitted_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT  NULL";
            $colums[] =    "`survey_submitted_from` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT  NULL";
            $colums[] =    "`mac_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL DEFAULT  NULL";
            $colums[] =    "`imei` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT  NULL";
            // if(!in_array('unique_id', $colums)){
                
            // $colums[] =    "`unique_id` varchar(255) COLLATE utf8_unicode_ci NULL DEFAULT  NULL";
            // }
            $colums[] =    "`device_detail` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT  NULL";
            $colums[] =    "`created_by` INT(100) NOT NULL";
            $colums[] =    "`created_at` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci  NULL DEFAULT NUll";
            $colums[] =    "`deleted_at` TIMESTAMP NULL ";
           
            DB::statement("CREATE TABLE `{$table_name}` ( `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY, " . implode(', ', $colums) . " ) ");
            //DB::select("ALTER TABLE `{$table_name}` ADD `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Row ID' FIRST");
        }
       
            if(!empty($values['unique_id'])){
                $check_unique_id = DB::table($newTableName)->where('unique_id',$values['unique_id']);
                if($check_unique_id->exists()){
                    $check_unique_id->update($values);
                    return true;
                }else{
                   DB::table($newTableName)->insert($values);
                    return true; 
                }
            }else{
                $values = array_merge($values, ['created_at'=> date('Y-m-d')]);
                if(Session::has('inserted_id'.$form_id)){
                    $insert_id =  Session::get('inserted_id'.$form_id);
                    DB::table($newTableName)->where('id',$insert_id)->update($values);
                    return true;
                }
                 $id = DB::table($newTableName)->insertGetId($values);
                 Session::put('inserted_id'.$form_id, $id);
                 return true;
            }
    }


    public function listAllSurveys(Request $request){
        $response = [];
        $organizationWithActivation = GO::where('active_code',$request['activation_key']);
        if(!$organizationWithActivation->exists()){
            return ['status'=>'error', 'message'=>'wrong activation code!'];
        }
        $org_id = $organizationWithActivation->first()->id;
        $group_id = $organizationWithActivation->first()->group_id;
        Session::put('organization_id',$org_id);
        Session::put('group_id',$group_id);
        $response['users'] = $this->getUsersList();
    }

    protected function getUsersList(){
        $users = GroupUsers::with('organization_user.user_role_rel.roles')->has('organization_user')->get()->toArray();
        dd($users);
        /*foreach ($users as $key => $value) {
           $users[$key]['org_id'] = $org_id; 
           $users[$key]['user_roles'] =  array_column(array_column($users[$key]['organization_user']['user_role_rel'], 'roles'), 'slug');
           unset($users[$key]['organization_user']); 
        }*/
    }
}
