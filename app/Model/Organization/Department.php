<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Department extends Model
{
    public function __construct()
	{
	    if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_departments';
	    }
	}
	   protected $fillable = [ 'name', 'description', 'status'];

	public function departmentList(){
        return self::orderBy('id')->pluck('name','id');
    }
}
