<?php

namespace App\Http\Controllers\Organization\hrm;
use Excel;
use Validator;
use Illuminate\Http\Request;
use App\Model\Organization\Employee;
use App\Model\Organization\Holiday;
use App\Model\Organization\EmployeeLeave as Leave;
use App\Http\Controllers\Controller;
use App\Model\Organization\Attendance;
use App\Model\Organization\AttendanceFile;
use App\Model\Organization\User;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\Shift;
use App\Model\Group\GroupUsers;
use Carbon\Carbon;
use DB;
use EmployeeHelper;
use Session;
use Auth;
use Illuminate\Support\Collection;
/*
    |--------------------------------------------------------------------------
    | Attendance Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles Employee's Attendance. Some important Methods list below with description:-
    | @import_form : This method display Import form & form post on @attendance_Import
    | @attendance_import :  This method handle xls file to import monthly attendance of employee.
    |  
    |	Method use To display attendance list below:-
    |		1. 	list_attendance : Return on view (organization/attendance/attendance.blade.php) then Ajax request goes to AttendanceController@ajax method 
    |							  & get attendance data by default previous month from current month.
    			UPDATE 14th February 2018 (@SGS Sandhu): Method renamed to hrm_attendance_view
    |       2.  Ajax : This method use for Ajax Request to get attendance & also handle filter attendance by- Monthly, weekly, Daily. 
    |				   Return on view (organization/attendance/attendance_table.blade.php) deal in monthly, weekly, daily tray.
    |				   attendance_data_disply.blade.php deal in employee list & attendance data display in this file.
    |
    */

class AttendanceController extends Controller
{
 	protected $current_date_data;
 	public function __construct() {
 		$current_date_time = Carbon::now('Asia/Calcutta');
 		$this->current_date_data  = ['date'=>$current_date_time->day, 'month'=> '0'.$current_date_time->month , 'year'=>$current_date_time->year, 'day'=> $current_date_time->format('l') , 'month_week_no'=>$current_date_time->weekOfMonth];
 	}
 	
	public function design_attendance()
	{
		return view('common.Designattendances');
	}
	/**
     * check_in_out
     * @param  Request $request [posted data]
     * @return [route]           [will redirect back]
     * @author  paljinder Singh, rahul
     */
	public function check_in_out(Request $request)
	{
		$u_id = Auth::guard('org')->user()->id;
		$status = $request->status;
		$employee_id = Employee::select('employee_id')->where(['user_id'=>$u_id])->first()->employee_id;
		$time = Carbon::now('Asia/Calcutta');
		$ct = gmdate('H:i:s',strtotime($time));
		$ip =  \Request::ip();
	
		$year 	= 	$time->format('Y');
		$month 	= 	$time->format('m');
		$date  	=	str_replace('0', '', $time->format('d'));
		
		$day 	=  	$time->format('l');
		$data = Attendance::select(['id','check_for_checkin_checkout','in_out_data'])->where([ 'user_id'=> $u_id , 'year'=>$year ,'date'=>$date , 'month'=>$month ]);
		if($data->count() > 0)
		{
			$att_data = $data->first();
			$emp_attendance = Attendance::find($att_data->id);
			if(!empty($att_data->in_out_data))
			{	
				$current_time =[];
				$inserted_time = json_decode($att_data->in_out_data,true);
				for($i=0; $i<count($inserted_time); $i++)
				{
					array_push($current_time, $inserted_time[$i]);	
				}
				array_push($current_time, [$ip=>gmdate('H:i:s',strtotime($time))]);
			}
		}
		else{
			$emp_attendance =	new Attendance();
			$current_time[] =  [$ip=>gmdate('H:i:s',strtotime($time))];

		}
		$emp_attendance->user_id = $u_id;
		$emp_attendance->employee_id = $employee_id;
		$emp_attendance->in_out_data = 		json_encode($current_time);
		$emp_attendance->year 	=		$year; 
		$emp_attendance->month 	=		$month; 
		$emp_attendance->date	=		$date;
		$emp_attendance->day	=		$day; 	
		$emp_attendance->month_week_no	= $time->weekOfMonth;
		//$emp_attendance->ip_address	= $ip;
		$emp_attendance->attendance_status = 'present';
		$emp_attendance->check_for_checkin_checkout = $status;
		$emp_attendance->submited_by ='self';
		$emp_attendance->save();

		return ['message'=>'successfully '];
	}
	
