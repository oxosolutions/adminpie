<?php if(Auth::guard('admin')->check()): ?>
  <?php 
    $layout = 'admin.layouts.main';
    $route = 'create.forms';
   ?>
<?php else: ?>
  <?php 
    $layout = 'layouts.main';
    $route = 'org.create.forms';
   ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<?php 
$title = (@$type == 'form')?'Add New Form':'Add New Survey';
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => $title,
    'add_new' => 'All Forms',
    'route' => 'list.forms'
    
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
    <div class="row">
    <?php echo Form::open([ 'method' => 'POST', 'route' => $route ,'class' => 'form-horizontal']); ?>

    <?php echo FormGenerator::GenerateForm('add_survey_form'); ?>

       
       
        <input type="hidden" name="type" value="<?php echo e(@$type); ?>">
         <?php if(@$errors->has()): ?>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kay => $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="color: red"><?php echo e($err); ?></div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
       
       
     
    <?php echo Form::close(); ?> 
    </div>
    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
    .h-30{
        height: 30px;
    }
    
    .pv-10{
        padding:10px 0px
    }
    .aione-setting-field:focus{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
    textarea{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>