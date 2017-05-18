<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use EmployeeHelper;
use App\Model\Organization\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){

    	$time = Carbon::now('Asia/Calcutta');
		$current_time =  gmdate('H:i:s',strtotime($time));
		//echo $time->format('l jS \\of F Y h:i:s A');
		$ip =  \Request::ip();
		$year 	= 	$time->format('Y');
		$month 	= 	$time->format('m');
		$date  	=	$time->format('d');
		$day 	=  	$time->format('l');
    	$user_id = Auth::guard('org')->user()->id;
    	$data = Attendance::select('check_for_checkin_checkout')->where([ 'user_id'=> $user_id , 'year'=>$year ,'date'=>$date , 'month'=>$month ]);
		$check_in_out_status = Null;
		if($data->count() > 0)
		{
			$check_in_out_status = $data->first()->check_for_checkin_checkout;

		}
    	return view('organization.dashboard.index',['check_in_out_status'=>$check_in_out_status]);
    }
}
