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
use App\Model\Group\GroupUsers;
use Carbon\Carbon;
use DB;
use EmployeeHelper;
use Session;
use Auth;
use Illuminate\Support\Collection;

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
	/**
	*Check in & check out 
	@author Paljinder singh
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
	*Import attendance form
	*
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
	*excel upload
	*
	*/
	protected function upload_import($request , $orgID){
		$storage_path = env('USER_FILES_PATH').'_'.$orgID.'/hrm_attendance_import_files';
		$file = $request->file('attendance_file');
		$file_name = str_random(13).$file->getClientOriginalName();
		$file->move($storage_path, $file_name);
		
		

		
		return $storage_path.'/'.$file_name;
	}

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

	/*
	*check validation Import attendance
	*
	*@author Paljinder Singh
	*/
	protected function validate_import_request($request, $file){
		$this->validate($request, [
        'attendance_file' => 'required',
        'title'=>'required'
      
    	]);
		$validator = Validator::make(
			    [
			        'file'      => $file,
			         'extension' => strtolower($file->getClientOriginalExtension()),
			    ],
			    [
			        'file'          => 'required',
			        'extension'      => 'required|in:csv,xls,xlsx,XLS',
			    ]
			);
		return $validator;
	}
	/**
	* excel Attendance sheet Data handle 
	*/
	protected function import_data_handling($data, $year, $month_year, $month, $dates, $daysInMonth){
		// $month_year = date('m-Y', strtotime($datee[0]));
		// $year = date('Y', strtotime($datee[0]));
		$keys = "abc";
			$i = 1;
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
							$actual_hour = '09:00:00';
							if(!empty($in_time ) && !empty($out_time)){
								$actual_hours	= new Carbon('09:00:00');
								$time = new Carbon($in_time);
								$shift_end_time =new Carbon($out_time);
								$totalDuration = $time->diffInSeconds($shift_end_time);
								$total_time = gmdate('H:i:s', $totalDuration);
								$total = new Carbon($total_time);
									if($total>$actual_hours){	
										$over_time = gmdate('H:i:s',$actual_hours->diffInSeconds($total));
									}else{ 
										$due_time = gmdate('H:i:s',$actual_hours->diffInSeconds($total));
									}
							}
	    					$diff = (strtotime($out_time) - strtotime($in_time));
	    					$total = $diff/60;
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
						if(empty($out_time) || is_null($in_time) ){
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
												'submited_by' => "import"];
						$attendance_query = Attendance::where(['employee_id'=>$employee_id, 'year'=>$year,'month'=>$month, 'date'=>$dates]);
						if($attendance_query->count() >0){
							$attendance_query->update($data_for_insertion);
							}else{

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
	/**
	* file save
	*
	*/
	protected function import_file_save($title , $file_name){
				Session::flash('success',' File upload successfully!');
				$attendanceFile = new AttendanceFile();
				$attendanceFile->title = $title;
				$attendanceFile->name =  $file_name;
				$attendanceFile->save(); 
	}
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
			 if(starts_with($month, 0)){
				$check_month = str_replace(0,'', $month);
			 }
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

public function attendance_file(){
	$files = AttendanceFile::all();
	return view('organization.attendance.attendance_file',['data'=>$files]);
}

	protected function filter($request)
	{
		$where['month_week_no'] = null;
		$where['date'] = null;
		if ($request->isMethod('post'))
		{
			unset($where);
			$where = [];
			if(!empty($request['date']))
			{
				$fdate = $where['date']= $request['date'];
				Session::put('date',$fdate);
			}else{
				Session::forget('date');
			}
			if(!empty($request['week']))
			{
				 $fweek_no = $where['month_week_no'] = $request['week'];
			}
			 	$month  = $where['month'] =   $request['month'];
				$where['year']  = 	$request['years'];
			if(strlen($month)==1)
			{
				$where['month'] = '0'.$month;
			}
		
		 	
		}else{
			if(Session::has('date'))
			{
				Session::forget('date');
			}
		}
		return $where;
	}

	public function list_attendance(Request $request, $year=null, $month=null)
	{	
		$data['year'] = $data['month'] = null;
		if($request->isMethod('post')){
			$data['year'] = $request['year'];
			$data['month'] = $request['month'];
		}
			$plugins = [
				'js' => ['custom'=>['attendance']],
				'css' => ['custom'=>['attendance']]
			];		
 		return view('organization.attendance.attendance',['plugins'=>$plugins, 'data'=>$data]);
	}

	public function ajax(Request $request){

		$now = Carbon::now();
		$where['month'] = $month = $now->subMonth()->month;
		$where['year']  = $years = $now->year;	
		$fweek_no =  $fdate = null;
		$dt = Carbon::parse($years.'-'.$month);
		$year_month  = "$years-$month";
		if($request->isMethod('post')){
			$where = $this->filter($request);
			if(!empty($where['month_week_no'])){
				$fweek_no = $where['month_week_no'];
			}
			$month = $where['month']; 
			$years = $where['year']; 
			$year_month  = "$years-$month"; 			
	 		$dt = Carbon::parse($year_month);	
		}

		$holidays = Holiday::whereMonth('date_of_holiday',$month)->get();
		$holiday_data = $holidays->mapWithKeys(function($data){
			$holiday_date = str_replace('0','',date('d', strtotime($data['date_of_holiday'])));
			return [$holiday_date=> $data['title']];
		});
		$user_data = GroupUsers::with(['metas_for_attendance'])->whereHas('metas_for_attendance')->get();

		// dd($group);

		// $user_data = User::with(['metas_for_attendance','belong_group'])->whereHas('metas_for_attendance')->whereIn('user_type',['employee'])->get();
		// dump($user_data);
		$attendance  =Attendance::select('employee_id','day','date' ,'total_hour', 'over_time','attendance_status','lock_status')->where($where)->get()->groupBy('employee_id');
		 $leave_data = $total_over_time = $lock_status = $attendance_by_self = $total_hour = $attendance_count = $total_days = null;

		return view('organization.attendance.attendance_table', ['attendance_data'=>$attendance, 'fill_attendance_days'=>$total_days, 'month'=> $month , 'year'=> $years, 'attendance_count'=>$attendance_count ,'user_data'=>$user_data , 'holiday_data' => $holiday_data ,'leave_data'=>$leave_data, 'total_hour'=>$total_hour ,'total_over_time'=>$total_over_time , 'attendance_by_self'=>$attendance_by_self,'fweek_no'=>$fweek_no, 'fdate' => $fdate, 'lock_status'=>$lock_status]);
	}

	protected function employee_data($dates){
		$data = Employee::with(['employ_info.metas', 'designations', 'department', 'department_rel','attendance' =>function($query) use($current_dates){
				 		$query->where($current_dates);
					}])->where('status',1)->get();	
		return $data;
	}
	public function attendance_by_hr(Request $request){	

		$filter_dates = $attendance_data = null;
		$current_dates = $this->current_date_data;
		if($request->isMethod('post')){
			$filter_dates = $current_dates = $request->except(['_token']);
		}
		$cDate =	date('Y-m-d',strtotime($current_dates["year"].'-'.$current_dates["month"].'-'.$current_dates["date"]));
		$employee_data = GroupUsers::with(['metas_for_attendance'])->whereHas('metas_for_attendance')->get();
		// $employee_data = User::with('metas_for_attendance')->whereHas('metas_for_attendance')->whereIn('user_type',['employee'])->get();
		$attendance_data = Attendance::where($current_dates)->get()->keyBy('employee_id');
		if($request->isMethod('post')){
			$attendance_data = Attendance::where($current_dates)->get()->keyBy('employee_id');
		}
		return view('organization.attendance.hrm_attendance',['employee_data'=>$employee_data, 'attendance_data'=> $attendance_data, 'filter_dates'=>$filter_dates]);
	}


	public function attendance_fill_hr(Request $request )
	{

		$conditions = $request['dates'];
		unset($request['dates']);
		foreach ($request->all() as $key => $value) {
			if($key !='_token'){

				if(isset($value['punch_in_out']))
				{
					$value['punch_in_out'] = json_encode($value['punch_in_out']);
				}else{
					$value['punch_in_out'] =Null;
				}

				if(isset($value['in_out_data']))
				{
					$value['in_out_data'] = json_encode($value['in_out_data']);
				}else{
					$value['in_out_data'] =Null;
				}

				$where 		= 	array_collapse([$conditions, ['employee_id'=>$key]]);
				$all_data 	= 	array_collapse([$conditions, $value]);
				$attendance_check = Attendance::select('id','lock_status')->where($where);
				if($attendance_check->exists())
				{
					if($attendance_check->first()->lock_status==0){
						continue;
					}
				}

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
		return redirect()->route('list.attendance');
	}
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
	/**
	 * @author Ashish, paljinder singh
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
