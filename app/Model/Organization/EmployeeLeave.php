<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class EmployeeLeave extends Model
{
	protected $fillable =['employee_id', 'reason_of_leave', 'description', 'total_day_of_leave', 'from', 'to', 'approved_status', 'approved_by'];
    public function __construct()
    {
    	//dd(Session::get('organization_id'));
    	$this->table = Session::get('organization_id')."_employee_leaves";
    }
}
