<?php  

	//hellooooo
	// $sunday_count =0;
	// $holidays =[];
	// 		if(!empty($holiday_data))
	// 		{
	// 			foreach ($holiday_data as $key => $value) {
	// 			$holidays[$value->day] = $value->title;
	// 			}
	// 		}
		//$emp_group_by = $employee_data->groupBy('employee_id')->toArray();
		//dump($emp_group_by);
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
		 	$postDate = Session::get('date');
		 }
			$month_wise = $dat  = Carbon\Carbon::create($year, $month, $postDate, 0);
		 $mo =	$dat->month;

		 if(!empty($fill_attendance_days)) 
		 {
		 	if(!empty($fweek_no) || !empty($fdate))
		 	{
		 		$total_days = $fill_attendance_days;

		 	}
		 	else{
		 			$total_days = $daysInMonth  =$dat->daysInMonth;

		 	}
		 }else{
		 $total_days = $daysInMonth  =$dat->daysInMonth;
		}
//dump($fweek_no);

//previous days		 
		$dat->subDay();
		$pre_date = $dat->day;
		$pre_month = $dat->month;
		$pre_year = $dat->year;
//next days 
		$dat->addDays(2);
		$nxt_date = $dat->day;
		$nxt_date_month = $dat->month;
		$nxt_date_year = $dat->year;
