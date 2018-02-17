<?php 
	$postDate = 01;
	if(!empty(Session::get('date')))
	{
	 	$fdate = $postDate = Session::get('date');
	}
	$MO_data = ['01'=>'JAN', '02'=>'FEB', '03'=>'MAR', '04'=>'APR' ,'05'=>'MAY', '06'=>'JUN','07'=>'JUL', '08'=>'AUG','09'=>'SEP', '10'=>'OCT','11'=>'NOV', '12'=>'DEC'];
	$year_data = range(2015, 2050);
 ?>
<div class="row design-bg valign-wrapper p-10 bg-grey bg-lighten-3">
	<div class=" col s2">
	 	<div class="left-align">
			<a class="nav left-align nav-past" onclick="attendance_filter(null, null, <?php echo e($previous_month); ?> , <?php echo e($previous_year); ?> )">Previous Month</a>
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
						<?php if(intval($current_year)==$val): ?>
							<option selected="selected" value="<?php echo e($val); ?>"><?php echo e($val); ?> </option>
						<?php else: ?>
								<option value="<?php echo e($val); ?>"><?php echo e($val); ?> </option>
							<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
				<div class="col s3 pl-7">
					<select class="browser-default"  onchange="attendance_filter(null, null, this.value, <?php echo e(intval($current_year)); ?> )" >
						<?php $__currentLoopData = $MO_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($current_month==$key): ?>
								<option selected="selected" value="<?php echo e($key); ?>"><?php echo e($val); ?> </option>
							<?php else: ?>
								<option value="<?php echo e($key); ?>"><?php echo e($val); ?> </option>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
				
			</div>
		</div>
	</div>
	<div class=" col s2" style="text-align: right;">
		<div class="right-align">
			<a onclick="attendance_filter(null, null, <?php echo e($next_month); ?> , <?php echo e($next_year); ?> )" style="cursor:pointer;" class="nav right-align nav-future">Next Month</a>
		</div>	 
	</div>
		
	<div style="clear:both;">
	</div>
</div>
<script type="text/javascript">
	$('.month-tab').addClass('active').siblings().removeClass('active');
</script>