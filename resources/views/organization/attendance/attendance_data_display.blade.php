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

		
			{{-- {{dd($attendance_data)}} --}}

			@foreach($user_data as $userKey => $value)

				@php
					$user_meta  = $value->metas_for_attendance->mapwithKeys(function($item){
	 					return [$item['key'] => $item['value'] ];
						 }); 
					
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

							for($d=$number; $d<=$total_days; $d++)
							{
								$getDay = Carbon\Carbon::create($year, $month, $d, 0);
								if($getDay->format('l')=="Sunday")
								{
									echo "<div class='attendance-sheet column sunday'>O</div>";
								}else
								{
									// http_response_code(500);
									// dump($attendance_data);
									// continue;
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
									@include('organization.attendance.attendance_stats')
 									
 								</div>
							@php
					}
				@endphp
				<br>
			@endforeach
			<div style="clear: both;"></div>
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.show-details',function(e){
			e.preventDefault();
			$('.attendance-details').hide();
			$(this).parents('.attendance-sheet').nextAll('.attendance-details:first').toggle();
		})
	})
</script>





