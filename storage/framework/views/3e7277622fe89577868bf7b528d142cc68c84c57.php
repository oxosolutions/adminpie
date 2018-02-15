
<?php  
$number = 1;
	
		$postDate = 01;
		 if(!empty(Session::get('date')))
		 {
		 	$fdate = $postDate = Session::get('date');
		 }
			$month_wise = $dat  = Carbon\Carbon::create($year, $month, $postDate, 00);
			$mo =	$dat->month; // use for week filter

		 if(!empty($fill_attendance_days)) 
		 {
		 	if(!empty($fweek_no) || !empty($fdate))
		 	{
		 		$total_days = $daysInMonth  =$dat->daysInMonth;
		 	}
		 	else{
		 			$total_days = $daysInMonth  =$dat->daysInMonth;
		 	}
		 }else{
		 $total_days = $daysInMonth  =$dat->daysInMonth;
		}
		 $current_month =	$dat->month;
		 $current_year =	$dat->year;
		 $current_days = $dat->daysInMonth;
		 $current_date = $dat->day;

		$dat->subDay();
		$pre_date = $dat->day;
		$pre_month = $dat->month;
		$pre_year = $dat->year;

		$dat->addDays(2);
		$nxt_date = $dat->day;
		$nxt_date_month = $dat->month;
		$nxt_date_year = $dat->year;

		$pre_week = $dat->weekOfMonth;
		$pre_week_month = $dat->month;
		$pre_week_year = $dat->year;

		if(!empty($fweek_no))
		{
			$weekDate = Carbon\Carbon::create($year, $month, 1, 00);
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

			$previous = $dat->subMonth();
			$previousMonth = $previous->month;
			$previousYear  =  $previous->year;


			$next = $dat->addMonth(2);
			$nextMonth = $next->month;
			$nextYear = $next->year;

		$week =4;
		if($total_days >28)
		{
			$week =5;
		} 
		for($j=1; $j<=$week; $j++ )
		{
			$week_option[$j] = "$j Week"; 
		}
		$sunday_count =0;
		$td="";
		$MO_data = ['01'=>'JAN', '02'=>'FEB', '03'=>'MAR', '04'=>'APR' ,'05'=>'MAY', '06'=>'JUN','07'=>'JUL', '08'=>'AUG','09'=>'SEP', '10'=>'OCT','11'=>'NOV', '12'=>'DEC'];
		$year_data = range(2015, 2050);

	 ?>


<div class="aione-border mb-10">
	<div class="p-10 aione-align-right">
		<ul class="hrm-attendance-view-switch">
		    <li class="active"><a href="#" onclick="attendance_filter(null, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class="hrm-attendance-monthly" id="monthly">Monthly</a></li>
		    <li><a href="#" onclick="attendance_filter(null, 1, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class="hrm-attendance-weekly" id="weekly">Weekly</a></li>
		    <li><a href="#" onclick="attendance_filter(1, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class="hrm-attendance-daily" id="daily">Daily</a></li>
		</ul>		
	</div>
</div>






<div id="month">

					
	<div class="row design-bg valign-wrapper p-10 bg-grey bg-lighten-3">
		<div class=" col s2">
			<?php  
			 $dt = '1-'.$month.'-'.$year;
			// 		$ym = date('Y-m', strtotime($dt));
			 ?>
			 	<div class="left-align">
					<a class="nav left-align nav-past" onclick="attendance_filter(null, null, <?php echo e($previousMonth); ?> , <?php echo e($previousYear); ?> )">Previous Month</a>
				</div>
		</div>
		
		<div class="col l8">
			<div class="aione aione-heading center-align">
				<div class="row valign-wrapper" style="margin-bottom: 0px">
					<div class="col s3">
						
					</div>
					<div class="col s3 pr-7 right-align">
						<select class="browser-default"  onchange="attendance_filter(null, null, <?php echo e($current_month); ?>, this.value )" >
						<?php $__currentLoopData = $year_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($current_year==$val): ?>
								<option selected="selected" value="<?php echo e($val); ?>"><?php echo e($val); ?> </option>
							<?php else: ?>
									<option value="<?php echo e($val); ?>"><?php echo e($val); ?> </option>
								<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</select>
					</div>
					<div class="col s3 pl-7">
						<select class="browser-default"  onchange="attendance_filter(null, null, this.value, <?php echo e($current_year); ?> )" >
							<?php $__currentLoopData = $MO_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($current_month==$key): ?>
									<option selected="selected" value="<?php echo e($key); ?>"><?php echo e($val); ?> </option>

								<?php else: ?>
									<option value="<?php echo e($key); ?>"><?php echo e($val); ?> </option>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							
						</select>

					</div>
					<div class=" col s3">
						<input id="current_month" type="hidden" value="<?php echo e($current_month); ?>">
						<input id="year" type="hidden" value="<?php echo e($current_year); ?>">
					</div>
				</div>
				
				
					

					
					
			</div>
		</div>
		
		<div class=" col s2" style="text-align: right;">
			<div class="right-align">
				<a onclick="attendance_filter(null, null, <?php echo e($nextMonth); ?> , <?php echo e($nextYear); ?> )" style="cursor:pointer;" class="nav right-align nav-future">Next Month</a>
				
			</div>	 
		</div>
		
		<div style="clear:both;">
		</div>
	</div>
</div> 


<div id="week">
	<div class="row design-bg valign-wrapper">
		<div class="col s2">
			<?php   
			 $dt = '1-'.$month.'-'.$year;
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
</div> 

<div id="days">
	<div class="row design-bg valign-wrapper">
		<div class="col s2">
			<?php  
			 $dt = '1-'.$month.'-'.$year;
			// 		$ym = date('Y-m', strtotime($dt));
			 ?>
			 	<i class="fa fa-angle-left"></i>
				<a onclick="attendance_filter(<?php echo e($pre_date); ?>, null, <?php echo e($pre_month); ?> , <?php echo e($pre_year); ?> )" style="cursor: pointer;" name="date" value="<?php echo e($pre_date); ?>" class="nav left-align">Previous Day</a>
		</div>
		<div class="col s8">
			<div class="aione aione-heading center-align">
				<i class="fa fa-calendar-o" aria-hidden="true" style="margin: 0px 10px"></i>
				<span class="design-style"><?php echo e(date('F, Y', strtotime($dt))); ?></span>
			</div>	
		</div>
		
		<div class="col s2">
			<div class="right-align">
				<a onclick="attendance_filter(<?php echo e($nxt_date); ?>, null, <?php echo e($nxt_date_month); ?> , <?php echo e($nxt_date_year); ?> )" style="cursor: pointer" name="date" value="<?php echo e($nxt_date); ?>" class="nav right-align">Next Day</a>
				<i class="fa fa-angle-right"></i>
			</div>
		</div>	 
		<div style="clear: both;">
		</div>
  	</div>
  	<div id="dates" class="aione-navigation-1">
		<?php for($i=1; $i<=$current_days; $i++): ?>
			<?php if($current_date==$i): ?>
				<a style="cursor: pointer; color:red;" href="javascript:void(0)" onclick="attendance_filter(<?php echo e($i); ?>, null, <?php echo e($mo); ?> , <?php echo e($current_year); ?> )" name="date"  > <?php echo e($i); ?></a>

			<?php else: ?>
				<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter(<?php echo e($i); ?>, null, <?php echo e($mo); ?> , <?php echo e($current_year); ?> )" name="date"  > <?php echo e($i); ?></a>
			<?php endif; ?>
		<?php endfor; ?>
	</div>
</div>
<?php echo $__env->make('organization.attendance.attendance_data_display', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>