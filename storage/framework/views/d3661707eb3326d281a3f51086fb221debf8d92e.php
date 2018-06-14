<?php if(Auth::guard('admin')->check() == true): ?>
  <?php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.category.update';
  ?>
<?php else: ?>
  <?php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'category.update';
  ?>
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Categories <span>'.$modelData->name.'</span>',
);
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo Form::model($modelData,['route'=>[$route,$modelData['id']],'method'=>'POST']); ?>

		<?php echo FormGenerator::GenerateForm('edit_category_form'); ?>

		<input type="hidden" name="id" value="<?php echo e($modelData['id']); ?>">
		<input type="submit" value="submit">
	<?php echo Form::close(); ?>	

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>