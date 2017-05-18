<?php

namespace App\Http\Controllers\Organization\hrm;
use Excel;
use Illuminate\Http\Request;
use App\Model\Organization\Employee;
// use App\Model\EmployeeAttendance as Attendance;
//use App\Model\ListOfHoliday as LH;
use App\Model\Organization\Holiday as LH;

use App\Model\EmployeeLeave as Leave;
use App\Http\Controllers\Controller;
use App\Model\Organization\Attendance;

use Carbon\Carbon;
use DB;
use EmployeeHelper;
use Session;

class AttendanceController extends Controller
{
 	protected $current_date_data;
 	public function __construct()
 	{
 		$current_date_time = Carbon::now('Asia/Calcutta');
 		$this->current_date_data  = ['date'=>$current_date_time->day, 'month'=> '0'.$current_date_time->month , 'year'=>$current_date_time->year, 'day'=> $current_date_time->format('l') , 'month_week_no'=>$current_date_time->weekOfMonth];
 		
 	}
	public function design_attendance()
	{
		return view('common.Designattendances');
	}
	public function upload_attendence_form()
	{
		return view('common.create');
	}
	public function check_in_out(Request $request)
	{
		$status = $request->status;
		$employee_id = Employee::select('employee_id')->where('user_id',$request->user_id)->first()->employee_id;
		$time = Carbon::now('Asia/Calcutta');
		$ct = gmdate('H:i:s',strtotime($time));
		$current_time =  [gmdate('H:i:s',strtotime($time))];
		//echo $time->format('l jS \\of F Y h:i:s A');
		$ip =  \Request::ip();
		$year 	= 	$time->format('Y');
		$month 	= 	$time->format('m');
		$date  	=	$time->format('d');
		$day 	=  	$time->format('l');
		$data = Attendance::select(['id','check_in','check_out','check_for_checkin_checkout'])->where([ 'employee_id'=> $employee_id , 'year'=>$year ,'date'=>$date , 'month'=>$month ]);
		if($data->count() > 0)
		{
			$att_data = $data->first();
			$emp_attendance = Attendance::find($att_data->id);
			 if($status =='check_out')
			{
							echo $in_time = last(json_decode($att_data->check_in));
							echo '<br>in'. $times 	= new Carbon($in_time);
							echo '<br> out'. $shift_end_time 	= new Carbon($ct);
							echo 'total durnation '.$totalDuration 	= $times->diffInSeconds($shift_end_time);
							$total_time = gmdate('H:i:s', $totalDuration);
							dump($total_time);
			 }
			if(!empty($att_data->$status))
			{
				$current_time = array_collapse([ json_decode($att_data->$status) ,$current_time]);
			}
		}
		else{
		$emp_attendance =	new Attendance();
		}
		$emp_attendance->user_id = $request->user_id;
		$emp_attendance->employee_id = $employee_id;
		$emp_attendance->$status = 		json_encode($current_time);
		$emp_attendance->year 	=		$year; 
		$emp_attendance->month 	=		$month; 
		$emp_attendance->date	=		$date;
		$emp_attendance->day	=		$day; 	
		$emp_attendance->month_week_no	= $time->weekOfMonth;
		$emp_attendance->ip_address	= $ip;
		$emp_attendance->attendance_status = 'present';
		$emp_attendance->check_for_checkin_checkout = $status;
		$emp_attendance->submited_by ='self';
		$emp_attendance->save();
		dump($request->all());
	}
	
