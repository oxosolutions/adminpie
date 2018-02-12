<?php $__env->startSection('content'); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div> 
	<div class="aione-row">
		<div class="site-logo">
		</div>
		<div class="site-title">
			<?php echo env('ADMIN_LOGIN_TITLE'); ?>

		</div>
		<div class="site-tagline">
			<?php echo env('ADMIN_LOGIN_DESCRIPTION'); ?>

		</div>
	<?php if(Session::has('login_fails')): ?>
	<div class="row error">
		<span><i class="fa fa-ban"></i></span>
		<?php echo e(Session::get('login_fails')); ?><a href="">recover your password</a>
	</div>
	<?php endif; ?>
	<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => 'org.login.post']); ?>

	<?php echo FormGenerator::GenerateForm('organization_user_login_form',['type'=>'inset']); ?>

	<?php if(session()->has('csrf_error')): ?>
		<div style="text-align: center; color: red;"><?php echo e(session('csrf_error')); ?></div>
	<?php endif; ?>
	<?php echo Form::close(); ?>


	<div id="aione_footer" class="aione-footer">
		<div class="wrapper">
			<?php echo env('ADMIN_LOGIN_COPYRIGHT'); ?>

		</div><!-- .aione-row -->
	</div>

	</div>
	</div> 
	<style type="text/css">
	.login-wrapper .site-title {
    	font-size: 26px;
    }
    .login-wrapper .site-tagline{
    	font-size: 18px;
    }
</style>
</div> 
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login-v2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>