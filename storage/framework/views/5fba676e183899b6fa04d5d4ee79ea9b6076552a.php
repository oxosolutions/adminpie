<?php $__env->startSection('content'); ?>

<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Visualization <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Visualization',
	'route' => ['visualization.view',['dataset_id'=>$dataset['id']]]
	); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
	.aione-list{
		color: #757575
	}
	.aione-list > .aione-item{
		border: 1px solid #e8e8e8;
		margin-bottom: 5px;
		padding: 10px
	}
	.aione-list > .aione-item:first-child{
		font-weight: 600;
	}
	.truncate{
		    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
	}
</style>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if($visualizations->isEmpty()): ?>
		<div class="aione-message warning">
			No Visualizations Found!
		</div>
	<?php else: ?>
		<ul class="aione-list">
				<li class="aione-item ar">
					<div class="ac l25">Name of visualization</div>
					<div class="ac l25">Description</div>
					<div class="ac l25">Created</div>
				</li>
			<?php $__currentLoopData = $visualizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<li class="aione-item ar">
					<div class="ac l25"><a href="<?php echo e(url('visualization/edit/'.$value->id)); ?>"><?php echo e($value->name); ?></a></div>
					<div class="ac l25"><?php echo e($value->description); ?></div>
					<div class="ac l25"><?php echo e($value->created_at->diffForHumans()); ?></div>
				</li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	<?php endif; ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>