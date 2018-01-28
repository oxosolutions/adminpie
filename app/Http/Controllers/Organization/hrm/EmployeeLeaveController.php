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
use DB;
class EmployeeLeaveController extends Controller
{
	/**
	 * { The check_carry_forward method sets leave cat to carry forward & for -> monthy / yearly  status }
	 */
	protected function check_carry_forward($assigned_categories){
		$leave_rule = cat::with('meta')->where(['type'=>'leave', 'status'=>1])->whereIn('id',$assigned_categories)->get();
		$check_monthly_yearly_carry_forward = $leave_rule->mapWithKeys(function($items){
					$meta_data  = $items['meta']->pluck('value','key');
					if(!empty($meta_data['carry_farward']) && $meta_data['carry_farward']=='1'){
						return [$items['id'] => ['name'=>@$items['name'], 'apply_before'=>@$meta_data['apply_before'], 'assigned_leave'=>@$meta_data['number_of_day'] ,'for'=>@$meta_data['valid_for'],  'carry_farward'=>true]];
					}else{
						return [$items['id'] => ['name'=>@$items['name'] , 'apply_before'=>@$meta_data['apply_before'], 'assigned_leave'=>@$meta_data['number_of_day'] , 'for'=>@$meta_data['valid_for'], 'carry_farward'=>false]];
					}
				});
		return 	$check_monthly_yearly_carry_forward;
	}
/*The mapping_category_id method use in Assigned_category to set leave category*/
	protected function mapping_category_id($id , $data){
			$collection = collect($data);
			$map  = $collection->map(function($item , $key)use($id){
				if(in_array($id,array_map('intval',json_decode($item['value'])))) {
					return $item['category_id'];
				}
			});
			return array_filter($map->toArray());
	}
/*The assigned_categories method use leave_listing && it is calculate assigned leave categories to current user */
	protected function assigned_categories(){
			$user_id = get_user_id();
			$designation_id =  get_current_user_meta('designation');
			$catMetas = catMeta::whereIn('key',['number_of_day','valid_for', 'apply_before', 'maximum_saction_leave','minimum_saction_leave','carry_farward', 'include_designation','user_include','user_exclude'])->get();
			$collection = $catMetas->whereIn('key',['number_of_day','valid_for', 'apply_before', 'maximum_saction_leave','minimum_saction_leave','carry_forward']);//->groupBy('category_id'));
			$group  = $catMetas->groupBy('key')->toArray();
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
			$assigned_categories =  collect($total_categories)->diff($not_assign_categories)->toArray();
			return $assigned_categories;
	}

/*The Usesd_leave method use in leave_category detail to calculate used leave by user*/
protected function used_leave($leave_category_id, $year){
	$next_year = $year + 1;
	// dump($year ,$next_year);
	$emp_id = get_current_user_meta('employee_id');
	$fromLeavesData = EMP_LEV::where(['leave_category_id'=>$leave_category_id, 'employee_id'=>$emp_id, 'status'=>1])->whereBetween('from',[$year.'-04-01',$next_year.'-03-31'] )->get();//->toArray();
	$exist_id = array_pluck($fromLeavesData,'id');
	$toLeavesData =EMP_LEV::where(['leave_category_id'=>$leave_category_id, 'employee_id'=>$emp_id, 'status'=>1])->whereBetween('to',[$year.'-04-01',$next_year.'-03-31'] )->get();
			@$total_leave = @$fromLeavesData->sum('total_days'); 
			@$from_leave_count = @$fromLeavesData->sum('from_leave_count');
			@$to_leave_count = @$toLeavesData->sum('to_leave_count');
			@$all_leave = collect([$total_leave,$from_leave_count,$to_leave_count])->sum();
	return $all_leave;
}
/*The leave category detail  use in leave listing method */
protected function leave_category_detail($category_id, $year, $month=null){
		$temp_add =  $year +1; 
		$date_of_joining = get_current_user_meta('date_of_joining');
		$data = catMeta::whereIn('key',['number_of_day','valid_for', 'apply_before', 'maximum_saction_leave','minimum_saction_leave','carry_farward'])->where('category_id', $category_id)->get()->pluck('value','key')->put('category_id',$category_id)->toArray();
		$assigned_leave = $data['number_of_day'];
	 	$time  = strtotime($date_of_joining);
        $joining_month = date('m', $time);
        $joining_year  = date('Y', $time);
		if($joining_year==$year &&  $joining_month > 3){
            $calculate_month = 12 - ($joining_month - 4);
            $per_month_assigned = $assigned_leave/12;   
            $data['number_of_day'] = $calculate_month * $per_month_assigned;
        }elseif($joining_year==$year+1 && $joining_month < 4){
        	$calculate_month = 4 - $joining_month;
        	$per_month_assigned = $assigned_leave/12;   
            $data['number_of_day'] = $calculate_month * $per_month_assigned; 
        }

        if($joining_year == $year &&  $joining_month < 4 && !empty($month) && $month < 4){
        	
        	$year = $year - 1;
        	$calculate_month = 4 - $joining_month;
        	$per_month_assigned = $assigned_leave/12;   
            $data['number_of_day'] = $calculate_month * $per_month_assigned;
            $data['from_to'] =  "april $year - March next year";
        }elseif($joining_year == $year &&  $joining_month > 3 && !empty($month) && $month > 3){
       		$calculate_month = 12 - ($joining_month - 4);
            $per_month_assigned = $assigned_leave/12;   
            $data['number_of_day'] = $calculate_month * $per_month_assigned;
       	}elseif(!empty($month) && $month < 4){
       		$year = - 1;
       	}
        $data['used_leave'] = $this->used_leave($category_id, $year);
        $data['name'] = cat::where('id',$category_id)->first()->name;
 	return $data;
}

