
<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Designations',
	'add_new' => '+ Add Designation'
); 
	$id = "";
	 ?>	

		<?php if(@$data): ?>
			<?php $__currentLoopData = @$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php 
					$newData = $v->name;
					$id = $v->id;
				 ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
				<script type="text/javascript">
				$(window).load(function(){
					document.getElementById('modal-edit').click();
				});
			</script>
		<?php endif; ?>
		<?php 
			@$model = ['name' => @$newData];
			
	 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(@$newData == 'undefined' || @$newData == '' || @$newData == null): ?>
		<?php echo Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>


	<?php endif; ?>
	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add designation','button_title'=>'Save Designation','section'=>'titlesection']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	 <?php echo Form::close(); ?>

	<?php if(@$model): ?>
		<?php echo Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			<input type="hidden" name="id" value="<?php echo e($id); ?>">
			<a href="#modal_edit" style="display: none" id="modal-edit"></a>
			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit designation','button_title'=>'update Designation','section'=>'titlesection']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	<?php endif; ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>