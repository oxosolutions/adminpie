<div id="aione_header" class="aione-header">
	{{-- @if(@$design_settings['header_show_topbar'] == 1)
		@include('layouts.themes.theme-corporate.includes._topbar')
	@endif
	@if( @$design_settings['header_show_logo'] == 1 ||
		 @$design_settings['header_show_site_title'] == 1 ||
		 @$design_settings['header_show_site_description'] == 1 ||
		 @$design_settings['header_show_banner'] == 1 )

		@include('layouts.themes.theme-corporate.includes._logo')
	@endif
	@if(@$design_settings['header_show_menu'] == 1)
		@include('layouts.themes.theme-corporate.includes._menu')
	@endif --}}
	<div class="wrapper">
		<div class="ar">
			<div class="ac l50 m50 s50 pv-5">
				
				@if( @$design_settings['header_show_logo'] == 1 ||
					 @$design_settings['header_show_site_title'] == 1 ||
					 @$design_settings['header_show_site_description'] == 1 ||
					 @$design_settings['header_show_banner'] == 1 )
					 @include('layouts.themes.theme-corporate.includes._logo')
				@endif
			</div>
			<div class="ac l50 m50 s50 pv-5">
				
		        @if(@$design_settings['header_show_menu'] == 1)
					@include('layouts.themes.theme-corporate.includes._menu')
				@endif
	        </div>

		</div>
	</div>
</div><!-- .aione-header -->

	