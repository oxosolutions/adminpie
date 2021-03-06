
<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Create Template',
	'add_new' => 'All Templates',
	'route' => 'document.templates'
); 
 ?>	
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(@$model != null || @$model != ""): ?>
	<?php echo Form::model($model ,['route'=>'update.documant.template' , 'class'=> 'form-horizontal','method' => 'post']); ?>

	<input type="hidden" name="id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
<?php else: ?>
	<?php echo Form::open(['route'=>'save.document.template' , 'class'=> 'form-horizontal','method' => 'post']); ?>

<?php endif; ?>
		<?php echo FormGenerator::GenerateForm('document_create_template'); ?>

		<button type="submit" >Save Template</button>
	<?php echo Form::close(); ?>

	<?php if(Session::has('success-update')): ?>
		<script type="text/javascript">Materialize.toast('updated Successfully' , 4000)</script>
	<?php endif; ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>