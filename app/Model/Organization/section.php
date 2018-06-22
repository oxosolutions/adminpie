<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class section extends Model
{
   public static $breadCrumbColumn = 'section_name';
   protected $fillable = ['form_id','section_name','section_slug','section_description','order'];

   public function __construct(){

          if(!empty(get_organization_id())){
            $this->table = get_organization_id().'_form_sections';
          }
    }    
    function form(){
    	return $this->belongsTo('App\Model\Organization\forms','form_id');
    }
    function fields()
    {
    	return $this->hasMany('App\Model\Organization\FormBuilder','section_id','id')->orderBy('order','ASC');
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
