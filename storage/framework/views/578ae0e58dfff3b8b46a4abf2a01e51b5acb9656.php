<?php $__env->startSection('content'); ?>
<?php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Form',
	'add_new' => '+ Add Widget'
	); 
?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<div class="row">
	<div class="aione-card col l12">
		<div class="aione-row"> 
		<?php echo Form::open(['route'=>'save.discussion' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			<?php echo FormGenerator::GenerateForm('aione_form_fields_test',[]); ?>

		<?php echo Form::close(); ?>

		</div>
	</div>
	<div class="aione-card col l12">
		<div class="aione-row"> 
			
		</div>
	</div>
	</div>
	
	
	

	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>