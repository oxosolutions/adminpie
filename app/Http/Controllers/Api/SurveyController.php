<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\forms;
use App\Model\Organization\User;
use App\Model\Admin\GlobalOrganization as GO;
use Session;

class SurveyController extends Controller
{
    public function surveys(Request $request){
        $org_id = GO::where('active_code',$request['activation_key'])->first()->id;
    	Session::put('organization_id',$org_id);
    	$form  =  forms::with('section.fields.fieldMeta')->where('type','survey')->get();
    	$data["status"]= "success";
    	$data["media"]= "";
        $question = [];
        $surveys =[];
        $groups =[];
        foreach ($form as $key => $value) 
        {
            $temp_form = ["id"=>$value['id'], "survey_table"=>'', "name"=>$value['form_title'], "created_by"=>'', "description"=>$value['form_description'], "status"=>'', "created_at"=>date('Y-m-d',strtotime($value->created_at)), "updated_at"=>date('Y-m-d',strtotime($value->updated_at)), "deleted_at"=>'']; 
            array_push($surveys,$temp_form);
            if(!empty($value['section']))
            {
               $section[] = $value['section'];
               foreach ($value['section'] as $sectionKey => $sectionValue) 
               {
                $temp_section =  ["id"=>$sectionValue['id'], "survey_id"=>$sectionValue['form_id'], "title"=>$sectionValue['section_name'], "description"=>$sectionValue['section_description'], "group_order"=>$sectionValue['order'], "created_at"=>date('Y-m-d',strtotime($sectionValue['created_at'])), "updated_at"=>date('Y-m-d',strtotime($sectionValue['updated_at'])), "deleted_at"=>''];
                    array_push($groups,$temp_section);
                    if(!empty($sectionValue['fields']))
                    {
                        $index=0;
                        foreach ($sectionValue['fields'] as $fieldKey => $fieldValue) 
                        {
                            $index++;
                            if(!empty($fieldValue['fieldMeta']))
                            {
                                $collect = collect($fieldValue['fieldMeta']);
                                $form_meta =  $collect->mapWithKeys(function($item){
                                    return [$item['key'] => $item['value']];
                                });

                                $form_fields =   ['question_text'=>$fieldValue['field_title'], 'question_type'=>$fieldValue['field_type'], 'question_key'=>null, "question_id"=> $fieldValue['id'], "next_question_key"=> null, "question_message"=> null, "required"=> null, "pattern"=> null, "otherPattern"=>null, "survey_id"=> $fieldValue['form_id'], "group_id"=> $fieldValue['section_id'],
                                            "question_order"=>$fieldValue["order"], "question_desc"=> $fieldValue["field_description"], "created_at"=>$fieldValue['created_at'], "updated_at"=>$fieldValue['updated_at'], "deleted_at"=>null, "answers"=>[[]], ]; 
                                if(!empty($form_meta['question_id'])){
                                    $form_fields['question_key'] = $form_meta['question_id'];
                                }
                                if($fieldValue['field_type']=='select' ||  $fieldValue['field_type']=='multi_select' || $fieldValue['field_type']== 'radio' || $fieldValue['field_type'] == 'checkbox')
                                {
                                    $options = json_decode($form_meta['field_options'],true);
                                    
                                    $option = null;
                                    if(!empty($options)){
                                        for($i=0; $i < count($options); $i++){
                                           $option[$i]['option_type']= $fieldValue['field_type'];
                                           $option[$i]['option_value']= $options[$i]['key'];
                                           $option[$i]['option_text']= $options[$i]['value'];
                                           $option[$i]['option_next']= '';
                                           $option[$i]['option_prompt']= '';
                                       }
                                    }
                                    $form_fields['answers'] = [$option];
                                }
                            array_push($question,$form_fields);
                            }
                        }
                    }
               }

            }
        }
            $data['questions']   = $question;
            $data['surveys']     = $surveys;           
            $data['groups']      = $groups;
            $data["users"]       = User::all();
        	return $data; 	
}
            public function surveyPerview($form_id)
            {

                dd($form_id);
            }

            public function save_app_survey_filled_data(Request $request){
                 // dump(get_organization_id());
                //  $org_id = GO::where('active_code',$request['activation_key'])->first()->id;
                dd($request->all());
            }

}
