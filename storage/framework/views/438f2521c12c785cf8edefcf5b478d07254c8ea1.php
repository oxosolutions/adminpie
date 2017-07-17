<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.settings._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::open(['route'=>'save.organizationSettings','method'=>'POST']); ?>

		<div class="col l3" style="line-height: 30px">
			Primary Organization
		</div>
		<div class="col l9">
			<?php 
				$organizationListArray = App\Model\Admin\GlobalOrganization::organizationsList()->toArray();
				$organizationListArray[0] = 'Default';
			 ?>
			<?php echo Form::select('primary_organization',$organizationListArray,$model,['placeholder'=>'Select Primary Organization']); ?>

		</div>
		<input type="hidden" name="key" value="primary_organization">
		<button type="submit" class="btn blue">Save</button>
	<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>