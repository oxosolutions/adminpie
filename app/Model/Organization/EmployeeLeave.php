<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class EmployeeLeave extends Model
{
	public static $breadCrumbColumn = 'id';
	protected $fillable =['employee_id', 'reason_of_leave', 'description', 'total_day_of_leave', 'from', 'to', 'approved_status', 'approved_by'];
    public function __construct()
    {
    	$this->table = get_organization_id()."_employee_leaves";
    }
}
