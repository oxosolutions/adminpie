<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => '404 : Page not found',
  'add_new' => ''
); 

  
   ?> 
  <?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
<style type="text/css">
.aione-main h1 {
  font-weight: 600;
  color: white;
  text-shadow: 0 1px 0 #ccc, 
  0 2px 0 #c9c9c9, 
  0 3px 0 #bbb, 
  0 4px 0 #b9b9b9, 
  0 5px 0 #aaa, 
  0 6px 1px rgba(0,0,0,.1), 
  0 0 5px rgba(0,0,0,.1), 
  0 1px 3px rgba(0,0,0,.3), 
  0 3px 5px rgba(0,0,0,.2), 
  0 5px 10px rgba(0,0,0,.25), 
  0 10px 10px rgba(0,0,0,.2), 
  0 20px 20px rgba(0,0,0,.15);
  font-size: 120px

}
.aione-wrapper-error {
    
    margin: 0 auto;
    padding:40px 0px;
    text-align:center;
}
</style>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div id="aione_wrapper" class="aione-wrapper-error">
 
  <div id="aione_main" class="aione-main">
    <h1>404</h1>
    <h2 class="font-weight-300">Page not found</h2>
    </div>
  <div id="aione_footer" class="aione-footer">
    
    </div>
  
</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>