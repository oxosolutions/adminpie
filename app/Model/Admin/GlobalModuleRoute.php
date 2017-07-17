<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalModuleRoute extends Model
{
    protected $fillable = ['sub_module_id', 'route', 'route_name', 'status'];
	
	public function module_role_permisson()
    {
        return $this->hasMany('App\Model\Organization\RolePermisson','module_id','id');
    } 

   // public function permissons()
   //  {
   //      return $this->morphMany('RolePermisson', 'permisson');
   //  }
}
