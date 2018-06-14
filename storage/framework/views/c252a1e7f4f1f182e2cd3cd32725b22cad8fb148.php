<?php $__env->startSection('content'); ?>
		<div>
		<h1>Opening list</h1>
	<div>
		<?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<h3><?php echo e($value['title']); ?></h3><a href="<?php echo e(route('apply',['id'=>$value['id'] ])); ?>"> Apply</a>

			 <ul>
			<?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
			<?php if(!is_array($val) && !empty($val)): ?>
				<li><label style="width:250px;display: inline-block;"><?php echo e(str_replace('_',' ', $title)); ?></label><span ><?php echo e($val); ?></span></li>
			<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
				<?php if(!empty($value['opening_meta'])): ?>
					<ul>			
						<?php $__currentLoopData = $value['opening_meta']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metaKey => $metaValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><label style="width:250px;display: inline-block;"><?php echo e($metaValue['key']); ?></label><span ><?php echo e($metaValue['value']); ?></span></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				<?php endif; ?> 
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
	</div>


		</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>