<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Department extends Model
{
	public static $breadCrumbColumn = 'id';
    public function __construct()
	{
	    if(!empty(get_organization_id()))
	    {
	    	$this->table = get_organization_id().'_departments';
	    }
	}
	   protected $fillable = [ 'name', 'description', 'status'];

	public function departmentList(){
        return self::orderBy('id')->pluck('name','id');
    }
    public static function departmentLists(){
        return self::orderBy('id')->where('status',1)->pluck('name','id');
    }

}
