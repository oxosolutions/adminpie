<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalSubModule extends Model
{
    protected $fillable = ['module_id', 'sub_module_route', 'name', 'status']; 

	/*public function moduleRoute()
    {
        return $this->belongsTo('App\Model\Admin\GlobalModuleRoute','id','sub_module_id');
    } */

   

    public function moduleRoute()
    {
        return $this->hasMany('App\Model\Admin\GlobalModuleRoute','sub_module_id','id');
    } 


}
