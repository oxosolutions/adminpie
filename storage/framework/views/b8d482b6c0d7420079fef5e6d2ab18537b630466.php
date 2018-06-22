<?php if(Auth::guard('admin')->check() == true): ?>
	<?php
		$layout = 'admin.layouts.main';
		$route = 'update.custom.map';
	?>
<?php else: ?>
	<?php
		$layout = 'layouts.main';
		$route = 'org.update.custom.map';
	?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Custom Maps',
	'add_new' => '+ Add Custom Map'
);
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::model($model,['route'=>[$route,$model->id]]); ?>

		
			<input type="hidden" name="id" value="<?php echo e($model->id); ?>">
			<input type="hidden" name="type" value="<?php echo e($model->type); ?>">
			<?php echo FormGenerator::GenerateSection('custommapsection'); ?>

			<input type="submit" value="submit">
	<?php echo Form::close(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>