
<?php $__env->startSection('content'); ?>
<?php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => __('organization/hrm.departments_list_page_title'),
	'add_new' => __('organization/hrm.department_list_page_add_department_button')
); 
?>
	<?php if(!$errors->isEmpty()): ?>
		<script type="text/javascript">
			window.onload = function(){
				$('#add_new_model').modal('open');
			}
		</script>
	<?php endif; ?>
	<?php if(@$data): ?>
		<?php $__currentLoopData = @$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				$model = ['name' => $value['name']];
			?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<script type="text/javascript">
			window.onload = function(){
				$('#modal_edit').modal('open');
			}
			// $(document).ready(function(){
			// 	console.log('hello 2');
			// 	document.getElementById('modal-edit').click();
			// 	console.log('hello 3');
			// });
		</script>
		
	<?php endif; ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::open(['route'=>'store.department' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			

		<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>__('organization/hrm.model_title_add_department'),'button_title'=>__('organization/hrm.save_department_btn'),'section'=>'adddepartment']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

		<?php if(@$model): ?>
			<?php echo Form::model($model ,['route'=>'edit.department' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			<input type="hidden" name="id" value="<?php echo e($data[0]['id']); ?>">
			
			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>__('organization/hrm.model_title_edit_department'),'button_title'=>__('organization/hrm.update_department_btn'),'section'=>'adddepartment']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

		<?php endif; ?>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 	 = $(this).parents('.shadow').find('.name').text();
			postedData['id'] 	 = $(this).parents('.shadow').find('.id').val();
			postedData['status'] = $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] = $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/department/update',
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
			postedData['name'] 	 = $(this).parents('.shadow').find('.name').text();
			postedData['id'] 	 = $(this).parents('.shadow').find('.id').val();
			postedData['status'] = $(this).prop('checked');
			postedData['_token'] = $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/department/update',
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
	});	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>