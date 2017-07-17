<?php $__env->startSection('content'); ?>


<div class="row">
	<div class="">
	<?php echo Form::model($model,['route'=>['save.user.profile',$model->id]], ['class'=> 'form-horizontal','method' => 'post','id'=>'save-user-details']); ?>

			
						<?php echo $__env->make('organization.user._form_employee', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

						
						
		<?php echo Form::close(); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>