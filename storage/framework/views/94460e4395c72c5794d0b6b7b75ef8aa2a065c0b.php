<?php $__env->startSection('content'); ?>
<?php if(Session::has('forgot-error')): ?>
	<div class="row error">
		<span><i class="fa fa-ban"></i></span>
		<?php echo e(Session::get('forgot-error')); ?>

	</div>
<?php endif; ?>
<div class="display-1">
	Forgot Password
</div>
<div class="sub-title">
	Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy.
</div>
<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => 'forgot']); ?>

<div>
	<input type="email" name="email" placeholder="Enter Your Email">
</div>
<div class="row">
	<div class="col l6">
		<a style="line-height: 34px" href="<?php echo e(route('org.login.post')); ?>">Go to Login page</a>
	</div>
	<div class="col l6 right-align">
		<button type="submit">Reset Password</button>	
	</div>
</div>
<?php echo Form::close(); ?>

<div class="copyright">
Copyright &copy; OXO Solutions 2017
</div>





<div style="position: absolute;bottom: 0;left: 0;display: none">
	
	<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => 'forgot']); ?>

		<div class="text-center">
			
			<h5 class="content-group" style="font-size: 26px;font-weight: 900;color: grey;margin-top: 0px">Admin<span style="color: #03A9F4">Pie</span></h5>
		</div>

		<div class="form-group has-feedback has-feedback-left">
			
			<?php echo Form::email('email',null,['class' => 'form-control' , 'placeholder' => 'Email']); ?>

			<?php if(Session::has('forgot-error')): ?>
				<span style="color: red"><?php echo e(Session::get('forgot-error')); ?></span>
				
			<?php endif; ?>
			<div class="form-control-feedback">
				<i class="icon-user text-muted"></i>
			</div>
		</div>
		

		<div class="form-group login-options">
			<div class="row">
				<div class="col-sm-6">
					
				</div>

				<div class="col-sm-6 text-right">
					<a href="<?php echo e(route('org.login.post')); ?>">Go to Login Page</a>
				</div>
			</div>
		</div>

		<div class="form-group">
			
			<?php echo Form::button('Reset Password<i class="icon-arrow-right14 position-right"></i>',['type'=> 'submit','class' => 'btn bg-blue btn-block']); ?>

		</div>

		
	<?php echo Form::close(); ?>

	<div class="footer">
			© 2017, All Right Reserved. <a href="http://oxosolutions.com/" target="_blank"  style="color: white"><span>OXO solutions</span></a>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>