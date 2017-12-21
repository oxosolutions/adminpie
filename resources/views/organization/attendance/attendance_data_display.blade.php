<div id="attendance_sheet_container" class="table-responsive">
	<div class="attendance-sheet">
		<div class="attendance-sheet">
			<div class="attendanc-sheet content">
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
							$td .="<div class='attendance-sheet column'>-</div>";
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
							$td .="<div class='attendance-sheet column'>-</div>";
						}
						@endphp
							<div class="attendance-sheet column">{{$d}}<br> 
							{{substr($getDay->format('l'),0,1)}} 
							</div>
						@endfor
					@endif
 			</div>
			<div style="clear:both;"> </div>

			{{-- {{ dump($user_data->toArray()) }} --}}
			
			@foreach($user_data as $userKey => $value)

				@php
					$user_meta  = $value->metas_for_attendance->mapwithKeys(function($item){
	 					return [$item['key'] => $item['value'] ];
						 }); 
					if(!empty($user_meta['employee_id']) && !empty($user_meta['user_shift']) && !empty($user_meta['date_of_joining']))
					{
 						if(!empty($fweek_no) || !empty($fdate)){
							echo "<br>";
							if(!empty($fdate))
							{	
								if(date('Y-m-d', strtotime($user_meta['date_of_joining'])) > date('Y-m-d' ,strtotime("$current_year-$current_month-$fdate")))
								{
									continue;
								}
 							}
							if(!empty($fweek_no)){
								if(date('m', strtotime($user_meta['date_of_joining'])) >  $current_month){
								continue;
								}
								if(date('m', strtotime($user_meta['date_of_joining'])) ==  $current_month){
									$joining_week = Carbon\Carbon::parse($user_meta['date_of_joining']);
									
									}
							}
						}else{	
								if(date('Y', strtotime($user_meta['date_of_joining'])) > $current_year ){
									continue;
								}
								if(date('m', strtotime($user_meta['date_of_joining'])) >  $current_month && date('Y', strtotime($user_meta['date_of_joining'])) >= $current_year ){
									continue;
								}
 						}


							echo '<div class="attendance-sheet">';
								if(strlen($user_meta['employee_id']) > 10){
									echo '<div class="attendanc-sheet content">'.substr($user_meta['employee_id'], 0,10).'.. </div>';
								}else{
									echo '<div class="attendanc-sheet content">'.$user_meta['employee_id'].' </div>';
								}
								
								if(strlen($value['belong_group']['name']) > 12){
									echo '<div class="attendanc-sheet content">'.substr($value['belong_group']['name'], 0,12).'.. </div>';
								}else{
									echo '<div class="attendanc-sheet content">'.$value['belong_group']['name'].' </div>';
								}
							echo '</div>';
						if(isset($attendance_data[$user_meta['employee_id']]) && !empty($attendance_data[$user_meta['employee_id']]))
						{
 							$attendanceVal = collect($attendance_data[$user_meta['employee_id']])->keyBy('date');
 							// dump($user_meta['employee_id'] , $attendanceVal->toArray());
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
												<div class="attendance-sheet column present-bg-color">P</div>
										@elseif(@$attendanceVal[$d]['attendance_status']=='absent')
											<div class="attendance-sheet column absent-bg-color">A</div>
										@elseif(@$attendanceVal[$d]['attendance_status']=='Sunday')
											<div class="attendance-sheet column sunday">S</div>
										@elseif(@$attendanceVal[$d]['attendance_status']=='leave')
											<div class="attendance-sheet column sunday">L</div>
										@else
											<div class="attendance-sheet column ">-</div>
										@endif
									@php
								}else{
									echo '<div class="attendance-sheet column ">-</div>';
								}	
								}
							}


					}
				@endphp
			@endforeach
			<div style="clear: both;"></div>
			
		</div>
	</div>
</div>
			







