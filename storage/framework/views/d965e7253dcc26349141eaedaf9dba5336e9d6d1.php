<?php 
    $design_settings = get_design_settings();

    if(@$design_settings->theme == null || $design_settings->theme == ''){
	    $layout = 'layouts.front';
    } else {
	    $layout = 'layouts.themes.'.$design_settings->theme.'.layout';
    }
 ?>

<?php $__env->startSection('content'); ?>
	<?php echo $pageData->content; ?>




<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>