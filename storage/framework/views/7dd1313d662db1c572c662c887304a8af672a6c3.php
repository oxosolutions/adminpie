<?php $__env->startSection('content'); ?>
<div id="projects" class="projects list-view">
	<div class="row">

	</div>
	<div class="row">
		<div class="col s12 m12 l12" >
				<table class="bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Date</th>
							<th>Description</th>	
						</tr>
						
					</thead>
					<tbody>
						<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $holidays): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($holidays->title); ?></td>
								<td><?php echo e(date( 'D / d M Y' , strtotime($holidays->date_of_holiday) )); ?></td>
								<td><?php echo e($holidays->description); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
					</tbody>
				</table>
		</div>

		
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>