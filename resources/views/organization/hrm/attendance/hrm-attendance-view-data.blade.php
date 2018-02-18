@include('organization.hrm.attendance.data-display.check-condition')
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
		 			$td="";
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
							$getDay = Carbon\Carbon::create($current_year, $current_month, $d, 0);
						}
					}
				@endphp
					@if(!empty($fdate))
						@php
							$number = $total_days = $fdate;
							$getDay = Carbon\Carbon::create($current_year, $current_month, $fdate, 0);
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
						</div> <div class="attendance-sheet column"> Shift Hours </div><div class="attendance-sheet column">In out Time </div>
					@else
						@for($d=$number; $d<=$total_days; $d++)
						@php

						$getDay = Carbon\Carbon::create($current_year, $current_month, $d, 0);
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
				@endphp
				@php
					$check = check_joining_leaving_employee($user_meta , $current_year,  $current_month);
					if($check==false){
						continue;
					}
 					if(!empty($fweek_no) || !empty($fdate)){
						
						if(!empty($fdate)) {
							$joining_date =	check_joining_date($user_meta, $current_year, $current_month, $fdate);

							if($joining_date==false){
								continue;
							}
 						}
						if(!empty($fweek_no)){
							$check_joining_week = check_joining_week($user_meta , $current_year , $current_month , $fweek_no );
							if($check_joining_week==false){
								continue;
							}
						}
						echo "<br>";
					}
						echo '<div class="attendance-sheet">';
								if(strlen($user_meta['employee_id']) > 10){
									echo '<div class="attendanc-sheet content">'.substr($user_meta['employee_id'], 0,10).'.. </div>';
									@endphp
									<div class="attendanc-sheet content"><a href="{{route('account.attandance',['id'=>$value['id']])}}">{{substr($user_meta['employee_id'], 0,10)}}.. </a></div>
						 			@php
								}else{
									@endphp
									<div class="attendanc-sheet content"><a href="{{route('account.attandance',['id'=>$value['id']])}}">{{$user_meta['employee_id']}} </a>
									</div>
						 			@php
								}
								if(strlen($value['name']) > 10){
									echo '<div class="attendanc-sheet content">'.substr($value['name'], 0,10).'.. <a href="#" class="grey aione-float-right ph-10 show-details"><i class="fa fa-ellipsis-v"></i></a></div>';
								}else{
									echo '<div class="attendanc-sheet content">'.$value['name'].'<a href="#" class="grey aione-float-right ph-10 show-details"><i class="fa fa-ellipsis-v"></i></a> </div>';
								}
							echo '</div>';

						if(isset($attendance_data[$user_meta['employee_id']]) && !empty($attendance_data[$user_meta['employee_id']]))
						{
 							$attendanceVal = collect($attendance_data[$user_meta['employee_id']])->keyBy('date');
 						}else{
 							$attendanceVal = [];
 						}
						for($d=$number; $d<=$total_days; $d++) {
								$getDay = Carbon\Carbon::create($current_year, $current_month, $d, 0);
								if($getDay->format('l')=="Sunday")
								{
									echo "<div class='attendance-sheet column sunday'>O</div>";
								}else
								{
									if(isset($attendance_data[$user_meta['employee_id']]) && !empty($attendance_data[$user_meta['employee_id']]))
									{
									@endphp
										@if(!empty($holiday_data[$d]))
											@if(!empty($attendanceVal[$d]['punch_in_out']))
												<div class="attendance-sheet column attendance-status-holiday attendance-status-present">H</div>

											@else
											<div class="attendance-sheet column attendance-status-holiday">H</div>
											@endif
										@elseif(isset($attendanceVal[$d]) && empty($attendanceVal[$d]['shift_hours']))
											@if(!empty($attendanceVal[$d]['punch_in_out']))
												<div class="attendance-sheet column attendance-status-holiday attendance-status-present">O</div>
											@else
												<div class="attendance-sheet column attendance-status-holiday">O</div>
											@endif
										@elseif(@$attendanceVal[$d]['attendance_status']=='present')
												<div class="attendance-sheet column attendance-status-present aione-tooltip attendance-status-tardy" data-title="9:00 - 5:00">P</div>
										@elseif(@$attendanceVal[$d]['attendance_status']=='absent')
											<div class="attendance-sheet column attendance-status-absent">A</div>
										@elseif(@$attendanceVal[$d]['attendance_status']=='Sunday')
											@if(!empty($attendanceVal[$d]['punch_in_out']))
												<div class="attendance-sheet column sunday attendance-status-holiday attendance-status-present">O</div>
											@else
												<div class="attendance-sheet column sunday attendance-status-holiday">O</div>
											@endif
										@elseif(@$attendanceVal[$d]['attendance_status']=='leave')
											@if(!empty($attendanceVal[$d]['punch_in_out']))
												<div class="attendance-sheet column sunday attendance-status-leave ">L</div>
											@else
												<div class="attendance-sheet column attendance-status-leave">L</div>
											@endif
										@else
											<div class="attendance-sheet column attendance-status-null">-</div>
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
							@endphp
							
								<div class='attendance-details'> 
									@include('organization.hrm.attendance.attendance_stats')
 									
 								</div>
 								<br>
							
				
			@endforeach
			<div style="clear: both;"></div>
			
		</div>
	</div>
</div>