<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class LeaveRule extends Model
{
    public function __construct()
	{
		if(!empty(Session::get('organization_id')))
		{
			$this->table = Session::get('organization_id').'_leave_rules';
		}

					//$this->table = '32_holidays';
	}
	//use SoftDeletes;
    protected $fillable = ['name', 'designation_id', 'leave_category_id', 'days', 'status'];
}
