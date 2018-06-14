<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Add Widget',
    'add_new' => 'All Widgets',
    'route' => 'list.widgets'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php
$url = url()->current();
?>

<?php if(str_contains($url,'edit')): ?>

    <?php echo Form::model($data,['route' => 'edit.widget']); ?>

    <input type="hidden" name="id" value="<?php echo e($id); ?>">
<?php else: ?>
    <?php echo Form::open(['route' => 'create.widget']); ?>

<?php endif; ?>

    <?php echo FormGenerator::GenerateForm('add_edit_widget_form'); ?>

    
<?php echo Form::close(); ?>



<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>