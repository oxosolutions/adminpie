<div id="aione_header" class="aione-header">
	@if(@$design_settings['header_show_topbar'] == 1)
		@include('layouts.front._topbar')
	@endif
	@if( @$design_settings['header_show_logo'] == 1 ||
		 @$design_settings['header_show_site_title'] == 1 ||
		 @$design_settings['header_show_site_description'] == 1 ||
		 @$design_settings['header_show_banner'] == 1 )

		@include('layouts.front._logo')
	@endif
	@if(@$design_settings['header_show_menu'] == 1)
		@include('layouts.front._menu')
	@endif
</div><!-- .aione-header -->

	