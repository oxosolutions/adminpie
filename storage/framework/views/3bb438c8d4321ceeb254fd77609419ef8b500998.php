<?php $__env->startSection('content'); ?>
	<?php if(@$errors->any()): ?>
		<script type="text/javascript">
			// $(window).load(function(){
			// 	$('.modal').modal('open');
			// 	$('#modal-edit').modal({
			// 		dismissible : true
			// 	});
			// });
			window.onload = function(){
				$('#add_new_model').modal('open');
			}
		</script>
	<?php endif; ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Leave Categories',
	'add_new' => '+ Add Leave Category',
	'route' => 'leave.category.add'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::open(['route'=>'store.leaveCat' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			
		<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Leave Category','button_title'=>'Save Leave','form'=>'leave_categories']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>

	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
		
			postedData['id'] 				= $(this).parents('.shadow').find('.cat_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.token').val();

			$.ajax({
				url:route()+'/leave/category_status',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			
		});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>