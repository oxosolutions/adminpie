<?php $__env->startSection('content'); ?>
	
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Leave Category',
	'add_new' => '+ Add Leave Category'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo Form::open(['route'=>'store.leaveCat' , 'class'=> 'form-horizontal','method' => 'post']); ?>


<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Leave Category','button_title'=>'Save Leave','section'=>'leavecatsec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>

<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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