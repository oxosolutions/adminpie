<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class OrganizationDepartment extends Model
{
    public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_organization_departments';
	   	}
   }
   protected $fillable = ['name', 'description'];
}
