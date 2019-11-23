<?php
	$model = "App\\Model\\Organization\\forms";
	$item_count = $model::all()->count();
	$items = $model::orderBy('id','DESC')->where('type','survey')->limit(3)->get();
	$route = "list.survey";
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
						<li class="item waves-effect" style="overflow: hidden; text-overflow: ellipsis;"><?php echo e($item->form_title); ?>

							<a class="item-action" href="<?php echo e(route('survey.perview',$item->id)); ?>">view</a>
						</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    			<?php else: ?> 
    				<div class="aione-widget-error">
    					<?php echo e(__('messages.widget_empty_list', ['entity' => 'dataset'])); ?>

    				</div>
    			<?php endif; ?>
			</ul>
		</div>
		<div class="aione-widget-footer"></div>
     <?php echo $__env->make('organization.widgets.includes.widget-back-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.widgets.aioneWidgetButton', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.widgets.includes.widget-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>