<?php $__env->startSection('content'); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(Session::has('forgot-error')): ?>
	<div class="row error">
		<span><i class="fa fa-ban"></i></span>
		<?php echo e(Session::get('forgot-error')); ?>

	</div>
<?php endif; ?>

<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => 'forgot']); ?>


	<?php echo FormGenerator::GenerateForm('organization_user_forgot_password_form',['type'=>'inset']); ?>



<?php echo Form::close(); ?>


	<div class="aione-align-center" style="margin: 10px 0 20px 0">
				If you do not have a user account?
				<a class="aione-login-signup-link display-block bold" href="<?php echo e(route('register')); ?>">Signup Here</a>
			</div>
			<div class="aione-align-center">
				Already have a user account?
				<a class="aione-login-signup-link display-block bold" href="/login">Login Here</a>
			</div>
	</div>	

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>