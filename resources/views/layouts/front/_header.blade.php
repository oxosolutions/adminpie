<div id="aione_header" class="aione-header">
	@if(@$design_settings['header_show_topbar'] == 1)
		@include('layouts.front._topbar')
	@endif
	<div>
		@if( @$design_settings['header_show_logo'] == 1 ||
			 @$design_settings['header_show_site_title'] == 1 ||
			 @$design_settings['header_show_site_description'] == 1 ||
			 @$design_settings['header_show_banner'] == 1 )
			<div class="aione-header-logo">
				@include('layouts.front._logo')
			</div>
		@endif
		@if(@$design_settings['header_show_menu'] == 1)
			<div class="aione-header-menu">
				@include('layouts.front._menu')
			</div>
		@endif
		
	</div>
</div><!-- #aione-header -->