<?php if(!empty($filters)): ?>
<?php if(isset($meta['enable_filters']) && $meta['enable_filters'] == 1): ?>

<!--==============================-->

<div id="aione_sidebar_<?php echo e($visualization_id); ?>" class="aione-box aione-sidebar aione-sidebar-position-<?php echo e($meta['filter_position']); ?>" style="margin-top: 15px;margin-right: 15px">
	<div class="wrapper-row" >

		<div class="chart-filters" >
			
			<div class="filter-title" >
				<center> 
					<h6 style="margin: 0px;font-size: 18px;font-weight: 600;color: grey">Filters <span><a href="javascript:;"><img src="<?php echo e(asset('arrow-down1.png')); ?>" alt=""></a></span></h6>
				</center>
			</div>
			
			<div class="survey-chart-filters hideDiv">
				<form method="POST" action="">
					<?php echo Form::token(); ?>

					<?php 
						$multidrop = 0;
						$singledrop = 0;
						$range = 0;
					 ?>
					<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($value['column_type'] == 'mdropdown'): ?>
							<div class="row">
								<div class="">
									<label><?php echo e(ucfirst($value['column_name'])); ?></label>
									<select name='mdropdown[<?php echo e($multidrop); ?>][<?php echo e($key); ?>][]' class="aione-multi-select" multiple>
										<?php $__currentLoopData = $value['column_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($option); ?>"
											<?php if(isset($value['selected_value']) && in_array($option, $value['selected_value'])): ?>
												selected="selected"
											<?php endif; ?>
											><?php echo e($option); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							<div class="divider"></div>
							<?php 
								$multidrop++;
							 ?>
						<?php endif; ?>
						<?php if($value['column_type'] == 'dropdown'): ?>
							<div class="row">
								<div class="">
									<label><?php echo e(ucfirst($value['column_name'])); ?></label>
									<select name='dropdown[<?php echo e($singledrop); ?>][<?php echo e($key); ?>][]'>
										<option value="">All</option>
										<?php $__currentLoopData = $value['column_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($option); ?>" 
											<?php if(isset($value['selected_value']) && in_array($option, $value['selected_value'])): ?>
												selected="selected"
											<?php endif; ?>
											><?php echo e($option); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
									</select>
								</div>
							</div>
							<div class="divider"></div>
							<?php 
								$singledrop++;
							 ?>
						<?php endif; ?>
						<?php if($value['column_type'] == 'range'): ?>
							<div class="row"">
								<div class="">
									<label style="width: 100%"><?php echo e(ucfirst($value['column_name'])); ?></label>
									<input type="range[]"  name="range[<?php echo e($range); ?>][<?php echo e($key); ?>]" data-slider-min="<?php echo e($value['column_min']); ?>" data-slider-max="<?php echo e($value['column_max']); ?>" data-slider-step="1" data-slider-value="[<?php echo e($value['column_min']); ?>,<?php echo e($value['column_max']); ?>]" class="aione-range-slider" />
								</div>
							</div>
							<?php 
								$range++;
							 ?>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div class="chats-filter-button">
						<button name="downloadData" type="submit" value="downloadData" class="aione-button" style="">Download Data</button>
						<input type="submit" name="applyFilter" style="float: right" class="aione-button" value="Apply Filters" />
					</div>
					
				</form>
			</div>
		</div>


	</div> <!-- wrapper-row -->
</div> <!-- aione_sidebar -->
<?php endif; ?>
<?php endif; ?>
