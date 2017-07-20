<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Application extends Model
{
    public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_applications';
	   	}
   }
   protected $fillable = [ 'applicant_id', 'opening_id', 'status'];
}
