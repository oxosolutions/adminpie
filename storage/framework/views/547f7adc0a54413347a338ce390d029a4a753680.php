<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.settings._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::open(['route'=>'save.settings','method'=>'POST']); ?>

		<?php echo FormGenerator::GenerateSection('setsec2',[],$model); ?>

		<input type="hidden" name="key" value="designation">
		<button type="submit" class="btn blue">Save</button>
	<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>