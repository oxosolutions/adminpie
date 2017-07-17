<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class LeaveRule extends Model
{
	public static $breadCrumbColumn = 'id';
	protected $fillable = ['name', 'designation_id', 'user_id', 'leave_category_id', 'number_of_day', 'apply_before', 'status'];
    public function __construct()
	{
		if(!empty(Session::get('organization_id')))
		{
			$this->table = Session::get('organization_id').'_leave_rules';
		}
	}
	
	public function leave_category()
	{
		return $this->belongsTo('App\Model\Organization\Category','leave_category_id','id');
	}

}
