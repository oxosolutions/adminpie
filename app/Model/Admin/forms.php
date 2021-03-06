<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
class forms extends Model
{
    protected $fillable = ['form_title','form_slug','form_description','type','order','status','created_by'];
    protected $table	= 'global_forms';
    

	public function listForm()
	    {
	    	return self::pluck('form_title','id');
	    }    

    public function section(){
    	return $this->hasMany('App\Model\Admin\section','form_id','id');
    }

    public function formsMeta(){
    	return $this->hasMany('App\Model\Admin\FormsMeta','form_id','id');
    }
  
}

