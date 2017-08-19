<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class FormBuilder extends Model
{

    protected $table = 'global_form_fields';

    protected $fillable = ['field_slug', 'form_id', 'section_id', 'field_title','field_type','field_description','field_order'];

    public function __construct(){
        try{
            if(Auth::guard('org')->check()){
                if(!empty(Session::get('organization_id'))){
                    $this->table = Session::get('organization_id').'_form_fields';
                }
            }
        }catch(\Exception $e){
            
        }
    }
    
    public function fields()
    {
    	return $this->belongsTo('App\Model\Organization\section','id','section_id');
    }
    public function fieldMeta()
    {
        return $this->hasMany('App\Model\Organization\FieldMeta','field_id','id');
    }

    public function formsMeta(){
        return $this->hasMany('App\Model\Organization\FormsMeta','form_id','form_id');
    }
    
    public function setTable($table){
        
        $this->table = $table;
    }
}
