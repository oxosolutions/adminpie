<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class UsersTodo extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users_todos';
	   	}
   }
   
   protected $fillable = [  'project_id', 'title', ' description', 'start', 'end', 'priority'];
}
