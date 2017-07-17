<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class Attendance extends Model
{
	public static $breadCrumbColumn = 'employee_id';
	public function __construct()
	{

		if(!empty(Session::get('organization_id')))
		{
			$this->table = Session::get('organization_id').'_attendances';
		}
				//	$this->table = '32_attendances';

	}


    protected $fillable = [ 'punch_in_out', 'in_out_data', 'employee_id', 'year','month_week_no','month','date','day', 'in_time', 'out_time', 'total_hour', 'actual_hour', 'over_time', 'due_time', 'check_in', 'check_out', 'ip_address','attendance_status','import_data', 'submited_by'];
	//protected $dates =['deleted_at'];
	//protected $softDelete = true;

	public function employee()
	{
		return $this->belongsTo('App\Model\Organization\Employee','employee_id', 'employee_id');
	}
}
