<?php $__env->startSection('content'); ?>
<div class="fade-background">

</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l12 " >
			
		</div>
	</div>
	<div class="row">
		<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>
<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>