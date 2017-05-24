

@php 
	// $sunday_count =0;
	// $holidays =[];
	// 		if(!empty($holiday_data))
	// 		{
	// 			foreach ($holiday_data as $key => $value) {
	// 			$holidays[$value->day] = $value->title;
	// 			}
	// 		}

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
				<div class="aione-navigation left-align">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
					 	<div class="col 14">
					 		<i class="fa fa-angle-left"></i>
							<a class="nav left-align" style="cursor:pointer;" onclick="attendance_filter(null, null, {{$previousMonth}} , {{$previousYear}} )">Previous Month</a>
						</div>
				</div>
					<div class="aione-heading center-align">
						<span class="design-style">{{date('F, Y', strtotime($dt))}}</span>
					</div>
				<div class="aione-navigation right-align">
					<div class="col 14">
						<a onclick="attendance_filter(null, null, {{$nextMonth}} , {{$nextYear}} )" style="cursor:pointer;" class="nav right-align">Next Month</a>
						<i class="fa fa-angle-right"></i>
					
				</div>	 
					</div>
		  	</div>
		</div> 

		<div id="week">
			<div class="row design-bg valign-wrapper">
				<div class="aione-navigation left-align">
					@php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 @endphp
					<div class="col 14">	
						<i class="fa fa-angle-left"></i>		
						<a onclick="attendance_filter(null, 1, {{$mo}} , {{$previousYear}} )" style="cursor:pointer;" class="nav left-align">Previous Week</a>
					</div>
				</div>
						<div>
								@for($w=1; $w <=$week; $w++)
								<a href="javascript:void(0)" onclick="attendance_filter(null, {{$w}}, {{$mo}} , {{$previousYear}} )" name="week" > {{$w}}</a>
								@endfor
							</div>
				<div class="aione-heading center-align">
					<span class="design-style">{{date('W ,F, Y', strtotime($dt))}}</span>
				</div>
				<div class="aione-navigation right-align">
					<div class="col 14">
						<a onclick="attendance_filter(null, 2, {{$mo}} , {{$previousYear}} )" style="cursor:pointer;" class="nav right-align">Next Week</a>
						<i class="fa fa-angle-right"></i>
					</div>
					
				</div>	 
		  	</div>
		</div> 


		<div id="days">
			<div class="row design-bg valign-wrapper">
				<div class="aione-navigation left-align">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
					 	<i class="fa fa-angle-left"></i>
						<a onclick="attendance_filter({{$pre_date}}, null, {{$pre_month}} , {{$pre_year}} )" style="cursor: pointer;" name="date" value="{{$pre_date}}" class="nav left-align">Previous Day</a>
							<div id="dates">
								@for($i=1; $i<=$total_days; $i++)

								<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter({{$i}}, null, {{$mo}} , {{$previousYear}} )" name="date"  > {{$i}}</a>
								@endfor
							</div>
				</div>
				<div class="aione-heading center-align">
					<span class="design-style">{{date('F, Y', strtotime($dt))}}</span>
				</div>
				<div class="aione-navigation right-align">
					<a onclick="attendance_filter({{$nxt_date}}, null, {{$nxt_date_month}} , {{$nxt_date_year}} )" style="cursor: pointer" name="date" value="{{$nxt_date}}" class="nav right-align">Next Day</a>
					<i class="fa fa-angle-right"></i>
				</div>	 
		  	</div>
		</div> 
			<div id="attendance_table" class="table-responsive" style="overflow: scroll">
			@if(!empty($error))
			{{-- {{dump($employee_data) }} --}}
			<table class="bordered">
					<thead>
						<tr class="table-tr">
						<th>Employee</th>
						<th>Name</th>
							@for($d=1; $d<=$total_days; $d++)
								@php 
								$getDay = Carbon\Carbon::create($year, $month, $d, 0);
								if($getDay->format('l')=="Sunday")
								{
									$td .="<td  class='absent-bg-color sunday'>S</td>";
								}else
								{
									$td .="<td> - </td>";
								}
								@endphp
							<th>{{$d}}<br> 
							{{substr($getDay->format('l'),0,1)}} 
							</th>
							@endfor
						</tr>
					</thead>
					<tbody>
						@foreach($employee_data as $empKey => $empVal)
						<tr>
						<td class="emp_id">
						{{$empVal['employee_id']}}
						</td>
						<td>name</td>
						{!! $td  !!}
						</tr>
						@endforeach
					</tbody>
		
			@else
				<table class="bordered">
					<thead>
						<tr class="table-tr">
							<th>Employee</th>
							<th>Name</th>
							{{-- <th>Department</th> --}}
							{{-- <th>Attendance Count</th> --}}
							{{-- <th>Attendance %</th>
							<th>Total Hours</th>
							<th>Over Time Hours</th> --}}

							@if(!empty($fweek_no) || !empty($fdate))
								@if(isset($attendance_data[0]))
									@foreach($attendance_data[0] as $dateKey =>$dateVal)
										@if($dateVal['day']=='Sunday')
											<?php $sunday_count++; ?>
										@endif
										<th>{{$dateVal['date']}}<br>{{substr($dateVal['day'], 0,1)}}</th>

										
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
											$td .="<td  class='absent-bg-color sunday'>S</td>";
										}else
										{
											$td .="<td> - </td>";
										}
									}
									@endphp
								<th>{{$d}}<br> 
								{{substr($getDay->format('l'),0,1)}} 
								</th>
								@endfor


							@endif

							


							
							
						</tr>
					</thead>
					<tbody>
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
							<tr class="table-tr" > 
									
								<td class="emp_id">
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
								</td>
								<td class="emp_name">
									{{$employ_info['name']}}
								</td>
								{{-- <td > {{$percent}} </td>
								<td> {{$total_hour[$groupVal[0]['employee_id']]}}</td>
								<td> {{$total_over_time[$groupVal[0]['employee_id']]}}</td> --}}
									@foreach($groupVal as $employeeKey =>$employeeVal)
										
										@if(array_key_exists($employeeVal['date'], $holidays))
												<td class="absent-bg-color">{{$holidays[$employeeVal['date']]}}</td>
											@else
												@if($employeeVal['attendance_status']=='present')
														<td class="present-bg-color">P</td>
												@elseif($employeeVal['attendance_status']=='absent')
													<td class="absent-bg-color">A</td>
												@elseif($employeeVal['attendance_status']=='Sunday')
													<td class="absent-bg-color sunday">S</td>
													
												@endif
										@endif
									@endforeach
									{!! $td  !!}
							</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			@endif
			</div>
		