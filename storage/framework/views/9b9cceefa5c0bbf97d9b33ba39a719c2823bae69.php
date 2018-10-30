<div class="aione-accordion">
	<div class="aione-item">
		<div class="aione-item-header">
			<?php echo e($key); ?>

			
		</div>
		<div class="aione-item-content">
			<?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($value->isArray == 'true'): ?>
					<?php
						unset($value->chartType);
						unset($value->isArray);
						$fieldName[] = $key;
					?>
					<?php echo $__env->make('organization.visualization.recursive-chart-settings',['jsonData'=>$value,'key'=>$key,'fieldName'=>$fieldName], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php else: ?>
					<div class="row fields">
						<div class="col-md-12">
							<div class="label">
								<label><strong><?php echo e($value->label); ?></strong></label>
							</div>
							<?php
								$name = '';
								$index = 0;
								foreach($fieldName as $k => $field){
									if($index == 0){
										$name .= 'chart_settings['.$field.']';
									}else{
										$name .= '['.$field.']';
									}
									$index++;
								}
								$name .= '['.$key.']';
							?>
							<?php if($value->type != 'select'): ?>
								<?php echo Form::{$value->type}($name,null); ?>

							<?php else: ?>
								
								<?php echo Form::{$value->type}($name,$value->options,null,['placeholder'=>'Select Value']); ?>

							<?php endif; ?>
						</div>
					</div>
					<hr />
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
		
</div>