	/**
     * import_form
     * @param  Request $request [posted data]
     * @return [route]           [will redirect back]
     * @author  paljinder Singh, rahul
     */
	public function import_form(Request $request, $year=null, $month=null)
	{	
		if(empty($year) || empty($month) ){
			return redirect()->route('lists.attendance');
		}
		$data['month'] = $month;
		$data['year'] =  $year;
		if($request->isMethod('post')){
			$data['year']	= $request['import_year'];
			$data['month']	= $request['import_month'];
		}
		return view('organization.attendance.attendance_import',compact('data'));
	}

	/**
     * upload_import use in attendance_import method 
     * @param  Request $request , organization id 
     * @return file path + name
     * @author  paljinder Singh
     */
	protected function upload_import($request , $orgID){
		$storage_path = env('USER_FILES_PATH').'_'.$orgID.'/hrm_attendance_import_files';
		$file = $request->file('attendance_file');
		$file_name = str_random(13).$file->getClientOriginalName();
		$file->move($storage_path, $file_name);
		return $storage_path.'/'.$file_name;
	}
	/**
     * read_import_file  (read data of file) use in attendance_import method 
     * @param  file name 
     * @return attendance data
     * @author  paljinder Singh
     */
	protected function read_import_file($file_name){
		$data =''; 
		Excel::load($file_name, function ($reader)use(&$data)
		{
			$reader->noHeading();
			$data = json_decode(json_encode($reader->get()[1]) , true);
		});
		unset($data[0] , $data[1]); 
		$all_data = array_slice($data, 0);
		return $all_data;
	}

