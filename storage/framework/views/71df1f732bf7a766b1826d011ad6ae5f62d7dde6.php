<?php $__env->startSection('content'); ?>


<div class="row">
	<div class="">
	<?php echo Form::open(['route'=>'save.user_meta', 'class'=> 'form-horizontal','method' => 'post','id'=>'save-user-details']); ?>

		<input type="hidden" name="user_id" value="<?php echo e($send_data[0]['user_id']); ?>">
			
						<?php echo $__env->make('organization.user._form_employee', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

						
						
		<?php echo Form::close(); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>