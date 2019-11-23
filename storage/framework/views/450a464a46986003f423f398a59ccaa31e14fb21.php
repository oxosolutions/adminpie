<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Dashboard',
	'add_new' => ''
); 
?>
<style type="text/css">
	.aione-widget{
		float: left;
	    width: 23%;
	    min-height: 160px;
	    padding: 0;
	    margin: 0 2% 2% 0;
	    position: relative;
	    color: #666666;
	}
	.test .aione-widget{
		min-width: 123px;
	}
	.test .aione-widget-content-section{
		padding-top: 10%;
		min-height: 121px;
		font-size: 80px
	}
	.test .aione-widget-content-section{
		padding-top: 0px;
		min-height: 0px;
	}
</style>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="aione-dashboard">
		<!-- Dashboard Widgets -->
		<div class="ar">

			<div class="aione-widgets " id="sortable-widgets">
				<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
					$count = $value['count'];
					$route = $value['route'];
					// $list = $value['list'];
				?>
					<!-- Dashboard Widget -->
					<span class="sortable-divs" widget-order="<?php echo e($key); ?>"></span>
						<div class="test">
							<?php echo $__env->make('organization.widgets.commonWidget', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
					<!-- Dashboard Widget -->
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>