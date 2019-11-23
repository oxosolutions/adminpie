<?php $__env->startSection('content'); ?>
<?php
	// $isEmployee = App\Model\Organization\Employee::where('user_id' , $model->id)->first();
	$isEmployee = is_employee(@request()->route()->parameters()['id']);
	$isAdmin = is_admin();
?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => __('organization/profile.profile_view_page_title_text'),
	'add_new' => ''
); 
?>
<?php
	$mapModel = 'App\\Model\\Organization\\UsersRole';
	if(@$model->role != null){
		$role = $mapModel::whereIn('id',$model->role->pluck('role_id'))->get();
	}
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('organization.my-profile._profile_tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row">
			<div class="aione-table">
				<table class="wide">
					 <thead>
			            <tr>
			                <th><?php echo e(__('organization/profile.field')); ?></th>
			                <th><?php echo e(__('organization/profile.value')); ?></th>
			                
			                
			            </tr>
			          </thead>
					<tbody>

						
					<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if(!is_array($value)): ?>
							<?php if($value != ''): ?>
								<tr>
									<td>
										<?php echo e(ucfirst(str_replace('_', " ", $key))); ?>

									</td>
									<td>
										<?php echo e($value); ?>

									</td>
								</tr>	
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php if(@$role != null): ?>
						<tr>
							<td>
								Roles
							</td>
							<td>
								<?php $__currentLoopData = $role->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php echo e($v); ?>

									<?php if(!$loop->last): ?>
										<?php echo e(' ,'); ?>

									<?php endif; ?>
									
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
				
			</div>
		</div>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>