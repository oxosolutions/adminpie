<?php $__env->startSection('content'); ?>
	
<style type="text/css">

</style>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Leave',
	'add_new' => '+ Add Leave'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php if($data): ?>
	<?php $__currentLoopData = @$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php 
			$id = $value->id;
			$model = ['name' => $value->name,'from' => $value->from, 'to' => $value->to , 'reason_of_leave' => $value->reason_of_leave, 'employee_id' => $value->employee_id , 'leave_category_id' => $value->leave_category_id];
		 ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<script type="text/javascript">
		$(window).load(function(){
			document.getElementById('modal-edit').click();
		});
	</script>
<?php endif; ?>	
<?php echo Form::open(['route'=>'store.leave' , 'class'=> 'form-horizontal','method' => 'post']); ?>


<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add leaves','button_title'=>'Save','section'=>'leavesection']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>

<?php if(@$model): ?>
	<?php echo Form::model($model ,['route'=>'edit.leave' , 'class'=> 'form-horizontal','method' => 'post']); ?>

	<input type="hidden" name="id" value="<?php echo e($id); ?>">
	<a href="#modal_edit" style="display: none" id="modal-edit"></a>
	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit Leave','button_title'=>'update Leave','section'=>'leavesection']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>

<?php endif; ?>	
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
<style type="text/css">
.add-new-wrapper{
	display:none;
	position: relative;
}
.add-new-wrapper.active{
	display:block;
}
/*.add-new-wrapper:after{
    content: "";
    position: absolute;
    bottom: -16px;
    right: 100px;
    border-right: 12px solid transparent;
    border-left: 12px solid transparent;
    border-top: 16px solid #0288d1;
}*/
.modal-dialog{
	margin: 0px !important;
	width: 100%;
}
.modal .modal-content {
     padding: 0px; 
}
#modal1,#modal2{
	padding-right: 0px !important;
}
.modal-body{
	    padding-bottom: 12px;
}
.element-item{
	left: 1px !important;
	float: left;
	clear: both
}
.none{
	display: none
}
.list-view .project .project-detail{
    display:block;
}
[contenteditable]:focus{
	outline: 0px solid transparent;
}
.edit-fields{
	border:1px solid #e8e8e8;padding: 5px;
}
.shadow l4{
	min-width: 100%;
}
.close-model{
	    float: right;
    padding: 10px;
    margin-top: -50px;
    color: red;
    font-size: 22px
}
</style>

	<script type="text/javascript">
	$(document).ready(function(){

		
		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/leave/update',
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
			postedData['name'] 			= $(this).parents('.shadow').find('.name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/leave/update',
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
	/*$(".datepicker").pickadate({
			selectMonths:true,
			selectYear:15,
			min: new Date(new Date().getFullYear(),new Date().getMonth()+1,new Date().getDate())
		});*/
	$('.datepicker').on('open', function() {
	    $('.datepicker').appendTo('body');
	});

		
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>