
<?php $__env->startSection('content'); ?>

<!-- <?php $__currentLoopData = $user_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<?php 
		$textData = json_decode($value->text);
	 ?>

	<?php $__currentLoopData = $textData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ky => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo e(dump($val)); ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
	<div class="row">
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row ">
			recent activities
			<?php $__currentLoopData = $user_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row valign-wrapper" style="padding:5px 0px">
					<div class="col l1 blue white-text center-align">
						<div class="row " style="font-size: 16px ;font-weight: 700">
							<?php echo e(date_format($value->created_at , "M")); ?>

						</div>
						<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
							<?php echo e(date_format($value->created_at , "d")); ?>

						</div>
					</div>
					<div class="col l6 pl-7 truncate">
						<?php $__currentLoopData = json_decode($value->text); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($loop->index == 0): ?>
								<?php echo e($val); ?>

							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<div class="col l3 pl-7 truncate">
						<?php $__currentLoopData = json_decode($value->text); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($loop->index == 2): ?>
								<?php echo e($val); ?>

							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<div class="col l2">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text"><?php echo e($value->type); ?></span>
					</div>
					<!-- <div class="col l2">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
					</div> -->
					<div class="col l2 grey-text center-align" style="font-size: 13px">
						2 hour ago
					</div>	
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php echo e($user_log->render()); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>