	public function leave_listing(Request $request){
		$year = date('Y');
 		if(date('m')<4){
			$year = $year - 1;
		}		
		if($request->isMethod('post')){
			$year = $request->year;
		}
		$current_used_leave = $leave_count_by_cat = $leave_rule = $leavesData = $error =null;
		$emp_id = get_current_user_meta('employee_id');
		if(in_array(1, role_id())){
			$error = "You can not view leave.";
		}else{
/*assigned_categories method get all Assigned categories */
			$assigned_categories = $this->assigned_categories();
			if(!empty($assigned_categories)){
				foreach($assigned_categories as $key => $value) {
					$current_used_leave[$value] =  $this->leave_category_detail($value, $year); # code...
				}
				$next_year = $year+1;
				$leavesData = EMP_LEV::with('categories_rel')->where(['employee_id'=>$emp_id])->whereBetween('from',[$year.'-04-01', $next_year.'-03-31'])->whereBetween('to',[$year.'-04-01', $next_year.'-03-31'],'or')->get();
			}else{
				$error = "Not assign leave category";
			}
		}
		return view('organization.profile.leaves',['data'=>$leavesData, 'leave_rule'=>$leave_rule , 'leave_count_by_cat'=>$leave_count_by_cat, 'current_used_leave'=>$current_used_leave , 'filter_year'=>$year, 'error'=>$error]);
	}
/**
 * The store method work for apply leave's with various leave rule's. Coditions check before Applying. 
 * 	1. From date must be less than to date.
 * 	2. Secondly it check  emplyoee applying leave for same date's or not which they already gotten leave or rejected & 
 * 	what ever status & return back with error message if true.
 * 	3. 
 * 
 * 
 */
	protected function apply_leave_dates_lies_in_taken_leave($request, $emp_id){
		$error = null;
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
		return $error;
	}

	protected function leave_rule_check($rules , $number_of_applied_leave, $before, $current , $from){
		
		$error = null;
		if(!empty($rules['maximum_saction_leave']) && intval($rules['maximum_saction_leave']) < $number_of_applied_leave ){
			$error['maximum_saction_leave'] = "exceed maximum saction limit.";
		}
		if(!empty($rules['minimum_saction_leave']) && intval($rules['minimum_saction_leave']) > $number_of_applied_leave){
			$error['minimum_saction_leave'] = "less than minimum saction limit.";
		}
		if(!empty($rules['apply_before']) && $current->toDateString() > $from )
		{
			$error['not_apply_past_date_this_category'] = 'Not apply for past date in this leave rule';
		}
		if(!empty($rules['apply_after']) && $rules['apply_after'] < $before )
		{
			$error['not_apply_past_date_this_category'] = 'Apply leave after'.$rules['apply_after']['value'];
		}
		if(!empty($rules['apply_before']) && $rules['apply_before'] > $before) {
			$error['apply_before'] = "Apply leave After ".$rules['apply_before']; 
		}
		if($rules['used_leave'] == $rules['number_of_day']){
			$error['use_all_leave'] = "you already use all leave in this apply with other leave Categories"; 
		}
		$total_leave = $number_of_applied_leave + $rules['used_leave'];
		if($total_leave > $rules['number_of_day']) {
			$error['exceed_number_of_day'] = "Exceed leave limit"; 
		}
		return $error;
	}

