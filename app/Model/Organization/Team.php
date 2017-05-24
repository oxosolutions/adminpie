<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Team extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_teams';
	   	}
   }
   protected $fillable = ['title', 'description', 'member_ids'];
}
