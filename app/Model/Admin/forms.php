<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class forms extends Model
{
    protected $fillable = ['form_title','form_slug','form_description'];
    protected $table	= 'global_forms';

    function section(){
    	return $this->hasMany('App\Model\Admin\section','form_id','id');
    }
}

