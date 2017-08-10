<style type="text/css">
   .aione-tabs{
      border-bottom: 1px solid #e8e8e8;
      padding-bottom: 4px;
      padding: 0px;
      margin: 0px;
   }
   .aione-tabs > .tab{
     
    display: inline-block;
   }
   .aione-tabs > .tab:hover{
      background-color: #e8e8e8;
          border-bottom: 1px solid #EEE;
   }
   .aione-tabs > .tab > a{
    padding: 0px 12px  !important; 
    line-height: 40px;
    display: inline-block; 
    color: #0073aa;
   }
   .aione-active{
      border: 1px solid #e8e8e8;
      border-bottom: 1px solid #fff;
      margin-bottom: -1px !important;
   }
   .aione-active a{
      color: black !important;
      font-weight: 500
   }


	.aione-navigation-1 a{
		    display: inline-block;
		    text-align: center;
		    width: 30px;
		    line-height: 30px;
	}
	.aione-navigation-1 a:hover{
		    background-color: #039BE5;
		    color: white;
	}

	.nav-past{
		    cursor: pointer;
			display: inline-block;
			position: relative;
	}
	.nav-past:before{
		    content: "";
		    position: absolute;
		    top: 5px;
		    left: -10px;
		    border-top: 1px solid #d2d2d2;
		    border-right: 1px solid #d2d2d2;
		    width: 10px;
		    height: 10px;
		    -webkit-transform: rotate(225deg);
		    -moz-transform: rotate(225deg);
		    transform: rotate(225deg);
		    -webkit-transition: all 150ms ease-out;
		    -moz-transition: all 150ms ease-out;
		    -o-transition: all 150ms ease-out;
		    transition: all 150ms ease-out;
	}

	.select-dropdown{
			margin-bottom: 0px !important;
		    border: 1px solid #a8a8a8 !important;
		    
		}
		.select-wrapper input.select-dropdown{
			height: 30px;
	    	line-height: 30px;
	    	text-align: center;
			
			
			background-color: white !important;
		}
		
		.select-wrapper span.caret{
			   
			    z-index: 9 !important;
		}
		.dropdown-content{
			background-color: white;
			
		}
		.dropdown-content li>a, .dropdown-content li>span{
			color: #0288D1 !important
		}

	.nav-future{
		    cursor: pointer;
			display: inline-block;
			position: relative;
	}
	.nav-future:after{
		    content: "";
		    position: absolute;
		    top: 5px;
		    right: -10px;
		    border-top: 1px solid #d2d2d2;
		    border-right: 1px solid #d2d2d2;
		    width: 10px;
		    height: 10px;
		    -webkit-transform: rotate(45deg);
		    -moz-transform: rotate(45deg);
		    transform: rotate(45deg);
		    -webkit-transition: all 150ms ease-out;
		    -moz-transition: all 150ms ease-out;
		    -o-transition: all 150ms ease-out;
		    transition: all 150ms ease-out;
	}
