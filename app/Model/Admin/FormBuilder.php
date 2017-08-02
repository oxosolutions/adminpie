<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class FormBuilder extends Model
{

    protected $table = 'global_form_fields';

    protected $fillable = ['field_slug', 'form_id', 'section_id', 'field_title','field_type','field_description','field_order'];
    
    public function fields()
    {
    	return $this->belongsTo('App\Model\Admin\section','id','section_id');
    }
    public function fieldMeta()
    {
        return $this->hasMany('App\Model\Admin\FieldMeta','field_id','id');
    }
    
    public function setTable($table){
        
        $this->table = $table;
    }
}
