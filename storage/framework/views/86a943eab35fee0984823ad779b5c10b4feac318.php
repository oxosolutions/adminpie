<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'yes',
'show_navigation' => 'yes',
'page_title' => 'Edit Leave Category',
'add_new' => 'All Leave Categories',
'route' => 'leave.categories'
); 

// dump($data, current_organization_user_id());

 ?>
<?php if(Session::has('success')): ?>
	<div class="aione-message success">
		<p> <?php echo e(Session::get('success')); ?></p>
	</div>
<?php endif; ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">
			<input id="token" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
			<?php if(isset($data)): ?>
			<?php 
			// $data = collect($data);
			 ?>
			
					 <?php echo Form::model($data,['route'=>'meta.category' ,	'class'=> 'form-horizontal', 'method' => 'post']); ?>

				<?php else: ?>
	 <?php echo Form::open(['route'=>'meta.category' ,	'class'=> 'form-horizontal', 'method' => 'post']); ?>

			<?php endif; ?>

	<?php echo Form::hidden('id',$data['id']); ?>

		<?php echo FormGenerator::GenerateForm('edit_leave_category_form'); ?>

	</div>
	
	<style type="text/css">
	.radio_button{
		position: inherit!important;
 		opacity: 3!important;
	}
		.aione-setting-field:focus{
			border-bottom: 1px solid #a8a8a8 !important;
			box-shadow: none !important;
		}
		.select-dropdown{
			margin-bottom: 0px !important;
		    border: 1px solid #a8a8a8 !important;
		    
		}
		.select-wrapper input.select-dropdown{
			height: 30px;
	    	line-height: 30px;
		}

		.pv-10{
			padding:10px 0px
		}
		.aione-setting-field:focus{
			border-bottom: 1px solid #a8a8a8 !important;
			box-shadow: none !important;
		}
		textarea{
			border-bottom: 1px solid #a8a8a8 !important;
			box-shadow: none !important;
		}
		.btn{
			background-color: #0288D1;
		}
		.select-dropdown{
			margin-bottom: 0px !important;
		    border: 1px solid #a8a8a8 !important;
		    
		}
		.select-wrapper input.select-dropdown{
			height: 30px;
	    	line-height: 30px;
		}
		.file-path{
			margin-bottom: 0px !important
		}
		.datepicker{
			margin-bottom: 0px !important
		}
		.level{
			margin: 0px !important;
		}
		.green{
			background-color: green;
		}
</style>
<script>
$(document).ready(function(){
$('.hides').hide();
})

$("#include_designation").on('change',function(event){
	des_id = $('#include_designation').val();
	data = {};
	data['des_id'] =	des_id;
	data['_token'] = 	$('#token').val();
	$.ajax({
		url:route()+'/ajax_user_drop_down',
		method:'POST',
		data:data,
		success:function(res){
			$("#user_drop_down").html(res);
		}
	});
});

 function show_option(id){
	$('#'+id).addClass('green');
	if(id =='include_role'){
		$('#exclude_role').removeClass('green');
		$('.exclude_role').hide();
		$("#role_include").attr('name','role_include[]');
		$("#roles_exclude").attr('name','');
		}else if(id=='exclude_role'){
			$("#role_include").attr('name','');
			$("#roles_exclude").attr('name','roles_exclude[]');
			$('#include_role').removeClass('green');
			$('.include_role').hide();
		}
 	if(id =='include_designation'){
 		$('#exclude_designation').removeClass('green');
		$('.exclude_designation').hide();
		$("#designation_exclude").attr('name','');
		$("#designation_include").attr('name','include_designation[]');
		}else if(id=='exclude_designation'){
			$('#include_designation').removeClass('green');
			$('.include_designation').hide();
			$("#designation_exclude").attr('name','exclude_designation[]');
			$("#designation_include").attr('name','');
		}
	if(id =='include_user'){
		$('#exclude_user').removeClass('green');
		$('.exclude_user').hide();
		
		$("#user_exclude").attr('name','');
		$("#user_include").attr('name','user_include[]');
		}else if(id=='exclude_user'){
			$('.include_user').hide();
		$('#include_user').removeClass('green');
		$("#user_exclude").attr('name','user_exclude[]');
		$("#user_include").attr('name','');
		}
	$('.'+id).show();
}
</script>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>