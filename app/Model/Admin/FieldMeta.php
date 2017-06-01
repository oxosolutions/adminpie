<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FieldMeta extends Model
{
	protected $table = 'global_form_field_meta';
	protected $fillable = ['field_id','key','value'];   
}
