<?php if(Auth::guard('admin')->check() == true): ?>
  <?php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.category.save';
  ?>
<?php else: ?>
  <?php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'category.save';
  ?>
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Categories',
	'add_new' => '+ Add Category'
);
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<?php echo Form::open(['route'=>$route,'method'=>'POST']); ?>

	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Category','button_title'=>'Save','form'=>'add_category_form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo Form::close(); ?>	

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>