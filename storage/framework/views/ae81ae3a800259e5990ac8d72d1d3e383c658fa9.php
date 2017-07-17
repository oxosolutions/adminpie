<?php $__env->startSection('content'); ?>
<?php 
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Attachments',
    'add_new' => '+ Add Attachment'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<div>
<?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::open(['method' => 'post' , 'route' => 'upload.attachment.project' , 'files' => true]); ?>

	<?php if(request()->route()->parameters()): ?>
	    <input type="hidden" name="project_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">	
	<?php endif; ?>
	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Upload Attachemnt','button_title'=>'upload','section'=>'prosec6']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>			
</div>
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>