<div class="row-wrapper">
	<div class="ar grey">
		<?php if( @$design_settings['header_show_logo'] == 1): ?>
			<div id="aione_header_logo" class="aione-header-item">
				<img src="/<?php echo @get_organization_meta('logo'); ?>" class="aione-topbar-logo-item" alt="Organization's Logo"> 
			</div><!-- .aione-topbar-item -->
		<?php endif; ?>
		<?php if( @$design_settings['header_show_site_title'] == 1 || @$design_settings['header_show_site_description'] == 1): ?>
			<div id="aione_header_title " class="display-inline-block p-5">
				<?php if( @$design_settings['header_show_site_title'] == 1 && @$design_settings['header_show_site_description'] == 1): ?>
					<h2 class="aione-align-left font-size-28 m-0 font-weight-200"><?php echo @get_organization_meta('title'); ?></h2>
				<?php endif; ?>
				<?php if( @$design_settings['header_show_site_title'] == 1 && @$design_settings['header_show_site_description'] == 1): ?>
					<span class="aione-align-left font-size-14"><?php echo @get_organization_meta('tagline'); ?></span>
				<?php endif; ?>
			</div><!-- .aione-topbar-item -->
		<?php endif; ?>
		<?php if( @$design_settings['header_show_banner'] == 1 && !empty(@$design_settings['header_banner_content'])): ?>
			<?php echo @$design_settings['header_banner_content']; ?>

		<?php endif; ?>
	</div>
</div><!-- .row-wrapper -->