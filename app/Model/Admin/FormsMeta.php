<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FormsMeta extends Model
{
    protected $table	= 'global_form_meta';
    protected $fillable = ['key','value','form_id'];
    public function forms(){
    	return $this->belongsTo('App\Model\Admin\forms','form_id','id');
    }
}
