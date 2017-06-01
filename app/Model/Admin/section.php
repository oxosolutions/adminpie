<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
   protected $fillable = ['form_id','section_name','section_slug','section_description'];
   protected $table = 'global_form_sections'; 

    function form(){
    	return $this->belongsTo('App\Model\Admin\forms','form_id');
    }
    function fields()
    {
    	return $this->hasMany('App\Model\Admin\FormBuilder','section_id','id');
    }
}
