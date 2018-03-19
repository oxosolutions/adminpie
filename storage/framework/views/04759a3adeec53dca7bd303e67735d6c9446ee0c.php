<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Customize <span>' .get_visualization_title(request()->route()->parameters()['id']). '</span>' ,
  'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.visualization._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    	<?php 
    		if(!@$model->isEmpty()){
    			$model['css_code'] = @$model->where('key','css_code')->first()->value;
    			$model['js_code'] = @$model->where('key','js_code')->first()->value;
    		}
    	 ?>
    	<?php echo Form::model($model,['route'=>['update.customize.visualization',$id]]); ?>

          <?php echo FormGenerator::GenerateForm('custom_code'); ?>

        <?php echo Form::close(); ?>

    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>