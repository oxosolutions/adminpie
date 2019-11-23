<?php $__env->startSection('content'); ?>
<?php

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Survey Settings <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Feedback'
); 
?>
<?php if(Auth::guard('admin')->check() == true): ?>
<?php

$route = 'save.form.settings';
?>
<?php else: ?>
<?php

$route = 'org.save.form.settings';
?>
<?php endif; ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.survey._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<style type="text/css">
	
.btn-reset{
	position: relative;
    left: 118px;
    bottom: 95px;
}
	</style>
		<?php if(!@$permission): ?>
		<div class="aione-message warning">
            	<?php echo e(__('survey.survey_with_no_permisson')); ?>

        </div>
		<?php else: ?>
			<div class="survey-settings-wrapper">
				<div class="ar">
					<div class="ac l50 m50 s100">
						<?php echo Form::model($model,['route' => ['save.survey.settings',request()->route()->parameters()['id']], 'class'=> 'form-horizontal','method' => 'post']); ?>

							<?php echo FormGenerator::GenerateForm('Survey_Setting_Form'); ?>

							<input type="submit" class='btn-reset' name="reset" value="Reset" >
						<?php echo Form::close(); ?>		
					</div>
					<div class="ac l50 m50 s100"> 
						<?php echo Form::model(@$model,['route'=>[$route,request()->route()->parameters()['id']]]); ?>

							<?php echo FormGenerator::GenerateForm('form_setting_form',['type'=>'inset']); ?>

							<input type="submit" class="btn-reset"  name="reset" value="Reset" >
						<?php echo Form::close(); ?>

					</div>
				</div>
			</div> <!-- .survey-settings-wrapper -->
		<?php endif; ?>
		
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>