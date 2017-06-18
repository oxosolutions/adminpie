<?php $__env->startSection('content'); ?>
	<?php echo FormGenerator::GenerateForm('org_form'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>