<?php echo $__env->make('organization.hrm.attendance.data-display.check-condition', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="attendance_sheet_container" class="table-responsive">
	<div class="attendance-sheet line-height-30">
		<div class="attendance-sheet">
			<div class="attendanc-sheet content">
				Employee
			</div>
			<div class="attendanc-sheet content">
				<div class="attendanc-sheet content">Name</div>
			</div>
			<div>
				<?php 
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
				 ?>
					<?php if(!empty($fdate)): ?>
						<?php 
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
						 ?>
						<div class="attendance-sheet column"><?php echo e($fdate); ?><br> 
							<?php echo e(substr($getDay->format('l'),0,1)); ?> 
						</div> <div class="attendance-sheet column"> Shift Hours </div><div class="attendance-sheet column">In out Time </div>
					<?php else: ?>
						<?php for($d=$number; $d<=$total_days; $d++): ?>
						<?php 

						$getDay = Carbon\Carbon::create($current_year, $current_month, $d, 0);
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
				 ?>
				<?php 
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
								if( strlen($user_meta['employee_id']) > 10){
									echo '<div class="attendanc-sheet content">'.substr($user_meta['employee_id'], 0,10).'.. </div>';
									 ?>
									<div class="attendanc-sheet content"><a href="<?php echo e(route('account.attandance',['id'=>$value['id']])); ?>"><?php echo e(substr($user_meta['employee_id'], 0,10)); ?>.. </a></div>
						 			<?php 
								}else{
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
						if(!empty($attendance_data) && isset($attendance_data[$user_meta['employee_id']]) && !empty($attendance_data[$user_meta['employee_id']]))
						{
 							$attendanceVal = collect($attendance_data[$user_meta['employee_id']])->keyBy('date');
 						// dd($attendanceVal->toArray() );
 						}else{
 							$attendanceVal = [];
 						}

 						//$total_days=20;
 					 ?>
						<?php for($d=$number; $d<=$total_days; $d++): ?> 
							
							<?php 
								$getDay = Carbon\Carbon::create($current_year, $current_month, $d, 0);
							 ?>
							<?php echo $__env->make('organization.hrm.attendance.data-display.hrm-attendence-status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<?php endfor; ?>
							
						<div class='attendance-details'> 
							<?php echo $__env->make('organization.hrm.attendance.attendance_stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
						<br>
							
				
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<div style="clear: both;"></div>
			
		</div>
	</div>
</div>