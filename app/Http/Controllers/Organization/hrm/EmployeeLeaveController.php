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
	// echo date('Y-m');
	protected function mapping_category_id($id , $data){
			$collection = collect($data);
			$map  = $collection->map(function($item , $key)use($id){
				if(in_array($id,json_decode($item['value']))){
					return $item['category_id'];
				}
			});
			return array_filter($map->toArray());
	}
	/**
	 * { The check_carry_forward method sets leave cat to carry forward & for -> monthy / yearly  status }
	 *
	 * @param      <collection>  $assigned_categories  The assigned categories which cat assign to current user
	 *
	 * @return     <collection>  ( [carry_forward=>true/false , for=>monthly/yearly ] )
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
	

/**
 * The count_used_leave method Counts the number of used leave .
 *
 * @param      <type>  $emp_id                              The emp identifier
 * @param      <type>  $check_monthly_yearly_carry_forward  The check monthly yearly carry forward
 *
 * @return     <type>  Number of used leave.
 */
	protected function count_used_leave($emp_id , $check_monthly_yearly_carry_forward, $year){
 		$next_year  = $year + 1;
		foreach ($check_monthly_yearly_carry_forward as $key => $value) {
			$all_leave=null;
			// $common_query = EMP_LEV::where(['leave_category_id'=>$key, 'employee_id'=>$emp_id,'status'=>1]);
 		// 	$from_query = $common_query->whereYear('from',date('Y'));
 		// 	$to_query = $common_query->whereNull('total_days')->whereYear('to',date('Y'));
				// if($value['for']=='monthly'){
				// 	$fromLeavesData = EMP_LEV::where(['leave_category_id'=>$key, 'employee_id'=>$emp_id])->whereYear('from',date('Y'))->whereMonth('from',date('m'))->get();
				// 	$toLeavesData = EMP_LEV::where(['leave_category_id'=>$key, 'employee_id'=>$emp_id,'status'=>1])->whereMonth('to',date('m'))->whereNull('total_days')->whereYear('to',date('Y'))->get();
				// 	$from = date('Y F');
				// 	@$total_leave = @$fromLeavesData->sum('total_days'); 
				// @$from_leave_count = @$fromLeavesData->sum('from_leave_count');
				// @$to_leave_count = @$toLeavesData->sum('to_leave_count');
				// @$all_leave =collect([$total_leave,$from_leave_count,$to_leave_count])->sum();
				// }elseif($value['for']=='yearly'){ ->whereNotIn('id',$exist_id)
				 $frombetween[$key] = $fromLeavesData = EMP_LEV::where(['leave_category_id'=>$key, 'employee_id'=>$emp_id, 'status'=>1])->whereBetween('from',[$year.'-04-01',$next_year.'-03-31'] )->get();//->toArray();
				 $exist_id = array_pluck($fromLeavesData,'id');
				 $toBetween[$key] = $toLeavesData =EMP_LEV::where(['leave_category_id'=>$key, 'employee_id'=>$emp_id, 'status'=>1])->whereBetween('to',[$year.'-04-01',$next_year.'-03-31'] )->get();//->toArray();
				 
				 
				// $fromLeavesData = EMP_LEV::where(['leave_category_id'=>$key, 'employee_id'=>$emp_id, 'status'=>1])->whereYear('from',$year)->get();
				// $toLeavesData = EMP_LEV::where(['leave_category_id'=>$key, 'employee_id'=>$emp_id,'status'=>1])->whereNull('total_days')->whereYear('to',$year)->get();
				@$total_leave = @$fromLeavesData->sum('total_days'); 
				@$from_leave_count = @$fromLeavesData->sum('from_leave_count');
				@$to_leave_count = @$toLeavesData->sum('to_leave_count');
				@$all_leave = collect([$total_leave,$from_leave_count,$to_leave_count])->sum();
				// }
				$used_leave[$key] = ['name'=> $value['name'] , 'apply_before' =>$value['apply_before'], 'assigned_leave'=>$value['assigned_leave'], 'used_leave'=> $all_leave,'carry_forward'=> $value['carry_farward'] , 'valid_for'=> $value['for'] , 'leave_used_in'=>@$year];
		}
		  // dd($frombetween, $toBetween);
		return $used_leave;
	}

	protected function assigned_categories($group , $user_id, $designation_id){
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
			return $assigned_categories;
	}
