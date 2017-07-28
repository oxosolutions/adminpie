<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Email Template',
	'add_new' => '+ Add Department'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row">
			<div class="col l6 pr-7">
				<?php echo Form::select('language',['EN'=>'EN','FR'=>'FR'],NULL,['class'=>'browser-default','placeholder'=>'select Language']); ?>	
			</div>
			<div class="col l6 pl-7">
				<div class="col s12 m2 l12 aione-field-wrapper">
					 <?php echo Form::text('slug',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Slug']); ?>

				</div>
			</div>
			<div class="col l12">
				<textarea style="height: 400px" autocomplete="off" id="text" name="text" class="markdown-textarea"></textarea>
			</div>
		</div>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>