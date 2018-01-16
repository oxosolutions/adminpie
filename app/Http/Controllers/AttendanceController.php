<?php

namespace App\Http\Controllers;
use Excel;
use Illuminate\Http\Request;
use App\Model\Organization\Employee;
use App\Model\EmployeeAttendance as Attendance;
use App\Model\ListOfHoliday as LH;
use App\Model\EmployeeLeave as Leave;
use Carbon\Carbon;
use DB;
use EmployeeHelper;

class AttendanceController extends Controller
{
 
	public function design_attendance()
	{
		return view('common.Designattendances');
	}
	public function upload_attendence_form()
	{
		return view('common.create');
	}
	public function list_holiday_form()
	{
		
	}
	public function list_holiday_save(Request $request)
	{

	}

	public function attendance_import(Request $request)
	{
		if($request->file('attendance_file'))
		{	
			$storage_path = public_path().'/attendance_file';
			$file = $request->file('attendance_file');
			$file_name = $file->getClientOriginalName();
			$file->move($storage_path,$file_name);	
		
		Excel::load('attendance_file/'.$file_name, function ($reader)
		{
			$reader->noHeading();
			$all_data = json_decode(json_encode($reader->all()) , true);
			$keys = "abc";
			$i = 1;

			$dates = explode('~',$all_data[1][2][2]);
			$month_year = date('m-Y', strtotime($dates[0]));
			$year = date('Y', strtotime($dates[0]));
			$month = date('m', strtotime($dates[0]));
			$check_attendance = Attendance::where(['year'=>$year,'month'=>$month])->count();	
			if($check_attendance>0)
			{
				echo "alraedy import";
				die;
			}							
			foreach($all_data[1] as $logkey => $logvalue)
			{				
				if ($logvalue[0] == "Period :")
				{
					
				}
				if ($logvalue[0] == "No :")
				{
					foreach($logvalue as $log_val_key => $log_value)
					{
						if (is_null($log_value))
						{
							unset($logvalue[$log_val_key]);
						}
						else
						{
							if ($log_val_key == 2)
							{
								$employee[$i]['employee_id'] = $log_value;
							}
							if ($log_val_key == 10)
							{
								$employee[$i]['name'] = $log_value;
							}
							if ($log_val_key == 20)
							{
								$employee[$i]['department'] = $log_value;
							}
						}
					}
					$keys = $logkey + 1;
				}
				else
				{
					if ($logkey == $keys && $keys != "abc")
					{
						$employee[$i]['attendence'] = $logvalue;
						$i++;
					}
				}
			}
			foreach ($employee as $key => $value) {
				
				$employee_id = $value['employee_id'];
				$employee_check = Employee::where('employee_id',$employee_id)->count();
				if($employee_check ==0)
				{
					$employee  =	new Employee();
					$employee->employee_id = $value['employee_id'];
					//$employee->name = $value['name'];
					$employee->department = $value['department'];
					$employee->save();
				}
				foreach ($value['attendence'] as $attendanceDate => $attendanceValue) {
					$dates =	$attendanceDate;
					$dates++;
					$full_date = $dates.'-'.$month_year;
					$day = date('l', strtotime($full_date));
					$due_time = $over_time = $total_time ="00:00:00";
					if(is_null($attendanceValue))
					{
						$in_time =null;		
						$out_time =null;
						if($day == "Sunday")
						{
							$attendance_status =$day;
						}else{
							$attendance_status = "absent";
						}		
					}
					else
					{
						$time =	explode(PHP_EOL, $attendanceValue);
						$in_time 	= $time[0];
						$out_time 	= $time[1];
						$actual_hour = '09:00:00';
						if(!empty($in_time ) && !empty($out_time))
						{
							$actual_hours	= new Carbon('09:00:00');
							$time = new Carbon($in_time);
							$shift_end_time =new Carbon($out_time);
							$totalDuration = $time->diffInSeconds($shift_end_time);
							$total_time = gmdate('H:i:s', $totalDuration);
							$total = new Carbon($total_time);
								if($total>$actual_hours)
								{	
									$over_time = gmdate('H:i:s',$actual_hours->diffInSeconds($total));
								}else{ 
									$due_time = gmdate('H:i:s',$actual_hours->diffInSeconds($total));
								}
						}	
							
    					$diff = (strtotime($out_time) - strtotime($in_time));
    					$total = $diff/60;
						if(is_null($in_time) &&  is_null($out_time))
						{
							$attendance_status = "absent";
						}else{
							$attendance_status = "present";		
						}
					}

			 		$carbon = carbon::parse("$dates-$month_year");
					$month_week_no =$carbon->weekOfMonth;

					$attendance = new Attendance();
					$attendance->employee_id = $employee_id;
					$attendance->year 		 = $year;
					$attendance->month  	 = $month;
					$attendance->date  		 = $dates;
					$attendance->day  		 = $day;
					$attendance->month_week_no = $month_week_no;
					$attendance->in_time 	 = $in_time;
					$attendance->out_time 	 = $out_time;
					$attendance->actual_hour = $actual_hour;
					$attendance->total_hour  = $total_time;
					$attendance->over_time 	 = $over_time;
					$attendance->due_time 	 = $due_time;
					$attendance->attendance_status 	 = $attendance_status;
					$attendance->import_data 	 = $attendanceValue;
					$attendance->save();
				}
				
				
			 }
			
		});
		echo "import_successfully";
	}
	}

