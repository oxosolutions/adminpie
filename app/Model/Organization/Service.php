<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	public static $breadCrumbColumn = 'id';
     public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_services';
	   	}
   }
   protected $fillable = [  'name', 'description', 'cost'];
}
