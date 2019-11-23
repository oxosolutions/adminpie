<?php if(Auth::guard('admin')->check() == true): ?>
	<?php
		$layout = 'admin.layouts.main';
		$route = 'create.form';
	?>
<?php else: ?>
	<?php
		$layout = 'layouts.main';
		$route = 'org.create.form';
	?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<?php
$title = (@$title != '')?$title:__('forms.form_page_title_text');
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => $title,
	'add_new' => ($title == 'Survey')?__('forms.add_survey_button_text'):__('forms.add_form_button_text'),
	'route' => ($title == 'Survey')?'create.survey':$route,
	'second_button_title' => ($title == 'Survey')?__('forms.import_survey_button_text'):__('forms.import_form_button_text'),
	'second_button_route' => 'import.survey'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>