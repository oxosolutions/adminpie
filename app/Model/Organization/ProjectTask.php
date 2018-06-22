<?php

namespace App\Model\Organization;
use Session;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
	public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_project_tasks';
	   	}
   }
   protected $fillable = [ 'project_id', 'title', 'description', 'assign_to', 'priority', 'end_date', 'status'];
}
