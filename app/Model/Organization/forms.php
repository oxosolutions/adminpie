<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
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
}

