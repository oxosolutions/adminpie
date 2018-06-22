<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class OrganizationDepartment extends Model
{
	public static $breadCrumbColumn = 'id';
    public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_organization_departments';
	   	}
   }
   protected $fillable = ['name', 'description'];
}
