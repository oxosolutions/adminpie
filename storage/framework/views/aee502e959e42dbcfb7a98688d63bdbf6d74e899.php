<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Define <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <button onclick="window.location.href='<?php echo e(route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'xls'])); ?>'">Export as XLS</button>
    <button onclick="window.location.href='<?php echo e(route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'csv'])); ?>'">Export as CSV</button>
    <button onclick="window.location.href='<?php echo e(route('clone.dataset',request()->route()->parameters()['id'])); ?>'">Clone</button>
    <button>Merge Dataset</button>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>