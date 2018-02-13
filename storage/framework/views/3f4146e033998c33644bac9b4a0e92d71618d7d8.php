<div id="aione_header" class="aione-header">
	<?php if(@$design_settings['header_show_topbar'] == 1): ?>
		<?php echo $__env->make('layouts.themes.theme-corporate.includes._topbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
	<div class="wrapper">
		<div class="ar">
			<div class="ac l50 m50 s50 pv-5">
				
				<?php if( @$design_settings['header_show_logo'] == 1 ||
					 @$design_settings['header_show_site_title'] == 1 ||
					 @$design_settings['header_show_site_description'] == 1 ||
					 @$design_settings['header_show_banner'] == 1 ): ?>
					 <?php echo $__env->make('layouts.themes.theme-corporate.includes._logo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endif; ?>
			</div>
			<div class="ac l50 m50 s50 pv-5">
				
		        <?php if(@$design_settings['header_show_menu'] == 1): ?>
					<?php echo $__env->make('layouts.themes.theme-corporate.includes._menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endif; ?>
	        </div>

		</div>
	</div>
</div><!-- .aione-header -->

	