<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class RolePermisson extends Model
{

   protected $fillable =[ 'role_id', 'module_id', 'read', 'write', 'delete', 'other', 'status'];

public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_role_permissons';
	   	}
   }

}
