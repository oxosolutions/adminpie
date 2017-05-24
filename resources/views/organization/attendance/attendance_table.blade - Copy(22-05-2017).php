@php 
	// $sunday_count =0;
	// $holidays =[];
	// 		if(!empty($holiday_data))
	// 		{
	// 			foreach ($holiday_data as $key => $value) {
	// 			$holidays[$value->day] = $value->title;
	// 			}
	// 		}
		$emp_group_by = $employee_data->groupBy('employee_id')->toArray();
		//dump($emp_group_by);
		$holidays =[];
		if(!empty($holiday_data))
		{
			foreach ($holiday_data as $key => $value) {
			$holidays[$value->day] = $value->title;
			}
		}
		$postDate = 01;
		 if(!empty(Session::get('date')))
		 {
		 	$postDate = Session::get('date');
		 }
		$month_wise = $dat  = Carbon\Carbon::create($year, $month, $postDate, 0);
		 $mo =	$dat->month;

		 if(!empty($fill_attendance_days)) 
		 {
		 	if(!empty($fweek_no) || !empty($fdate))
		 	{
		 		$total_days = $fill_attendance_days;

		 	}
		 	else{
		 			$total_days = $daysInMonth  =$dat->daysInMonth;

		 	}
		 }else{
		 $total_days = $daysInMonth  =$dat->daysInMonth;
		}

//dump($fweek_no);

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
// echo $dat->subWeek();
		$pre_week = $dat->weekOfMonth;
		//dump($dat->addWeek());
		$pre_week_month = $dat->month;
		$pre_week_year = $dat->year;

		
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
@endphp

@if($total_days==28)
	<style type="text/css"> 
		.tbl-cell
		{
			width: 2.85% !important;
		}
	</style>
@endif
@if($total_days==31)
	<style type="text/css"> 
		.tbl-cell
		{
			width: 2.58% !important;
		}
	</style>
@endif


	{{-- {{dump('current'. $mo)}}
	{{dump('pre'.$previousMonth)}}
	 {{dump('nxt'.$nextMonth)}}
	 {{dump($total_days) }}

	{{dump('weekno-'. $pre_week )}}
{{dump('mo-'.$pre_week_month )}}
{{dump('yr-'.$pre_week_year )}} --}}

<div class="row">

			<h5 class="text-center"></h5>
</div>

<div id="month">
			<div class="row design-bg valign-wrapper">
				<div class="row col s4">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
					 	<div class="left-align">
					 		<i class="fa fa-angle-left"></i>
							<a class="nav left-align" style="cursor:pointer;" onclick="attendance_filter(null, null, {{$previousMonth}} , {{$previousYear}} )">Previous Month</a>
						</div>
				</div>
				<div class="aione aione-heading center-align">
						<span class="design-style">{{date('F, Y', strtotime($dt))}}</span>
				</div>
				<div class="row col s4" style="text-align: right;">
					<div class="right-align">
						<a onclick="attendance_filter(null, null, {{$nextMonth}} , {{$nextYear}} )" style="cursor:pointer;" class="nav right-align">Next Month</a>
						<i class="fa fa-angle-right"></i>
					</div>	 
				</div>
				<div style="clear:both;">
				</div>
		  	</div>
</div> 

<div id="week">
			<div class="row design-bg valign-wrapper">
				<div class="row col s4">
					@php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 @endphp
					<div class="col 14">	
						<i class="fa fa-angle-left"></i>		
						<a onclick="attendance_filter(null, 1, {{$mo}} , {{$previousYear}} )" style="cursor:pointer;" class="nav left-align">Previous Week</a>
					</div>
				</div>
				<div class="aione aione-heading center-align">
					<span class="design-style">{{date('W ,F, Y', strtotime($dt))}}</span>
				</div>
				<div class="row col s4">
					<div class="right-align">
						<a onclick="attendance_filter(null, 2, {{$mo}} , {{$previousYear}} )" style="cursor:pointer;" class="nav right-align">Next Week</a>
						<i class="fa fa-angle-right"></i>
					</div>
				</div>	
				<div style="clear:both;">
				</div>
		  	</div>
		  	<div class="aione-navigation">
								@for($w=1; $w <=$week; $w++)
								<a href="javascript:void(0)" onclick="attendance_filter(null, {{$w}}, {{$mo}} , {{$previousYear}} )" name="week" > {{$w}}</a>
								@endfor
			</div> 
</div> 

<div id="days">
			<div class="row design-bg valign-wrapper">
				<div class="row col s4">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
					 	<i class="fa fa-angle-left"></i>
						<a onclick="attendance_filter({{$pre_date}}, null, {{$pre_month}} , {{$pre_year}} )" style="cursor: pointer;" name="date" value="{{$pre_date}}" class="nav left-align">Previous Day</a>
				</div>
				<div class="aione aione-heading center-align">
					<span class="design-style">{{date('F, Y', strtotime($dt))}}</span>
				</div>
				<div class="row col s4">
					<div class="right-align">
						<a onclick="attendance_filter({{$nxt_date}}, null, {{$nxt_date_month}} , {{$nxt_date_year}} )" style="cursor: pointer" name="date" value="{{$nxt_date}}" class="nav right-align">Next Day</a>
						<i class="fa fa-angle-right"></i>
					</div>
				</div>	 
				<div style="clear: both;">
				</div>
		  	</div>
		  	<div id="dates" class="aione-navigation">
								@for($i=1; $i<=$total_days; $i++)

								<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter({{$i}}, null, {{$mo}} , {{$previousYear}} )" name="date"  > {{$i}}</a>
								@endfor
			</div>
