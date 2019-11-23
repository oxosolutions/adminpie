<?php $__env->startSection('content'); ?>
<?php
	$page_title_data = array(
			'show_page_title' => 'yes',
			'show_add_new_button' => 'no',
			'show_navigation' => 'yes',
			'add_new' => '+ Add Feedback',
			'page_title' => 'View Survey  <span>'.get_survey_title(request()->route()->parameters()['form_id']).'</span>',
		); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<?php if(Session::has('sucess')): ?>
		<div class='aione-message aione-message-success'> <?php echo e(Session::get('sucess')); ?></div>
	<?php endif; ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('organization.survey._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php if(!empty($error)): ?>
		<div class="aione-message warning">
            <?php echo e($error); ?>

        </div>

		<?php elseif(!@$permission): ?>
			<div class='aione-message aione-message-error'>Access Denied</div>
		<?php else: ?>
			
				<?php echo FormGenerator::GenerateForm($slug,[],'','org'); ?>

				<input type="hidden" name="form_id" value="<?php echo e($form_id); ?>" >
				<input type="hidden" name="form_slug" value="<?php echo e($slug); ?>" >
			
		<?php endif; ?>

	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>