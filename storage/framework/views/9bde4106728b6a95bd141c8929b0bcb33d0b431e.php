<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Users',
	'add_new' => '+ Add User'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::open(['method' => 'POST','class' => '','route' => 'store.user']); ?>

	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add new user','button_title'=>'Save User','section'=>'usesec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>


<?php echo Form::open(['method' => 'POST','class' => '','route' => 'change.pass']); ?>

	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'change_password','heading'=>'Change Password','button_title'=>'Save ','section'=>'changepasssec2']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>


<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(Session::has('exist_email')): ?>
	<script type="text/javascript">
		$(document).ready(function(){
			Materialize.toast('Email already in use ',4000);
		});
	</script>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.change_password',function(){
			var user_id = $(this).attr('id');
			var data = '<input type="hidden" name="user_id" value="'+user_id+'">';
			$('#change_password').append(data);
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>