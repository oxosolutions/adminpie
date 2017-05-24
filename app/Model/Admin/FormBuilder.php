<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class FormBuilder extends Model
{
    protected $table = 'global_form_builder_meta';

    protected $fillable = ['id', 'key', 'value', 'type'];
}
