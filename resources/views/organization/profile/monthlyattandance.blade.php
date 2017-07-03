{{-- MONTHLY STARTS --}}

					@php
					$dt = Carbon\Carbon::create($filter['year'], $filter['month'], 1);
			       $current_mo = $dt->format('F');
			       $current_yr =$dt->year;
			       $beforeDay = $dt->dayOfWeek;
			       $dayInMonth = $dt->daysInMonth;
			       $dt->subMonth();
			     	$previous_mo = $dt->month;
			       	$previous_yr = $dt->year;
			       	$dt->addMonths(2);
			        $nxt_mo = $dt->month;
			        $nxt_yr = $dt->year;

			       	// 						$val = collect($attendance_data[$month]);
											// $data = $val->keyBy('date')->toArray();
					@endphp
					<div class="row month-view" style="padding: 20px 40px">
						<div class="row">
							
						</div>
						<div class="row" style="border: 1px solid #CCC">
							<div class="month">      
							  <ul>
							    <li onclick="attendance_monthly_filter({{$previous_mo}}, {{$previous_yr}})" class="prev"><i class="fa fa-arrow-left" ></i></li>
							    <li  onclick="attendance_monthly_filter({{$nxt_mo}}, {{$nxt_yr}})" class="next"><i class="fa fa-arrow-right" ></i></li>
							    <li style="text-align:center">
							      {{$current_mo}},
							      <span style="font-size:18px">{{$current_yr}}</span>
							    </li>
							  </ul>
							</div>

							<ul class="weekdays">
							 <li>Su</li>
							  <li>Mo</li>
							  <li>Tu</li>
							  <li>We</li>
							  <li>Th</li>
							  <li>Fr</li>
							  <li>Sa</li>
							 
							</ul>

							<ul class="days">  
							@for($i=1; $i<=$beforeDay; $i++)
							<li style="color:white;">.</li>
							@endfor
							
							@for($j=1; $j<=$dayInMonth; $j++ )
							@if(!empty($attendance_data[$j]['attendance_status']))
									@if($attendance_data[$j]['attendance_status']=='present')
												<li style="background-color: rgba(0,128,0,0.2);">{{$j}}</li>
											@elseif($attendance_data[$j]['attendance_status']=='absent')
												<li style="background-color: red;">{{$j}}</li>
											@elseif($attendance_data[$j]['attendance_status']=='Sunday')
												<li style="background-color: pink;">{{$j}}</li>
											@elseif($attendance_data[$j]['attendance_status']=='leave')
												<li style="background-color: orange;">{{$j}}</li>
											@else
												<li style="background-color: purple;">{{$j}}</li>
											@endif
								@else
								<li style="background-color: purple;">{{$j}}</li>
								@endif
							@endfor
							  
							</ul>

						</div>
					</div>
					{{-- MONTHLY ENNDS --}}