	public function store(Request $request, $id=null){
		$valid_fields = ['reason_of_leave'=>'required', 'from'=>'required', 'to'=>'required','leave_category_id'=>'required'];
		$this->validate($request, $valid_fields);
		$leave_category_id = $request['leave_category_id'];
		$user = user_info()->toArray();	
		$designation_id =  get_current_user_meta('designation');
		$emp_id = get_current_user_meta('employee_id');
		$date_of_joining = get_current_user_meta('date_of_joining');
		if($request->isMethod('post'))
		{
			$current = Carbon::parse(date('Y-m-d'));
			$from = Carbon::parse($request->from);
			$before = $current->diffInDays($from);
			$to = Carbon::parse($request->to);
/*check from < to date for applying leave.*/
			$request['from'] 	=	$from->toDateString();
			$request['to'] 		=   $to->toDateString();
			if(strtotime($request['from']) > strtotime($request['to'])){
				$error['from_greater_than_to'] = 'From date must be less than to.';
				return redirect()->route('account.leaves')->with('errorss',$error);
			}
			if(strtotime($request['from']) < strtotime($date_of_joining)){
				$error['joining_date_before'] = "You can't apply leave before joining";
				return redirect()->route('account.leaves')->with('errorss',$error);
			}
/* Check leaves applying dates already exist then notify employee to correct leave dates Accordinly*/
			$result = $this->apply_leave_dates_lies_in_taken_leave($request , $emp_id);
			if(!empty($result)){
				$error = $result;
				return redirect()->route('account.leaves')->with('errorss',$error);
			}
/*check Assigned cat & rules list get from category meta table */
			$assigned_leave  = $this->assigned_categories();
			if(!empty($assigned_leave)){
				if(in_array($leave_category_id, $assigned_leave)){
					if($from->month !=  $to->month){
						$from_end_date_of_month = Carbon::parse($from->daysInMonth.'-'.$from->month.'-'.$from->year);
						$from_leave_count = $from->diffInDays($from_end_date_of_month) + 1;
						$request['from_leave_count'] = $from_leave_count;
						$to_end_date_of_month = Carbon::parse('1-'.$to->month.'-'.$to->year);
						$to_leave_count = $to_end_date_of_month->diffInDays($to) + 1;
						$request['to_leave_count'] = $to_leave_count;
						$applying_total_days =	$from_leave_count + $to_leave_count;
						
					}else{
						$applying_total_days = $request['total_days'] = $from->diffInDays($to) + 1;
					}
						$leave_rules = $this->leave_category_detail($leave_category_id, $from->year, $from->month);
						if($from->month ==3 && $to->month>3){
/*From leave check*/		$error = $this->different_session_year($leave_rules, $leave_category_id, $from, $to, $request, $from_leave_count , $to_leave_count, $before, $current );
							
						}else{
							$leave_rule_check = $this->leave_rule_check($leave_rules , $applying_total_days, $before , $current , $request['from']);
							if(!empty($leave_rule_check)){
								$error = $leave_rule_check;
							}
						}
				}else{
					$error['not_assigned_leave_this_category'] = "Not assigned this leave category.";
					return redirect()->route('account.leaves')->with('errorss',$error);
				}
			}else{
				$error['not_assigned_leave_category'] = "Not assigned leave category.";
				return redirect()->route('account.leaves')->with('errorss',$error);
			}
/* Total day check */
			if(empty($error)) {
				$leave = new EMP_LEV();	
				$request['employee_id'] = $emp_id;  
				$leave->fill($request->all());
				$leave->save();
				save_activity('apply_leave');
				Session::flash('sucessful', 'Successfully Apply Leave ');
			}else{
				Session::flash('errorss', $error);
			}
		 }
 	return redirect()->route('account.leaves');
	}
	protected function different_session_year($from_leave_rules ,$leave_category_id, $from, $to, $request, $from_leave_count, $to_leave_count, $before, $current  ){
		$error = null;
		$from_leave_rule_check = $this->leave_rule_check($from_leave_rules, $from_leave_count, $before , $current , $request['from']);
		$to_leaves = $this->leave_category_detail($leave_category_id, $to->year, $to->month);
		$to_leave_rule_check = $this->leave_rule_check($to_leaves, $to_leave_count, $before , $current , $request['to']);
		if(!empty($from_leave_rule_check) ){
			$error['from'] =$from_leave_rule_check;
			$prev_year = $from->year - 1;
			$error['from']['session_year'] = "April $prev_year March  $from->year"; 
		}if(!empty($to_leave_rule_check) ){
			$to_next_year = $to->year + 1;
			$error['to'] = $to_leave_rule_check;
			$error['to']['session_year'] = "April $to->year March  $to_next_year";
		}
		return $error;
	}

