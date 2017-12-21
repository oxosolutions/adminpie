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
use Session;

class EmployeeLeaveController extends Controller
{
	protected function mapping_category_id($id , $data){
			$collection = collect($data);
			$map  = $collection->map(function($item , $key)use($id){
				if(in_array($id,json_decode($item['value']))){
					return $item['category_id'];
				}
			});
			return array_filter($map->toArray());
	}
	public function leave_listing(){
		
		$leave_count_by_cat =$leave_rule =$leavesData = $error =null;
		if(in_array(1, role_id())){
			$error = "You can not view leave.";
		}else{
			$user = user_info()->toArray();	
			
			$user_id = $user['id'];
			$designation_id =  get_current_user_meta('designation');
			$catMetas = catMeta::whereIn('key',['include_designation','user_include','user_exclude'])->get();
			$group  = $catMetas->groupBy('key')->toArray();
/* Find leave category ids which Assign to designation of current user @$designation_categories contian Categories id in array form */
			$designation_categories = [];
			if(!empty($group['include_designation'])){
				$designation_categories = $this->mapping_category_id($designation_id , $group['include_designation']);
			} 
/* Find leave category ids which Assign to current user  @$user_categories contian Categories id in array form */
			$user_categories = [];
			if(!empty($group['user_include'])){
				$user_categories = $this->mapping_category_id($user_id , $group['user_include']);
			} 
/* Find leave category which Not Assign to current user @$not_assign_categories contian Categories id in array form */
			$not_assign_categories =[];
			if(!empty($group['user_exclude'])){
					$not_assign_categories  = $this->mapping_category_id($user_id , $group['user_exclude']);
				} 
			$total_categories	= 	collect([$designation_categories,$user_categories])->collapse()->unique();
			$assigned_categories =  collect($total_categories)->diff($not_assign_categories);//->toArray();
			$leave_rule = cat::with('meta')->where(['type'=>'leave', 'status'=>1])->whereIn('id',$assigned_categories)->get();
			// dump($leave_rule);
			if(!empty($leave_rule->toArray())){
			$emp_id = get_current_user_meta('employee_id');
			$leavesData = EMP_LEV::where(['employee_id'=>$emp_id])->get();
			$leave_count_by_cat = $leavesData->where('status',1)->groupBy('leave_category_id');
			// dump($leave_count_by_cat);
			}else{
				$error = "Not assign with any category";
			}
		}

		return view('organization.profile.leaves',['data'=>$leavesData, 'leave_rule'=>$leave_rule , 'leave_count_by_cat'=>$leave_count_by_cat,'error'=>$error]);
	}

