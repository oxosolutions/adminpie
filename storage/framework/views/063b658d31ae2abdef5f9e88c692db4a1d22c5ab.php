
<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Create Project',
	// 'add_new' => '+ Add New Team' 
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(@$data): ?>
		<?php echo Form::model(@$data,['route'=>'update.project', 'class'=> 'form-horizontal','method' => 'post']); ?> 
			<input type="hidden" name="id" value="<?php echo e($id); ?>">
	<?php else: ?>	
		<?php echo Form::open(['route'=>'save.project', 'class'=> 'form-horizontal','method' => 'post']); ?>

	<?php endif; ?>
		<?php echo FormGenerator::GenerateForm('addproject'); ?>


			
	<?php echo Form::close(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
	 $('.chips').material_chip();
 
  $('.chips-placeholder').material_chip({
    placeholder: 'Enter a tag',
    secondaryPlaceholder: '+Tag',
  });
      
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>