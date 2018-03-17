<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Attendance as Attendance;
use App\Model\Organization\Employee;


use Carbon\Carbon;
use Auth;
use App\Model\Group\GroupUsers as US;
use Session;

class AttendanceController extends Controller
{

    public function myattendance(Request $request, $user_id = null){
        //can_i_access_this_user($id);
        $employee_name =null;
        $where['year'] = $year = Carbon::now()->year;
        if(!empty($user_id)){
            $empId = false;
            $employee_name = get_user_detail(false , false, $user_id)->name;
            $empId = get_user_meta($user_id, $key = 'employee_id', $array = false);
            
        }else{
            $user =  get_user_detail($meta = false);
            $employee_name = $user->name;
            $user_id = $user->id;
            $empId = get_current_user_meta('employee_id');
        }
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

        return view('organization.account.myattandance',['attendance_data'=>$attendance_data ,'filter'=>$where, 'error'=>$error, 'user_id'=>$user_id, 'employee_id'=>$empId,  'employee_name'=>$employee_name]);
    }

    public function attendance_monthly(Request $request){
        http_response_code(500);
        // dd($request->all());
        $where['year'] = $request['year'];
        $where['month'] = $request['month'];
        if(strlen($request['month'])==1) {
           $where['month'] = '0'.$request['month'];  
        }
        $user_id = Auth::guard('org')->user()->id;
        if(!empty($request['employee_id'])){
            $where['employee_id'] = $request['employee_id'];

        }else{
            $where['employee_id'] = get_user_meta(get_user_id(), $key = 'employee_id', $array = false);//Employee::where('user_id',$user_id)->select('employee_id')->first()->employee_id;
        }
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
