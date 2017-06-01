<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FormBuilder extends Model
{

    protected $table = 'global_form_fields';

    protected $fillable = ['field_slug', 'form_id', 'section_id', 'field_title','type','field_description','field_order'];

    public function fields()
    {
    	return $this->belongsTo('App\Model\Admin\section','id','section_id');
    }
}
