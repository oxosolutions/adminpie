<?php $__env->startSection('content'); ?>
<style type="text/css">
	.dragula-handle{
		cursor: move;
	}
</style>
<div class="row">
	<div class="col-md-12">
		
		<div class="row">
			<div class="col-md-7">
									
				<?php echo Form::open(['route'=>'save.team_info', 'class'=> 'form-horizontal','method' => 'post','id'=>'team-list-form']); ?>

					<input type="hidden" name="team_id" value="<?php echo e($team->id); ?>">
					<div class="card shadow">
						<div class="panel-heading">
							<h6 class="panel-title">Manage  <?php echo e($team->title); ?>  </h6>
							<p> <?php echo e($team->description); ?> </p>
							
						</div>

						<div class="panel-body">
							<ul class="media-list media-list-container left-" id="media-list-target-left">
								<?php if(!empty($members)): ?>
									<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memKey => $memVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										
										<?php $__currentLoopData = $memVal->metas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyMeta => $valMeta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php echo e(dump($valMeta->type)); ?>

											<?php echo e(dump($valMeta->key)); ?>

											<?php echo e(dump($valMeta->value)); ?>													


										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<li class="media">
				                    		<div class="media-left media-middle">
				                    			<i class="icon-dots dragula-handle"></i>
			                    			</div>

											<div class="media-left">
												<a href="#"><img src="<?php echo e(asset('LTR/default/assets/images/placeholder.jpg')); ?>" class="img-circle" alt=""></a>
											</div>

											<div class="media-body">
												<div class="media-heading text-semibold"><?php echo e($memVal->name); ?></div>
												<input type="hidden" name="id[]" value="<?php echo e($memVal->id); ?>">
												<?php echo e($memVal->email); ?>

											</div>

											<div class="media-right media-middle">
												<span class="label bg-blue">Colleague</span>
											</div>
										</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<li class="media drag-message" style="border:2px Dashed #e8e8e8;padding: 30px">
											<div class="media-body">
												<center><h4 style="color: #e8e8e8">Please Drag Here </h4></center>
											</div>
										</li> 
								<?php else: ?>
								<li class="media drag-message" style="border:2px Dashed #e8e8e8;padding: 30px">
											<div class="media-body">
												<center><h4 style="color: #e8e8e8">Please Drag Here </h4></center>
											</div>
										</li> 
								<?php endif; ?>
								
							</ul>
						</div>
					</div>
					<!-- <div class="text-right">
						<button type="submit" class="btn btn-primary team-list-form">Submit form <i class="icon-arrow-right14 position-right"></i></button>
					</div> -->
				<?php echo Form::close(); ?>


			</div>

			<div class="col-md-5">
				<div class="card shadow">
					<div class="panel-heading">
						<h6 class="panel-title">Employe List</h6>
						<div class="heading-elements">
							
	                	</div>
					</div>
					<div class="panel-body">
						<ul class="media-list media-list-container" id="media-list-target-right">
						<?php if(!empty($employee)): ?>

							<?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="media">
		                    		<div class="media-left media-middle">
		                    			<i class="icon-dots dragula-handle"></i>
		                			</div>

									<div class="media-left">
										<a href="#"><img src="<?php echo e(asset('LTR/default/assets/images/placeholder.jpg')); ?>" class="img-circle" alt=""></a>
									</div>

									<div class="media-body">
										<div class="media-heading text-semibold"><?php echo e($emp->name); ?></div>
										<input type="hidden" name="id[]" value="<?php echo e($emp->id); ?>">
										<?php echo e($emp->email); ?>

									</div>

									<div class="media-right media-middle">
										<span class="label bg-blue">Colleague</span>
									</div>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<li class="media drag-message" style="border:2px Dashed #e8e8e8;padding: 30px">
								<div class="media-body">
									<center><h4 style="color: #e8e8e8">Please Drag Here </h4></center>
								</div>
							</li> 
						<?php else: ?>
							<li class="media drag-message" style="border:2px Dashed #e8e8e8;padding: 30px">
								<div class="media-body">
									<center><h4 style="color: #e8e8e8">Please Drag Here </h4></center>
								</div>
							</li> 
						<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		// console.log($('#media-list-target-left').find('.media').length);
		if($('#media-list-target-left').find('.media').length == '1'){
			// console.log("empty");
			 $('#media-list-target-left').parents('.shadow').find('.drag-message').show();
		}else{
			// console.log('not empty');
			 $('#media-list-target-left').parents('.shadow').find('.drag-message').hide();
		}

		// console.log($('#media-list-target-right').find('.media').length);
		if($('#media-list-target-right').find('.media').length == '1'){
			// console.log("empty");
			 $('#media-list-target-right').parents('.shadow').find('.drag-message').show();
		}else{
			// console.log('not empty');
			 $('#media-list-target-right').parents('.shadow').find('.drag-message').hide();
		}
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>