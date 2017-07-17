<?php $__env->startSection('content'); ?>
<?php if(!empty(Session::get('success'))): ?>
	<div id="card-alert" class="card green lighten-5"><div class="card-content green-text"><?php echo e(Session::get('success')); ?></div></div>
	
<?php endif; ?>

<?php if(!empty(Session::get('error'))): ?>
	<div id="card-alert" class="card red lighten-5"><div class="card-content red-text"><?php echo e(Session::get('error')); ?></div></div>
	
<?php endif; ?>

<div class="fade-background">

</div>
<div id="search" class="projects list-view">
	<div class="row" id="find-project">
		<div class="col s12 m12 l12 " >
			
			<div class="list" id="list">
				<div class="row">
					<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			
				
			</div>
		</div>

		
	</div>
</div>
<script type="text/javascript">
	var options = {valueNames:[name]};
	var userList = new List('user',options);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>