
<?php $__env->startSection('content'); ?>
<style type="text/css">
	.view-detail > div >div{
		padding: 10px;
		border-bottom: 1px solid #37474f;
	}
	.tb_head{
		font-weight: 600;
	}
</style>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat ">
						<div class="panel-body view-detail">
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Name
								</div>
								<div class="col-lg-9">
									<?php echo e($detail->name); ?>

								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Company Name
								</div>
								<div class="col-lg-9">
									<?php echo e($detail->company_name); ?>

								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Address
								</div> 
								<div class="col-lg-9">
									<?php echo e($detail->address); ?>

								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									country
								</div>
								<div class="col-lg-9">
									<?php echo e($detail->country); ?>

								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									state
								</div>
								<div class="col-lg-9">
									<?php echo e($detail->state); ?>

								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									City
								</div>
								<div class="col-lg-9">
									<?php echo e($detail->city); ?>

								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Email
								</div>
								<div class="col-lg-9">
									<?php echo e($detail->email); ?>

								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Phone
								</div>
								<div class="col-lg-9">
									<?php echo e($detail->phone); ?>

								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-3 tb_head">
									Additional Info
								</div>		
								<div class="col-lg-9">
									<?php echo e($detail->additional_info); ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>