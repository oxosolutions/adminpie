<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_contacts';
	   	}
   }
   protected $fillable = [ 'name', 'email'];
}
