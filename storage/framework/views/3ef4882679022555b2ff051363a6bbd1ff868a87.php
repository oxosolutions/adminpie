
<?php $__env->startSection('content'); ?>
<?php

	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Edit User',
	    'add_new' => '+ Add Designation'
	);

?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
		<?php
			$roleModel = 'App\\Model\\Admin\\GlobalUsersRole';
			$role = $roleModel::where('id',$plugins["model"]->role_id)->pluck('id','role_name');
			$plugins['model']->role_id = $role;
		?>
		<?php echo Form::model($plugins['model'],['route' => ['admin.user.edit' , $plugins["model"]->id ] , 'type' =>'post']); ?>


			<?php echo FormGenerator::GenerateForm('admin_edit_user_form'); ?>

			<div class="row">
				<div class="col l12">
					<button class="" type="submit">Update</button>
				</div>
			</div>
		<?php echo Form::close(); ?>

	
	<style type="text/css">
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.input-field{
		margin-top: 0px
	}
	</style>


<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>