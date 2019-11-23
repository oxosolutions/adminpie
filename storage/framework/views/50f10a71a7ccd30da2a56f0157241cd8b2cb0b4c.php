<?php $__env->startSection('content'); ?>
<?php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Dashboard',
	'add_new' => '+ Add Dashboard'
	); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="aione-dashboard">
		<!-- Dashboard Widgets -->
		<div class="ar">
			<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<!-- Dashboard Widget -->
				<div class="ac s100 m50 l25 pt-15 pb-15">
					<div class="aione-widget aione-border bg-grey bg-lighten-5">
						<div class="aione-title">
							<h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 bg-grey bg-lighten-4"><a href="<?php echo e(route($value['route'])); ?>" class="blue-grey darken-4"><?php echo e(ucfirst($key)); ?></a></h5>
						</div>
						<div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2"> 
							<?php echo e($value['count']); ?>

						</div>
						<div class="aione-align-center p-5 aione-border-top bg-grey bg-lighten-4"> 
							<a href="<?php echo e(route($value['route'])); ?>" class="display-block p-10 white bg-blue-grey bg-darken-4">All <?php echo e($key); ?></a>
						</div>
					</div>
				</div>
				<!-- Dashboard Widget -->
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('group.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>