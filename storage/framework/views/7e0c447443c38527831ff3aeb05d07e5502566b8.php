

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-12">
	<?php echo Form::model($model, ['route'=>['edit.applicant',$model['id']], 'class'=> 'form-horizontal','method' => 'post']); ?>

			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">

						<div class="panel-body">
							<?php echo FormGenerator::GenerateForm('appinfo',['type'=>'inset']); ?>

						</div>
					</div>
				</div>
			</div>
		<?php echo Form::close(); ?>

	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>