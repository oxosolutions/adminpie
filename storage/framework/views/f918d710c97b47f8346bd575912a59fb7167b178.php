<?php 
$data = [];

  $data['visualization_name'] = $model['name'];
  $data['select_dataset'] = $model['dataset_id'];
  $data['description'] = $model['description'];

     ?>

<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Edit Visualization',
  'add_new' => '+ Add Visualization'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   		<?php echo Form::model($data,['route'=>['update.visualization' , $model['id']]]); ?>

        <input type="hidden" name="id" value="<?php echo e($model['id']); ?>">
	    	<?php echo FormGenerator::GenerateSection('vissec1',['type'=>'inset']); ?>	 
        <input type="submit" value="submit">
	    <?php echo Form::close(); ?>

    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>