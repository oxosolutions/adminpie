<?php $__env->startSection('content'); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div> 
	<div class="aione-row" >
		<div class="site-logo" >
		</div>
		<div class="site-title" >
			<?php echo env('GROUP_LOGIN_TITLE'); ?>

		</div>
		<div class="site-tagline" >
			<?php echo env('GROUP_LOGIN_DESCRIPTION'); ?>

		</div>
	<?php if(Session::has('login_fails')): ?>
		<div class="aione-message error">
			<?php echo e(Session::get('login_fails')); ?> 
		</div>
	<?php endif; ?>
	<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => 'group.post']); ?>

	<?php echo FormGenerator::GenerateForm('group_login_form',['type'=>'inset']); ?>

	<?php if(session()->has('csrf_error')): ?>
		<div style="text-align: center; color: red;"><?php echo e(session('csrf_error')); ?></div>
	<?php endif; ?>
	<?php echo Form::close(); ?>


	<div id="aione_footer" class="aione-footer">
		<div class="aione-row">
			<?php echo env('GROUP_LOGIN_COPYRIGHT'); ?>

		</div><!-- .aione-row -->
	</div>

	</div>
	</div> 
</div>
<style type="text/css">
	.login-background{
	    background-image: url(assets/images/bg-pattern.png),linear-gradient(to bottom,#168dc5,#096996);
		background-size: auto,auto;
	    background-repeat: repeat,no-repeat;
	    background-attachment: fixed,scroll;
	}
	.login-wrapper .site-title {
    	font-size: 26px;
    }
    .login-wrapper .site-title span{
    	color:#0f79ab;
    }
    .login-wrapper .site-tagline{
    	font-size: 18px;
    }
</style>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>