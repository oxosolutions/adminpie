
<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Customer',
	'add_new' => ''
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
	.view-detail > div >div{
		padding: 10px;
		border-bottom: 1px solid #37474f;
	}
	.tb_head{
		font-weight: 600;
	}
</style>
	
	
	<div class="aione-table">
		<table>
			<thead>
				<tr>
					<th>key</th>
					<th>Value</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Name</td>
					<td><?php echo e($detail->name); ?></td>
				</tr>
				<tr>
					<td>Company Name</td>
					<td><?php echo e($detail->company_name); ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><?php echo e($detail->address); ?></td>
				</tr>
				<tr>
					<td>country</td>
					<td><?php echo e($detail->country); ?></td>
				</tr>
				<tr>
					<td>state</td>
					<td><?php echo e($detail->state); ?></td>
				</tr>
				<tr>
					<td>City</td>
					<td><?php echo e($detail->city); ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo e($detail->email); ?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><?php echo e($detail->phone); ?></td>
				</tr>
				<tr>
					<td>Additional Info</td>
					<td><?php echo e($detail->additional_info); ?></td>
				</tr>
			</tbody>
		</table>
	</div>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>