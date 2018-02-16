<?php 
	$model = "App\Model\Admin\GlobalOrganization";
	$item_count = $model::find(session()->get('organization_id'));
	$activate_key = $item_count->active_code;
	$items = $model::orderBy('id','DESC')->limit(5)->get();
 ?>
<?php echo $__env->make('organization.widgets.includes.widget-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
		<div class="aione-widget-content-wrapper">
			<span class="aione-hero-text aione-counter" style="font-size: 40px;position: absolute;top: 41%;left: 24%;"><?php echo e($activate_key); ?></span>
		</div>
		<div class="aione-widget-footer"></div>
    
		<div class="aione-widget-footer"></div>
<?php echo $__env->make('organization.widgets.includes.widget-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>