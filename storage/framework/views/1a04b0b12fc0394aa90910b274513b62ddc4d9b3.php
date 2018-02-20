<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Create Template',
	'add_new' => '+ Add Email'
); 
 ?>	
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(@$model != null || @$model != ""): ?>
		<?php echo Form::model($model ,['route'=>'update.template' , 'class'=> 'form-horizontal','method' => 'post','files' => true]); ?>

		<input type="hidden" name="id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
	<?php else: ?>
		<?php echo Form::open(['route'=>'save.template' , 'class'=> 'form-horizontal','method' => 'post','files' => true]); ?>

	<?php endif; ?>
		<?php echo FormGenerator::GenerateForm('email-template'); ?>

		<?php if(@$model != null): ?>
			<?php $__currentLoopData = $model->templateMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($v->value != ''): ?> 
					<?php 
						$exploded = explode('.',$v->value);
					 ?>
					<?php if(@$exploded[1] == 'png' || @$exploded[1] == 'jpg' || @$exploded[1] == 'jpeg'): ?>
						<img src="<?php echo e(asset('/files/organization_'.get_organization_id().'/emailAttachments/'.$v->value)); ?>" width="10%">
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
		<?php echo Form::file('attachment[]',['multiple'=>'multiple']); ?>

		<button type="submit">Save</button>
	<?php echo Form::close(); ?>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>