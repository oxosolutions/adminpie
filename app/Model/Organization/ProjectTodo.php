<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class ProjectTodo extends Model
{
	public static $breadCrumbColumn = 'id';
    public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_project_todos';
	   	}
   }
   protected $fillable = [  'project_id', 'title', ' description', 'start', 'end', 'priority', 'status'];
}
