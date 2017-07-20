<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class ApplicationMeta extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_application_meta';
	   	}
   }
   protected $fillable = [ 'application_id', 'key', 'value'];
}
