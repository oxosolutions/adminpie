<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class ApplicationMeta extends Model
{
   protected $fillable = [ 'application_id', 'key', 'value'];
   public function __construct(){	
	   	if(!empty(get_organization_id())){
	       $this->table = get_organization_id().'_application_meta';
	   	}
   }

   // public function 
}
