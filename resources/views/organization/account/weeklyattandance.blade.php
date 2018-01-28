

{{-- {{dump($attendance_data)}}

{{dump($filter['month_week_no'])}} --}}

@php

	$end_date = $filter['month_week_no'] * 7;
	$start_date = $end_date - 6;
	$dt = Carbon\Carbon::create($filter['year'], $filter['month'], $start_date);
	if($filter['month_week_no']==5){
		$end_date = $dt->daysInMonth;
	}
	$dt->weekOfMonth;

	$dt->subWeek();

	$pre_yr = $dt->year;
	$pre_mo = $dt->month;
	$pre_week = $dt->weekOfMonth;

	$dt->addWeeks(2);
	$nxt_yr = $dt->year;
	$nxt_mo = $dt->month;
	$nxt_week = $dt->weekOfMonth;

	//dump($start_date);
	//dump($end_date);
@endphp
<div class="row center-align" style="margin-top: 40px">
							<span onclick="attendance_weekly_filter({{$pre_week}}, {{$pre_mo}}, {{$pre_yr}})"><i class="fa fa-arrow-left" style="margin-right: 10px;line-height: 36px"></i></span>
							<span>{{$start_date}}-{{$filter['month']}}-{{$filter['year']}} - {{$end_date}}-{{$filter['month']}}-{{$filter['year']}}</span>
							<span onclick="attendance_weekly_filter({{$nxt_week}}, {{$nxt_mo}}, {{$nxt_yr}})"><i class="fa fa-arrow-right" style="margin-left: 10px"></i></span>
							<span><a href="" class="btn-flat" style="position: absolute;right: 0px;border: 1px solid #e8e8e8;margin-right: 14px;">Check In</a></span>
						</div>
						<div class="row" >
						@for($i=$start_date; $i<=$end_date; $i++)
							@if(isset($attendance_data[$i]))
								<div class="row center-align" style="padding:10px ">
									<div class="col l2">
										{{$attendance_data[$i]['day']}},{{$attendance_data[$i]['date']}}
									</div>
									
										@if($attendance_data[$i]['attendance_status']=='present')
											<div class="col l8 present">
												<div class="aione-line-bg">
													<span class="absence-status">Present</span>	
												</div>
											</div>
											@elseif($attendance_data[$i]['attendance_status']=='absent')
												<div class="col l8">
													<div class="aione-line-bg">
														<span class="absence-status">Absent</span>	
													</div>
												</div>
											@elseif($attendance_data[$i]['attendance_status']=='Sunday')
												<div class="col l8 weekend">
													<div class="aione-line-bg">
														<span class="absence-status">Weekend</span>	
													</div>
												</div>
											@elseif($attendance_data[$i]['attendance_status']=='leave')
												<div class="col l8 weekend">
													<div class="aione-line-bg">
														<span class="absence-status">leave</span>	
													</div>
												</div>	
											@else
												<div class="col l8 weekend">
													<div class="aione-line-bg">
														<span class="absence-status">--</span>	
													</div>
												</div>	
											@endif
											
									
									<div class="col l2">
										{{$attendance_data[$i]['total_hour']}}
									</div>
								</div>
							@endif
						@endfor
							{{-- <div class="row center-align" style="padding:10px ">
								<div class="col l2 ">
									Tues,06
								</div>
								<div class="col l8 present">
									<div class="aione-line-bg">
										<span class="absence-status">Present</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align" style="padding:10px ">
								<div class="col l2">
									Wed,07
								</div>
								<div class="col l8 present">
									<div class="aione-line-bg">
										<span class="absence-status">Present</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align" style="padding:10px ">
								<div class="col l2">
									Thru,08
								</div>
								<div class="col l8">
									<div class="aione-line-bg">
										<span class="absence-status">Absent</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align" style="padding:10px ">
								<div class="col l2">
									Fri,09
								</div>
								<div class="col l8 present">
									<div class="aione-line-bg">
										<span class="absence-status">Present</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align" style="padding:10px ">
								<div class="col l2">
									Sat,10
								</div>
								<div class="col l8 weekend">
									<div class="aione-line-bg">
										<span class="absence-status">Weekend</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div>
							<div class="row center-align" style="padding:10px ">
								<div class="col l2">
									Sun,11
								</div>
								<div class="col l8 weekend">
									<div class="aione-line-bg">
										<span class="absence-status">Weekend</span>	
									</div>
								</div>
								<div class="col l2">
									08:12Hrs
								</div>
							</div> --}}
						</div>