//week 
// echo $dat->subWeek();
		$pre_week = $dat->weekOfMonth;
		//dump($dat->addWeek());
		$pre_week_month = $dat->month;
		$pre_week_year = $dat->year;

		 $current_month =	$dat->month;
		 $current_year =	$dat->year;

		 $current_days = $dat->daysInMonth;
		
		if(!empty($fweek_no))
		{
			$dat->addWeek(); 
			$nxt_week = $dat->weekOfMonth;
			$nxt_week_month =	$dat->month;
			$nxt_week_year =	$dat->year;
			$dat->subWeeks(2); 

			$prev_month = $dat->weekOfMonth;
			$prev_week_month =	$dat->month;
		 	$prev_week_year =	$dat->year;
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

<?php if($total_days==28): ?>
	<style type="text/css"> 
		.column
		{
			width: 2.85% !important;
		}
	</style>
<?php endif; ?>
<?php if($total_days==31): ?>
	<style type="text/css"> 
		.column
		{
			width: 2.58% !important;
		}
	</style>
<?php endif; ?>


	
<div id="projectss" class="projects list-view">
			<div class="row ">
				<div class="col s12 m12 l6 " >
					<ul class="class-list" style="margin: 0px;margin-top: 4px">
						<li style="display: inline-block;"><a style="margin-top: 0px" onclick="attendance_filter(null, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )"  class="btn monthly">Monthly</a></li>
						
						<li style="display: inline-block;"><a onclick="attendance_filter(null, 1, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )"   style="margin-top: 0px"  class="btn weekly">Weekly</a></li>

						<li style="display: inline-block;"><a onclick="attendance_filter(1, null, <?php echo e($current_month); ?> , <?php echo e($current_year); ?> )" style="margin-top: 0px" class="btn daily" >Daily</a></li>
					</ul>
				</div>

				
			</div>
		</div>

<div class="row">

			<h5 class="text-center"></h5>
</div>


<div id="month">

					
			<div class="row design-bg valign-wrapper">
				<div class="row col s4">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
					 	<div class="left-align">
					 		<i class="fa fa-angle-left"></i>
							<a class="nav left-align" style="cursor:pointer;" onclick="attendance_filter(null, null, <?php echo e($previousMonth); ?> , <?php echo e($previousYear); ?> )">Previous Month</a>
						</div>
				</div>
				<div class="aione aione-heading center-align">
					<div class="row">
						<div class=" col s3">
						lock 
						<div class="switch">
									    <label>
											
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
						<div class="col s3 pr-7 right-align">
							<select  onchange="attendance_filter(null, null, <?php echo e($current_month); ?>, this.value )" >
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
							<select  onchange="attendance_filter(null, null, this.value, <?php echo e($current_year); ?> )" >
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
							
						</div>
					</div>
					<style type="text/css">
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
					</style>
					
						

						
						
				</div>
				<div class="row col s4" style="text-align: right;">
					<div class="right-align">
						<a onclick="attendance_filter(null, null, <?php echo e($nextMonth); ?> , <?php echo e($nextYear); ?> )" style="cursor:pointer;" class="nav right-align">Next Month</a>
						<i class="fa fa-angle-right"></i>
					</div>	 
				</div>
				<div style="clear:both;">
				</div>
		  	</div>
</div> 

<div id="week">
			<div class="row design-bg valign-wrapper">
				<div class="row col s4">
					<?php   
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					  ?>
					<div class="col 14">	
						<i class="fa fa-angle-left"></i>		
						<a onclick="attendance_filter(null, 1, <?php echo e($mo); ?> , <?php echo e($previousYear); ?> )" style="cursor:pointer;" class="nav left-align">Previous Week</a>
					</div>
				</div>
				<div class="aione aione-heading center-align">
					<span class="design-style"><?php echo e(date('W ,F, Y', strtotime($dt))); ?></span>
				</div>
				<div class="row col s4">
					<div class="right-align">
						<a onclick="attendance_filter(null, 2, <?php echo e($mo); ?> , <?php echo e($previousYear); ?> )" style="cursor:pointer;" class="nav right-align">Next Week</a>
						<i class="fa fa-angle-right"></i>
					</div>
				</div>	
				<div style="clear:both;">
				</div>
		  	</div>
		  	<div class="aione-navigation">
								<?php for($w=1; $w <=$week; $w++): ?>
								<a href="javascript:void(0)" onclick="attendance_filter(null, <?php echo e($w); ?>, <?php echo e($mo); ?> , <?php echo e($previousYear); ?> )" name="week" > <?php echo e($w); ?></a>
								<?php endfor; ?>
			</div> 
</div> 

<div id="days">
			<div class="row design-bg valign-wrapper">
				<div class="row col s4">
					<?php  
					 $dt = '1-'.$month.'-'.$year;
					// 		$ym = date('Y-m', strtotime($dt));
					 ?>
					 	<i class="fa fa-angle-left"></i>
						<a onclick="attendance_filter(<?php echo e($pre_date); ?>, null, <?php echo e($pre_month); ?> , <?php echo e($pre_year); ?> )" style="cursor: pointer;" name="date" value="<?php echo e($pre_date); ?>" class="nav left-align">Previous Day</a>
				</div>
				<div class="aione aione-heading center-align">
					<span class="design-style"><?php echo e(date('F, Y', strtotime($dt))); ?></span>
				</div>
				<div class="row col s4">
					<div class="right-align">
						<a onclick="attendance_filter(<?php echo e($nxt_date); ?>, null, <?php echo e($nxt_date_month); ?> , <?php echo e($nxt_date_year); ?> )" style="cursor: pointer" name="date" value="<?php echo e($nxt_date); ?>" class="nav right-align">Next Day</a>
						<i class="fa fa-angle-right"></i>
					</div>
				</div>	 
				<div style="clear: both;">
				</div>
		  	</div>
		  	<div id="dates" class="aione-navigation">
								<?php for($i=1; $i<=$current_days; $i++): ?>

								<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter(<?php echo e($i); ?>, null, <?php echo e($mo); ?> , <?php echo e($previousYear); ?> )" name="date"  > <?php echo e($i); ?></a>
								<?php endfor; ?>
			</div>
</div> 		

<div id="attendance_sheet_container" class="table-responsive">
			<?php if(!empty($error)): ?>
			
			<div class="attendance-sheet row">
					<div class="attendance-sheet row">
						<div class="attendanc-sheet content">
							Employee
						</div>
						<div class="attendanc-sheet content">
							<div class="attendanc-sheet content">Name</div>
						</div>
						<div>
								<?php for($d=1; $d<=$total_days; $d++): ?>
								<?php  
								$getDay = Carbon\Carbon::create($year, $month, $d, 0);
								if($getDay->format('l')=="Sunday")
								{
									$td .="<div class='attendance-sheet column sunday'>S</div>";
								}else
								{
									$td .="<div class='attendance-sheet column'> - </div>";
								}
								 ?>
									<div class="attendance-sheet column"><?php echo e($d); ?><br> 
									<?php echo e(substr($getDay->format('l'),0,1)); ?> 
									</div>
								<?php endfor; ?>

						</div>
						<div style="clear:both;">
						</div>
					</div>
					
						<?php $__currentLoopData = $employee_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empKey => $empVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
						$employ_info = EmployeeHelper::employ_info($empVal['employee_id']); 

						 ?>
						<div class="attendance-sheet row">
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
			<div class="attendance-sheet row">
				<div class="attendance-sheet">
					<div class="attendance-sheet row">
						<div class="attendanc-sheet content">Employee</div>
						<div class="attendanc-sheet content">Name</div>
						
						
						

						<?php if(!empty($fweek_no) || !empty($fdate)): ?>
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
										$td .="<div  class='attendance-sheet column sunday'>S</div>";
									}else
									{
										$td .="<div class='attendance-sheet column'> - </div>";
									}
								}
								 ?>
							<div class="attendance-sheet column"><?php echo e($d); ?><br> 
							<?php echo e(substr($getDay->format('l'),0,1)); ?> 
							</div>
							<?php endfor; ?>
						<?php endif; ?>
					</div>
				</div>in
			</div>

			
			<div class="attendance-sheet row">
				<div class="attendance-sheet row">
					<div class="attendanc-sheet content">
					<?php if(!empty($attendance_data)): ?>

						<?php $__currentLoopData = $attendance_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupkey => $groupVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<?php 
								$collect = collect($groupVal);
							 $att_datas =$collect->keyBy('date')->toArray();

								
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

							<div class="attendance-sheet row" > 
									
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
								
									

									<?php for($j=1; $j<=$total_days; $j++): ?>
									<?php if(isset($att_datas[$j]['attendance_status'])): ?>

										<?php if(array_key_exists($att_datas[$j]['date'], $holidays)): ?>
												<div class="attendance-sheet column absent-bg-color"><?php echo e($holidays[$j]); ?></div>
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