	Public function list_attendance(Request $request)
	{	
		//EmployeeHelper::employee_checkin_checkout(12,'check_out');
		$now = Carbon::now();
		$where['month'] = $month = '0'.$now->month -1;
		$where['year']  = $years = $now->year;
		$dt = Carbon::parse($years.'-'.$month);

		if($month ==0)
		{
			$where['month'] = $month = 12;
			$where['year']  = $years = $years-1;
		}

		$year_month  = "$years-$month";
		if ($request->isMethod('post'))
		{

			unset($where);
			$where = [];
			if(!empty($request['week']))
			{
				$where['month_week_no']= $request['week'];
			}
			$where['month'] = $month 	=  $request['month'];
			$where['year']  = $years  = $request['years'];
			if(count($month)==1)
			{
				$where['month'] = $month ='0'.$month;
			}

			$year_month  = "$years-$month";
		 	$dt = Carbon::parse($year_month);	
		 		  	
		 	//die;
		}

		$chunk = $total_days = $dt->daysInMonth;

		if(isset($where['month_week_no']) )
		{	
			$chunk =7;
			if($where['month_week_no'] ==5)
			{
				$chunk = $total_days -28;
			}
		}
		$holiday_data = LH::select([DB::raw('DAY(date_of_holiday) as day'),'title','holiday_status'])->whereYear('date_of_holiday', '=', $where['year'])
					->whereMonth('date_of_holiday', '=', $where['month'])
					->get();

		$attendance = Attendance::select('employee_id','day','date','attendance_status')->where($where)->get();

		
		$where['attendance_status'] ='present';
		
		$attendance_count = DB::table('employee_attendances')->select([DB::raw('count(employee_id) as attendance_count, employee_id')])
			->where($where)
            ->groupBy('employee_id')
            ->get();	
		$attendance_count = json_decode(json_encode($attendance_count),true);
		$attendance_data = array_chunk(json_decode(json_encode($attendance),true),$chunk);
		$leave_data = Leave::whereYear('from','=',$where['year'])->whereMonth('from','=',$where['month'])->where('approved_status',1)->get();
		
		$employee_data = Employee::all()->toArray();
 		return view('organization.attendance.attendance', ['attendance_data'=>$attendance_data, 'chunk'=>$chunk , 'total_days'=>$total_days, 'month'=> $month , 'year'=> $years, 'attendance_count'=>$attendance_count ,'employee_data'=>$employee_data , 'holiday_data' => $holiday_data ,'leave_data'=>$leave_data]);
		 // return view('common.Attendance',['attendance_data'=>$attendance_data, 'chunk'=>$chunk , 'total_days'=>$total_days, 'month'=> $month , 'year'=> $years, 'attendance_count'=>$attendance_count ,'employee_data'=>$employee_data , 'holiday_data' => $holiday_data ,'leave_data'=>$leave_data]);


	}

}
