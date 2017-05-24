<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users_roles';
	   	}
   }
   
   protected $fillable = [ 'name', 'description', 'status'];
}
