<?php $__env->startSection('content'); ?>


<?php

$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => __('admin.edit_group_page_title').'&nbsp;&nbsp;<span>'.$group_data->name.'</span>',
    'add_new' => '+ Add User'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('admin.group._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php
    $selectedModule = json_decode($group_data->modules);
    $selectedModuleArray = App\Model\Admin\GlobalModule::whereIn('id',$selectedModule)->pluck('id','name');
    $group_data['modules'] = $selectedModuleArray;

    $groupEmail = App\Model\Group\AdminUsers::where('group_id',$group_data->id)->first()->email;
    $group_data['email'] = $groupEmail; 
  ?>

  <?php echo Form::model($group_data, ['route' => ['update.group', $group_data->id]]); ?>

    <?php echo FormGenerator::GenerateForm('edit_group_form'); ?>

  <?php echo Form::close(); ?> 
  <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>