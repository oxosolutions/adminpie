<?php $__env->startSection('content'); ?>
<div class="row">
	<a href="#modal1" class="btn blue">add category</a>
	<?php echo Form::open(['route'=>'save.category','method'=>'POST']); ?>

	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add Category','button_title'=>'Save','section'=>'prosec5']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>	
</div>

<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>