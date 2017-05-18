<?php 
namespace App\Helpers;
use App\Model\Employee;
use App\Model\EmployeeLeave as Leave;
use App\Model\EmployeeAttendance as EMP_ATT;
use Carbon\Carbon;
use Illuminate\Http\Request;



class EmployeeHelper{

	public static function employ_info($employee_id)
	{
		$employee_data = Employee::where('employee_id',$employee_id);
		if($employee_data->count() >0)
		{
			return $employee_data->first();	
		}
		return false;
	}

	public static function employ_leave_check($emp_id , $date)
	{
		return	$date = date('Y-m-d', strtotime($date));		
	}

	public static function employee_checkin_checkout($request)
	{
		// `check_in`, `check_out`, `ip_address`
		$time = Carbon::now('Asia/Calcutta');
		$current_time =  gmdate('H:i:s',strtotime($time));
		echo $time->format('l jS \\of F Y h:i:s A');
		$ip =  \Request::ip();
		$year 	= 	$time->format('Y');
		$month 	= 	$time->format('m');
		$date  	=	$time->format('d');
		$day 	=  	$time->format('l');
		$data = EMP_ATT::select('id')->where([ 'user_id'=> $employee_id, 'year'=>$year ,'date'=>$date , 'month'=>$month ]);
		if($data->count() > 0)
		{
			$emp_attendance = EMP_ATT::find($data->first()->id);
		}
		else{
		$emp_attendance =	new EMP_ATT();
		}

		$emp_attendance->employee_id = $employee_id;
		$emp_attendance->$status = 		$current_time;
		$emp_attendance->year 	=		$year; 
		$emp_attendance->month 	=		$month; 
		$emp_attendance->date	=		$date;
		$emp_attendance->day	=		$day; 	
		$emp_attendance->month_week_no	= $time->weekOfMonth;
		$emp_attendance->ip_address	= $ip;
		$emp_attendance->save();
	}
}