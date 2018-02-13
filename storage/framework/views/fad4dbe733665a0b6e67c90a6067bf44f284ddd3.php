<div id="aione_copyright" class="aione-copyright">
	<div class="aione-row">
		<?php if(!empty(@$design_settings['copyright_content'])): ?>
			<?php echo @$design_settings['copyright_content']; ?>

		<?php else: ?>
			&copy;<?php echo e(date("Y")); ?> <?php echo get_organization_meta('title'); ?>. All rights reserved.
		<?php endif; ?>
	</div><!-- .aione-row -->
</div>