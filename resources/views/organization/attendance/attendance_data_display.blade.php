<div id="attendance_sheet_container" class="table-responsive">
	<div class="attendance-sheet line-height-30">
		<div class="attendance-sheet">
			<div class="attendanc-sheet content ">
				Employee
			</div>
			<div class="attendanc-sheet content">
				<div class="attendanc-sheet content">Name</div>
			</div>
			<div>
					@php
					
					$number=1;
					if(!empty($fweek_no)){
						if($fweek_no==5){
							$end_week_day = $total_days;
							$number = $start_week_day = 29;
						}else{
							$total_days = $end_week_day = $fweek_no * 7;
							$number = $start_week_day = $end_week_day -6;
						}
						for($d=$start_week_day; $d<=$end_week_day; $d++){
							$getDay = Carbon\Carbon::create($year, $month, $d, 0);
						}
					}
					@endphp
					@if(!empty($fdate))
						@php
							$number = $total_days = $fdate;
							$getDay = Carbon\Carbon::create($year, $month, $fdate, 0);
							if($getDay->format('l')=="Sunday")
						{
							$td .="<div class='attendance-sheet column sunday'>S</div>";
						}else
						{
							$td .="<div class='attendance-sheet column bg-grey bg-lighten-3'></div>";
						}
						$fdate;
						@endphp
						<div class="attendance-sheet column">{{$fdate}}<br> 
							{{substr($getDay->format('l'),0,1)}} 
							</div>
					@else
						@for($d=$number; $d<=$total_days; $d++)
						@php 
						$getDay = Carbon\Carbon::create($year, $month, $d, 0);
						if($getDay->format('l')=="Sunday")
						{
							$td .="<div class='attendance-sheet column sunday'>S</div>";
						}else
						{
							$td .="<div class='attendance-sheet column bg-grey bg-lighten-3'></div>";
						}
						@endphp
							<div class="attendance-sheet column">{{$d}}<br> 
							{{substr($getDay->format('l'),0,1)}} 
							</div>
						@endfor
					@endif
 			</div>
			<div style="clear:both;"> </div>

		
			
			@foreach($user_data as $userKey => $value)

				@php
					$user_meta  = $value->metas_for_attendance->mapwithKeys(function($item){
	 					return [$item['key'] => $item['value'] ];
						 }); 
					
					// if(date('Y', strtotime($user_meta['date_of_joining'])) > $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) < $current_year) ){
					// 				continue;
					// 			}
					// 			
					if(date('Y', strtotime($user_meta['date_of_joining'])) > $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) < $current_year)) {
									continue;
								}
								if(date('m', strtotime($user_meta['date_of_joining'])) >  $current_month && date('Y', strtotime($user_meta['date_of_joining'])) >= $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) == $current_year && date('m', strtotime($user_meta['date_of_leaving'])) <  $current_month  )) {
									continue;
								}
					if(!empty($user_meta['employee_id']) && !empty($user_meta['user_shift']) && !empty($user_meta['date_of_joining']))
					{
 						if(!empty($fweek_no) || !empty($fdate)){
							echo "<br>";
							if(!empty($fdate))
							{	
								if(date('Y-m-d', strtotime($user_meta['date_of_joining'])) > date('Y-m-d' ,strtotime("$current_year-$current_month-$fdate")) || (!empty($user_meta['date_of_leaving']) && date('Y-m-d', strtotime($user_meta['date_of_leaving'])) < date('Y-m-d' ,strtotime("$current_year-$current_month-$fdate"))) ) {
									continue;
								}
 							}
							if(!empty($fweek_no)){
								// dump($fweek_no, date('m', strtotime($user_meta['date_of_joining'])), $current_month);
								// if(date('Y', strtotime($user_meta['date_of_joining'])) > $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) < $current_year) ){
								// 	continue;
								// }
								// if(date('m', strtotime($user_meta['date_of_joining'])) >  $current_month && date('Y', strtotime($user_meta['date_of_joining'])) >= $current_year ){
								// 	continue;
								// }
								
								if(date('Y', strtotime($user_meta['date_of_joining'])) == $current_year &&date('m', strtotime($user_meta['date_of_joining'])) ==  $current_month){
									$joining_week = Carbon\Carbon::parse($user_meta['date_of_joining'])->weekOfMonth;
									if($fweek_no < $joining_week)
										continue;
									}
									if(!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) == $current_year &&date('m', strtotime($user_meta['date_of_leaving'])) ==  $current_month){
									$leaving_week = Carbon\Carbon::parse($user_meta['date_of_leaving'])->weekOfMonth;
									if($fweek_no > $leaving_week)
										continue;
									}
							}
						}else{	
								// if(date('Y', strtotime($user_meta['date_of_joining'])) > $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) < $current_year)) {
								// 	continue;
								// }
								// if(date('m', strtotime($user_meta['date_of_joining'])) >  $current_month && date('Y', strtotime($user_meta['date_of_joining'])) >= $current_year || (!empty($user_meta['date_of_leaving']) && date('Y', strtotime($user_meta['date_of_leaving'])) == $current_year && date('m', strtotime($user_meta['date_of_leaving'])) <  $current_month  )) {
								// 	continue;
								// }
 						}


							echo '<div class="attendance-sheet">';
								if(strlen($user_meta['employee_id']) > 10){
									echo '<div class="attendanc-sheet content">'.substr($user_meta['employee_id'], 0,10).'.. </div>';
									@endphp
									<div class="attendanc-sheet content"><a href="{{route('account.attandance',['id'=>$value['id']])}}">{{substr($user_meta['employee_id'], 0,10)}}.. </a></div>
						 			@php
								}else{
									// echo '<div class="attendanc-sheet content">'.$user_meta['employee_id'].' </div>';
									@endphp
									<div class="attendanc-sheet content"><a href="{{route('account.attandance',['id'=>$value['id']])}}">{{$user_meta['employee_id']}} </a></div>
						 			@php
								}
								
								if(strlen($value['name']) > 10){
									echo '<div class="attendanc-sheet content">'.substr($value['name'], 0,10).'.. </div>';
								}else{
									echo '<div class="attendanc-sheet content">'.$value['name'].' </div>';
								}
							echo '</div>';
						if(isset($attendance_data[$user_meta['employee_id']]) && !empty($attendance_data[$user_meta['employee_id']]))
						{
 							$attendanceVal = collect($attendance_data[$user_meta['employee_id']])->keyBy('date');
 						}
							for($d=$number; $d<=$total_days; $d++)
							{
								$getDay = Carbon\Carbon::create($year, $month, $d, 0);
								if($getDay->format('l')=="Sunday")
								{
									echo "<div class='attendance-sheet column sunday'>S</div>";
								}else
								{
									if(isset($attendance_data[$user_meta['employee_id']]) && !empty($attendance_data[$user_meta['employee_id']]))
									{
										@endphp
											@if(!empty($holiday_data[$d]))
												<div class="attendance-sheet column present-bg-color">H</div>
											@elseif(@$attendanceVal[$d]['attendance_status']=='present')
													<div class="attendance-sheet column present-bg-color aione-tooltip attendance-tardy" data-title="9:00 - 5:00">P</div>
											@elseif(@$attendanceVal[$d]['attendance_status']=='absent')
												<div class="attendance-sheet column absent-bg-color">A</div>
											@elseif(@$attendanceVal[$d]['attendance_status']=='Sunday')
												<div class="attendance-sheet column sunday">S</div>
											@elseif(@$attendanceVal[$d]['attendance_status']=='leave')
												<div class="attendance-sheet column sunday">L</div>
											@else
												<div class="attendance-sheet column bg-grey bg-lighten-3">-</div>
											@endif
										@php
									}else{
										if(!empty($holiday_data[$d])){
											echo '<div class="attendance-sheet column present-bg-color">H</div>';
										}else{
											echo '<div class="attendance-sheet column " style="background-color:rgba(128, 128, 128, 0.38);height:31px"></div>';
										}
									}	
								}
							}


					}
				@endphp
				<br>
			@endforeach
			<div style="clear: both;"></div>
			
		</div>
	</div>
</div>

{{-- 
<div class="aione-border mt-100">
	<div class="aione-border-bottom line-height-30">
		<div class="display-inline-block " style="width: 10%">Employee</div>
		<div class="display-inline-block" style="width: 10%">Name</div>
		<div class="display-inline-block" style="width: 2.66%"></div>
	</div>
	<div class="aione-border-bottom line-height-30">
		<div class="display-inline-block " style="width: 10%">112233</div>
		<div class="display-inline-block" style="width: 10%">Ashish</div>
		<div class="display-inline-block" style="width: 2.66%">p</div>
	</div>
</div>
			

 --}}





