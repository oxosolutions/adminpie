
<?php $__env->startSection('content'); ?>
	<?php if(@$errors->has()): ?>
		<script type="text/javascript">
			$(window).load(function(){
				$('.modal').modal('open');
			});
		</script>
	<?php endif; ?>
	
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Employees',
	'add_new' => '+ Add Employee',
	'second_button_title' => 'Export Employees',
	'second_button_route' => 'export.employee',
	'third_button_title' => 'Import Employees',
	'third_button_route' => 'import.employee'
); 

	 if(check_route_permisson('hrm/employee/save')==false){
	 	$page_title_data['show_add_new_button'] ='no';
	 }
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::open(['route'=>'store.employee' , 'class'=> 'form-horizontal','method' => 'post']); ?>

<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Employee','button_title'=>'Save Employee','section'=>'addempsec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>