	/**
     * validate_import_request
     * @param  request file 
     * @return Validation result
     * @author  paljinder Singh
     */
	protected function validate_import_request($request, $file){
		$this->validate($request, [
        'attendance_file' => 'required',
        'title'=>'required'
      
    	]);
		$validator = Validator::make(
			    [	'file'      => $file,
			         'extension' => strtolower($file->getClientOriginalExtension()),
			    ],
			    [	'file'          => 'required',
			        'extension'      => 'required|in:csv,xls,xlsx,XLS',
			    ]
			);
		return $validator;
	}
	/**
     * import_data_handling use in attendance_import method 
     * @param  Attendance data  
     * @return 
     * @author  paljinder Singh
     */
	protected function check_employee_id(){
		return $employee_ids = UsersMeta::where('key','employee_id')->pluck('value','user_id')->toArray();
	}
	protected function import_data_handling($data, $year, $month_year, $month, $dates, $daysInMonth){
		$keys = "abc";
			$i = 1;
			$employee_ids  = $this->check_employee_id();
            foreach($data as $logkey => $logvalue){				
					if ($logvalue[0] == "Period :"){}
					if ($logvalue[0] == "No :"){
						foreach($logvalue as $log_val_key => $log_value){
							if (is_null($log_value)){
								unset($logvalue[$log_val_key]);
							}
							else{
								if ($log_val_key == 2){
									
									$employee[$i]['employee_id'] = $log_value;
								}
								if ($log_val_key == 10){
									$employee[$i]['name'] = $log_value;
								}
								if ($log_val_key == 20){
									$employee[$i]['department'] = $log_value;
								}
							}
						}
						$keys = $logkey + 1;
					}
					else{
						if ($logkey == $keys && $keys != "abc"){
							$employee[$i]['attendence'] = $logvalue;
							$i++;
						}
					}
				}
				foreach ($employee as $key => $value) {
					if(!in_array($value['employee_id'], $employee_ids)) {
										continue;
									}
					$employee_id = $value['employee_id'];
					$limitDays = 1;
				if(isset($value['attendence'])){
 					foreach ($value['attendence'] as $attendanceDate => $attendanceValue) {
						if($limitDays > $daysInMonth){
							break; 
						}
						$pus_in_out =null;
						$dates =	$attendanceDate;
						$date_data[] = $attendanceDate;
						$dates++;
						$full_date = $dates.'-'.$month_year;
						$day = date('l', strtotime($full_date));
						$due_time = $over_time = $total_time ="00:00:00";
						if(is_null($attendanceValue)){
							$in_time =null;		
							$out_time =null;
							if($day == "Sunday"){
								$attendance_status =	$day;
							}else{
								$attendance_status = 	"absent";
							}		
						}
						else{
							$pushinout =null;
							$time =	explode(PHP_EOL, $attendanceValue);
							if(count($time)>0)
							{
								for($i=0; $i<count($time); $i++)
								{
									if(!empty($time[$i])){
										$pushinout[] =	$time[$i];
									}
								}
								$pus_in_out = json_encode($pushinout);
							}
							$in_time 	= $time[0];
							$out_time 	= $time[1];
							// $actual_hour = '09:00:00';
							// if(!empty($in_time ) && !empty($out_time)){
							// 	$actual_hours	= new Carbon('09:00:00');
							// 	$time = new Carbon($in_time);
							// 	$shift_end_time =new Carbon($out_time);
							// 	$totalDuration = $time->diffInSeconds($shift_end_time);
							// 	$total_time = gmdate('H:i:s', $totalDuration);
							// 	$total = new Carbon($total_time);
							// 		if($total>$actual_hours){	
							// 			$over_time = gmdate('H:i:s',$actual_hours->diffInSeconds($total));
							// 		}else{ 
							// 			$due_time = gmdate('H:i:s',$actual_hours->diffInSeconds($total));
							// 		}
							// }
	    					// $diff = (strtotime($out_time) - strtotime($in_time));
	    					// $total = $diff/60;
							if(is_null($in_time) &&  is_null($out_time)){
								$attendance_status = "absent";
							}else{
								$attendance_status = "present";		
							}
						}
				 		$carbon = carbon::parse("$dates-$month_year");
						$month_week_no =$carbon->weekOfMonth;
						if(empty($in_time) || is_null($in_time)){
							$in_time = Null;
						}
						if(empty($out_time) || is_null($in_time)){
							$out_time = Null;
						}
						$data_for_insertion = ['employee_id'=>$employee_id,
												'year'=>$year,
												'month'=>$month,
												'date'=>$dates ,
												'day'=> $day,
												'month_week_no' => $month_week_no,
												'attendance_status' => $attendance_status,
												'punch_in_out'=> $pus_in_out,
												'import_data' => $attendanceValue,
												'submited_by' => "import",
												'over_time'=>null];
						$where =['employee_id'=>$employee_id, 'year'=>$year,'month'=>$month, 'date'=>$dates];
						$attendance_query = Attendance::where($where);
						if($attendance_query->count() >0){
							$shift_hours_overtime = $this->shift_hours_overtime($attendance_query, $day, $employee_id, $employee_ids,  $pushinout);
							if(!empty($shift_hours_overtime)){
								$data_for_insertion = array_merge($data_for_insertion, $shift_hours_overtime);
							}
						$attendance_query->update($data_for_insertion);
						}else{
							$shift_data = $this->get_shift_hours($employee_id, $employee_ids);
								if(!empty($shift_data)){
									if(in_array(strtolower($day), $shift_data['working_days'])){
										$data_for_insertion['shift_hours'] = json_encode($shift_data['shift_hours']);
										$over_times = $this->calculate_over_time($shift_data['shift_hours'] , $pushinout);
										if(!empty($over_times)){
											$data_for_insertion['over_time'] = $over_times;
										}
									}
								}
							$attendance = new Attendance();
							$attendance->fill($data_for_insertion);
							$attendance->save();
							$limitDays++;
						}
					}
					}									
				 }
			return $employee;
	}
	protected function shift_hours_overtime($attendance_query, $day, $employee_id, $employee_ids,$pushinout){
		$data_for_insertion =null;
		$shift_hours = $attendance_query->first()->shift_hours;
		if(empty($shift_hours)){
			$shift_data = $this->get_shift_hours($employee_id, $employee_ids);
			if(!empty($shift_data)){
				if(in_array(strtolower($day), $shift_data['working_days'])){
					$over_times = $this->calculate_over_time($shift_data['shift_hours'] , $pushinout);
					if(!empty($over_times)){
						$data_for_insertion['over_time'] = $over_times;
					}
					$data_for_insertion['shift_hours'] = json_encode($shift_data['shift_hours']);
				}else{
					if(!empty($pushinout) && !empty($pushinout[1]) && !empty($pushinout[0])){
						$data_for_insertion['over_time'] = $this->calculate_hour($pushinout[0],$pushinout[1], "sec");
					}
				}
			}
		}else{
		 	$shift_hour = json_decode($shift_hours, true);
		 	$over_times = $this->calculate_over_time($shift_hour , $pushinout);
			if(!empty($over_times)){
				$data_for_insertion['over_time'] = $over_times;
			}
		}
		return $data_for_insertion;
	}
	protected function calculate_over_time($shift_data, $pushinout ){
		$actual_hours = $this->calculate_hour($shift_data[0], $shift_data[1], "hr");	
		if(!empty($pushinout) && !empty($pushinout[1]) && !empty($pushinout[0])){
			$total_working_hours = $this->calculate_hour($pushinout[0],$pushinout[1], "hr");
				if($total_working_hours > $actual_hours || ($total_working_hours < $actual_hours)){
					return $this->calculate_hour($actual_hours, $total_working_hours, "sec");
				}
		} 
		return null;
	}
	protected function calculate_hour($from, $to, $retun_time){
 		$time = new Carbon($from);
		$shift_end_time =new Carbon($to);
		$totalDuration = $time->diffInSeconds($shift_end_time, false);
		if($retun_time=="sec"){
			return $totalDuration;
		}elseif($retun_time=="hr"){
			return $total_time = gmdate('H:i', $totalDuration);
		}
	}
	protected function get_shift_hours($employee_id, $employee_ids){
		$shift_hours = null;
		$user_id  = array_search($employee_id, $employee_ids);
		$shift_id = get_user_meta($user_id, 'user_shift');
		$shift = Shift::select(['working_days','from','to'])->where('id',$shift_id)->whereNotNull('from')->whereNotNull('to')->whereNotNull('working_days');
		if($shift->exists()){
			$shift_data 	= 	$shift->first()->toArray();
			$working_days	=	json_decode($shift_data['working_days'], true);
			$shift_time 	=	[$shift_data['from'],$shift_data['to']];  
			$shift_hours 	=  	array_values($shift_time);
			return ['working_days'=>$working_days, 'shift_hours'=>$shift_hours];
		}
		return $shift_hours;
	}
	/**
     * import_file_save  (read data of file) use in attendance_import method 
     * @param  title of file & name  
     * @return 
     * @author  paljinder Singh
     */
	protected function import_file_save($title , $file_name){
				Session::flash('success',' File upload successfully!');
				$attendanceFile = new AttendanceFile();
				$attendanceFile->title = $title;
				$attendanceFile->name =  $file_name;
				$attendanceFile->save(); 
	}
	/**
     * attendance_import_file  list below include methods 
     * 1. validate_import_request
     * 2. upload_import
     * 3. read_import_file
     * 4. import_data_handling
     * 5. import_file_save
     * @param  file name 
     * @return attendance data
     * @author  paljinder Singh
     */
	public function attendance_import(Request $request)
	{
		$checkStatus = ''; $orgID = Session::get('organization_id'); $file = $request->file('attendance_file');
		if ($this->validate_import_request($request, $file)->fails()) {
        	return back();
    	}
		if($request->file('attendance_file')) {	
			$file_name = $this->upload_import($request ,$orgID);
            $data = $this->read_import_file($file_name);
            $dates = explode('~',$data[0][2]);
			$month_year = date('m-Y', strtotime($dates[0]));
			$year = date('Y', strtotime($dates[0]));
			$check_month = $month = date('m', strtotime($dates[0]));
			$daysInMonth = cal_days_in_month(CAL_GREGORIAN,$month,$year);
			if(!empty($request['year']) && !empty($request['month']) && $request['month'] != $check_month || $request['year'] != $year){
				Session::flash('error','Not match Month & year.');
				return redirect()->route('import.form.attendance',['year'=>$request['year'],'month'=>$request['month']]);
			}
        	$this->import_data_handling($data, $year, $month_year, $month, $dates, $daysInMonth);
			if(!Session::has('error')){
				$this->import_file_save($request->title, $file_name);
			}
			return redirect()->route('attendance.files');
		}
	}
	/**
     * attendance_file  (read data of file) use in attendance_import method 
     * @param -
     * @return view list of fille
     * @author  paljinder Singh
     */
	public function attendance_file(){
		$files = AttendanceFile::all();
		return view('organization.attendance.attendance_file',['data'=>$files]);
	}
	/**
     * filter method use in ajax to set filter data for query
     * @param $request
     * @return array where
     * @author  paljinder Singh
     */
	protected function set_filter_for_attendance($request)
	{
		if ($request->isMethod('post')) {
			unset($where);
			$where = [];
			if(!empty($request['date'])) {
				 $where['date']= $request['date'];
				Session::put('date',$request['date']);
			}else{
				Session::forget('date');
			}
			if(!empty($request['week'])) {
				$where['month_week_no'] = $request['week'];
			}
			 	$month  = $where['month'] =   $request['month'];
				$where['year']  = 	$request['year'];
			if(strlen($month)==1) {
				$where['month'] = '0'.$month;
			}
		}
		return $where;
	}
	

