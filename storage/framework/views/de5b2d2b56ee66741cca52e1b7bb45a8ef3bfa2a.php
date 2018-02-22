<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Orders',
    'add_new' => '+ Add New Organization'

); 
 ?>
<style type="text/css">
	#aione_form_wrapper_292{
		width: 91%;
		float: left;
	}
</style>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::open(['method' => 'get']); ?>

	<div>
		<div class="organization-wise-order">
			<?php echo FormGenerator::GenerateForm('organization_wise_order'); ?>

			<button style="padding: 7px 26px 9px 24px;"><i class="fa fa-search"></i></button>
		</div>
	</div>
<?php echo Form::close(); ?>

    <?php if(!empty($showColumns)): ?>
    	<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
	    
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>