<?php $__env->startSection('content'); ?>
	
<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => ['login.post']]); ?>


<div class="" style="">
	<div class="container-body">
		<div class="form">
		
		<h1 class="center white">Login to your account <small class="display-block">Your credentials</small></h1>
				
			<div class="has-feedback<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
				<?php echo Form::email('email',null,['class' => 'form-control' , 'placeholder' => 'Username']); ?>			
				<?php if($errors->has('email')): ?>
		            <span class="help-block">
		                <strong><?php echo e($errors->first('email')); ?></strong>
			        </span>
		        <?php endif; ?>
			</div>
			<div class="has-feedback<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
				<?php echo Form::password('password',['class' => 'form-control' , 'placeholder' => 'Password']); ?>			
				<?php if($errors->has('email')): ?>
		            <span class="help-block">
		                <strong><?php echo e($errors->first('email')); ?></strong>
			        </span>
		        <?php endif; ?>
			</div>
				
				
				<?php echo Form::button('Let me Signin...<i class="icon-arrow-right14 position-right"></i>',['type'=> 'submit','class' => 'btn bg-blue btn-block submit']); ?>

				
		</div>
	</div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<style type="text/css">
	input{
		background-color: #D1D2EA;
		padding: 10px;
		border:none;
		color: #292A3C;
		width: 300px;
		margin-top:10px !important;
		font-size: 16px;
	}
	.form{
		width: 320px;
	}
	.center{
		text-align: center;
	}
	.white{
		color: white;
	}
	.submit{
		background-color: #609EDA;
		width: 320px;
		font-size: 16px;
		color: white;
		margin-top: 10px !important
	}
	.form{
		margin: 0px auto;
	}
	.login-container .page-container .login-form {
	    width: 400px !important;
	}
	.login-cover{
		background:url(<?php echo e(asset('images/new-york-background.jpg')); ?>) !important;
		background-size:100% !important;
		background-repeat: no-repeat !important;
	}
	.panel{
		background-color: transparent !important;
		border:0px !important;
	}
	.form h1{
		font-size: 30px;
		font-family: Lucida Sans Unicode;
	}
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>