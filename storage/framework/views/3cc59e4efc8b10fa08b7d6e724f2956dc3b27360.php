<?php 
	$model = "App\Model\Organization\User";
	$item_count = $model::all()->count();
	$items = $model::orderBy('id','DESC')->limit(5)->get();
	$route = 'list.user';
 ?>
<?php echo $__env->make('organization.widgets.includes.widget-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.widgets.includes.widget-front-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
		<div class="aione-widget-content-wrapper">
			<span class="aione-hero-text aione-counter"><?php echo e($item_count); ?></span>
		</div>
		<div class="aione-widget-footer"></div>
    <?php echo $__env->make('organization.widgets.includes.widget-front-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.widgets.includes.widget-back-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    	
    	<div class="aione-widget-content-wrapper">
            <ul class="aione-recent-items">
				<?php if(!$items->isEmpty()): ?>
    				<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="item waves-effect"><?php echo e($item->email); ?>

							<a class="item-action" href="<?php echo e(route('account.profile',$item->id)); ?>">view</a>
						</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    			<?php else: ?> 
    				<div class="aione-widget-error">
    					<?php echo e(__('messages.widget_empty_list', ['entity' => 'user'])); ?>

    				</div>
    			<?php endif; ?>
			</ul>
		</div>
		<div class="aione-widget-footer"></div>
     <?php echo $__env->make('organization.widgets.includes.widget-back-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.widgets.aioneWidgetButton', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     
<?php echo $__env->make('organization.widgets.includes.widget-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>