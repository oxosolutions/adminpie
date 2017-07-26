<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE App\Model\Organization\Leave as EMP_LEV;
USE App\Model\Organization\Category as cat;
USE App\Model\Organization\Employee as EMP;
USE App\Model\Organization\CategoryMeta as catMeta;
use Auth;
use Carbon\Carbon;

class EmployeeLeaveController extends Controller
{

	Public function index(Request $request, $id=null)
	{ 

		if(role_id()==1){
			return redirect()->route('access.denied');
		}
		$leave_rule = cat::with('meta')->where(['type'=>'leave', 'status'=>1])->get();
		$emp_id = Auth::guard('org')->user()->id;

		$user = user_info()->toArray();	

		$leavesData = EMP_LEV::where('employee_id',$user['employee_rel']['employee_id'])->get();
		$leave_count_by_cat = $leavesData->groupBy('leave_category_id');
		
		// $start_Date='2016-06-02';
		// $end_Date='2016-06-06';
		// $start = Carbon::parse($start_Date);
		// $end = Carbon::parse($end_Date);
	
		if($request->isMethod('post')){
			$current = Carbon::now();
			$from = Carbon::parse($request->from);
			$before = $from->diffInDays($current);
			//echo "year".$from->year;
			//echo "<br>month".$from->month;
			$to = Carbon::parse($request->to);
			$request['total_days'] = $from->diffInDays($to) + 1; 
			
			$rules = catMeta::where('category_id', $request['leave_category_id']);
			if($rules->exists())
			{	
				dump($user);		
				$rule_check = json_decode($rules->get()->keyBy('key'),true);
				//dump($rule_check);
			if(!empty($rule_check['include_designation']['value']))
				{
					$include_designation = array_map('intval',json_decode($rule_check['include_designation']['value'],true));
					if(!in_array($user['employee_rel']['designation'], $include_designation))
					{
						$error['include_designation'] = "Designation not Includes"; 
					}
				}
/*Designation Include Check*/
				elseif(!empty($rule_check['exclude_designation']['value'])){
					$exclude_designation = array_map('intval',json_decode($rule_check['exclude_designation']['value'],true));
					if(in_array($user['employee_rel']['designation'], $exclude_designation))
					{
						$error['exclude_designation'] = "Exclude Designation"; 
					}
				}
//user Include Check 				
				if(!empty($rule_check['user_include']['value']))
				{
					$include_designation = array_map('intval',json_decode($rule_check['user_include']['value'],true));
					if(!in_array($user['id'], $include_designation))
					{
						$error['user_include'] = "User not Includes"; 
					}
				}
/*user exclude Check*/
				elseif(!empty($rule_check['user_exclude']['value'])){
					$user_exclude = array_map('intval',json_decode($rule_check['user_exclude']['value'],true));
					if(in_array($user['id'], $exclude_designation))
					{
						$error['user_exclude'] = "Exclude User"; 
					}
				}

				//Role Include Check 				
				if(!empty($rule_check['role_include']['value']))
				{
					$role_include = array_map('intval',json_decode($rule_check['role_include']['value'],true));
					if(!in_array($user['role_id'], $role_include))
					{
						$error['role_include'] = "Role not Includes"; 
					}
				}
/*Role Include Check*/
				elseif(!empty($rule_check['roles_exclude']['value'])){
					$roles_exclude = array_map('intval',json_decode($rule_check['roles_exclude']['value'],true));
					if(in_array($user['role_id'], $roles_exclude))
					{
						$error['roles_exclude'] = "Exclude Role"; 
					}

					
				}


				if($request['total_days'] > $rule_check['number_of_day']['value'])
				{
					$error['exceed_number_of_day'][] = "You can only take leave  ".$rule_check['number_of_day']['value']; 
				}

				if($rule_check['valid_for']['value'] == "monthly")
				{
						// if($from->month == $to->month)
						// {
							
							$leaveFrm = EMP_LEV::where(['employee_id'=>$user['employee_rel']['employee_id'], 'leave_category_id'=>$request['leave_category_id']])->whereMonth('from',array($from->month))->get()->keyBy('id');

							$leaveTo = EMP_LEV::where(['employee_id'=>$user['employee_rel']['employee_id'], 'leave_category_id'=>$request['leave_category_id']])->whereMonth('to',array($from->month))->get()->keyBy('id');
							$leaveData = $leaveFrm->merge($leaveTo);//->toArray();
						// }
						// elseif($from->month != $to->month)
						// {

						// }
					if($from->month != $to->month)
					{
						$leaveToFormReq = EMP_LEV::where(['employee_id'=>$user['employee_rel']['employee_id'], 'leave_category_id'=>$request['leave_category_id']])->whereMonth('from',array($to->month))->get()->keyBy('id');

						$leaveToReq = EMP_LEV::where(['employee_id'=>$user['employee_rel']['employee_id'], 'leave_category_id'=>$request['leave_category_id']])->whereMonth('to',array($to->month))->get()->keyBy('id');
							$data = $leaveToFormReq->merge($leaveToReq);
							$leaveData = $data->merge($leaveData);
							//dump($leaveData);
						

					}				

					//$leaveData = $leave->WhereMonth('to',array($from->month))->get()->toArray();
					//dump($leaveData);
					foreach($leaveData->toArray() as $key => $val){
						$fromMo = Carbon::parse($val['from']);
						$toMo = Carbon::parse($val['to']);
						//dump('frm mo'.$fromMo.' to month --->'.$toMo);
						if($fromMo->month != $toMo->month){
							if($from->month == $fromMo->month ){
								$totalMoDay = $from->daysInMonth;
								$total_days[$fromMo->month][] = $totalMoDay - $fromMo->day; 
							}
							elseif($from->month == $toMo->month ){
								$total_days[$toMo->month][] = $toMo->day; 
							}
						}
						else{
							$total_days[$toMo->month][] = $val['total_days'];
						}
					 }

					// dump($total_days);
					if(!empty($total_days))
					 {
					 	if($from->month == $to->month)
						{
								$takenLeave = collect($total_days[$from->month])->sum();
								$sumAll = $request['total_days'] + $takenLeave;
								//dump($sumAll);
								if($sumAll >$rule_check['number_of_day']['value'])
								{
									$error['exceed_number_of_day'] = "You already taken leave  ".$takenLeave." applied leave".$request['total_days']; 
								}
						}
						elseif($from->month != $to->month){
							$fromTakenLeave = collect($total_days[$from->month])->sum();
							
							if($from->day == $from->daysInMonth)
							{
								$totalFrm = $fromTakenLeave +1;   
								if($totalFrm > $rule_check['number_of_day']['value'])
								{
									$error['exceed_number_of_day'][] = "you exceed leave limit in month ".$from->month;
								}
							}else{

									$totalFrm = $from->daysInMonth - $from->day;
									$totalSumFrom = $fromTakenLeave + $totalFrm;
									//echo "sum from";
							//dump($totalSumFrom);
									if($totalSumFrom > $rule_check['number_of_day']['value'])
									{
										 $error['exceed_number_of_day'][] = "you exceed leave limit in month ".$from->month;
									}
								}
							$toTakenLeave = collect($total_days[$to->month])->sum();
							$totalTo = $to->day + $toTakenLeave;
							//echo "total to";

							//dump($totalTo);
							if($totalTo > $rule_check['number_of_day']['value'])
									{
										 $error['exceed_number_of_day'][] = "you exceed leave limit in month ".$to->month;
									}
					}
				}
					// echo "to sum";
					 //dump( @$total_days);

					// $leave_sumdays = $leave->sum('total_days');
					// $total_sum = $leave_sumdays + $request['total_days'];
					// if($total_sum >= $rule_check['number_of_day']['value'])
					// {
					// 	$error['exceed_number_of_day'] = "You already taken leave include current  ".$total_sum; 
					// }
					
				}
				elseif($rule_check['valid_for']['value'] == "yearly")
				{
					$leave_sumdays = EMP_LEV::where(['employee_id'=>$user['employee_rel']['employee_id'], 'leave_category_id'=>$request['leave_category_id']])->whereYear('from',array($from->year))->sum('total_days');
						$total_sum = $leave_sumdays + $request['total_days'];
						if($total_sum >= $rule_check['number_of_day']['value'])
						{
							$error['exceed_number_of_day'] = "You already taken leave  ".$leave_sumdays; 
						}
				}

				if($rule_check['apply_before']['value'] > $before)
				{
					$error['apply_before'] = "Apply leave before ".$rule_check['apply_before']['value']; 
				}	
				dump(@$error);
			}
			//dd($request->all());
			//$from = Carbon::parse($request->from);
			//$to = Carbon::parse($request->to);
			//$request['total_days'] = $from->diffInDays($to) + 1;
			//$user_id = Auth::guard('org')->user()->id;
			if(empty($error)) {
				$request['from'] =	$from->toDateString();
				$request['to'] = $to->toDateString();
				$leave = new EMP_LEV();	
				$request['employee_id'] = EMP::where('user_id', $user['id'])->select('employee_id')->first()->employee_id;
				$leave->fill($request->all());
				$leave->save();
				save_activity('apply_leave');
			}
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
		
		return view('organization.profile.leaves',['data'=>$leavesData, 'leave_rule'=>$leave_rule , 'leave_count_by_cat'=>$leave_count_by_cat]);
	}
    
}
