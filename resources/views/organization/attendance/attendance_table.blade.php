

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

		 $total_days = $daysInMonth  =$dat->daysInMonth;

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
				<div class="col l4 center-align">
					<ul class="pager">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>

									<button  class="btn btn-floating" onclick="attendance_filter(null, null, {{$previousMonth}} , {{$previousYear}} )" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-left"></i> </button>
									<div>Previous Month</div>

					</ul>
				</div>
				<div class="col l4">
					<i class="fa fa-calendar" aria-hidden="true"></i>
					
					<h3 class="design-style">{{date('F, Y', strtotime($dt))}}</h3>
				</div>
				<div class="col l4 center-align ">
					<button onclick="attendance_filter(null, null, {{$nextMonth}} , {{$nextYear}} )" type="button" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-right"></i></button>
						<div>Next Month</div>
					
				</div>	 
		  	</div>
		</div> 

		<div id="week">
			<div class="row design-bg valign-wrapper">
				<div class="col l4 center-align">
					<ul class="pager">
					@php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 @endphp
								
									<button type="button" onclick="attendance_filter(null, 1, {{$mo}} , {{$previousYear}} )" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-left"></i> </button>
									<div>Previous Week</div>
							<div style="width:900px;" >
								@for($w=1; $w <=$week; $w++)
								<a href="javascript:void(0)" onclick="attendance_filter(null, {{$w}}, {{$mo}} , {{$previousYear}} )" name="week" > {{$w}}</a>
								@endfor
							</div>
					</ul>
				</div>
				<div class="col l4">
					
					<h3 class="design-style">{{date('W ,F, Y', strtotime($dt))}}</h3>
				</div>
				<div class="col l4 center-align ">



						<button onclick="attendance_filter(null, 2, {{$mo}} , {{$previousYear}} )" type="button" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-right"></i></button>
						<div>Next Week</div>
					
				</div>	 
		  	</div>
		</div> 


		<div id="days">
			<div class="row design-bg valign-wrapper">
				<div class="col l4 center-align">
					<ul class="pager">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
								

									<button onclick="attendance_filter({{$pre_date}}, null, {{$pre_month}} , {{$pre_year}} )" type="button" name="date" value="{{$pre_date}}" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-left"></i> </button>
									<div>Previous Day</div>
									<div id="dates" style="width:900px">
										@for($i=1; $i<=$total_days; $i++)

										<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter({{$i}}, null, {{$mo}} , {{$previousYear}} )" name="date"  > {{$i}}</a>
										@endfor
									</div>

					</ul>
				</div>
				<div class="col l4">
					
					<h3 class="design-style">{{date('F, Y', strtotime($dt))}}</h3>
				</div>
				<div class="col l4 center-align ">
					


						<button onclick="attendance_filter({{$nxt_date}}, null, {{$nxt_date_month}} , {{$nxt_date_year}} )" type="button" name="date" value="{{$nxt_date}}" class="btn btn-floating" style="margin: 14px;margin-top: -4px;"><i class="fa fa-arrow-right"></i></button>
						<div>Next Day</div>
					
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
									$td .="<td  class='absent-bg-color'>S</td>";
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

							@for($d=1; $d<=$total_days; $d++)
								@php 

								$getDay = Carbon\Carbon::create($year, $month, $d, 0);
								if($d > $fill_attendance_days)
								{
									if($getDay->format('l')=="Sunday")
									{
										$td .="<td  class='absent-bg-color'>S</td>";
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
		