	/************************************************************
	*	@function hrm_attendance_view
	*	@description Generates the attendance view in HRM
	*	@access	public
	*	@since	1.0.0.0
	*	@author	SGS Sandhu(sgssandhu.com)
	*	@perm request		[collection	optional	default	collection]
	*	@perm year		[string	optional	default	null]
	*	@perm month		[string	optional	default	null]
	*	@return view
	************************************************************/
	public function hrm_attendance_view(Request $request, $year=null, $month=null){
		$data['year'] = $data['month'] = null;
		if($request->isMethod('post')){
			$data['year'] = $request['year'];
			$data['month'] = $request['month'];
		}

 		return view('organization.hrm.attendance.hrm-attendance-view',['data'=>$data]);
	}

	

	/**
     * ajax use for attendance display & filter attendance 
     * @param -$request
     * @return view (organization/attendance/attendance_table.blade.php +include attendance_data_display.blade.php  ) 
     * @author  paljinder Singh
     */
	protected function monthly_previous_next($carbon){
		if(!empty($carbon)){
			$preivous_day = $carbon->copy()->subDay();
			$data['daily_previous_date'] = $preivous_day->day;
			$data['daily_previous_month'] = $preivous_day->month;
			$data['daily_previous_year'] = $preivous_day->year;

			$next_day = $carbon->copy()->addDay();
			$data['daily_next_date'] = $next_day->day;
			$data['daily_next_month'] = $next_day->month;
			$data['daily_next_year'] = $next_day->year;

			$data['current_week_of_month'] = $carbon->weekOfMonth;

			$previous_week = $carbon->copy()->subWeek();

			$data['previous_week']			= $previous_week->weekOfMonth;
			$data['previous_week_year']		= $previous_week->year;
			$data['previous_week_month']	= $previous_week->month;


			$next_week = $carbon->copy()->addWeek();
			$data['next_week']			= $next_week->weekOfMonth;
			$data['next_week_year']		= $next_week->year;
			$data['next_week_month']	= $next_week->month;
			
			// if($data['current_week_of_month'] ==1 && $data['next_week'] == 2 && $previous_week->daysInMonth >28){
			// 	$data['previous_week'] =5;
			// } 

			$previous = $carbon->copy()->subMonth();
			$data['previous_month'] = $previous->month;
			$data['previous_year']  =  $previous->year;

			$next = $carbon->copy()->addMonth();
			$data['next_month'] = $next->month;
			$data['next_year'] = $next->year;

		return $data;
		}
		return null;
	}
	protected function date_handling($request){
			extract($request);
			$data['current_year'] = $year;
			$data['current_month'] = $month;
			
		if(empty($date)){
			$carbon = Carbon::parse($year.'-'.$month.'-'.'01');
		 }elseif(!empty($date)) {
		 	$carbon = Carbon::parse($year.'-'.$month.'-'.$date);
		}	
			$data['condition'] = $request;
			$data['total_days'] = $carbon->daysInMonth;
			$data = array_merge($data, $this->monthly_previous_next($carbon));
		return $data;
	}
	
