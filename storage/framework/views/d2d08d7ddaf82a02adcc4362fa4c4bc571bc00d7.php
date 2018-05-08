<?php $__env->startSection('content'); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
		
	<?php 
		$userRegStatus = get_organization_meta('enableuserregisteration');
	 ?>
	
		<?php if($errors->any()): ?>
		    <div class="aione-message error">
		        <ul class="aione-messages">
		            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <li><?php echo e($error); ?></li>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		        </ul>
		    </div>
		<?php endif; ?>
		<?php if(@$userRegStatus != 'no'): ?>
			<?php echo Form::open(['route'=>'signup.user']); ?>

				<?php echo FormGenerator::GenerateSection('organization_user_registration_form_section_1',['type'=>'inset']); ?>

				<?php if(@$form_slug != '' && $form_slug != null): ?>
					<?php echo FormGenerator::GenerateForm($form_slug,['type'=>'inset'],[],'org'); ?>

				<?php endif; ?>

				<?php if($settings->where('key' ,'user_role_default') != '' && !$settings->where('key' ,'user_role_default')->isEmpty()): ?>
					<?php if( $settings->where('key' ,'user_role_default')->first()->value != null): ?>
						<input type="hidden" name="role" value="<?php echo e($settings->where('key' ,'user_role_default')->first()->value); ?>">
					<?php else: ?>
						<input type="hidden" name="role" value="2">
					<?php endif; ?>
				<?php endif; ?>

			<button type="submit">Register1</button>
			<?php echo Form::close(); ?>

		<?php else: ?>
			<div class="aione-border font-size-20 aione-align-center mv-100" style="padding: 20px;">
				<?php echo e(__('auth.registration_disabled')); ?>

			</div>
		<?php endif; ?>
		<div class="aione-align-center" style="margin: 10px 0 20px 0">
			Have you forgotten your password? <br>
			<a class="aione-login-reset-password-link display-block bold" href="<?php echo e(route('forgot.password')); ?>">Reset your password</a>
		</div>
		<div class="aione-align-center">
			Already have a user account?
			<a class="aione-login-signup-link display-block bold" href="/login">Login Here</a>
		</div>
	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>