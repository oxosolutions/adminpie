<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class EmployeeAttendance extends Model
{
	use SoftDeletes;
    protected $fillable = [ 'employee_id', 'year','month_week_no','month','date','day', 'in_time', 'out_time', 'total_hour', 'actual_hour', 'over_time', 'due_time', 'check_in', 'check_out', 'ip_address','attendance_status'];
	protected $dates =['deleted_at'];
	protected $softDelete = true;

	public function employee()
	{
		return $this->belongsTo('App\Model\Employee','employee_id', 'employee_id');
	}
}
