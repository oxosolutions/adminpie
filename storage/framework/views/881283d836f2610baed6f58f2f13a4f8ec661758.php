
<?php $__env->startSection('content'); ?>
	<?php if(@$data): ?>
		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				$model = [
						'name' 	=>	$value->name ,
						'from' 	=>	$value->from ,
						'to'	=>	$value->to,
						'working_days' => json_decode($value->working_days)
					];
			?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<script type="text/javascript">
			window.onload = function(){
				$('#modal_edit').modal('open');
			}
		</script>
	<?php endif; ?>

<?php if(!$errors->isEmpty()): ?>
	<script type="text/javascript">
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
	'page_title' => 'Shifts',
	'add_new' => '+ Add Shift'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::open(['route'=>'store.shifts' , 'class'=> 'form-horizontal','method' => 'post']); ?>

<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Shift','button_title'=>'Save Shift','section'=>'addshiftsec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>

<?php if(@$data): ?>
	<?php echo Form::model($model,['route'=>'edit.shifts' , 'class'=> 'form-horizontal','method' => 'post']); ?>

	<input type="hidden" name="id" value="<?php echo e(@$data[0]->id); ?>">
	<a href="#modal_edit" style="display: none" id="modal-edit"></a>
	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit Shift','button_title'=>'update Shift','section'=>'addshiftsec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo Form::close(); ?>

<?php endif; ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<script type="text/javascript">
	$(document).ready(function(){


		 $('#modal1').modal(); 

		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.shift_name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.shift_from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.shift_to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('.shift_token').val();

			$.ajax({
				url:route()+'/shifts/update',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});
		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.shift_name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.shift_from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.shift_to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.shift_token').val();

			$.ajax({
				url:route()+'/shifts/update',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});
		$('.editable h5 , .editable p').click(function(e){
			e.preventDefault();
			if (e.which == 13) {        
		        e.preventDefault();
		    }
			$(this).addClass('edit-fields');
		});
		$('.fa-close').click(function(){
			location.reload();
		});
	});

		
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>