<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE App\Model\Organization\Leave as EMP_LEV;
USE App\Model\Organization\Category as cat;
use Auth;
use Carbon\Carbon;

class EmployeeLeaveController extends Controller
{

	Public function index(Request $request, $id=null)
	{ 
		$leave_rule = cat::with('meta')->where(['type'=>'leave', 'status'=>1])->get();
		$emp_id = Auth::guard('org')->user()->id;
		$data = EMP_LEV::where('employee_id',$emp_id)->get();
		$leave_count_by_cat = $data->groupBy('leave_category_id');
		
		// $start_Date='2016-06-02';
		// $end_Date='2016-06-06';
		// $start = Carbon::parse($start_Date);
		// $end = Carbon::parse($end_Date);
	
		if($request->isMethod('post')){
			$from = Carbon::parse($request->from);
			$to = Carbon::parse($request->to);
			$request['total_days'] = $from->diffInDays($to) + 1; 
			$request['from'] =$from->toDateString();
			$request['to'] =$to->toDateString();
			$leave = new EMP_LEV();	
			$request['employee_id'] = Auth::guard('org')->user()->id;
			$leave->fill($request->all());
			$leave->save();
		 }
		else if($request->isMethod('patch')){
			$leave_id = $request['leave_id'];
			unset( $request['leave_id'] , $request['_method'] , $request['_token']);
			EMP_LEV::where('id', $leave_id)->update($request->all());
		}
		elseif($request->isMethod('DELETE')){
			$data = EMP_LEV::find($request['delete_id']);
			$data->delete();
		}
		
		return view('organization.profile.leaves',['data'=>$data, 'leave_rule'=>$leave_rule , 'leave_count_by_cat'=>$leave_count_by_cat]);
	}
    
}
