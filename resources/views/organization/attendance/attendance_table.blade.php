<style type="text/css">
   .aione-tabs{
      border-bottom: 1px solid #e8e8e8;
      padding-bottom: 4px;
      padding: 0px;
      margin: 0px;
   }
   .aione-tabs > .tab{
     
    display: inline-block;
   }
   .aione-tabs > .tab:hover{
      background-color: #e8e8e8;
          border-bottom: 1px solid #EEE;
   }
   .aione-tabs > .tab > a{
    padding: 0px 12px  !important; 
    line-height: 40px;
    display: inline-block; 
    color: #0073aa;
   }
   .aione-active{
      border: 1px solid #e8e8e8;
      border-bottom: 1px solid #fff;
      margin-bottom: -1px !important;
   }
   .aione-active a{
      color: black !important;
      font-weight: 500
   }


	.aione-navigation-1 a{
		    display: inline-block;
		    text-align: center;
		    width: 30px;
		    line-height: 30px;
	}
	.aione-navigation-1 a:hover{
		    background-color: #039BE5;
		    color: white;
	}

	.nav-past{
		    cursor: pointer;
			display: inline-block;
			position: relative;
	}
	.nav-past:before{
		    content: "";
		    position: absolute;
		    top: 5px;
		    left: -10px;
		    border-top: 1px solid #d2d2d2;
		    border-right: 1px solid #d2d2d2;
		    width: 10px;
		    height: 10px;
		    -webkit-transform: rotate(225deg);
		    -moz-transform: rotate(225deg);
		    transform: rotate(225deg);
		    -webkit-transition: all 150ms ease-out;
		    -moz-transition: all 150ms ease-out;
		    -o-transition: all 150ms ease-out;
		    transition: all 150ms ease-out;
	}

	.select-dropdown{
			margin-bottom: 0px !important;
		    border: 1px solid #a8a8a8 !important;
		    
		}
		.select-wrapper input.select-dropdown{
			height: 30px;
	    	line-height: 30px;
	    	text-align: center;
			
			
			background-color: white !important;
		}
		
		.select-wrapper span.caret{
			   
			    z-index: 9 !important;
		}
		.dropdown-content{
			background-color: white;
			
		}
		.dropdown-content li>a, .dropdown-content li>span{
			color: #0288D1 !important
		}

	.nav-future{
		    cursor: pointer;
			display: inline-block;
			position: relative;
	}
	.nav-future:after{
		    content: "";
		    position: absolute;
		    top: 5px;
		    right: -10px;
		    border-top: 1px solid #d2d2d2;
		    border-right: 1px solid #d2d2d2;
		    width: 10px;
		    height: 10px;
		    -webkit-transform: rotate(45deg);
		    -moz-transform: rotate(45deg);
		    transform: rotate(45deg);
		    -webkit-transition: all 150ms ease-out;
		    -moz-transition: all 150ms ease-out;
		    -o-transition: all 150ms ease-out;
		    transition: all 150ms ease-out;
	}
</style>
{{-- @include('organization.attendance.date_manage'); --}}
@php 
$number = 1;
	
		// $holidays =[];
		// if(!empty($holiday_data))
		// {
		// 	foreach ($holiday_data as $key => $value) {
		// 	$holidays[$value->day] = $value->title;
		// 	}
		// }
		$postDate = 01;
		 if(!empty(Session::get('date')))
		 {
		 	$fdate = $postDate = Session::get('date');
		 }
			$month_wise = $dat  = Carbon\Carbon::create($year, $month, $postDate, 00);
			$mo =	$dat->month; // use for week filter

		 if(!empty($fill_attendance_days)) 
		 {
		 	if(!empty($fweek_no) || !empty($fdate))
		 	{
		 		$total_days = $daysInMonth  =$dat->daysInMonth;
		 	}
		 	else{
		 			$total_days = $daysInMonth  =$dat->daysInMonth;
		 	}
		 }else{
		 $total_days = $daysInMonth  =$dat->daysInMonth;
		}
		 $current_month =	$dat->month;
		 $current_year =	$dat->year;
		 $current_days = $dat->daysInMonth;
		 $current_date = $dat->day;

//previous days		 
		$dat->subDay();
		$pre_date = $dat->day;
		$pre_month = $dat->month;
		$pre_year = $dat->year;

//next days 
		$dat->addDays(2);
		$nxt_date = $dat->day;
		$nxt_date_month = $dat->month;
		$nxt_date_year = $dat->year;

//week 
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
		for($j=1; $j<=$week; $j++ )
		{
			$week_option[$j] = "$j Week"; 
		}
		$sunday_count =0;
		$td="";
		$MO_data = ['01'=>'JAN', '02'=>'FEB', '03'=>'MAR', '04'=>'APR' ,'05'=>'MAY', '06'=>'JUN','07'=>'JUL', '08'=>'AUG','09'=>'SEP', '10'=>'OCT','11'=>'NOV', '12'=>'DEC'];
		$year_data = range(2015, 2050);

	@endphp

	@if($total_days==28)
	<style type="text/css"> 
		.column
		{
			width: 2.70% !important;
		}
	</style>
@endif
@if($total_days==31)
	<style type="text/css"> 
		.column
		{
			width: 2.43% !important;
		}
	</style>

@endif

<ul class="aione-tabs">
	        <li class="tab col monthly" ><a href="#" onclick="attendance_filter(null, null, {{$current_month}} , {{$current_year}} )" class="">Monthly</a></li>
	        <li class="tab col weekly "><a href="#" onclick="attendance_filter(null, 1, {{$current_month}} , {{$current_year}} )" class=" ">Weekly</a></li>
	        <li class="tab col daily"><a href="#" onclick="attendance_filter(1, null, {{$current_month}} , {{$current_year}} )" class=" ">Daily</a></li>
	       
	        <div style="clear: both">
	          
	        </div>
	    </ul>
	    <div class="row">
	<h5 class="text-center"></h5>
</div>

{{-- Month trey  --}}
<div id="month">

					
			<div class="row design-bg valign-wrapper" style="padding:14px">
				<div class=" col s2">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
					 	<div class="left-align">
							<a class="nav left-align nav-past" onclick="attendance_filter(null, null, {{$previousMonth}} , {{$previousYear}} )">Previous Month</a>
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
						<a onclick="attendance_filter(null, null, {{$nextMonth}} , {{$nextYear}} )" style="cursor:pointer;" class="nav right-align nav-future">Next Month</a>
						
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
@include('organization.attendance.attendance_data_display')
