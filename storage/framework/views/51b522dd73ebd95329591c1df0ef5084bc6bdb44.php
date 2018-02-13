
<?php if(!empty($attendanceVal)): ?>
<h3> Attendance stats </h3>
	<?php 
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