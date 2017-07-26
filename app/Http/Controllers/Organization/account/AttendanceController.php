<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Attendance as Attendance;
use App\Model\Organization\Employee;


use Carbon\Carbon;
use Auth;


class AttendanceController extends Controller
{
    public function myattendance(Request $request){
        $where['year'] = $year = Carbon::now()->year;
        $user_id = Auth::guard('org')->user()->id;
        $employ_check = Employee::where('user_id',$user_id);
       if(!$employ_check->exists()){
            dd('Your not employee user!');
       }else{
        $where['employee_id'] = $employ_check->select('employee_id')->first()->employee_id;
        }
        if($request->isMethod('post')){
           if(!empty($request["month"])){
                $where['month'] = $request["month"];
             } 
             if(!empty($request["year"])){
                $where['year'] = $request["year"];
             } 
             if(!empty($request["month_week_no"])){
                $where['month_week_no'] = $request["month_week_no"];
             }
            $attendance = Attendance::where($where)->select(['attendance_status','employee_id','date','month'])->get();
            $attendance_data = $attendance->groupBy('month')->toArray();
            return view('organization.profile.ajaxmyattandance',['attendance_data'=>$attendance_data, 'filter'=>$where]);
        }
    	
    	$attendance = Attendance::where($where)->select(['attendance_status','employee_id','date','month'])->get();
        // dd($attendance);
    	$attendance_data = $attendance->groupBy('month')->toArray();
        return view('organization.profile.myattandance',['attendance_data'=>$attendance_data ,'filter'=>$where]);
    }

    public function attendance_monthly(Request $request){
        $where['year'] = $request['year'];
        $where['month'] = $request['month'];
        if(strlen($request['month'])==1)
        {
           $where['month'] = '0'.$request['month'];  
        }
       
        $user_id = Auth::guard('org')->user()->id;
        $where['employee_id'] = Employee::where('user_id',$user_id)->select('employee_id')->first()->employee_id;
        $attendance = Attendance::where($where)->select(['attendance_status','employee_id','date','month'])->get();
        $attendance_data = $attendance->keyBy('date')->toArray();
        return view('organization.profile.monthlyattandance',['attendance_data'=>$attendance_data ,'filter'=>$where]);
    }
    public function attendance_weekly(Request $request){

        $where['year'] = $request['year'];
        $where['month'] = $request['month'];
        $where['month_week_no'] = $request['month_week_no'];
        if(strlen($request['month'])==1){
           $where['month'] = '0'.$request['month'];  
        }
        $user_id = Auth::guard('org')->user()->id;
        $where['employee_id'] = Employee::where('user_id',$user_id)->select('employee_id')->first()->employee_id;
        $attendance = Attendance::where($where)->select(['attendance_status','employee_id','date','month','month_week_no','day','total_hour'])->get();
        $attendance_data = $attendance->keyBy('date')->toArray();
        return view('organization.profile.weeklyattandance',['attendance_data'=>$attendance_data ,'filter'=>$where]);
    }
}
