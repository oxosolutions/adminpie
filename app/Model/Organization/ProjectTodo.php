<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class ProjectTodo extends Model
{
    public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_project_todos';
	   	}
   }
   protected $fillable = [  'project_id', 'title', ' description', 'start', 'end', 'priority', 'status'];
}
