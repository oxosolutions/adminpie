<?php 
		if(!empty($fweek_no) ) {
			$weekDate = Carbon\Carbon::create($current_year, $current_month, 1, 00);
			$mo =	$weekDate->month;
			$current_week = $weekDate->weekOfMonth;
			if($fweek_no==1) {
				$weekDate->addWeek(); 
			}
			else{
				$weekDate->addWeeks($fweek_no); 
			}
 			$nxt_week = $weekDate->weekOfMonth;
			$nxt_week_month =	$weekDate->month;
			$nxt_week_year =	$weekDate->year;
			$weekDate->subWeeks(2);
			$prev_week = $weekDate->weekOfMonth;
			if($nxt_week==2){
				if($current_month!=3){
					$prev_week = $prev_week +1;
				}else{
					$check_leap_year = Carbon\Carbon::parse('01-02-'.$current_year); 
					 if($check_leap_year->daysInMonth>28){
					 	$prev_week = $prev_week +1;
					 }
				}
			}
			$prev_week_month =	$weekDate->month;
		 	$prev_week_year =	$weekDate->year;
		}
		$week =4;
		if($total_days >28) {
			$week =5;
		}
 ?>
<div class="row design-bg valign-wrapper">
		<div class="col s2">
			<?php   
			 $dt = '1-'.$current_month.'-'.$current_year;
			  ?>
			<div class="col 14">	
				<i class="fa fa-angle-left"></i>
				<a onclick="attendance_filter(null, <?php echo e(@$prev_week); ?>, <?php echo e(@$prev_week_month); ?> , <?php echo e(@$prev_week_year); ?> )" style="cursor:pointer;" class="nav left-align">Previous Week</a>
			</div>
		</div>
		<div class="col s8">
			<div class="aione aione-heading center-align">
				<i class="fa fa-calendar-o" aria-hidden="true" style="margin: 0px 10px"></i>
				<span class="design-style"><?php echo e(date('F, Y', strtotime($dt))); ?></span>
			</div>
		</div>
		
		<div class="col s2">
			<div class="right-align">
			
				<a onclick="attendance_filter(null, <?php echo e(@$nxt_week); ?>, <?php echo e(@$nxt_week_month); ?> , <?php echo e(@$nxt_week_year); ?> )" style="cursor:pointer;" class="nav right-align">Next Week</a>
				<i class="fa fa-angle-right"></i>
			</div>
		</div>	
		<div style="clear:both;">
		</div>
  	</div>
  	<div class="aione-navigation-1">
		<?php for($w=1; $w <=$week; $w++): ?>
			<?php if(@$fweek_no==$w): ?>
				<a style="color:green;" href="javascript:void(0)" onclick="attendance_filter(null, <?php echo e($w); ?>, <?php echo e($mo); ?> , <?php echo e($current_year); ?> )" name="week" > <?php echo e($w); ?></a>
			<?php else: ?>
				<a  href="javascript:void(0)" onclick="attendance_filter(null, <?php echo e($w); ?>, <?php echo e($mo); ?> , <?php echo e($current_year); ?> )" name="week" > <?php echo e($w); ?></a>
			<?php endif; ?>
		<?php endfor; ?>
	</div> 
<script type="text/javascript">
	$('.week-tab').addClass('active').siblings().removeClass('active');
</script>