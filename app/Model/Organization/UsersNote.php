<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class UsersNote extends Model
{
	public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users_notes';
	   	}
   }
   
   protected $fillable = [`user_id`, `title`, `description`, `priority`];

}
