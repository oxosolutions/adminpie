<?php $__env->startSection('content'); ?>

<?php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'View User',
	'add_new' => '+ Add User'
);
	
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('group.user._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="aione-table">
		<table class="aione-table">
			<tr>
				<td width="300"><b>Field</b></td>
				<td><b>Value</b></td>
			</tr>
			<?php $__currentLoopData = $model->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(in_array($key,['name','email'])): ?>
				<tr>
					<td><?php echo e(ucfirst(str_replace('_',' ',$key))); ?></td>
					<td><?php echo e($value); ?></td>
				</tr>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td>Organizations having this user:</td>
				<td>
					<?php $__currentLoopData = $organizationsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;"><?php echo e($organization['name']); ?></span>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</td>
			</tr>
		</table>
		<div class="center mt-2p">
			<h5>Organizations having this user</h5>
		</div>
		<table class="aione-table">
			<thead>
				<tr>
					<th width="300">Organization Name</th>
					<th>Role Name</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $organizationsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($organization['name']); ?></td>
						<td>
							<?php $__currentLoopData = $organization['roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<span class="bg-teal white p-5 display-inline-block mb-5" style="cursor: pointer;"><?php echo e($role->name); ?></span>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('group.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>