<div class="row design-bg valign-wrapper">
		<div class="col s2">
			<?php $dt = '1-'.$current_month.'-'.$current_year; ?>
			 	<i class="fa fa-angle-left"></i>
				<a onclick="attendance_filter(<?php echo e($daily_previous_date); ?>, null, <?php echo e($daily_previous_month); ?> , <?php echo e($daily_previous_year); ?> )" style="cursor: pointer;" name="date" value="<?php echo e($daily_previous_date); ?>" class="nav left-align">Previous Day</a>
		</div>
		<div class="col s8">
			<div class="aione aione-heading center-align">
				<i class="fa fa-calendar-o" aria-hidden="true" style="margin: 0px 10px"></i>
				<span class="design-style"><?php echo e(date('F, Y', strtotime($dt))); ?></span>
			</div>	
		</div>
		
		<div class="col s2">
			<div class="right-align">
				<a onclick="attendance_filter(<?php echo e($daily_next_date); ?>, null, <?php echo e($daily_next_month); ?> , <?php echo e($daily_next_year); ?> )" style="cursor: pointer" name="date" value="<?php echo e($daily_next_date); ?>" class="nav right-align">Next Day</a>
				<i class="fa fa-angle-right"></i>
			</div>
		</div>	 
		<div style="clear: both;">
		</div>
  	</div>
  	<div id="dates" class="aione-navigation-1">
		<?php for($i=1; $i<=$total_days; $i++): ?>
			<?php if($postDate==$i): ?>
				<a style="cursor: pointer; color:red;" href="javascript:void(0)" onclick="attendance_filter(<?php echo e($i); ?>, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" name="date"  > <?php echo e($i); ?></a>
			<?php else: ?>
				<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter(<?php echo e($i); ?>, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" name="date"  > <?php echo e($i); ?></a>
			<?php endif; ?>
		<?php endfor; ?>
	</div>
	<script type="text/javascript">
		$('.daily-tab').addClass('active').siblings().removeClass('active');
	</script>