@php
if(!empty($date_handling)){
extract($date_handling);
//dump($current_year , $all_dates); 
	
}
// "current_year" => "2018"
//   "current_month" => "4"
//   "previous_year" => 2018
//   "previous_month" => 3
//   "next_month" => 5
//   "next_year" => 2018

// $date  = Carbon\Carbon::create($year, $month, $postDate, 00); // create date
// $daysInMonth  = $date->daysInMonth; // total number of days in that month
// $previous_month = $month->copy()->subMonth(); // previous month
// $next_month = $month->copy()->addMonth(); // next month
// $previous_year = $year->copy()->subYear(); // previous year
// $next_year = $year->copy()->addYear(); // next year
// $current_week = $date->weekOfMonth; // current week of month







		$postDate = 01;
		if(!empty(Session::get('date')))
		{
		 	$fdate = $postDate = Session::get('date');
		}
			$month_wise = $dat  = Carbon\Carbon::create($year, $month, $postDate, 00);
			$mo =	$dat->month; // use for week filter

		 // if(!empty($fill_attendance_days)) 
		 // {
		 // 	if(!empty($fweek_no) || !empty($fdate))
		 // 	{
		 // 		$total_days = $daysInMonth  =$dat->daysInMonth;
		 // 	}
		 // 	else{
		 // 		$total_days = $daysInMonth  =$dat->daysInMonth;
		 // 	}
		 // }else{
		 $total_days = $daysInMonth  =$dat->daysInMonth;
		// }
		 $current_month =	$dat->month;
		 $current_year =	$dat->year;
		 $current_days = $dat->daysInMonth;
		 $current_date = $dat->day;

		$dat->subDay();
		$pre_date = $dat->day;
		$pre_month = $dat->month;
		$pre_year = $dat->year;

		$dat->addDays(2);
		$nxt_date = $dat->day;
		$nxt_date_month = $dat->month;
		$nxt_date_year = $dat->year;

		$pre_week = $dat->weekOfMonth;
		$pre_week_month = $dat->month;
		$pre_week_year = $dat->year;

		if(!empty($fweek_no))
		{
			$weekDate = Carbon\Carbon::create($year, $month, 1, 00);
			$current_week = $weekDate->weekOfMonth;
			if($fweek_no==1)
			{
			$weekDate->addWeek(); 
			}
			else{
				$weekDate->addWeeks($fweek_no); 
			}
 			$nxt_week = $weekDate->weekOfMonth;
			$nxt_week_month =	$weekDate->month;
			$nxt_week_year =	$weekDate->year;
			
			 
				$weekDate->subWeeks(2);
				$prev_week = $weekDate->weekOfMonth;
				if($nxt_week==2){
					if($current_month!=3){
						$prev_week = $prev_week +1;
					}else{
						$check_leap_year = Carbon\Carbon::parse('01-02-'.$current_year); 
						 if($check_leap_year->daysInMonth>28){
						 	$prev_week = $prev_week +1;
						 }
					}
					
				}
			
			
			$prev_week_month =	$weekDate->month;
		 	$prev_week_year =	$weekDate->year;

		 	
		}		 

			$previous = $dat->subMonth();
			$previousMonth = $previous->month;
			$previousYear  =  $previous->year;


			$next = $dat->addMonth(2);
			$nextMonth = $next->month;
			$nextYear = $next->year;

		$week =4;
		if($total_days >28)
		{
			$week =5;
		} 
		// for($j=1; $j<=$week; $j++ )
		// {
		// 	$week_option[$j] = "$j Week"; 
		// }
		$sunday_count =0;
		$td="";
		$MO_data = ['01'=>'JAN', '02'=>'FEB', '03'=>'MAR', '04'=>'APR' ,'05'=>'MAY', '06'=>'JUN','07'=>'JUL', '08'=>'AUG','09'=>'SEP', '10'=>'OCT','11'=>'NOV', '12'=>'DEC'];
		$year_data = range(2015, 2050);

	@endphp


