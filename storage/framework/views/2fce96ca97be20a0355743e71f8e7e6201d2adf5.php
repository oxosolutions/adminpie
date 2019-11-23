<?php $__env->startSection('content'); ?>
<style type="text/css">
	#card-alert{
		position: absolute;
	    top: 10px;
	    width: 98%;
	}
	#card-alert i{
		float: right;
		cursor: pointer
	}
</style>
<?php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Users',
	'add_new' => '+ Add User',
	'route' => 'create.user'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-- <div id="card-alert" class="card green lighten-5"><div class="card-content green-text">Password Change Successfully<i class="material-icons dp48">clear</i></div></div> -->
<?php if($errors->any()): ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#add_new_model').modal('open');
		});
	</script>
<?php endif; ?>



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
		$(document).on('click','#card-alert i',function(){
			$('#card-alert').remove();
		});
	});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>