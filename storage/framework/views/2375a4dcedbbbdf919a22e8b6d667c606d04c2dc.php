<?php if(Auth::guard('admin')->check() == true): ?>
  <?php 
        $from = 'admin';
        $layout = 'admin.layouts.main';
   ?>
<?php else: ?>
  <?php 
        $from = 'org';
        $layout = 'layouts.main';
   ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<?php 
    
    $title = $form->form_title;


 ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Form <span>'.$title.'</span>',
  'add_new' => '+ Add Module'
); 
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.formbuilder._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo FormGenerator::GenerateForm($slug,[],'',$from); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
   .subtitle{
                
   
    font-weight: 500;
    display: inline-block;

         }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>