</div> 		

<div id="container" class="table-responsive">
			@if(!empty($error))
			{{-- {{dump($employee_data) }} --}}
			<div class="bordered">
					<div class="tbl-row">
						<div class="tbl-content">
							Employee
						</div>
						<div class="tbl-content">
							<div class="tbl-content">Name</div>
						</div>
						<div>
								@for($d=1; $d<=$total_days; $d++)
								@php 
								$getDay = Carbon\Carbon::create($year, $month, $d, 0);
								if($getDay->format('l')=="Sunday")
								{
									$td .="<div class='tbl-cell absent-bg-color sunday'>S</div>";
								}else
								{
									$td .="<div class='tbl-cell'> - </div>";
								}
								@endphp
									<div class="tbl-cell">{{$d}}<br> 
									{{substr($getDay->format('l'),0,1)}} 
									</div>
								@endfor
						</div>
						<div style="clear:both;">
						</div>
					</div>
						@foreach($employee_data as $empKey => $empVal)
						<div class="tbl-row">
							<div class="tbl-content">
								{{$empVal['employee_id']}}
							</div>
								<div class="tbl-content">name</div>
							{!! $td  !!}
						</div>
						@endforeach
					<div style="clear: both;"></div>
			</div>
		
			
			@else
			<div class="bordered">
				<div class="table">
					<div class="tbl-row">
						<div class="tbl-content">Employee</div>
						<div class="tbl-content">Name</div>
						{{-- <div class="tbl-cell">Department</div> --}}
						{{-- <div class="tbl-cell">Attendance Count</div> --}}
						{{-- <div class="tbl-cell">Attendance %</div>
						<div class="tbl-cell">Total Hours</div>
						<div class="tbl-cell">Over Time Hours</div> --}}

						@if(!empty($fweek_no) || !empty($fdate))
							@if(isset($attendance_data[0]))
								@foreach($attendance_data[0] as $dateKey =>$dateVal)
									@if($dateVal['day']=='Sunday')
										<?php $sunday_count++; ?>
									@endif
									<div class="tbl-cell">{{$dateVal['date']}}<br>{{substr($dateVal['day'], 0,1)}}</div>
									
								@endforeach
							@endif

						@else

							@for($d=1; $d<=$total_days; $d++)
								@php 

								$getDay = Carbon\Carbon::create($year, $month, $d, 0);
								if($d > $fill_attendance_days)
								{
									if($getDay->format('l')=="Sunday")
									{
										$td .="<div  class='tbl-cell absent-bg-color sunday'>S</div>";
									}else
									{
										$td .="<div class='tbl-cell'> - </div>";
									}
								}
								@endphp
							<div class="tbl-cell">{{$d}}<br> 
							{{substr($getDay->format('l'),0,1)}} 
							</div>
							@endfor
						@endif
					</div>
				</div>
			</div>

			
			<div class="tbl-body">
				<div class="tbl-row">
					<div class="tbl-content"
					@if(!empty($attendance_data))
					
						@foreach($attendance_data as $groupkey => $groupVal) 
								<?php 
								
									$day_count = $chunk - $sunday_count;
									$employ_info = EmployeeHelper::employ_info($groupVal[0]['employee_id']); 
									if(empty($attendance_count[$groupVal[0]['employee_id']]))
									{
										$attendance_count[$groupVal[0]['employee_id']] = 0;
									}
									if($day_count==0)
									{
												$day_count =1;
									}
									

									$percent = ceil(($attendance_count[$groupVal[0]['employee_id']] / $day_count * 100));
									//$over_time_sum = $sum = 0;
								?>
					</div>
				</div>
							<div class="tbl-row" > 
									
								<div class="tbl-content emp_id">
									<div class="popup hidden">
										<div class="name">
											<span>Department</span>
											<span>{{$employ_info['department']}}</span>
										</div>
										<div class="Departments">
											<span>Count</span>

											<span>{{@$attendance_count[$groupVal[0]['employee_id']]}} /{{$day_count}} </span>
										</div>
										
									</div>
									{{$groupVal[0]['employee_id']}} 
								</div>
								<div class="tbl-content emp_name">
									{{$employ_info['name']}}
								</div>
								{{-- <div class="tbl-cell"> {{$percent}} </div>
								<div class="tbl-cell"> {{$total_hour[$groupVal[0]['employee_id']]}}</div>
								<div class="tbl-cell"> {{$total_over_time[$groupVal[0]['employee_id']]}}</div>> --}}
									


									@foreach($groupVal as $employeeKey =>$employeeVal)
										
										@if(array_key_exists($employeeVal['date'], $holidays))
												<div class="tbl-cell absent-bg-color">{{$holidays[$employeeVal['date']]}}</div>
											@else
												@if($employeeVal['attendance_status']=='present')
														<div class="tbl-cell present-bg-color">P</div>
												@elseif($employeeVal['attendance_status']=='absent')
													<div class="tbl-cell absent-bg-color">A</div>
												@elseif($employeeVal['attendance_status']=='Sunday')
													<div class="tbl-cell absent-bg-color sunday">S</div>
													
												@endif
										@endif
									@endforeach
									{!! $td  !!}
									<div style="clear: both;"></div>
							</div>
						@endforeach
					@endif

			</div>
			@endif
			<div style="clear: both;"></div>

</div>





