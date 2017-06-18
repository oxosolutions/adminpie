
<?php $__env->startSection('content'); ?>
	<div>
		<div class="row">
		<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col l3 pr-7">
				<div class="card shadow" style="margin-top: 0px;">
					<div class="row center-align aione-widget-header" ><h5 style="margin: 0px"><a href="<?php echo e(route($value['route'])); ?>" style="display: block"><?php echo e(ucfirst($key)); ?></a></h5></div>
					<div class="row center-align aione-widget-content" ><?php echo e($value['count']); ?></div>
					<div class="row center-align aione-widget-footer" >
						<a href="<?php echo e(route($value['route'])); ?>" class="btn" style="background-color: #005A8B">All <?php echo e($key); ?></a>
					</div>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>

	<style type="text/css">
		.aione-widget-header{
			border-bottom: 1px solid #e8e8e8;cursor: pointer;
		}
		.aione-widget-header a{
			padding: 10px;color: black
		}
		.aione-widget-content{
			border-bottom: 1px solid #e8e8e8;padding: 10px;font-size: 72px
		}
		.aione-widget-footer{
			padding: 10px
		}
	</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>