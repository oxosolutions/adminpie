<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Attendance as Attendance;
use App\Model\Organization\Employee;


use Carbon\Carbon;
use Auth;
use App\Model\Group\GroupUsers as US;

class AttendanceController extends Controller
{

    public function myattendance(Request $request, $id = null){

        $where['year'] = $year = Carbon::now()->year;
        // if($id == null){
        //     return redirect()->route('account.attandance',get_user_id());
        // }
        $empId = get_user_meta($id, $key = 'employee_id', $array = false);
        
       if($empId==false){
            $attendance_data = $where =null;
            $error = 'Your not employee user!';
       }else{
            $error = null;
            $where['employee_id'] = $empId;
        
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
                return view('organization.account.ajaxmyattandance',['attendance_data'=>$attendance_data, 'filter'=>$where]);
            }
    	$attendance = Attendance::where($where)->select(['attendance_status','employee_id','date','month'])->get();
        $attendance_data = $attendance->groupBy('month')->toArray();
    }
        return view('organization.account.myattandance',['attendance_data'=>$attendance_data ,'filter'=>$where, 'error'=>$error]);
    }

    public function attendance_monthly(Request $request){
        $where['year'] = $request['year'];
        $where['month'] = $request['month'];
        if(strlen($request['month'])==1)
        {
           $where['month'] = '0'.$request['month'];  
        }
       
        $user_id = Auth::guard('org')->user()->id;
        $where['employee_id'] = get_user_meta(get_user_id(), $key = 'employee_id', $array = false);//Employee::where('user_id',$user_id)->select('employee_id')->first()->employee_id;
        $attendance = Attendance::where($where)->select(['attendance_status','employee_id','date','month'])->get();
        $attendance_data = $attendance->keyBy('date')->toArray();
        return view('organization.account.monthlyattandance',['attendance_data'=>$attendance_data ,'filter'=>$where]);
    }
    public function attendance_weekly(Request $request){

        $where['year'] = $request['year'];
        $where['month'] = $request['month'];
        $where['month_week_no'] = $request['month_week_no'];
        if(strlen($request['month'])==1){
           $where['month'] = '0'.$request['month'];  
        }
        $user_id = Auth::guard('org')->user()->id;
        $where['employee_id'] = get_user_meta(get_user_id(), $key = 'employee_id', $array = false);// Employee::where('user_id',$user_id)->select('employee_id')->first()->employee_id;
        $attendance = Attendance::where($where)->select(['attendance_status','employee_id','date','month','month_week_no','day','total_hour'])->get();
        $attendance_data = $attendance->keyBy('date')->toArray();
        return view('organization.account.weeklyattandance',['attendance_data'=>$attendance_data ,'filter'=>$where]);
    }
}