	public function attendance_import(Request $request)
	{
		if($request->file('attendance_file'))
		{	
			$storage_path = public_path().'/attendance_file';
			$file = $request->file('attendance_file');
			$file_name = str_random(13).$file->getClientOriginalName();
			$file->move($storage_path, $file_name);	
		
		Excel::load('attendance_file/'.$file_name, function ($reader)
		{
			$reader->noHeading();
			$all_data = json_decode(json_encode($reader->all()) , true);
			unset($all_data[0] , $all_data[1]); 
			$all_data = array_slice($all_data, 0);
			$keys = "abc";
			$i = 1;
			$dates = explode('~',$all_data[0][2]);
			$month_year = date('m-Y', strtotime($dates[0]));
			$year = date('Y', strtotime($dates[0]));
			$month = date('m', strtotime($dates[0]));
			$check_attendance = Attendance::where(['year'=>$year,'month'=>$month])->count();	
			if($check_attendance>0)
			{
				
				echo "alraedy import";
			}							
			foreach($all_data as $logkey => $logvalue)
			{				
				if ($logvalue[0] == "Period :")
				{
					dump($logvalue);
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
				// $employee_check = Employee::where('employee_id',$employee_id)->count();
				// if($employee_check ==0)
				// {
				// 	$employee  =	new Employee();
				// 	$employee->employee_id = $value['employee_id'];
				// 	//$employee->name = $value['name'];
				// 	$employee->department = $value['department'];
				// 	$employee->save();
				// }
				$limitDays = 1;
				$dt  = carbon::parse(date('Y-m-d',strtotime($dates[0])));
			  	$endLimit = $dt->daysInMonth;

				foreach ($value['attendence'] as $attendanceDate => $attendanceValue) {
					if($limitDays > $endLimit){
						break;
					}
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
							$attendance_status =	$day;
						}else{
							$attendance_status = 	"absent";
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
					if(empty($in_time) || is_null($in_time))
					{
						$in_time = Null;
					}

					if(empty($out_time) || is_null($in_time) )
					{
						$out_time = Null;
					}

					$data_for_insertion = ['employee_id'=>$employee_id,
											'year'=>$year,
											'month'=>$month,
											'date'=>$dates ,
											'day'=> $day,
											'month_week_no' => $month_week_no,
											'in_time' => $in_time,
											'out_time' => $out_time,
											'actual_hour' => $actual_hour,
											'total_hour' => $total_time,
											'over_time'  => $over_time,
											'due_time' => $due_time,
											'attendance_status' => $attendance_status,
											'import_data' => $attendanceValue,
											'submited_by' => "import"];
					$attendance_query = Attendance::where(['employee_id'=>$employee_id, 'year'=>$year,'month'=>$month, 'date'=>$dates]);
					if($attendance_query->count() >0)
					{
						$attendance_query->update($data_for_insertion);
					}else{

						$attendance = new Attendance();
						$attendance->fill($data_for_insertion);
						$attendance->save();
						$limitDays++;
					}
				}
								
			 }
			
		});
		echo "import_successfully";
		return redirect()->route('list.attendance');
		}
	}

	protected function filter($req)
	{
			unset($where);
				$where = [];
			if(!empty($req['date']))
			{
				$where['date']= $req['date'];
			}
			if(!empty($req['week']))
			{
				$where['month_week_no']= $req['week'];
			}
			 	$where['month'] = $month 	=  $req['month'];
				$where['year']  = $years  = $req['years'];

			if(strlen($month)==1)
			{
				$where['month'] = $month ='0'.$month;
			}
			return $where;
	}

	Public function list_attendance(Request $request)
	{	
		$plugins = [

				'js' => ['custom'=>['attendance']],
				'css' => ['custom'=>['attendance']]
		];
		//EmployeeHelper::employee_checkin_checkout(12,'check_out');
		$now = Carbon::now();
		$where['month'] = $month = $now->subMonth()->month;
		$where['year']  = $years = $now->year;	
		$fweek_no =  $fdate = null;
		 $dt = Carbon::parse($years.'-'.$month);
		$year_month  = "$years-$month";
		if ($request->isMethod('post'))
		{
				unset($where);
				$where = [];
			
			if(!empty($request['date']))
			{
				$fdate = $where['date']= $request['date'];
				Session::put('date',$fdate);
			}
			if(!empty($request['week']))
			{
				$fweek_no = $where['month_week_no']= $request['week'];
			}
			 	$where['month'] = $month 	=  $request['month'];
				$where['year']  = $years  = $request['years'];

			if(strlen($month)==1)
			{
				$where['month'] = $month ='0'.$month;
			}

			if(Attendance::where($where)->count()==0)
			{
				
				$error = "no data exist";
				return view('organization.attendance.attendance',['error'=>$error , 'month'=> $month , 'year'=> $years]);
				
			}
			 	$year_month  = "$years-$month"; 			
		 		$dt = Carbon::parse($year_month);	
		}
				//$where['submited_by'] = 'import';
				$count = Attendance::groupBy('employee_id')->selectRaw('count(id) as row,  employee_id')
				->where($where)->first()->row;
				$chunk = $total_days = $count;// $dt->daysInMonth;
				
				// if(isset($where['month_week_no']) )
				// {	
				// 	$chunk =7;
				// 	if($where['month_week_no'] ==5)
				// 	{
				// 		$chunk = $total_days;// -28;
				// 		dump($total_days);
				// 		//dd($chunk);
				// 	}
				// }
				if(isset($where['date']) )
				{	
					$chunk =1;
				}
				$holiday_data = LH::select([DB::raw('DAY(date_of_holiday) as day'),'title'])->whereYear('date_of_holiday', '=', $where['year'])
							->whereMonth('date_of_holiday', '=', $where['month'])
							->get();
				$attendance = Attendance::select('employee_id','day','date' ,'total_hour', 'over_time','attendance_status')->where($where)->get();
				$attendanceAggregate = Attendance::groupBy('employee_id')
		   		->selectRaw('sum(total_hour) as sum_total, sum(over_time) as ot, count(id) as row,  employee_id')->where($where);
				$total_hour = $attendanceAggregate->pluck('sum_total','employee_id');
				$total_over_time = $attendanceAggregate->pluck('ot','employee_id');
				$total_record = $attendanceAggregate->pluck('row','employee_id');

				$where['attendance_status'] ='present';

				$attendance_count = Attendance::orderBy('row','DESC ')->groupBy('employee_id')
		   		->selectRaw(' count(employee_id) as row,  employee_id')->where($where)->pluck('row','employee_id');
//dump('chunk'.$chunk);
				$attendance_data = array_chunk(json_decode(json_encode($attendance),true),$chunk);
				
				$leave_data = Leave::whereYear('from','=',$where['year'])->whereMonth('from','=',$where['month'])->where('approved_status',1)->get();
				
				$employee_data = Employee::all()->toArray();
				$where['submited_by'] = 'self';
				$attendance_by_self = Attendance::select('employee_id','day','date' ,'total_hour', 'over_time','attendance_status')->where($where)->get();
		
 		return view('organization.attendance.attendance', ['attendance_data'=>$attendance_data, 'chunk'=>$chunk , 'total_days'=>$total_days, 'month'=> $month , 'year'=> $years, 'attendance_count'=>$attendance_count ,'employee_data'=>$employee_data , 'holiday_data' => $holiday_data ,'leave_data'=>$leave_data, 'total_hour'=>$total_hour ,'total_over_time'=>$total_over_time , 'attendance_by_self'=>$attendance_by_self,'fweek_no'=>$fweek_no, 'fdate' =>  $fdate,'plugins'=>$plugins]);
		 // return view('common.Attendance',['attendance_data'=>$attendance_data, 'chunk'=>$chunk , 'total_days'=>$total_days, 'month'=> $month , 'year'=> $years, 'attendance_count'=>$attendance_count ,'employee_data'=>$employee_data , 'holiday_data' => $holiday_data ,'leave_data'=>$leave_data]);


	}

	public function attendance_by_hr()
	{	
		$attendance_data = null;
		$employee_data = Employee::all()->toArray();
		$attendance_check  = Attendance::where($this->current_date_data);
		if($attendance_check->count()>0)
		{
			$attendance_data = 	$attendance_check->get();
		}
		return view('organization.attendance.hrm_attendance',['employee_data'=>$employee_data, 'attendance_data'=> $attendance_data]);
	}
	public function attendance_fill_hr(Request $request )
	{

		foreach ($request->all() as $key => $value) {
			if($key !='_token')
			{
				$where 		= 	array_collapse([$this->current_date_data , ['employee_id'=>$key]]);
				$all_data 	= 	array_collapse([$this->current_date_data , $value]);	
				$attendance_check = Attendance::select('id')->where($where);
				if($attendance_check->count() > 0)
				{
					$attendance = Attendance::find($attendance_check->first()->id);
				}
				else
				{
					$attendance = 	new Attendance();
					$attendance->employee_id = $key;
				}
				$attendance->fill($all_data);
				$attendance->submited_by ="HR";
				$attendance->save();
			}
		}
		return redirect()->route('hr.attendance');
	}

}
