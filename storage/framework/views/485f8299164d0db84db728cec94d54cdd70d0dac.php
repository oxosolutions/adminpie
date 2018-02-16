
<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Products',
	'add_new' => 'All Product',
	'route' => 'list.products'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php echo Form::open(['route'=>'save.product' , 'class'=> 'form-horizontal','method' => 'post']); ?>

	<?php echo FormGenerator::GenerateForm('create_product_form'); ?>

<?php echo Form::close(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>