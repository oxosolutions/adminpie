<?php $__env->startSection('content'); ?>




<?php if(Session::has('success')): ?>
<p class="alert"><?php echo e(Session::get('success')); ?></p>
<?php endif; ?>


<?php if(Session::has('error')): ?>
<p class="alert"><?php echo e(Session::get('error')); ?></p>
<?php endif; ?>


<div class="row">
	<?php echo Form::open(['route'=>'upload.attendance', "files"=>true , 'class'=> 'form-horizontal','method' => 'post']); ?>

	<div class="row" style="padding:10px 0px">
		<div class="col l3" style="line-height: 30px">
			Enter title
		</div>
		<div class="col l9">
			
			<?php echo Form::text('title',null,['class' => 'aione-setting-field','id'=>'attendence-title','style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px']); ?>

		</div>
	</div>

	<div class="row pv-10" >
		<div class="col l3" style="line-height: 46px">
			Upload
		</div>
		<div class="col l9">
			<div class="file-field input-field" style="margin-top: 0px">
				<div class="btn">
					<span>Choose file</span>
					<input type="file" name="attendance_file">
				</div>
				<div class="file-path-wrapper">
					
					<?php echo Form::text('file',null,['class' => 'file-path validate']); ?>

				</div>
			</div>	
		</div>
	</div>
	<div  class="row">
		<button class="btn blue" type="submit" name="action" style="margin-top: 10px;">Upload Attendance
		<i class="material-icons right">save</i>
		</button>
	</div>
	<?php echo Form::close(); ?>

</div>
<style type="text/css">
	
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>