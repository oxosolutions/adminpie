<div id="aione_footer" class="aione-footer">
	<div class="aione-row">
		<?php if(@$admin_footer_content): ?>
		<?php echo @$admin_footer_content; ?>

		<?php else: ?>
			&copy;<?php echo e(date("Y")); ?> <a href="http://oxosolutions.com/" target="_blank">OXO Solutions</a>.All rights reserved. 
		<?php endif; ?>
		
	</div><!-- .aione-row -->
</div><!-- #aione_content --> 