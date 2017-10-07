<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalGroup extends Model
{
    protected $fillable = ['name','description','modules','status','created_by'];
    protected $table	= 'groups';
    

}
