<head>
	<?php echo $__env->make('components._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('layouts.front._css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if($is_survey): ?>
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/surveys.css?ref='.rand(1111,9999))); ?>">
	<?php endif; ?>
	<?php if($is_visualization): ?>
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/visualizations.css?ref='.rand(1111,9999))); ?>">
	<?php endif; ?>
	<?php echo @$design_settings['custom_content_head']; ?>

	<style type="text/css">
		.my-class{
			display: none;
		}
		<?php echo @$meta['css_code']; ?>

	</style>
	<style type="text/css">
		<?php echo @$design_settings['custom_css']; ?>

	</style>
</head>