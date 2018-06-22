<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class UsersNote extends Model
{
	public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_users_notes';
	   	}
   }
   
   protected $fillable = ['user_id', 'title', 'description', 'priority'];

}