protected function calculate_joining_year_carry_forward($leave_category_id, $leave_category_detail , $employee_id ){
		$date_of_joining = get_current_user_meta('date_of_joining');
		$assigned_leave = $leave_category_detail[$leave_category_id]['assigned_leave'];
	 	$time  = strtotime($date_of_joining);
        $joining_month = date('m', $time);
        $year  = date('Y', $time);
	if($joining_month < 4){
            $year = $year -1;
            $calculate_month =  4 - $joining_month;
            $per_month_assigned = $assigned_leave/12;   
            $alot_leave_joining_year     = $calculate_month * $per_month_assigned;
            $count_used_leave = $this->count_used_leave($employee_id , $leave_category_detail, $year);    
            array_set($count_used_leave, $leave_category_id.'.assigned_leave', $alot_leave_joining_year);
            $carry_forward_value =0;
            if($alot_leave_joining_year > $count_used_leave[$leave_category_id]['used_leave']){
                $carry_forward_value = $alot_leave_joining_year - $count_used_leave[$leave_category_id]['used_leave'];
            }
            $count_used_leave[$leave_category_id]['carry_forward_value'] = $carry_forward_value[$leave_category_id];
            $carry_forward[$year] =  $count_used_leave;
            $year  = $year + 1;
        }elseif($joining_month > 4){
            $calculate_month = 12 - ($joining_month - 4);
            $per_month_assigned = $assigned_leave/12;   
            $alot_leave_joining_year     = $calculate_month * $per_month_assigned;
            $count_used_leave = $this->count_used_leave($employee_id , $leave_category_detail, $year);    
            array_set($count_used_leave, $leave_category_id.'.assigned_leave', $alot_leave_joining_year);
            $carry_forward_value =0;
            if($alot_leave_joining_year > $count_used_leave[$leave_category_id]['used_leave']){
                $carry_forward_value = $alot_leave_joining_year - $count_used_leave[$leave_category_id]['used_leave'];
            }
            $count_used_leave[$leave_category_id]['carry_forward_value'] = $carry_forward_value;
            $carry_forward[$year] =  $count_used_leave[$leave_category_id];
            $year  = $year + 1;
        }
        if(!empty($carry_forward)){
        	return ['year'=>$year , 'carry_forward'=>$carry_forward];
        }
        return ['year'=>$year, 'carry_forward'=>false];
}   
protected function calculate_carry_forward($leave_category_id){
		$employee_id = get_current_user_meta('employee_id');
        $leave_category_detail =  $this->check_carry_forward([$leave_category_id]);
        $data = $this->calculate_joining_year_carry_forward($leave_category_id , $leave_category_detail, $employee_id);
    	$year = $data['year'];
    	if($data['carry_forward']!= false){
    	 	$carry_forward = $data['carry_forward'];
        }
        $assigned_leave = $leave_category_detail[$leave_category_id]['assigned_leave'];
        $current_month = date('m');
        if($current_month < 4){
            $end_year = date('Y') -1;
        }elseif($current_month >3){
            $end_year =  date('Y');   
        }
    for ($i=$year; $i <=$end_year; $i++) { 
        $count_used_leave = $this->count_used_leave($employee_id , $leave_category_detail, $i);    
        $carry_forward_value =0; 
        if($assigned_leave > $count_used_leave[$leave_category_id]['used_leave']){
        	$carry_forward_value = $assigned_leave - $count_used_leave[$leave_category_id]['used_leave'];
        }
        $count_used_leave[$leave_category_id]['carry_forward_value'] = $carry_forward_value;
        $carry_forward[$i] =$count_used_leave[$leave_category_id];
    }
    $carry_forward['sum'] = collect($carry_forward)->sum('carry_forward_value');
    return $carry_forward;
}
	public function leave_listing(Request $request){

		$data = to_html_table((object)[1, 2, 3, 4, 5], 'object');
		dd($data);
		$year = date('Y');
		if($request->isMethod('post')){
			$year = $request->year;
		}
		$current_used_leave = $leave_count_by_cat =$leave_rule =$leavesData = $error =null;
		$emp_id = get_current_user_meta('employee_id');
		// dump($date_of_joining , cat::all()->toArray());
		 $all_leave_by_cat = $this->calculate_carry_forward(3 );
		dump($all_leave_by_cat);

		if(in_array(1, role_id())){
			$error = "You can not view leave.";
		}else{
			$user = user_info()->toArray();
			$user_id = $user['id'];
			$designation_id =  get_current_user_meta('designation');
			$catMetas = catMeta::whereIn('key',['include_designation','user_include','user_exclude'])->get();
			$group  = $catMetas->groupBy('key')->toArray();
/*assigned_categories method get all Assigned categories */
			$assigned_categories = $this->assigned_categories($group, $user_id, $designation_id);
			if($assigned_categories->isNotEmpty()){
				$check_monthly_yearly_carry_forward = $this->check_carry_forward($assigned_categories);
			}else{
				$error = "Not assign leave category";
			}
/*set used leave data cat wise from current year or monthly*/
			if(!empty($check_monthly_yearly_carry_forward)){
				$current_used_leave = $this->count_used_leave($emp_id , $check_monthly_yearly_carry_forward, $year);
 				$next_year = $year+1;
				$leavesData = EMP_LEV::where(['employee_id'=>$emp_id])->whereBetween('from',[$year.'-04-01', $next_year.'-03-31'])->whereBetween('to',[$year.'-04-01', $next_year.'-03-31'],'or')->get();
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
	Public function store(Request $request, $id=null)
	{ 
		// dd($request->all());
		$valid_fields = [
                          'reason_of_leave'  => 'required',
                          'from'             => 'required',
                          'to'               => 'required',
                          'leave_category_id'=> 'required'
                      ];
		 $this->validate($request, $valid_fields);
		$leave_category_id = $request['leave_category_id'];
		$user = user_info()->toArray();	
		$designation_id =  get_current_user_meta('designation');
		$emp_id = get_current_user_meta('employee_id');
		if($request->isMethod('post'))
		{ 
			$current = Carbon::now();
			$from = Carbon::parse($request->from);
			$before = $from->diffInDays($current);
			$to = Carbon::parse($request->to);

/*check from < to date for applying leave.*/
			$request['from'] 	=	$from->toDateString();
			$request['to'] 		=   $to->toDateString();
			if(strtotime($request['from']) > strtotime($request['to'])){
				$error['from_greater_than_to'] = 'From date must be less than to.';
			}
 /* Check leaves applying dates already exist then notify employee to correct leave dates Accordinly*/
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
					// $this->get_carry_forward_leave($emp_id, $leave_category_id, $from->year );
					$check_monthly_yearly_carry_forward = $this->check_carry_forward([$leave_category_id]);
					if(!empty($check_monthly_yearly_carry_forward)){
						$count_used_leave = $this->count_used_leave($emp_id , $check_monthly_yearly_carry_forward, $from->year);
						}
						dump($count_used_leave[$leave_category_id]['carry_forward']);
						if($count_used_leave[$leave_category_id]['carry_forward']==false){
							$apply_taken_leave = $applying_total_days + $count_used_leave[$leave_category_id]['used_leave'];
							if($apply_taken_leave > $count_used_leave[$leave_category_id]['assigned_leave']){
								$pending_leave = $count_used_leave[$leave_category_id]['assigned_leave'] - $count_used_leave[$leave_category_id]['used_leave'];
								$error['exceed_number_of_day'] = "you'r leave limit exceed than assign & pending leave ".$pending_leave;
							}
						}elseif($count_used_leave[$leave_category_id]['carry_forward']==true){
							// $previous_year = $from->year -1;
							// 	$previous_count_used_leave = $this->count_used_leave($emp_id , $check_monthly_yearly_carry_forward, $previous_year);
								// $previous_count_used_leave[$leave_category_id] = 

						}
					// dd($request->all() ,  $check_monthly_yearly_carry_forward, $count_used_leave ,$error );
						
						

					$leave_sumdays = EMP_LEV::where(['employee_id'=>$emp_id, 'leave_category_id'=>$request['leave_category_id']])->whereYear('from',array($from->year))->sum('total_days');

/*old code   */		
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