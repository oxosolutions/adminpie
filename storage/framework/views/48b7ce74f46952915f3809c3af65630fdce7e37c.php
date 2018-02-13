<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Add Organization',
  'add_new' => 'All Organizations',
  'route' => 'list.groupOrganizations'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
        <?php echo Form::open([ 'method' => 'POST', 'route' => 'save.groupOrganization' ,'class' => 'form-horizontal']); ?>

            <input type="hidden" name="group_id" value="<?php echo e(Auth::guard('group')->user()->group_id); ?>">
            <?php echo FormGenerator::GenerateForm('create_organization_form'); ?>               
        <?php echo Form::close(); ?>      
    
      <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('group.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>