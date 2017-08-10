<?php $__env->startSection('content'); ?>
<style type="text/css">
	.login-form{
		    padding: 32px 32px 32px 32px !important;
	}
</style>
<?php if(Session::has('success')): ?>
 <div class="alert alert-info"><?php echo e(Session::get('success')); ?></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
	<?php echo Form::open(['route'=>'signup.user']); ?>

	<div class="row">
		<span class="display-1">Register</span>

	</div>
	<div class="sub-title">
		Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy.
	</div>
	
	<div class="row login-fields">
		
		<input type="text" name="name" placeholder="Name">
	</div>
	<div class="row login-fields">
		
		<input type="email" name="email" placeholder="Username">
	</div>
	<div class="row login-fields">
		
		<input type="password" name="password" placeholder="Password">
	</div>
	<div class="row login-fields">
		
		<input type="password" name="confirm-password" placeholder="Confirm Password">
	</div>
	
	<div class="row">
		<div class="col l7 m7 s6">
			<a style="line-height: 34px" href="<?php echo e(route('org.login.post')); ?>">Go to Login page</a>
		</div>
		<div class="col l5 m5 s6 right-align">
			<button type="submit">Register Now</button>	
		</div>
	</div>
<?php echo Form::close(); ?>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>