
<?php $__env->startSection('content'); ?>
<style type="text/css">
		.activities .month{
		 font-size: 16px ;font-weight: 700
	}
	.activities .date{
		padding:4px 18px;
	}
	.activites .day{
		font-size: 28px;line-height: 30px;font-weight: 700
	}
	.activites .box{
		padding: 4px 8px; font-size: 10px;border-radius: 3px
	}
	.mb-0{
		margin-bottom: 0px
	}
	.pv-5{
		padding:5px 0px
	}
</style>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Recent Activities',
	'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="row mb-0">
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row activities mb-0">
			recent activities

			<?php $__currentLoopData = $user_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row valign-wrapper  mb-0 pv-5" >
					<div class="col l1 blue white-text center-align date">
						<div class="row month mb-0" >
							<?php echo e(date_format($value->created_at , "M")); ?>

						</div>
						<div class="row day mb-0" >
							<?php echo e(date_format($value->created_at , "d")); ?>

						</div>
					</div>
					<div class="col l6 pl-7 truncate">
						<div class="row month mb-0" >
						<?php echo e(activity_log($value['slug'],'EN')); ?>

						</div>

					</div>
					<div class="col l3 pl-7 truncate">
						
					</div>
					<div class="col l2">
						<span class="box green white-text"></span>
					</div>
					
					<div class="col l2 grey-text center-align" style="font-size: 13px">
					<?php echo e(Carbon\Carbon::parse($value->created_at)->diffForHumans()); ?>

					</div>	
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php echo e($user_log->render()); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>