{{-- Month trey  --}}
<div id="month">
{{-- "current_year" => "2018"
//   "current_month" => "4"
//   "previous_year" => 2018
//   "previous_month" => 3
//   "next_month" => 5
//   "next_year" => 2018 --}}
					
	<div class="row design-bg valign-wrapper p-10 bg-grey bg-lighten-3">
		<div class=" col s2">
			<?php  
			 $dt = '1-'.$month.'-'.$year;
			// 		$ym = date('Y-m', strtotime($dt));
			 ?>
			 	<div class="left-align">
					<a class="nav left-align nav-past" onclick="attendance_filter(null, null, {{$previous_month}} , {{$previous_year}} )">Previous Month</a>
				</div>
		</div>
		
		<div class="col l8">
			<div class="aione aione-heading center-align">
				<div class="row valign-wrapper" style="margin-bottom: 0px">
					<div class="col s3">
						
					</div>
					<div class="col s3 pr-7 right-align">
						<select class="browser-default"  onchange="attendance_filter(null, null, {{$current_month}}, this.value )" >
						@foreach($year_data as $key =>$val)
							@if($current_year==$val)
								<option selected="selected" value="{{$val}}">{{$val}} </option>
							@else
									<option value="{{$val}}">{{$val}} </option>
								@endif
						@endforeach

						</select>
					</div>
					<div class="col s3 pl-7">
						<select class="browser-default"  onchange="attendance_filter(null, null, this.value, {{$current_year}} )" >
							@foreach($MO_data as $key => $val)
								@if($current_month==$key)
									<option selected="selected" value="{{$key}}">{{$val}} </option>

								@else
									<option value="{{$key}}">{{$val}} </option>
								@endif
							@endforeach
							
						</select>

					</div>
					<div class=" col s3">
						<input id="current_month" type="hidden" value="{{$current_month}}">
						<input id="year" type="hidden" value="{{$current_year}}">
					</div>
				</div>
				
					

					
					{{-- <span class="design-style">{{date('F, Y', strtotime($dt))}}</span> --}}
			</div>
		</div>
		
		<div class=" col s2" style="text-align: right;">
			<div class="right-align">
				<a onclick="attendance_filter(null, null, {{$current_month}} , {{$current_year}} )" style="cursor:pointer;" class="nav right-align nav-future">Next Month</a>
				
			</div>	 
		</div>
		
		<div style="clear:both;">
		</div>
	</div>
</div> 
{{-- week trey  --}}

<div id="week">
	<div class="row design-bg valign-wrapper">
		<div class="col s2">
			@php  
			 $dt = '1-'.$month.'-'.$year;
			// 		$ym = date('Y-m', strtotime($dt));
			 @endphp
			<div class="col 14">	
				<i class="fa fa-angle-left"></i>
				<a onclick="attendance_filter(null, {{@$prev_week}}, {{@$prev_week_month}} , {{@$prev_week_year}} )" style="cursor:pointer;" class="nav left-align">Previous Week</a>
			</div>
		</div>
		<div class="col s8">
			<div class="aione aione-heading center-align">
				<i class="fa fa-calendar-o" aria-hidden="true" style="margin: 0px 10px"></i>
				<span class="design-style">{{date('F, Y', strtotime($dt))}}</span>
			</div>
		</div>
		
		<div class="col s2">
			<div class="right-align">
			
				<a onclick="attendance_filter(null, {{@$nxt_week}}, {{@$nxt_week_month}} , {{@$nxt_week_year}} )" style="cursor:pointer;" class="nav right-align">Next Week</a>
				<i class="fa fa-angle-right"></i>
			</div>
		</div>	
		<div style="clear:both;">
		</div>
  	</div>
  	<div class="aione-navigation-1">
		@for($w=1; $w <=$week; $w++)
			@if(@$fweek_no==$w)
				<a style="color:green;" href="javascript:void(0)" onclick="attendance_filter(null, {{$w}}, {{$mo}} , {{$current_year}} )" name="week" > {{$w}}</a>
			@else
				<a  href="javascript:void(0)" onclick="attendance_filter(null, {{$w}}, {{$mo}} , {{$current_year}} )" name="week" > {{$w}}</a>
			@endif
		@endfor
	</div> 		
</div> 
{{-- Day trey  --}}
<div id="days">
	<div class="row design-bg valign-wrapper">
		<div class="col s2">
			<?php  
			 $dt = '1-'.$month.'-'.$year;
			// 		$ym = date('Y-m', strtotime($dt));
			 ?>
			 	<i class="fa fa-angle-left"></i>
				<a onclick="attendance_filter({{$pre_date}}, null, {{$pre_month}} , {{$pre_year}} )" style="cursor: pointer;" name="date" value="{{$pre_date}}" class="nav left-align">Previous Day</a>
		</div>
		<div class="col s8">
			<div class="aione aione-heading center-align">
				<i class="fa fa-calendar-o" aria-hidden="true" style="margin: 0px 10px"></i>
				<span class="design-style">{{date('F, Y', strtotime($dt))}}</span>
			</div>	
		</div>
		
		<div class="col s2">
			<div class="right-align">
				<a onclick="attendance_filter({{$nxt_date}}, null, {{$nxt_date_month}} , {{$nxt_date_year}} )" style="cursor: pointer" name="date" value="{{$nxt_date}}" class="nav right-align">Next Day</a>
				<i class="fa fa-angle-right"></i>
			</div>
		</div>	 
		<div style="clear: both;">
		</div>
  	</div>
  	<div id="dates" class="aione-navigation-1">
		@for($i=1; $i<=$current_days; $i++)
			@if($current_date==$i)
				<a style="cursor: pointer; color:red;" href="javascript:void(0)" onclick="attendance_filter({{$i}}, null, {{$mo}} , {{$current_year}} )" name="date"  > {{$i}}</a>

			@else
				<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter({{$i}}, null, {{$mo}} , {{$current_year}} )" name="date"  > {{$i}}</a>
			@endif
		@endfor
	</div>
</div>
@include('organization.hrm.attendance.hrm-attendance-view-data')