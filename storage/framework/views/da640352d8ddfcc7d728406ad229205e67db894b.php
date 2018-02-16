<?php 

$month_wise = $dat  = Carbon\Carbon::create($current_year, $current_month, $postDate, 00);
			$mo =	$dat->month; // use for week filter

		

		$pre_week = $dat->weekOfMonth;
		$pre_week_month = $dat->month;
		$pre_week_year = $dat->year;
		// if(empty($fweek_no)){
		// 	$week_nos =1;			
		// }

		if(!empty($fweek_no) )
		{
			$weekDate = Carbon\Carbon::create($current_year, $current_month, 1, 00);
			$current_week = $weekDate->weekOfMonth;
			if($fweek_no==1)
			{
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

			// $previous = $dat->subMonth();
			// $previousMonth = $previous->month;
			// $previousYear  =  $previous->year;


			// $next = $dat->addMonth(2);
			// $nextMonth = $next->month;
			// $nextYear = $next->year;

		$week =4;
		if($total_days >28)
		{
			$week =5;
		} 
	

 ?>
<div class="row design-bg valign-wrapper">
		<div class="col s2">
			<?php   
			 $dt = '1-'.$current_month.'-'.$current_year;
			// 		$ym = date('Y-m', strtotime($dt));
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