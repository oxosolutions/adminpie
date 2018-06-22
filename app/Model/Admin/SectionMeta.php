<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class SectionMeta extends Model
{
    protected $fillable = ['section_id','key','value'];
    protected $table = 'global_form_section_meta';
}