	protected function holidays($year, $month){
		$holidays = Holiday::whereYear('date_of_holiday',$year)->whereMonth('date_of_holiday',$month)->get();
		$holiday_data = $holidays->mapWithKeys(function($data){
			$holiday_date = str_replace('0','',date('d', strtotime($data['date_of_holiday'])));
			return [$holiday_date=> $data['title']];
		});
		return $holidays;
	}
	public function ajax(Request $request){
		http_response_code(500);
		$data['fweek_no'] = null;
		if($request->isMethod('post')){
			$where = $this->set_filter_for_attendance($request);
			$data['date_handling'] = $this->date_handling($request->all());
			if(!empty($where['month_week_no'])){
				$data['fweek_no'] = $where['month_week_no'];
			}
		}else{
			Session::forget('date');
			$now = Carbon::now();
			$where['month'] =  $now->subMonth()->month;
			$where['year']  =  $now->year;	
			$data['date_handling'] = $this->date_handling($where);
		}
		$data['holiday_data'] = $this->holidays($data['date_handling']['current_year'], $data['date_handling']['current_month']);
		$data['user_data'] = GroupUsers::with(['organization_employee_user', 'metas_for_attendance'])->whereHas('organization_employee_user')->whereHas('metas_for_attendance')->get();
		$data['attendance_data'] = Attendance::select('employee_id','punch_in_out','shift_hours','day','date', 'over_time','attendance_status','lock_status')->where($where)->get()->groupBy('employee_id');
	
	return view('organization.hrm.attendance.hrm-attendance-view-display',$data);
	}
/*it should be delete*/
	protected function employee_data($dates){
		$data = Employee::with(['employ_info.metas', 'designations', 'department', 'department_rel','attendance' =>function($query) use($current_dates){
				 		$query->where($current_dates);
					}])->where('status',1)->get();	
		return $data;
	}
	/**
     * The attendance_by_hr use in Mark attendance, edit
     * @param -
     * @return view
     * @author  paljinder Singh 
     */
	public function attendance_by_hr(Request $request){
		
		$attendance_data = null;
		$current_dates = $this->current_date_data;
		if($request->isMethod('post')){
			$time = aione_format_date($request['mark-attendance-date']); 
			$time = strtotime($time); 
			$current_dates['year'] =  date('Y', $time);
			$current_dates['month'] = intval(date('m', $time));
			$current_dates['date'] = intval(date('d', $time));
			unset($current_dates['month_week_no']);
			unset($current_dates['day']);
		}
		$employee_data = GroupUsers::with(['organization_employee_user', 'metas_for_attendance'])->whereHas('organization_employee_user')->whereHas('metas_for_attendance')->get();
		$attendance_data = Attendance::where($current_dates)->get()->keyBy('employee_id');
		$mark_attendance_date = $current_dates['year'].'-'.$current_dates['month'].'-'.$current_dates['date'];
		
		return view('organization.attendance.hrm_attendance',['employee_data'=>$employee_data, 'attendance_data'=> $attendance_data, 'mark_attendance_date'=>$mark_attendance_date]);
	}
	/**
	 * Gets the shift time Use in attendance_fill_hr *
	 * @param      <int>  $id     The identifier *
	 * @return     <json> from time  , To time
	 */
	protected function get_shift_time($id){
		$shift_hours = Shift::select(['from','to','working_days'])->where('id',$id)->first();
		return  ['working_days'=> json_decode($shift_hours->working_days, true) , 'shift_hour'=>json_encode([$shift_hours->from, $shift_hours->to])];
	}
	protected function check_working_days($emp_id,  $day){
		$user_id = get_user_id_from_employee_id($emp_id);
		if(!empty($user_id)){
			$shift_id = get_user_meta($user_id,'user_shift',false);
			$data = $this->get_shift_time($shift_id);
			if(in_array(strtolower($day), $data['working_days'])){
				return $data['shift_hour'];
			}
		}
		return;
	}
	/**
     * attendance_fill_hr  save data
     * @param -
     * @return to list attendance
     * @author  paljinder Singh
     */
	
