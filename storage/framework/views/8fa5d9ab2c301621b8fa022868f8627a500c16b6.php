<?php $__env->startSection('content'); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php 
        if($from == 'create_password'){
            $route = 'save.create.password';
        }else{
            $route = 'update.pass';
        }
     ?>
	<?php echo Form::open(['method' => 'POST','class' => 'modal-body','route' => $route]); ?>

        <?php if($from == 'create_password'): ?>
            <h5 class="aione-align-center">Create Password</h5>
        <?php else: ?>
            <h5 class="aione-align-center">Reset Password</h5>
        <?php endif; ?>
		<?php echo FormGenerator::GenerateForm('organization_user_reset_password_form',['type'=>'inset']); ?>

        <?php echo Form::hidden('reset_create_token',request()->token); ?>

	<?php echo Form::close(); ?>	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>