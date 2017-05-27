<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class UsersRole extends Model
{	

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
   protected $fillable = [ 'name', 'description', 'status'];
}
