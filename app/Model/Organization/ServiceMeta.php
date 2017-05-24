<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class ServiceMeta extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_services';
	   	}
   }
   protected $fillable = [ 'service_id', 'key', 'value'];


}
