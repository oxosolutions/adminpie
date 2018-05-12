<?php $__env->startSection('content'); ?>
	<?php if(@$errors->has() || Session::has('date_error')): ?>
		<script type="text/javascript">
			window.onload = function(){
				$('#add_new_model').modal('open');
			}
		</script>
	<?php endif; ?>
<?php if(@$data): ?>
	<?php $__currentLoopData = @$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kay => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php 
			$model = [
						'title'			=>		$value->title,
						'description'	=>		$value->description,
						'date_of_holiday'=>		$value->date_of_holiday
					];
		 ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<script type="text/javascript">
		window.onload = function(){
			$('#modal_edit').modal('open');
		}
	</script>
<?php endif; ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Holidays',
	'add_new' => '+ Add Holiday'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 	
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo Form::open(['route'=>'store.holiday' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add New Holiday','button_title'=>'Save Holiday','form'=>'holiday-add-edit']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

		<?php if(@$data): ?>
			<?php echo Form::model($model , ['route'=>'edit.holiday' , 'class'=> 'form-horizontal','method' => 'post']); ?>

				<input type="hidden" name="id" value="<?php echo e(@$data[0]->id); ?>">
				<a href="#modal_edit" style="display: none" id="modal-edit"></a>
				<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit Holiday','button_title'=>'update Holiday','section'=>'holidayadd']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo Form::close(); ?>

		<?php endif; ?>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style type="text/css">
	
.picker__day--infocus {
    padding: 8px 0 !important;
}
.picker--focused .picker__day--selected, .picker__day--selected{
	border-radius: 0%;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
 		

		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.holiday_id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('.holiday_token').val();

			$.ajax({
				url:route()+'/holiday/update',
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
			postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.holiday_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.holiday_token').val();

			$.ajax({
				url:route()+'/holiday/update',
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
		
		$(".datepicker").pickadate({
			selectMonths:true,
			selectYear:15,
			min: new Date(new Date().getFullYear(),new Date().getMonth()+1,new Date().getDate())
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>