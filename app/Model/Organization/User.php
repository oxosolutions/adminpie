<?php

namespace App\Model\Organization;
use Session;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable 
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users';
	   	}
   }
   
   protected $fillable = ['name', 'email', 'password', 'api_token', 'remember_token'];

   public function metas()
   {
   	return $this->hasMany('App\Model\Organization\UsersMeta','user_id','id');
   }

   public function employee_rel()
   {
      return $this->hasOne('App\Model\Employee','user_id','id');
   }
}
