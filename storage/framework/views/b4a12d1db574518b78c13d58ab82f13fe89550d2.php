<?php 
	$model = "App\Model\Organization\Employee";
 ?>


<?php $__env->startSection('front'); ?>

	<div class="front" >
		<div class="card shadow mt-0 fix-height" >
			<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst($data['widgets']->slug)); ?></a></h5></div>
			<div class="row center-align aione-widget-content mb-10" >
					<?php echo e($model::all()->count()); ?>

			</div>
			<div class="row aione-widget-footer mb-10" >
				<button href="#" class="all blue white-text">All <?php echo e($data['widgets']->slug); ?></button>
				<button href="#" class="recent blue white-text flip-btn-1">Recent <?php echo e($data['widgets']->slug); ?></button>
			</div>
		</div>
	</div>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('back'); ?>
	<div class="back">
		<div class="card shadow mt-0 fix-height" > 
			<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#"><?php echo e(ucfirst('Recent '.$data['widgets']->slug)); ?></a></h5>
				<a href="#" class="btn-unflip-1 btn-unflip"><i class="material-icons dp48">clear</i></a>
			</div>
			<div class="row aione-widget-list m-0" >
				<ul class="recent-five">
				<?php 
					$data2 = $model::orderBy('id','DESC')->limit(5)->get();
					$employees = [];
				 ?>
				<?php if($data2 == null || $data2->isEmpty()): ?>
					<?php echo e(dump("No Data Found")); ?>

				<?php else: ?>
				
				<?php $__currentLoopData = $data2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
						$employees[] = App\Model\Organization\User::where('id',$v->user_id)->first();
					 ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="waves-effect">
							<?php echo e($v->email); ?>

							<a href="<?php echo e(route('account.profile',$v->id)); ?>">view</a>
						</li>
						<div class="divider"></div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
					
				</ul>
			</div>
		</div>
	</div>
<?php $__env->stopSection(true); ?>
<?php echo $__env->make('layouts.widget', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>