	public function attendance_fill_hr(Request $request )
	{

		$current_date_data = $this->current_date_data;
		$conditions = $request['dates'];
		unset($request['dates']);
		foreach ($request->all() as $key => $value) {
			if($key !='_token'){
				if(isset($value['punch_in_out']) && !empty($value['punch_in_out'][0]))
				{
					$value['punch_in_out'] = json_encode($value['punch_in_out']);
				}else{
					$value['punch_in_out'] =Null;
				}
				if(isset($value['in_out_data']) && !empty($value['in_out_data'][0]))
				{
					$value['in_out_data'] = json_encode($value['in_out_data']);
				}else{
					$value['in_out_data'] =Null;
				}
				$where 		= 	array_collapse([$conditions, ['employee_id'=>$key]]);
				$all_data 	= 	array_collapse([$conditions, $value]);
				$attendance_check = Attendance::select('id','lock_status','shift_hours')->where($where);
				if($attendance_check->exists())
				{
					$row_attendance = 	$attendance_check->first();
					if($row_attendance->lock_status==0){
						continue;
					}
					if(empty($row_attendance['shift_hours'])){
						$shift_hour = $this->check_working_days($key, $all_data['day']);
						if(!empty($shift_hour)){
							$all_data['shift_hours'] = $shift_hour;
						}
					} 
				}
				if($attendance_check->count() > 0)
				{
					$attendance = Attendance::find($attendance_check->first()->id);
				}
				else
				{
					$shift_hour = $this->check_working_days($key, $all_data['day']);
					if(!empty($shift_hour)){
						$all_data['shift_hours'] = $shift_hour;
					}
					$attendance = 	new Attendance();
					$attendance->employee_id = $key;
				}

				$attendance->fill($all_data);
				$attendance->submited_by ="HR";
				$attendance->save();
			}

		}
		Session::flash('success','Successfully mark attendance');
		return back();//redirect()->route('list.attendance');
	}



