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
					<?php 
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
					 ?>
					<?php if(!empty($fdate)): ?>
						<?php 
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
						 ?>
						<div class="attendance-sheet column"><?php echo e($fdate); ?><br> 
							<?php echo e(substr($getDay->format('l'),0,1)); ?> 
							</div>
					<?php else: ?>
						<?php for($d=$number; $d<=$total_days; $d++): ?>
						<?php  
						$getDay = Carbon\Carbon::create($year, $month, $d, 0);
						if($getDay->format('l')=="Sunday")
						{
							$td .="<div class='attendance-sheet column sunday'>S</div>";
						}else
						{
							$td .="<div class='attendance-sheet column bg-grey bg-lighten-3'></div>";
						}
						 ?>
							<div class="attendance-sheet column"><?php echo e($d); ?><br> 
							<?php echo e(substr($getDay->format('l'),0,1)); ?> 
							</div>
						<?php endfor; ?>
					<?php endif; ?>
 			</div>
			<div style="clear:both;"> </div>

		
			

			<?php $__currentLoopData = $user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userKey => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<?php 
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
									 ?>
									<div class="attendanc-sheet content"><a href="<?php echo e(route('account.attandance',['id'=>$value['id']])); ?>"><?php echo e(substr($user_meta['employee_id'], 0,10)); ?>.. </a></div>
						 			<?php 
								}else{
									// echo '<div class="attendanc-sheet content">'.$user_meta['employee_id'].' </div>';
									 ?>
									<div class="attendanc-sheet content"><a href="<?php echo e(route('account.attandance',['id'=>$value['id']])); ?>"><?php echo e($user_meta['employee_id']); ?> </a>
									</div>
						 			<?php 
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
									 ?>
										<?php if(!empty($holiday_data[$d])): ?>
											<?php if(!empty($attendanceVal[$d]['punch_in_out'])): ?>
												<div class="attendance-sheet column present-bg-color-holiday">H</div>

											<?php else: ?>
											<div class="attendance-sheet column ">H</div>
											<?php endif; ?>
										<?php elseif(isset($attendanceVal[$d]) && empty($attendanceVal[$d]['shift_hours'])): ?>
											<?php if(!empty($attendanceVal[$d]['punch_in_out'])): ?>
												<div class="attendance-sheet column present-bg-color-holiday">O</div>
											<?php else: ?>
												<div class="attendance-sheet column">O</div>
											<?php endif; ?>
										<?php elseif(@$attendanceVal[$d]['attendance_status']=='present'): ?>
												<div class="attendance-sheet column present-bg-color aione-tooltip attendance-tardy" data-title="9:00 - 5:00">P</div>
										<?php elseif(@$attendanceVal[$d]['attendance_status']=='absent'): ?>
											<div class="attendance-sheet column absent-bg-color">A</div>
										<?php elseif(@$attendanceVal[$d]['attendance_status']=='Sunday'): ?>
											<?php if(!empty($attendanceVal[$d]['punch_in_out'])): ?>
												<div class="attendance-sheet column sunday present-bg-color">O</div>
											<?php else: ?>
												<div class="attendance-sheet column sunday">O</div>
											<?php endif; ?>
										<?php elseif(@$attendanceVal[$d]['attendance_status']=='leave'): ?>
											<?php if(!empty($attendanceVal[$d]['punch_in_out'])): ?>
												<div class="attendance-sheet column sunday present-bg-color">L</div>
											<?php else: ?>
												<div class="attendance-sheet column  leave-bg-color">L</div>
											<?php endif; ?>
										<?php else: ?>
											<div class="attendance-sheet column bg-grey bg-lighten-3">-</div>
										<?php endif; ?>
									<?php 
									}else{
										if(!empty($holiday_data[$d])){
											echo '<div class="attendance-sheet column present-bg-color">H</div>';
										}else{
											echo '<div class="attendance-sheet column " style="background-color:rgba(128, 128, 128, 0.38);height:31px"></div>';
										}
									}	
								}
							}
							 ?>
								<div class='attendance-details'> 
									<?php echo $__env->make('organization.attendance.attendance_stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 									
 								</div>
							<?php 
					}
				 ?>
				<br>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<div style="clear: both;"></div>
			
		</div>
	</div>
</div>
<style type="text/css">
	.attendance-details{
		display: none;
	}
	.present-bg-color{
		background-color: #6aa84f;
	}
	.present-bg-color-holiday{
		background-color: #274e13;
		color: white
	}
	.absent-bg-color{
		background-color: #c53929 !important;
	}
	.leave-bg-color{
		background-color: #f1c232
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.show-details',function(e){
			e.preventDefault();
			$('.attendance-details').hide();
			$(this).parents('.attendance-sheet').nextAll('.attendance-details:first').toggle();
		})
	})
</script>





