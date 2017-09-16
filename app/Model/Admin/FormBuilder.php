<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class FormBuilder extends Model
{

    protected $table = 'global_form_fields';

    protected $fillable = ['field_slug', 'form_id', 'section_id', 'field_title','field_type','field_description','order','status'];
    
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

    public function section(){
        return $this->belongsTo('App\Model\Admin\section','section_id','id');
    }

    public function formsMeta(){
        return $this->hasMany('App\Model\Admin\FormsMeta','form_id','form_id');
    }
    public function listColumn()
    {  
        if(request()->route()->parameters()['id'] != null){
            $requestParameter = request()->route()->parameters()['id'];
        }else{
            $requestParameter = request()->route()->parameters()['form_id'];
        }
        $list = $this->where('form_id',$requestParameter)->pluck('field_title','id');
        return $list;
    }
}