	/**
     * lock_status  lock un-lock attendance
     * @param - 
     * @return to list attendance
     * @author  paljinder Singh
     */
	public function lock_status(Request $request){
		$mo = $request['month'];
		if(strlen($request['month'])==1){
			$mo = '0'.$request['month'];
		}
		if($request['lock_status']=='true'){
			$lock_status['lock_status'] =0;
		}
		else{
			$lock_status['lock_status'] =1;
		}

		if(isset($request['lock'])){
			$lock_status['lock_status'] =0;
		}elseif(isset($request['unlock'])){
			$lock_status['lock_status'] =1;
		}
		Attendance::where(['month'=>$mo , 'year'=> $request['year'] ])->update($lock_status);
		Session::flash('attendance_year',$request['year']);
		return redirect()->route('lists.attendance');
	}
	

/** attendanceList  list accoding to year wise
     * 
     * @param - 
     * @return to list attendance
     * @author  Ashish, paljinder Singh
     */

	public function attendanceList(request $request)
	{
		$year = date('Y');
		if(Session::has('attendance_year'))  {
			$year = Session::get('attendance_year');
		}
		if($request->isMethod('post')){
			$year = $request['year'];
		}
		$data['year'] =$year;
		$query = Attendance::select('month','lock_status')->where(['year'=>$year])->groupBy('month');//->get();
		if($query->exists()){
			$query_data = $query->get();
		 	$data['lock'] = array_column($query_data->keyBy('month')->toArray(), 'lock_status','month');
		 	foreach ($data['lock'] as $key => $value) {
				$results =	$this->attendance_check($year, $key);
				$data[$key]['lock_status'] = $value;
				$data[$key]['attendance_status'] = $results;
		 	}
 		}
		return view('organization.attendance.attendence-list',compact('data'));
	}
/** attendance_check  use in attendanceList
     * 
     * @param - 
     * @return to list attendance
     * @author  Ashish, paljinder Singh
     */
	protected function attendance_check($year, $month){
		$emplyee_ids = UsersMeta::where('key','employee_id')->pluck('value');
		$daysInMonth = Carbon::parse($year.'-'.$month.'-1')->daysInMonth;
		$attendance_status = 1;
 		foreach ($emplyee_ids as $value) {
 			$emp[$month][$value] = $attendance_count = Attendance::where(['year'=>$year, 'month'=>$month, 'employee_id'=>$value])->count();
 			if($daysInMonth == $attendance_count){
 			}else{
 				$attendance_status =0;
 			}
 		}
 		return $attendance_status;
	}

}
