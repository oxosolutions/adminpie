<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'no',
    'page_title' => __('survey.create_survey_page_title_text'),
    'add_new' => __('survey.all_surveys_button_text'),
    'route' => 'list.survey'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
    <div id="add_survey_form" class="add-survey-form">
    <?php echo Form::open([ 'method' => 'POST', 'route' => 'save.survey' ,'class' => 'form-horizontal']); ?>

    <?php echo FormGenerator::GenerateForm('add_survey_form'); ?>

        <input type="hidden" name="type" value="<?php echo e(@$type); ?>">
         <?php if(!$errors->isEmpty()): ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>