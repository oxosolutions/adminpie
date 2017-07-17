<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class RolePermisson extends Model
{

	public static $breadCrumbColumn = 'id';

   	protected $fillable =[ "permisson_for", "permisson_type",  "permisson_id",  "permisson", 'role_id', 'module_id', 'read', 'write', 'delete', 'other', 'status'];

	public function __construct()
	   {	
		   	if(!empty(Session::get('organization_id')))
		   	{
		       $this->table = Session::get('organization_id').'_role_permissons';
		   	}
	   }
	public function permisson_module()
	{
		return $this->belongsTo('App\Model\Admin\GlobalModule','module_id');
	}

	// public function permisson()
 //    {
 //        return $this->morphTo();
 //    }

}
