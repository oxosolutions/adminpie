
<?php if(!empty($attendanceVal)): ?>
<h3> Attendance stats </h3>
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
	<div class="left-hand">
		<h5> Holidays days <?php echo e($holiday_data->count()); ?> </h5>
		<h5> working days <?php echo e($working_days_in_month); ?> </h5>
		<h5> Loss of Pay days <?php echo e($loss_of_pay_days); ?> </h5>
		<h5> Total Leave <?php echo e($leaves_in_month); ?> </h5>
		<h5> Total Absent <?php echo e($absent); ?> </h5>
		<h5> Total Un Paid Leave <?php echo e($un_paid); ?> </h5>
		<h5> Total Due Time  <?php echo e(convert_sec_to_hour(abs($due_time))); ?> </h5>
		<h5> Total Extra Time<?php echo e(convert_sec_to_hour($extra_time)); ?> </h5>
	</div>
	<div class="right-hand">
		<table>
			<tr>
				<?php $__currentLoopData = $all_stats->keys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<th><?php echo e($head); ?> </th>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tr>
			<tr>
			<?php $__currentLoopData = $all_stats->keys(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($all_stats[$key]['over_time'] < 0): ?>
				<td>-<?php echo e(convert_sec_to_hour(abs($all_stats[$key]['over_time']))); ?></td>
				<?php else: ?>
					<td><?php echo e(convert_sec_to_hour($all_stats[$key]['over_time'])); ?></td>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tr>
		</table>
	</div>
<?php else: ?>
<h3> No Attendance stats </h3>

<?php endif; ?>