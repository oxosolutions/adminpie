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
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Import Attendance',
	'add_new' => '+ Add Designation'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



<?php if(Session::has('success')): ?>
<div id="card-alert" class="card green lighten-5"><div class="card-content green-text">
<span class="alert"><?php echo e(Session::get('success')); ?></span>
<i class="material-icons dp48">clear</i></div></div>
<?php endif; ?>


<?php if(Session::has('error')): ?>
<p class="alert"><?php echo e(Session::get('error')); ?></p>
<?php endif; ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">
	<?php echo Form::open(['route'=>'upload.attendance', "files"=>true , 'class'=> 'form-horizontal','method' => 'post']); ?>

	<div class="row" style="padding:10px 0px">
		<div class="col l12 aione-field-wrapper">
			<?php echo Form::text('title',null,['class' => 'aione-field','id'=>'attendence-title','placeholder'=>'Enter title']); ?>

		</div>
	</div>
	<div class="row pv-10" >
		<?php echo Form::file('attendance_file',null,['class'=>'no-margin-bottom aione-field file-path validate','placeholder'=>'Select File to Upload','style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px']); ?>

	</div>
	<div  class="row">
		<button class="btn blue" type="submit" name="action" style="margin-top: 10px;">Upload Attendance
		</button>
	</div>
	<?php echo Form::close(); ?>

</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
	
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
</style>
<script type="text/javascript">
	$(document).on('click','#card-alert i',function(){
		$('#card-alert').remove();
	});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>