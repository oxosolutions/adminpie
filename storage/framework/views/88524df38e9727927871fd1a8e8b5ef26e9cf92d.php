
 
 
<div id="aione_copyright" class="aione-copyright <?php echo e(@$design_settings['copyright_theme']); ?>">
	<div class="wrapper aione-align-center font-weight-400 line-height-30">
		<?php if(!empty(@$design_settings['copyright_content'])): ?>
			<?php echo @$design_settings['copyright_content']; ?>

		<?php else: ?>
			&copy;<?php echo e(date("Y")); ?> <?php echo get_organization_meta('title'); ?>. All rights reserved.
		<?php endif; ?>
	</div><!-- .aione-row -->
</div><!-- .aione-copyright -->

