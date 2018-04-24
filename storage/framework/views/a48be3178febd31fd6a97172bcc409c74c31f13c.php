<?php 
	if(!empty($date_handling)){
		extract($date_handling);
	}
	$postDate = 01;
	if(!empty(Session::get('date'))) {
		$fdate = $postDate = Session::get('date');
	}
 ?>
<div class="aione-border mb-10">
	<div class="p-10 aione-align-right">
		<ul class="hrm-attendance-view-switch">
		    <li class="month-tab"><a href="#" onclick="attendance_filter(null, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class="hrm-attendance-monthly" id="monthly">Monthly</a></li>
		    <li class="week-tab" ><a href="#" onclick="attendance_filter(null, 1, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class="hrm-attendance-weekly" id="weekly">Weekly</a></li>
		    <li class="daily-tab" ><a href="#" onclick="attendance_filter(1, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class="hrm-attendance-daily" id="daily">Daily</a></li>
		</ul>		
	</div>
</div>

<?php if(empty($condition['date']) && empty($condition['week']) ): ?> 
	<div id="month">
		<?php echo $__env->make('organization.hrm.attendance.monthly-navigate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div> 
<?php elseif(!empty($condition['week'])): ?>
	<div id="week">
		<?php echo $__env->make('organization.hrm.attendance.weekly-navigate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div> 
<?php elseif(!empty($condition['date'])): ?>
	<div id="days">
		<?php echo $__env->make('organization.hrm.attendance.daily-navigate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
<?php endif; ?>
<?php echo $__env->make('organization.hrm.attendance.hrm-attendance-view-data', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>