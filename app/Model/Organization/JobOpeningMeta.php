<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class JobOpeningMeta extends Model
{
   public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(get_organization_id()))
	   	{
	       $this->table = get_organization_id().'_opening_meta';
	   	}
   }
   protected $fillable = [  'opening_id', 'key', 'value'];
}
