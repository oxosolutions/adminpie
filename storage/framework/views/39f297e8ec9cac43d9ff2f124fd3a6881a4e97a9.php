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


	


	<?php echo Form::model($model,['route'=>'update.custom.map']); ?>

		
			<input type="hidden" name="id" value="<?php echo e($model->id); ?>">
			<?php echo FormGenerator::GenerateSection('custommapsection'); ?>

			<input type="submit" value="submit">
	<?php echo Form::close(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>