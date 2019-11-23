<div class="aione-align-center p-5 aione-border-top bg-grey bg-lighten-4"> 
	<div class="aione-align-center aione-border-top bg-grey bg-lighten-4"> 
		<?php if(Auth::guard('admin')->check()): ?>
			<a href="<?php echo e(route($route)); ?>" class="display-block white bg-blue-grey bg-darken-4 p-10">All <?php echo e(ucfirst(str_replace('_', ' ', $key))); ?></a>
		<?php else: ?>
			<a href="<?php echo e(route($route)); ?> " class="display-block white bg-blue-grey bg-darken-4 p-10" style="font-size: 16px">All <?php echo e(ucfirst(str_replace('_', ' ', $key))); ?></a>
		<?php endif; ?>
	</div>
</div>