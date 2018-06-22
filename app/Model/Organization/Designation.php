<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Designation extends Model
{
	public static $breadCrumbColumn = 'name';
	public function __construct()
	{
	    if(!empty(get_organization_id()))
	    {
	    	$this->table = get_organization_id().'_designations';
	    }
	}
	   protected $fillable = [ 'name', 'status'];

	public function designationList(){
        	return self::orderBy('id')->pluck('name','id');
    }

}
