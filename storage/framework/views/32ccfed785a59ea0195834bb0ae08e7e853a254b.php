
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-12">
	<h1>Pricing</h1>
	<?php echo Form::open(['route'=>'price.products', 'class'=> 'form-horizontal','method' => 'post']); ?>

			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">
						<input type="text" name="id" value="<?php echo e($id); ?>">
						<div class="panel-body">
							<?php echo $__env->make('organization.crm.pricing._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php echo Form::close(); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>