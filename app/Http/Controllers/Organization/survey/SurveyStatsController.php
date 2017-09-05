<?php

namespace App\Http\Controllers\Organization\survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\forms;
use App\Model\Organization\FormsMeta;
use App\Model\Organization\FormBuilder;
use DB;

class SurveyStatsController extends Controller
{
    protected  function get_survey_table_name($form_id){
        $table = $replace_ocrm = null;
        $metaTable =  FormsMeta::where(['form_id'=>$form_id,'key'=>'survey_data_table']);
           if($metaTable->exists()){
              $table =   $metaTable->first()->value;
              $replace_ocrm = str_replace('ocrm_', '', $table);
                return ['table'=>$table , 'replace_ocrm'=> $replace_ocrm];
            }
        return null;
    }
    public function stats($id){
      $settings = $survey_completed_count = $group_count = $section_question_count = $question_count = $survey_data =null;
    	 $survey_data = forms::with(['section.fields.fieldMeta','formsMeta'])->where('id',$id)->get();
       if($survey_data[0]['formsMeta']->count()){
          $settings = $survey_data[0]['formsMeta']->mapWithKeys(function($items){
            return [$items['key']=>$items['value']];
           });
          
        }
       
        $table = $this->get_survey_table_name($id);
        if(!empty($table)){
            $survey_completed_count = DB::table($table['replace_ocrm'])->count();
        }
        if(!empty($survey_data)){
    		$group_count = count($survey_data[0]['section']);
        	 for($i=0; $i<$group_count; $i++){
    				$field[str_slug($survey_data[0]['section'][$i]['section_name'])] = count($survey_data[0]['section'][$i]['fields']);    	 	
        	 }
    	   $section_question_count = $field;
    	   $question_count = array_sum($field);
        }
	    return view('organization.survey.survey_stats',compact('group_count','section_question_count','question_count','survey_completed_count','settings'));
    }

    public function survey_structure($id){
        $survey_data = forms::with('section.fields.fieldMeta')->where('id',$id)->get()->toArray();
        return view('organization.survey.survey_structure',compact('survey_data') );
    }
    public function survey_result($id)
    {
       $metaTable =  FormsMeta::where(['form_id'=>$id,'key'=>'survey_data_table']);
       if($metaTable->exists()){
          $table =   $metaTable->first()->value;
          $newName = str_replace('ocrm_', '', $table);
          $data = DB::table($newName)->get();
          $formQuestion = FormBuilder::select('field_slug','field_title')->where('form_id',$id)->get()->mapWithKeys(function($items){
            return [$items['field_slug'] =>$items['field_title']];
          })->toArray();    
         }else{
                $data = null;
       }
       return view('organization.survey.survey_result',compact('data','formQuestion'));
    }
}
