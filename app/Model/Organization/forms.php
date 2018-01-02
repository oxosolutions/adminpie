<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Session;
use FormGenerator;
class forms extends Model
{
    protected $fillable = ['form_title','form_slug','form_description','type','created_by'];
    protected $table	= '';
    
    public function __construct(){
		    	if(!empty(Session::get('organization_id'))){
		    		$this->table = Session::get('organization_id').'_forms';
		    	}
    }
    public function listForm()
    {
        return self::pluck('form_title','id');
    }

    public function collabrate(){
        return $this->hasMany('App\Model\Organization\Collaborator','relation_id','id')->where('type','survey');
    }

    public function section(){
    	return $this->hasMany('App\Model\Organization\section','form_id','id');
    }

    // public function section_with_order(){
    //     return $this->hasMany('App\Model\Organization\section','form_id','id')->orderBy('order','asc');
    // }

    public function formsMeta(){
    	return $this->hasMany('App\Model\Organization\FormsMeta','form_id','id');
    }

    public function setTable($table){

        $this->table = $table;
    }

    public static function surveyList(){

        return self::where('type','survey')->pluck('form_title','id');
    }


    public function getSurveyResultRecords($collectionData){
        $surveyid = FormGenerator::GetMetaValue($collectionData->fieldMeta,'select_survey');
        $column = FormGenerator::GetMetaValue($collectionData->fieldMeta,'select_column');
        $listArray = [];
        if(($surveyid != '' && $surveyid != null) && ($column != '' && $column != null)){
            try{
                $surveyRecords = DB::table(get_organization_id().'_survey_results_'.$surveyid)->select($column)->get()->toArray();
                foreach($surveyRecords as $key => $record){
                    if(trim($record->{$column}) != ''){
                        $listArray[$record->{$column}] = $record->{$column};
                    }
                }
                return $listArray;
            }catch(\Exception $e){
                return [];
            }
        }
        return [];
    }

}

