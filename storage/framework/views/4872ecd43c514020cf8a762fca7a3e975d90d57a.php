<?php 

function check_joining_leaving_employee($user_meta , $current_year , $current_month=null ){
	
	if(!isset($user_meta['employee_id']) || empty($user_meta['employee_id']) || empty($user_meta['user_shift']) || empty($user_meta['date_of_joining'])) {
		return false;
	}
	if(date('Y', strtotime($user_meta['date_of_joining'])) > $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) < $current_year)) 
	{
		return false;		
	}
	if(date('m', strtotime($user_meta['date_of_joining'])) >  $current_month && date('Y', strtotime($user_meta['date_of_joining'])) >= $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) == $current_year && date('m', strtotime($user_meta['date_of_leaving'])) <  $current_month  )) {
						return false;
		}
return true;
}

function check_joining_date($user_meta , $current_year , $current_month , $fdate ){
	if(date('Y-m-d', strtotime($user_meta['date_of_joining'])) > date('Y-m-d' ,strtotime("$current_year-$current_month-$fdate")) || (!empty($user_meta['date_of_leaving']) && date('Y-m-d', strtotime($user_meta['date_of_leaving'])) < date('Y-m-d' ,strtotime("$current_year-$current_month-$fdate"))) ) 
	{
		return false;
	}
	return true;
}

function check_joining_week($user_meta , $current_year , $current_month ,$fweek_no ){
	if(date('Y', strtotime($user_meta['date_of_joining'])) == $current_year &&date('m', strtotime($user_meta['date_of_joining'])) ==  $current_month){
			$joining_week = Carbon\Carbon::parse($user_meta['date_of_joining'])->weekOfMonth;
			if($fweek_no < $joining_week)
				return false;
			}
			if(!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) == $current_year &&date('m', strtotime($user_meta['date_of_leaving'])) ==  $current_month){
			$leaving_week = Carbon\Carbon::parse($user_meta['date_of_leaving'])->weekOfMonth;
			if($fweek_no > $leaving_week)
				return false;
			}
	return true;
}
// if(!isset($user_meta['employee_id']) || empty($user_meta['employee_id']) || empty($user_meta['user_shift']) || empty($user_meta['date_of_joining'])) {
// 				continue;
// 			}
// dump($user_meta, $current_year);

// if(empty($user_meta['employee_id']) && empty($user_meta['user_shift']) && empty($user_meta['date_of_joining'])) {
// 				continue;
// 	}
					
// if(date('Y', strtotime($user_meta['date_of_joining'])) > $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) < $current_year)) {
// 				continue;
// }


 ?>