	Public function old_store(Request $request, $id=null)
	{ 
		$valid_fields = ['reason_of_leave'=>'required', 'from'=>'required', 'to'=>'required','leave_category_id'=>'required'];
		$this->validate($request, $valid_fields);
		$leave_category_id = $request['leave_category_id'];
		$user = user_info()->toArray();	
		$designation_id =  get_current_user_meta('designation');
		$emp_id = get_current_user_meta('employee_id');
		$date_of_joining = get_current_user_meta('date_of_joining');
		if($request->isMethod('post'))
		{
			$current = Carbon::parse(date('Y-m-d'));
			$from = Carbon::parse($request->from);
			$before = $current->diffInDays($from);
			$to = Carbon::parse($request->to);
/*check from < to date for applying leave.*/
			$request['from'] 	=	$from->toDateString();
			$request['to'] 		=   $to->toDateString();
			if(strtotime($request['from']) > strtotime($request['to'])){
				$error['from_greater_than_to'] = 'From date must be less than to.';
				return redirect()->route('account.leaves')->with('error',$error);
			}
			if(strtotime($request['from']) < strtotime($date_of_joining)){
				$error['joining_date_before'] = "You can't apply leave before joining";
				return redirect()->route('account.leaves')->with('error',$error);
			}

/* Check leaves applying dates already exist then notify employee to correct leave dates Accordinly*/
			$result = $this->apply_leave_dates_lies_in_taken_leave($request , $emp_id);
			if(!empty($result)){
				$error = $result;
			}
			
/*calculate total days of leave */
			if($from->month !=  $to->month){
				$from_end_date_of_month = Carbon::parse($from->daysInMonth.'-'.$from->month.'-'.$from->year);
				$from_leave_count = $from->diffInDays($from_end_date_of_month) + 1;
				$request['from_leave_count'] = $from_leave_count;

				$to_end_date_of_month = Carbon::parse('1-'.$to->month.'-'.$to->year);
				$to_leave_count = $to_end_date_of_month->diffInDays($to) + 1;
				$request['to_leave_count'] = $to_leave_count;
				$applying_total_days =	$from_leave_count + $to_leave_count;
			}else{
				$applying_total_days = $request['total_days'] = $from->diffInDays($to) + 1;
			}
/* rules list get from category meta table */
			$rules = catMeta::where('category_id', $request['leave_category_id']);
			if($rules->exists())
			{	
/*maximum saction*/$rule_check = json_decode($rules->get()->keyBy('key'),true);
				if(!empty($rule_check['maximum_saction_leave']['value']) && intval($rule_check['maximum_saction_leave']['value']) < $applying_total_days ){
						$error['maximum_saction_leave'] = "exceed maximum saction limit.";
					}
				if(!empty($rule_check['minimum_saction_leave']['value']) && intval($rule_check['minimum_saction_leave']['value']) > $applying_total_days){
					$error['minimum_saction_leave'] = "less than minimum saction limit.";
				}
/*Check leave category Assign to current user or not - first Designation check */				
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
							// dump($user_exclude);
							if(in_array($user['id'], $user_exclude)) {
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
					
				}
				elseif($rule_check['valid_for']['value'] == "yearly")
				{	
					$leave_category_detail = $this->leave_category_detail($leave_category_id, $from->year, $from->month);
					if($applying_total_days > intval($leave_category_detail['number_of_day'])) {
						$error['exceed_leave_than_assign'] =  " exceed leave limit ";
					}

					// dd($applying_total_days, $leave_category_detail);

							// $apply_taken_leave = $applying_total_days + $count_used_leave[$leave_category_id]['used_leave'];
							// if($apply_taken_leave > $count_used_leave[$leave_category_id]['assigned_leave']){
							// 	$pending_leave = $count_used_leave[$leave_category_id]['assigned_leave'] - $count_used_leave[$leave_category_id]['used_leave'];
							// 	$error['exceed_number_of_day'] = "you'r leave limit exceed than assign & pending leave ".$pending_leave;
							// }
				}

				if(!empty($rule_check['apply_before']['value']) && $current->toDateString() > $request['from'] )
				{
					$error['not_apply_past_date_this_category'] = 'Not apply for past date in this leave rule';
 				}
 				if(!empty($rule_check['apply_after']['value']) && $rule_check['apply_after']['value'] < $before )
				{
					$error['not_apply_past_date_this_category'] = 'Apply leave after'.$rule_check['apply_after']['value'];
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
	protected function get_carry_forward_leave($emp_id, $leave_cat_id,  $year, $month=null){
		$data = EMP_LEV::where(['employee_id'=>$emp_id ,'leave_category_id'=>$leave_cat_id, 'status'=>1 ])->get();
		dd($data->toArray());
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