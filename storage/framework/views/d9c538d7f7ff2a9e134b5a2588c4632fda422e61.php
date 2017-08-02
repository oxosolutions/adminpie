
<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = $plugins['model']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="row">
		<form method="POST" action="<?php echo e(route('user.edit',$value->id)); ?>">
			<div class="row" style="padding:10px 0px">
				<div class="col l3" style="line-height: 30px">
					Name
				</div>
				<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
				<div class="col l9">
					<input type="text" name="name" value="<?php echo e($value->name); ?>" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			<div class="row" style="padding:10px 0px">
				<div class="col l3" style="line-height: 30px">
					Email
				</div>
				<div class="col l9">
					<input type="email" name="email" value="<?php echo e($value->email); ?>" disabled="disabled" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			<div class="row" style="padding:10px 0px">
				<div class="col l3" style="line-height: 30px">
					Role ID
				</div>
				<div class="input-field col l9">
					<label for="roleId"></label>
					<select name="role_id">
						<?php $__currentLoopData = $plugins['roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option <?php echo e(($value->role_id == $key)?'selected': ''); ?> value="<?php echo e($key); ?>"><?php echo e($val); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
	            </div>
				
			</div>
			<div class="row">
				<div class="col l12">
					<button class="btn right-align blue" type="submit">Update</button>
				</div>
			</div>
		</form>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<style type="text/css">
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.input-field{
		margin-top: 0px
	}
	</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>