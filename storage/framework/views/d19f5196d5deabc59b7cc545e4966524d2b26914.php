<?php if(Auth::guard('admin')->check() == true): ?>
  <?php 
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.custom.save.pages';
   ?>
<?php else: ?>
  <?php 
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'save.page.settings';
   ?>
<?php endif; ?>



<?php $__env->startSection('content'); ?>
	
	
	<?php 
	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Custom Code <span>'.$page->title.'</span>',
	    'add_new' => '+ Add Media'
	); 
	 ?> 
	<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('organization.pages._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		

		<?php echo Form::model($customCode,['route' => $route , 'method' => 'post']); ?>

		<input type="hidden" name="page_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
			<?php echo FormGenerator::GenerateForm('custom_code'); ?>

		<?php echo Form::close(); ?>

	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>