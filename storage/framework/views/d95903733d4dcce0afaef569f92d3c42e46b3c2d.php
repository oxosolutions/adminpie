<?php $__env->startSection('content'); ?>

	<?php echo $__env->make('organization.settings._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo FormGenerator::GenerateSection('leasetsec1',['details'=>'You can change your organization settings like email, title and logo.','title'=>'Settings']); ?>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>