</style>
<?php  
$number = 1;
// dump(@$attendance_data);
		$holidays =[];
		if(!empty($holiday_data))
		{
			foreach ($holiday_data as $key => $value) {
			$holidays[$value->day] = $value->title;
			}
		}
		$postDate = 01;
		 if(!empty(Session::get('date')))
		 {
		 	$fdate = $postDate = Session::get('date');
		 	//dump('session'. $fdate);
		 }
		 // if(strlen($month)){
		 // 	$month = "0".$month;
		 // }
		

			$month_wise = $dat  = Carbon\Carbon::create($year, $month, $postDate, 00);
			// dump('current'.$month_wise);
			$mo =	$dat->month; // use for week filter
			//dump($dat->toDateTimeString());

		 if(!empty($fill_attendance_days)) 
		 {
		 	if(!empty($fweek_no) || !empty($fdate))
		 	{
		 		//$total_days = $fill_attendance_days;
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
//dump($fweek_no);

//previous days		 
		$dat->subDay();
		$pre_date = $dat->day;
		$pre_month = $dat->month;
		$pre_year = $dat->year;

		// dump("previous day year month date $pre_year $pre_month $pre_date ");
//next days 
		$dat->addDays(2);
		$nxt_date = $dat->day;
		$nxt_date_month = $dat->month;
		$nxt_date_year = $dat->year;
		// dump("Next day year month date $nxt_date_year $nxt_date_month $nxt_date ");

//week 
// echo $dat->subWeek();
		$pre_week = $dat->weekOfMonth;
		//dump($dat->addWeek());
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
			// dump("next week $nxt_week  $nxt_week_month $nxt_week_year".  $weekDate->toDateTimeString());
			// if($fweek_no==1)
			// {
				$weekDate->subWeeks(2); 
				// dump($weekDate->toDateTimeString());
			// }
			// else{
			// 	$wno = $nxt_week - 2;
			// 	dump($wno);
			// 	$weekDate->subWeeks($wno); 
			// }
			

			$prev_week = $weekDate->weekOfMonth;
			$prev_week_month =	$weekDate->month;
		 	$prev_week_year =	$weekDate->year;
			// dump("previous week $prev_week $prev_week_month $prev_week_year".  $weekDate->toDateTimeString());
		}		 

			$previous = $dat->subMonth();
			$previousMonth = $previous->month;
			$previousYear  =  $previous->year;

			// dump("previous month year $previousMonth  $previousYear");

			$next = $dat->addMonth(2);
			$nextMonth = $next->month;
			$nextYear = $next->year;
				// dump("next month year $nextMonth  $nextYear");

		$week =4;
		// dump("total day".$total_days);
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

<?php if($total_days==28): ?>
	<style type="text/css"> 
		.column
		{
			width: 2.70% !important;
		}
	</style>
<?php endif; ?>
<?php if($total_days==31): ?>
	<style type="text/css"> 
		.column
		{
			width: 2.43% !important;
		}
	</style>
<?php endif; ?>

	    <ul class="aione-tabs">
	        <li class="tab col monthly" ><a href="#" onclick="attendance_filter(null, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class="">Monthly</a></li>
	        <li class="tab col weekly "><a href="#" onclick="attendance_filter(null, 1, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class=" ">Weekly</a></li>
	        <li class="tab col daily"><a href="#" onclick="attendance_filter(1, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" class=" ">Daily</a></li>
	       
	        <div style="clear: both">
	          
	        </div>
	    </ul>
	
					


<div class="row">
	<h5 class="text-center"></h5>
</div>


<div id="month">

					
			<div class="row design-bg valign-wrapper" style="padding:14px">
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
								
								<div class="switch">
										    <label>
												lock 
													<?php if(@$lock_status == 1): ?>
														<input type="checkbox">
													<?php else: ?>
														<input type="checkbox" checked="checked">
													<?php endif; ?>
												
										      <span class="lever"></span>
										    </label>
										  </div>
								
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
				<a style="color:green;" href="javascript:void(0)" onclick="attendance_filter(null, <?php echo e($w); ?>, <?php echo e($mo); ?> , <?php echo e($previousYear); ?> )" name="week" > <?php echo e($w); ?></a>
			<?php else: ?>
				<a  href="javascript:void(0)" onclick="attendance_filter(null, <?php echo e($w); ?>, <?php echo e($mo); ?> , <?php echo e($previousYear); ?> )" name="week" > <?php echo e($w); ?></a>
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
				<a style="cursor: pointer; color:red;" href="javascript:void(0)" onclick="attendance_filter(<?php echo e($i); ?>, null, <?php echo e($mo); ?> , <?php echo e($previousYear); ?> )" name="date"  > <?php echo e($i); ?></a>

			<?php else: ?>
				<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter(<?php echo e($i); ?>, null, <?php echo e($mo); ?> , <?php echo e($previousYear); ?> )" name="date"  > <?php echo e($i); ?></a>
			<?php endif; ?>
		<?php endfor; ?>
	</div>
</div> 		

<div id="attendance_sheet_container" class="table-responsive">
			<?php if(!empty($error)): ?>

			<div class="attendance-sheet">
					<div class="attendance-sheet">
						<div class="attendanc-sheet content">
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
										//dump($end_week_day);

									}else{
										$total_days = $end_week_day = $fweek_no * 7;
										$number = $start_week_day = $end_week_day -6;
									}
									for($d=$start_week_day; $d<=$end_week_day; $d++){
										$getDay = Carbon\Carbon::create($year, $month, $d, 0);
										///echo '<div class="attendance-sheet column">'.$d.'<br>'.substr($getDay->format('l'),0,1).'</div>';
									}
								}
								// dump( @$fdate);

								 ?>

								<?php if(!empty($fdate)): ?>
									<?php 
										$getDay = Carbon\Carbon::create($year, $month, $fdate, 0);
										if($getDay->format('l')=="Sunday")
									{
										$td .="<div class='attendance-sheet column sunday'>S</div>";
									}else
									{
										$td .="<div class='attendance-sheet column'>-</div>";
									}
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
										$td .="<div class='attendance-sheet column'>-</div>";
									}
									 ?>
										<div class="attendance-sheet column"><?php echo e($d); ?><br> 
										<?php echo e(substr($getDay->format('l'),0,1)); ?> 
										</div>
									<?php endfor; ?>
								<?php endif; ?>

						</div>
						<div style="clear:both;">
						</div>
					</div>
					
						<?php $__currentLoopData = $employee_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empKey => $empVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
						$employ_info = EmployeeHelper::employ_info($empVal['employee_id']); 

						 ?>
						<div class="attendance-sheet">
							<div class="attendanc-sheet content">
								<?php echo e($empVal['employee_id']); ?>

							</div>
								<div class="attendanc-sheet content"><?php echo e($employ_info['employ_info']['name']); ?>  </div>
							<?php echo $td; ?>

						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div style="clear: both;"></div>
			</div>

		
			
			<?php else: ?>
			<div class="attendance-sheet">
				<div class="attendance-sheet">
					<div class="attendance-sheet">
						<div class="attendanc-sheet content">Employee</div>
						<div class="attendanc-sheet content">Name</div>
						
						
						
						<?php if(!empty($fweek_no) || !empty($fdate)): ?>
								<?php 
								if(!empty($fweek_no)){
									if($fweek_no==5){

										$end_week_day = $total_days;
										$number = $start_week_day = 29;
										//dump($end_week_day);

									}else{
										$total_days = $end_week_day = $fweek_no * 7;
										$number = $start_week_day = $end_week_day -6;
									}
									for($d=$start_week_day; $d<=$end_week_day; $d++){
										$getDay = Carbon\Carbon::create($year, $month, $d, 0);
										echo '<div class="attendance-sheet column">'.$d.'<br>'.substr($getDay->format('l'),0,1).'</div>';
									}
								}
