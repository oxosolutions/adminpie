<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class UsersRole extends Model
{	
   protected $fillable = [ 'name', 'description', 'status'];

   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users_roles';
	   	}
   }
   public function permisson()
   {
   		return $this->hasMany('App\Model\Organization\RolePermisson','role_id','id');
   }
   public function role_widget()
   {
      return $this->hasMany('App\Model\Organization\WidegetPermisson','role_id','id');
   }

}
