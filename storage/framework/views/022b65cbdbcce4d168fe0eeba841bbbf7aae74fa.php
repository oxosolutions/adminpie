



<?php 

	$end_date = $filter['month_week_no'] * 7;
	$start_date = $end_date - 6;
	$dt = Carbon\Carbon::create($filter['year'], $filter['month'], $start_date);
	$dt->weekOfMonth;

	$dt->subWeek();

	$pre_yr = $dt->year;
	$pre_mo = $dt->month;
	$pre_week = $dt->weekOfMonth;

	$dt->addWeeks(2);
	$nxt_yr = $dt->year;
	$nxt_mo = $dt->month;
	$nxt_week = $dt->weekOfMonth;

	//dump($start_date);
	//dump($end_date);
 ?>
<div class="row center-align" style="margin-top: 40px">
							<span onclick="attendance_weekly_filter(<?php echo e($pre_week); ?>, <?php echo e($pre_mo); ?>, <?php echo e($pre_yr); ?>)"><i class="fa fa-arrow-left" style="margin-right: 10px;line-height: 36px"></i></span>
							<span><?php echo e($start_date); ?>-<?php echo e($filter['month']); ?>-<?php echo e($filter['year']); ?> - <?php echo e($end_date); ?>-<?php echo e($filter['month']); ?>-<?php echo e($filter['year']); ?></span>
							<span onclick="attendance_weekly_filter(<?php echo e($nxt_week); ?>, <?php echo e($nxt_mo); ?>, <?php echo e($nxt_yr); ?>)"><i class="fa fa-arrow-right" style="margin-left: 10px"></i></span>
							<span><a href="" class="btn-flat" style="position: absolute;right: 0px;border: 1px solid #e8e8e8;margin-right: 14px;">Check In</a></span>
						</div>
						<div class="row" >
						<?php for($i=$start_date; $i<=$end_date; $i++): ?>
							<?php if(isset($attendance_data[$i])): ?>
								<div class="row center-align" style="padding:10px ">
									<div class="col l2">
										<?php echo e($attendance_data[$i]['day']); ?>,<?php echo e($attendance_data[$i]['date']); ?>

									</div>
									
										<?php if($attendance_data[$i]['attendance_status']=='present'): ?>
											<div class="col l8 present">
												<div class="aione-line-bg">
													<span class="absence-status">Present</span>	
												</div>
											</div>
											<?php elseif($attendance_data[$i]['attendance_status']=='absent'): ?>
												<div class="col l8">
													<div class="aione-line-bg">
														<span class="absence-status">Absent</span>	
													</div>
												</div>
											<?php elseif($attendance_data[$i]['attendance_status']=='Sunday'): ?>
												<div class="col l8 weekend">
													<div class="aione-line-bg">
														<span class="absence-status">Weekend</span>	
													</div>
												</div>
											<?php elseif($attendance_data[$i]['attendance_status']=='leave'): ?>
												<div class="col l8 weekend">
													<div class="aione-line-bg">
														<span class="absence-status">leave</span>	
													</div>
												</div>	
											<?php else: ?>
												<div class="col l8 weekend">
													<div class="aione-line-bg">
														<span class="absence-status">--</span>	
													</div>
												</div>	
											<?php endif; ?>
											
									
									<div class="col l2">
										<?php echo e($attendance_data[$i]['total_hour']); ?>

									</div>
								</div>
							<?php endif; ?>
						<?php endfor; ?>
							
						</div>