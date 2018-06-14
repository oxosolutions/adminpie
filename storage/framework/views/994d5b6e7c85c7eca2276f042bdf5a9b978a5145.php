<?php $__env->startSection('content'); ?>
		<h1>Apply Form</h1>
		<div class="row">
	<div class="col-md-12">
	<?php echo Form::open(['route'=>['apply'], 'class'=> 'form-horizontal','method' => 'post']); ?>

			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">
						<input name="opening_id" type="hidden" value="<?php echo e($id); ?>">

						<div class="panel-body">
							<section>
								<h3>Applicant Sign Up</h3>
								<ul>
									<li>Name<input name="name" type="text" ></li>
								
									<li>Email<input name="email" type="text" ></li>
									<li>Password <input name="password" type="text" ></li>
								</ul>
								
								

							</section>

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