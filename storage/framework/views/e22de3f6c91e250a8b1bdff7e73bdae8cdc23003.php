<?php $__env->startSection('content'); ?>

<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Organizations',
	'add_new' => '+ Add Organization',
	); 
 ?>


<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('group.organization._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="aione-table">
		<table>
			<thead>
				<tr>
					<th width="300">Field</th>
					<th>Value</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $model->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(!in_array($key, ['updated_at','created_by','id'])): ?>
						<?php if($key == 'group_id'): ?>
							<tr>
								<td>Group</td>
								<td><?php echo e(Auth::guard('group')->user()->name); ?></td>
							</tr>
						<?php elseif($key == 'modules'): ?>
							<tr>
								<td><?php echo e(ucwords(str_replace('_',' ',$key))); ?></td>
								<td>
									<?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;"><?php echo e($item); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</td>
							</tr>
						<?php else: ?>
							<tr>
								<td><?php echo e(ucwords(str_replace('_',' ',$key))); ?></td>
								<td><?php echo e($value); ?></td>
							</tr>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>	
	</div>
	
	<h3 class="aione-align-center">Organization Users List</h3>
	<div class="aione-table">
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($user->belong_group): ?>
						<tr>
							<th><?php echo e(@$user->belong_group->name); ?></th>
							<th><?php echo e(@$user->belong_group->email); ?></th>
							<th>
								<a href="<?php echo e(url('user/view/'.@$user->belong_group->id)); ?>">View</a> | 
								<a href="<?php echo e(url('user/edit/'.@$user->belong_group->id)); ?>">Edit</a>
							</th>
						</tr>	
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('group.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>