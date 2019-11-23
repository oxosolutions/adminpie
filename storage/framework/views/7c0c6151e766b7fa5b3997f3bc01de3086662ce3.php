<div id="aione_header" class="aione-header">
	<?php if(@$design_settings['header_show_topbar'] == 1): ?>
		<?php echo $__env->make('layouts.front._topbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
	<?php if( @$design_settings['header_show_logo'] == 1 ||
		 @$design_settings['header_show_site_title'] == 1 ||
		 @$design_settings['header_show_site_description'] == 1 ||
		 @$design_settings['header_show_banner'] == 1 ): ?>

		<?php echo $__env->make('layouts.front._logo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
	<?php if(@$design_settings['header_show_menu'] == 1): ?>
		<?php echo $__env->make('layouts.front._menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
</div><!-- #aione-header -->