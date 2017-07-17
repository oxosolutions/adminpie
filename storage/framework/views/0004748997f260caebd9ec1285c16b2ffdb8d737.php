<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col l2">
		<div class="card shadow p-10">
			<img src="<?php echo e(asset('assets/images/Employee1.png')); ?>" style="width:152px">
			<div class="form-group row valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('name', 'Name:', ['class' => ' control-label']);; ?>

				</div>
				<div class="col l9">
					<?php echo Form::text('name', null, array('required','class'=>'form-control')); ?>

				</div>
			</div>
			<div class="row center-align">
				<div class="col l3">
					Type:
				</div>
				<div class="col l9">
					admin
				</div>
			</div>
		</div>
	</div>
	<div class="col l8">
		<div class="card shadow p-10">
			<div class="row" style="margin-bottom: 10px">
				<div class="col l6">
					<h6>Basic Information</h6>	
				</div>
				<div class="col l6 right-align">
					<a class="btn" href="#">VIEW</a>
				</div>
			</div>
			<div class="divider"></div>
			<div class="form-group row valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('email', 'Email:', ['class' => ' control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::text('name', null, array('required','class'=>'form-control')); ?>

				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('phone', 'Phone:', ['class' => 'control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::number('phone',null,['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('dob', 'Date of Birth:', ['class' => 'control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::date('dob',null,['class' => 'datepicker']); ?>

				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('gender', 'Gender:', ['class' => 'control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::text('gender',null,['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('address', 'Address:', ['class' => 'control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::text('address',null,['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('country', 'Country:', ['class' => 'control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::text('country',null,['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('state', 'State:', ['class' => 'control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::text('state',null,['class' => 'form-control']); ?>

				</div>
			</div>
		
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('city', 'City:', ['class' => 'control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::text('city',null,['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					<?php echo Form::label('zip', 'Zip:', ['class' => 'control-label']);; ?>

				</div>
				<div class=" col l9">
					<?php echo Form::number('zip',null,['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="row l12 right-align">
				<a class="btn" href="#">save</a>
			</div>
			<div style="clear: both">
				
			</div>
		</div>
			
		</div>
	</div>
	<div class="col l2">
		<div class="card shadow p-10">
			<div class="row" style="margin-bottom: 10px">
				<div class="col l12">
					<h6>Settings</h6>
				</div>
			</div>
			<div class="divider"></div>
			<div class="center-align">
				<a href="">Remove as employee</a>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>