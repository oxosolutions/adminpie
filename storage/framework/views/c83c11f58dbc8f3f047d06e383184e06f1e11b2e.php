<?php $__env->startSection('content'); ?>
<div class="row " style="margin-bottom: 0px;height: 100vh">
	<div class="col l8 m6 grey lighten-1 left hide-on-small-only" style="padding: 0px">
		
	</div>
	<div class="col l4 m6 s12 login-form" style="">
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
	<div class="row">
		<span class="display-1">Sign in to your account</span>

	</div>
	<div class="sub-title">
		Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy.
	</div>
	<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => 'org.login.post']); ?>

	<div class="row login-fields">
		
		<input type="email" name="email" placeholder="Enter Username">
	</div>
	<div class="row login-fields">
		
		<input type="password" name="password" placeholder="Enter Password">
	</div>
	<div class="row">
		<div class="col l6">
			<p>
				<input type="checkbox" name="remember" class="filled-in" id="filled-in-box" checked="checked" />
				
				<label for="filled-in-box">Remember me</label>
		    </p>
		</div>
		<div class="col l6 forgot-password right-align">
			<a href="<?php echo e(route('forgot.password')); ?>">Forgot Password</a>
		</div>
	</div>
	<div class="row">
		<button type="submit" class="btn blue full-width sign-in" >Sign In</button>	
	</div>
	<?php echo Form::close(); ?>

	<div class="copyright">
		Copyright © <a href="http://oxosolutions.com/" target="_blank"  style="color: #a9b5be"><span>OXO solutions</span></a> 2017
	</div>
	</div>
</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>