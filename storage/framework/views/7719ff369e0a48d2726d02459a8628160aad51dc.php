<?php $__env->startSection('content'); ?>

<?php echo $__env->make('organization.settings._header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	 <?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('organization.settings._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::model(@$model,['route'=>'save.user.settings','method'=>'POST','files'=>true]); ?>

		<?php echo FormGenerator::GenerateForm('usersetting'); ?>

	<?php echo Form::close(); ?>

	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>