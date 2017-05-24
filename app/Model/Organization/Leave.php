<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class Leave extends Model
{
    
	public function __construct()
	{
		if(!empty(Session::get('organization_id')))
		{
			$this->table = Session::get('organization_id').'_leaves';
		}

					//$this->table = '32_holidays';
	}
	//use SoftDeletes;
    protected $fillable = ['name', 'employee_id', 'leave_category_id', 'from', 'to', ' description', 'total_days', 'status'];
   
}