// day by day attendance
								if(!empty($fdate)){
									$getDay = Carbon\Carbon::create($year, $month, $fdate, 0);
										echo '<div class="attendance-sheet column">'.$fdate.'<br>'.substr($getDay->format('l'),0,1).'</div>';	
								}

								 ?>
							<?php if(isset($attendance_data[0])): ?>
								<?php $__currentLoopData = $attendance_data[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateKey =>$dateVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($dateVal['day']=='Sunday'): ?>
										<?php $sunday_count++; ?>
									<?php endif; ?>
									<div class="attendance-sheet column"><?php echo e($dateVal['date']); ?><br><?php echo e(substr($dateVal['day'], 0,1)); ?></div>
									
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>

						<?php else: ?>

							<?php for($d=1; $d<=$total_days; $d++): ?>
								<?php  
								$getDay = Carbon\Carbon::create($year, $month, $d, 0);
								if($d > $fill_attendance_days)
								{
									if($getDay->format('l')=="Sunday")
									{
										$td .="<div  class='attendance-sheet column sunday'>St</div>";
									}else
									{
										$td .="<div class='attendance-sheet column'> t- </div>";
									}
								}
								 ?>
							<div class="attendance-sheet column"><?php echo e($d); ?><br>
							<?php echo e(substr($getDay->format('l'),0,1)); ?> 
							</div>
							<?php endfor; ?>
						<?php endif; ?>
						<div style="clear: both">
							
						</div>
					</div>
					</div>

			</div>

			
			<div class="attendance-sheet">
				<div class="attendance-sheet">
					<div class="attendanc-sheet content">
					<?php if(!empty($attendance_data)): ?>
						
						<?php $__currentLoopData = $attendance_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupkey => $groupVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<?php 
								$collect 	= 	collect($groupVal);
								$att_datas 	=	$collect->keyBy('date')->toArray();
								//dump($att_datas);
								
									$day_count = $chunk - $sunday_count;
									$employ_info = EmployeeHelper::employ_info($groupVal[0]['employee_id']); 
									if(empty($attendance_count[$groupVal[0]['employee_id']]))
									{
										$attendance_count[$groupVal[0]['employee_id']] = 0;
									}
									if($day_count==0)
									{
											$day_count =1;
									}
									$percent = ceil(($attendance_count[$groupVal[0]['employee_id']] / $day_count * 100));
									//$over_time_sum = $sum = 0;
								?>
					</div>
				</div>	
						<?php if(EmployeeHelper::employ_info($groupVal[0]['employee_id'])): ?>

							<div class="attendance-sheet " > 
									
								<div class="attendanc-sheet content emp_id">
									<div class="popup hidden">
										<div class="name">
											<span>Department</span>
											<span><?php echo e($employ_info['department']); ?></span>
										</div>
										<div class="Departments">
											<span>Count</span>

											<span><?php echo e(@$attendance_count[$groupVal[0]['employee_id']]); ?> /<?php echo e($day_count); ?> </span>
										</div>
										
									</div>
									<?php echo e($groupVal[0]['employee_id']); ?> 
								</div>
								<div class="attendanc-sheet content emp_name">
								<?php if(!empty($employ_info['employ_info']['name'])): ?>
									<?php echo e($employ_info['employ_info']['name']); ?>

									
								<?php endif; ?>
								</div>
								
								
								<?php if(!empty($fdate)): ?>
									<?php if(!empty($att_datas[$fdate])): ?>
										<?php if(array_key_exists($att_datas[$fdate]['date'], $holidays)): ?>
												<div class="attendance-sheet column absent-bg-color tooltipped"  data-position="bottom" data-tooltip="<?php echo e($holidays[$j]); ?>" style="background-color: #8A91F0;">H</div>
											<?php else: ?>
												<?php if($att_datas[$fdate]['attendance_status']=='present'): ?>
														<div class="attendance-sheet column present-bg-color">P</div>
												<?php elseif($att_datas[$fdate]['attendance_status']=='absent'): ?>
													<div class="attendance-sheet column absent-bg-color">A</div>
												<?php elseif($att_datas[$fdate]['attendance_status']=='Sunday'): ?>
													<div class="attendance-sheet column sunday">S</div>
												<?php elseif($att_datas[$fdate]['attendance_status']=='leave'): ?>
													<div class="attendance-sheet column sunday">L</div>
												<?php else: ?>
													<div class="attendance-sheet column sunday">o</div>
												<?php endif; ?>
										<?php endif; ?>
									<?php else: ?>

									<div class="attendance-sheet column present-bg-color">--</div>
									<?php endif; ?>
									
								<?php else: ?>
									<?php for($j=$number; $j<=$total_days; $j++): ?>
									<?php if(isset($att_datas[$j]['attendance_status'])): ?>

										<?php if(array_key_exists($att_datas[$j]['date'], $holidays)): ?>
												<div class="attendance-sheet column absent-bg-color tooltipped"  data-position="bottom" data-tooltip="<?php echo e($holidays[$j]); ?>" style="background-color: #8A91F0;">H</div>
											<?php else: ?>
												<?php if($att_datas[$j]['attendance_status']=='present'): ?>
														<div class="attendance-sheet column present-bg-color">P</div>
												<?php elseif($att_datas[$j]['attendance_status']=='absent'): ?>
													<div class="attendance-sheet column absent-bg-color">A</div>
												<?php elseif($att_datas[$j]['attendance_status']=='Sunday'): ?>
													<div class="attendance-sheet column sunday">S</div>
												<?php elseif($att_datas[$j]['attendance_status']=='leave'): ?>
													<div class="attendance-sheet column sunday">L</div>
												<?php else: ?>
													<div class="attendance-sheet column sunday">o</div>
												<?php endif; ?>
										<?php endif; ?>
									<?php else: ?>

									<div class="attendance-sheet column present-bg-color">--</div>
									<?php endif; ?>
									<?php endfor; ?>
								<?php endif; ?>
									<br>
									<div style="clear: both;"></div>
							</div>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>

			</div>
			<?php endif; ?>
			<div style="clear: both;"></div>

			

</div>







