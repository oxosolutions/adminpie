<?php $__env->startSection('content'); ?>
<?php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' =>  __('organization/profile.profile_edit_page_title_text'),
	'add_new' => ''
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('organization.my-profile._profile_tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		
	<?php echo Form::model($model,['route'=>['update.profile',$model['id']]], ['class'=> 'form-horizontal','method' => 'post','id'=>'save-user-details']); ?>


			
			<?php echo FormGenerator::GenerateForm('user_registration_form'); ?>

			<?php if($additional_form != null): ?>
				<?php echo FormGenerator::GenerateForm($additional_form,[],null,'org'); ?>

			<?php endif; ?>
			<button type="submit">save</button>
	<?php echo Form::close(); ?>

	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>