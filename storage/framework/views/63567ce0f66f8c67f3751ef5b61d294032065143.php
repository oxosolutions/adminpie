<?php $__env->startSection('content'); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php 
		$userRegStatus = get_organization_meta('enableuserregisteration');
        $forgetPassword = get_organization_meta('enable_forgot_password');
	 ?>
	<?php if(Session::has('login_fails')): ?>
	<div class="row error">
		<span><i class="fa fa-ban"></i></span>
		<?php echo e(Session::get('login_fails')); ?><a href="">recover your password</a> 
	</div>
	<?php endif; ?>
	<?php if(Session::has('password-changed')): ?>
	<div class="row error">
		<span><i class="fa fa-ban"></i></span>
		<?php echo e(Session::get('password-changed')); ?><a href="">recover your password</a> 
	</div>
	<?php endif; ?>
	<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => 'org.login.post']); ?>

			<?php echo Form::hidden('back_to',@request()->backto); ?>

			<?php echo FormGenerator::GenerateForm('organization_user_login_form'); ?>

            <?php if($forgetPassword == 1): ?>
    			<div class="aione-align-center" style="margin: 10px 0 20px 0">
    				Have you forgotten your password? <br>
    				<a class="aione-login-reset-password-link display-block bold" href="<?php echo e(route('forgot.password')); ?>">Reset your password</a>
    			</div>
            <?php endif; ?>
            
			<?php if(@$userRegStatus != 'no'): ?>
				<div class="aione-align-center">
					If you do not have a user account?
					<a class="aione-login-signup-link display-block bold" href="<?php echo e(route('register')); ?>">Signup Here</a>
				</div>
			<?php endif; ?>

			<?php if(session()->has('csrf_error')): ?>
				<div style="text-align: center; color: red;"><?php echo e(session('csrf_error')); ?></div>
			<?php endif; ?>
	<?php echo Form::close(); ?>


		

	</div>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>