
<?php if(!empty($attendanceVal)): ?>

	<?php 
	// function difference_secs($time_1 , $time_2){
	// 	$start_shift = new Carbon\Carbon($time_1);
	// 		$come_at = new Carbon\Carbon($time_2);
	// 		$diff = $start_shift->diffInSeconds($come_at);
	// 		$secs = convert_sec_to_hour($diff);
	// 	return $secs;
	// }
	$data = $attendanceVal->whereNotIn('shift_hours',[null])->whereNotIn('punch_in_out',[null]);
		$shift = $data->mapWithKeys(function($item , $key){
		$come_late =  $go_early = Null;
		$shift_hr = json_decode($item->shift_hours);
		$punch_in_out = json_decode($item->punch_in_out);
		if($shift_hr[0] < $punch_in_out[0]){
			$come_late = difference_secs($shift_hr[0] , $punch_in_out[0]);
		}
		// if(!empty($punch_in_out[2]) && ($shift_hr[2] > $punch_in_out[2])){
		// 	$go_late = difference_secs($shift_hr[2] , $punch_in_out[2]);
		// }
		return[$key=>['come_late'=>$come_late , 'go_early'=>$go_early]];
	});
	// dump($shift);
	    $working_days_in_month = $attendanceVal->whereNotIn('shift_hours',[null])->count();
	    $loss_of_pay_days = $attendanceVal->whereIn('attendance_status',['lop','absent'])->whereNotIn('shift_hours',[null])->count();
	    $absent = $attendanceVal->whereIn('attendance_status',['absent'])->whereNotIn('shift_hours',[null])->count();
	    $un_paid = $attendanceVal->whereIn('attendance_status',['lop'])->whereNotIn('shift_hours',[null])->count();
	    $leaves_in_month = $attendanceVal->whereIn('attendance_status',['leave'])->whereNotIn('shift_hours',[null])->count();
	    $due_time = $attendanceVal->where('over_time' ,'<', 0)->sum('over_time');
	    $extra_time = $attendanceVal->where('over_time' ,'>', 0)->sum('over_time');
	    $all_stats = $attendanceVal->whereNotIn('over_time' ,[null]);
	 ?>
	<div class="">
		<div class="ar aione-align-center">
	
			
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">working days</div>
					<div><?php echo e($working_days_in_month); ?> </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Loss of Pay days</div>
					<div><?php echo e($loss_of_pay_days); ?> </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Leave</div>
					<div><?php echo e($leaves_in_month); ?> </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Absent</div>
					<div><?php echo e($absent); ?> </div>
				</div>
			</div>
			<div class="ac l16 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Un Paid Leave </div>
					<div><?php echo e($un_paid); ?> </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Due Time</div>
					<div><?php echo e(convert_sec_to_hour(abs($due_time))); ?> </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Extra Time</div>
					<div><?php echo e(convert_sec_to_hour($extra_time)); ?> </div>
				</div>
			</div>
	
		</div>
	</div>
	
	<div class="right-hand">
		
		<div class="display-inline-block aione-align-center p-5 aione-border line-height-20">
				<span class="font-weight-700">DAY</span>
				<br>
				<span class="green darken-2">Over</span>/<span class="red darken-2">Due</span> Time
			</div>
	<?php $__currentLoopData = $all_stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<?php if($all_stats[$key]['over_time'] > 0): ?>

			<div class="display-inline-block aione-align-center p-5 aione-border line-height-20">
				<span class="font-weight-700"> <?php echo e($key); ?></span>
				<br>
				<span class="green darken-2"><?php echo e(convert_sec_to_hour($val['over_time'])); ?></span>
			</div>
		<?php else: ?>
			<div class="display-inline-block aione-align-center p-5 aione-border line-height-20">
				<span class="font-weight-700"><?php echo e($key); ?></span>
				<br>
				<span class="red darken-2"><?php echo e(convert_sec_to_hour(abs($val['over_time']))); ?></span>
			</div>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
	</div>
<?php else: ?>
<div class="aione-message error ">
	No Attendance stats
</div>


<?php endif; ?>