<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class section extends Model
{
   protected $fillable = ['form_id','section_name','section_slug','section_description','order','status'];
   protected $table = 'global_form_sections'; 

    
    function form(){
    	return $this->belongsTo('App\Model\Admin\forms','form_id');
    }
    function fields()
    {
    	return $this->hasMany('App\Model\Admin\FormBuilder','section_id','id');
    }

    public function sectionMeta(){
    	return $this->hasMany('App\Model\Admin\SectionMeta','section_id','id');
    }

    public function formsMeta(){
        return $this->hasMany('App\Model\Admin\FormsMeta','form_id','form_id');
    }

}
