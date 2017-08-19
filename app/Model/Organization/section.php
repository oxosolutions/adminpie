<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class section extends Model
{
   public static $breadCrumbColumn = 'section_name';
   protected $fillable = ['form_id','section_name','section_slug','section_description'];

   public function __construct(){
      try{
        if(Auth::guard('org')->check()){
          if(!empty(Session::get('organization_id'))){
            $this->table = Session::get('organization_id').'_form_sections';
          }
        }
      }catch(\Exception $e){
        
      }
    }
    
    function form(){
    	return $this->belongsTo('App\Model\Organization\forms','form_id');
    }
    function fields()
    {
    	return $this->hasMany('App\Model\Organization\FormBuilder','section_id','id');
    }

    public function sectionMeta(){
    	return $this->hasMany('App\Model\Organization\SectionMeta','section_id','id');
    }

    public function formsMeta(){
        return $this->hasMany('App\Model\Organization\FormsMeta','form_id','form_id');
    }

    public function setTable($table){

        $this->table = $table;
    }

}
