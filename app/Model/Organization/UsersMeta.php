<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class UsersMeta extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users_metas';
	   	}
   }
   
   protected $fillable = ['user_id', 'key', 'value', 'type'];
}
