<?php $__env->startSection('content'); ?>
<?php
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Holidays',
    'add_new' => '+ Add Tasks'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class=" aione-table">
	<?php if($model != null && !$model->isEmpty()): ?>
	<table>
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
	<?php else: ?>
	<div class="aione-message warning">
		No holiday available
	</div>
	<?php endif; ?>
</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
/*.holidays-list table, td, th {    
    border: 1px solid #e8e8e8;
    text-align: left;
}

.holidays-list table {
    border-collapse: collapse;
    width: 100%;
}

.holidays-list th, td {
    padding: 15px;
}
.holidays-list th{
	font-weight: 600
}*/
</style>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>