	Public function store(Request $request, $id=null)
	{ 
		//dd($request->all());
		$valid_fields = [
                          'reason_of_leave'  => 'required',
                          'from'             => 'required',
                          'to'               => 'required',
                          'leave_category_id'=> 'required'
                      ];
		 $this->validate($request, $valid_fields);
		$user = user_info()->toArray();	
		$designation_id =  get_current_user_meta('designation');
		echo $emp_id = get_current_user_meta('employee_id');	
		
		if($request->isMethod('post'))
		{ 
			$current = Carbon::now();
			$from = Carbon::parse($request->from);
			$before = $from->diffInDays($current);
			$to = Carbon::parse($request->to);
			$request['from'] 	=	$from->toDateString();
			$request['to'] 		=   $to->toDateString();
			if(strtotime($request['from']) > strtotime($request['to'])){
				$error['from_greater_than_to'] = 'From date must be less than to.';
			}
 /* Check apply leaves dates alredy exist  then notify employee to correct leave dates Accordinly*/
			$data =	EMP_LEV::where(function($query)use($request){
				$query->whereBetween('from', [$request['from'], $request['to'] ])->orWhereBetween('to',[$request['from'], $request['to']]);
			})->where('employee_id',$emp_id);
			
			if($data->exists()){
				$leave = $data->first();
				if($leave->status ==1){
					$error['already_taken_leave_between_from_and_to_date'] = 'Already apply leave between from and to date Correct the dates.';
 				}elseif($leave->status ==3){
					$error['already_taken_leave_between_from_and_to_date'] = 'Already Reject leave between from and to date choose another  dates.';

 				}elseif($leave->status ==0){
					$error['already_taken_leave_between_from_and_to_date'] = 'Already apply not approved leave between from and to date choose another  dates.';

 				}
			}
/* when user leave dates not correct notify to employee correct the leave date & Never from date greater than to date*/
			// if($to->month < $from->month ) {
			// 	$error['from_greater_than_to'] = 'from date must be less than to date.';
			// 	Session::flash('error',$error);
			// 	return redirect()->route('account.leaves');
			// }
/*calculate total days of leave */
			$request['total_days'] = $from->diffInDays($to) + 1;
/* rules list get from category meta table */
			$rules = catMeta::where('category_id', $request['leave_category_id']);
			if($rules->exists())
			{	
				$rule_check = json_decode($rules->get()->keyBy('key'),true);
/*Designation check */				
				if(!empty($rule_check['include_designation']['value']))
				{
					$include_designation = array_map('intval',json_decode($rule_check['include_designation']['value'],true));
					if(!in_array($designation_id, $include_designation))
					{
						if(!empty($rule_check['user_include']['value'])) {
							$include_user= array_map('intval',json_decode($rule_check['user_include']['value'],true));
							if(!in_array($user['id'], $include_user)) {
								$error['user_include'] = "User not Includes"; 
								$error['include_designation'] = "Designation not Includes"; 
							}
						}
					}elseif(!empty($rule_check['user_exclude']['value'])){
							$user_exclude = array_map('intval',json_decode($rule_check['user_exclude']['value'],true));
							if(in_array($user['id'], $exclude_designation)) {
								$error['user_exclude'] = "Exclude User"; 
							}
					}
				}else{
						if(!empty($rule_check['user_include']['value']))
						{
							$include_user = array_map('intval',json_decode($rule_check['user_include']['value'],true));
							if(!in_array($user['id'], $include_user)) {
								$error['user_include'] = "User not Includes"; 
							}
						}
/*user exclude Check*/ elseif(!empty($rule_check['user_exclude']['value'])){
							$user_exclude = array_map('intval',json_decode($rule_check['user_exclude']['value'],true));
							if(in_array($user['id'], $exclude_designation)) {
								$error['user_exclude'] = "Exclude User"; 
							}
						}
					}
/* Not Need  Exclude Designation Check */
				// elseif(!empty($rule_check['exclude_designation']['value'])){
				// 	$exclude_designation = array_map('intval',json_decode($rule_check['exclude_designation']['value'],true));
				// 	if(in_array($designation_id, $exclude_designation))
				// 	{
				// 		$error['exclude_designation'] = "Exclude Designation"; 
				// 	}
				// }
//user Include Check 				
				// if(!empty($rule_check['user_include']['value']))
				// {
				// 	$include_designation = array_map('intval',json_decode($rule_check['user_include']['value'],true));
				// 	if(!in_array($user['id'], $include_designation)) {
				// 		$error['user_include'] = "User not Includes"; 
				// 	}
				// }
/*user exclude Check*/
				// elseif(!empty($rule_check['user_exclude']['value'])){
				// 	$user_exclude = array_map('intval',json_decode($rule_check['user_exclude']['value'],true));
				// 	if(in_array($user['id'], $exclude_designation)) {
				// 		$error['user_exclude'] = "Exclude User"; 
				// 	}
				// }

/*  correct code upto here*/
				//Role Include Check 				
				// if(!empty($rule_check['role_include']['value']))
				// {
				// 	$role_include = array_map('intval',json_decode($rule_check['role_include']['value'],true));
				// 	$roleIdExistingVal = array_intersect($role_include,role_id());
				// 	if(empty($roleIdExistingVal))
				// 	{
				// 		$error['role_include'] = "Role not Includes"; 
				// 	}
				// }
/*Role Include Check*/
				// elseif(!empty($rule_check['roles_exclude']['value'])){
				// 	$roles_exclude = array_map('intval',json_decode($rule_check['roles_exclude']['value'],true));
				// 	$roleIdExcludeExistingVal = array_intersect($roles_exclude,role_id());
				// 	if(empty($roleIdExcludeExistingVal))
				// 	{
				// 		$error['roles_exclude'] = "Exclude Role"; 
				// 	}					
				// }

/* Total day check */
				if($request['total_days'] > $rule_check['number_of_day']['value']) {
					$error['exceed_number_of_day'] = "You can only take leave  ".$rule_check['number_of_day']['value']; 
				}

				if($rule_check['valid_for']['value'] == "monthly")
				{
						$leaveFrm = EMP_LEV::where(['employee_id'=>$emp_id, 'leave_category_id'=>$request['leave_category_id']])->whereMonth('from',array($from->month))->get()->keyBy('id');

							$leaveTo = EMP_LEV::where(['employee_id'=>$emp_id, 'leave_category_id'=>$request['leave_category_id']])->whereMonth('to',array($from->month))->get()->keyBy('id');
							$leaveData = $leaveFrm->merge($leaveTo);//->toArray();
					if($from->month != $to->month)
					{
						$leaveToFormReq = EMP_LEV::where(['employee_id'=>$emp_id, 'leave_category_id'=>$request['leave_category_id']])->whereMonth('from',array($to->month))->get()->keyBy('id');

						$leaveToReq = EMP_LEV::where(['employee_id'=>$emp_id, 'leave_category_id'=>$request['leave_category_id']])->whereMonth('to',array($to->month))->get()->keyBy('id');
							$data = $leaveToFormReq->merge($leaveToReq);
							$leaveData = $data->merge($leaveData);
					}				

					foreach($leaveData->toArray() as $key => $val){
						$fromMo = Carbon::parse($val['from']);
						$toMo = Carbon::parse($val['to']);
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
					if(!empty($total_days))
					 {
					 	if($from->month == $to->month)
						{
							$takenLeave = collect($total_days[$from->month])->sum();
							$sumAll = $request['total_days'] + $takenLeave;
							dump($rule_check['number_of_day']['value']);
							if($sumAll >$rule_check['number_of_day']['value'])
							{
								$error['exceed_number_of_day'] = "You already taken leave  ".$takenLeave."&&  Now your applying leave for ".$request['total_days'].' day'; 
							}
						}
						elseif($from->month != $to->month){
							$fromTakenLeave =null;
							if(!empty($total_days[$from->month])){
								$fromTakenLeave = collect($total_days[$from->month])->sum();
							}
							
							if($from->day == $from->daysInMonth)
							{
								$totalFrm = $fromTakenLeave +1;   
								if($totalFrm > $rule_check['number_of_day']['value']) {
									$error['exceed_number_of_day'] = "you exceed leave limit in month ".$from->month;
								}
							}else{
									$totalFrm = $from->daysInMonth - $from->day;
									$totalSumFrom = $fromTakenLeave + $totalFrm;
									if($totalSumFrom > $rule_check['number_of_day']['value']) {
										 $error['exceed_number_of_day'] = "you exceed leave limit in month ".$from->month;
									}
								}
								$toTakenLeave = null;
								if(isset($total_days[$to->month])){
									$toTakenLeave = collect($total_days[$to->month])->sum();
								}
							$totalTo = $to->day + $toTakenLeave;

							if($totalTo > $rule_check['number_of_day']['value']) {
										 $error['exceed_number_of_day'] = "you exceed leave limit in month ".$to->month;
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
					$leave_sumdays = EMP_LEV::where(['employee_id'=>$emp_id, 'leave_category_id'=>$request['leave_category_id']])->whereYear('from',array($from->year))->sum('total_days');
						$total_sum = $leave_sumdays + $request['total_days'];
						if($total_sum > $rule_check['number_of_day']['value']) {
							$error['exceed_number_of_day'] = "You already taken leave  ".$leave_sumdays; 
						}elseif($rule_check['valid_for']['value']){}
				}

				if(!empty($rule_check['apply_before']['value']) && $current->toDateString() > $request['from'] )
				{
					$error['not_apply_past_date_this_category'] = 'Not apply for past date in this leave rule';
 				}
 				if(!empty($rule_check['apply_after']['value']) && $rule_check['apply_after']['value'] > $before )
				{
					$error['not_apply_past_date_this_category'] = 'Apply leave before'.$rule_check['apply_after']['value'];
 				}

				if(!empty($rule_check['apply_before']['value']) && $rule_check['apply_before']['value'] > $before) {
					$error['apply_before'] = "Apply leave After ".$rule_check['apply_before']['value']; 
				}	
			}

			if(empty($error)) {
				$leave = new EMP_LEV();	
				$request['employee_id'] = $emp_id;  
				$leave->fill($request->all());
				$leave->save();
				save_activity('apply_leave');
				Session::flash('sucessful', 'Successfully Apply Leave ');

			}else{
				Session::flash('error', $error);
			}
		 }
 	return redirect()->route('account.leaves');
	}
}

// else if($request->isMethod('patch')){
// 			$leave_id = $request['leave_id'];
// 			unset( $request['leave_id'] , $request['_method'] , $request['_token']);
// 			EMP_LEV::where('id', $leave_id)->update($request->all());
// 		}
// 		elseif($request->isMethod('DELETE')){
// 			$data = EMP_LEV::find($request['delete_id']);
// 			$data->delete();
// 		}