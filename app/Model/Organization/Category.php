<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Category extends Model
{
    //
     public function __construct()
	{
	    if(!empty(Session::get('organization_id')))
	    {
	    	$this->table = Session::get('organization_id').'_categories';
	    }
	}
	protected $fillable = ['name', 'description', 'type', 'status'];

	public function rule()
    {
    	return $this->hasMany('App\Model\Organization\LeaveRule','leave_category_id','id');
    }
}
