<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col l12">
			<h5>Edit Details</h5>
			<div>
			<?php echo Form::model($page,['route'=>'update.page' ]); ?>

				<?php echo $__env->make('organization.pages._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo Form::close(); ?>

			</div>
		</div>
		
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>