<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalWidget extends Model
{
    protected $fillable = ['title', 'description', 'status'];

    public function widget_permisson()
    {
    	return $this->hasMany('App\Model\Organization\WidegetPermisson','widget_id','id');
    }

}
