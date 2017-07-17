
<div class="row">
	<div class="col-md-12">
	<?php echo Form::open(['route'=>'upload.attendance', "files"=>true , 'class'=> 'form-horizontal','method' => 'post']); ?>

			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">

						<div class="panel-body">
							<?php echo $__env->make('common._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
