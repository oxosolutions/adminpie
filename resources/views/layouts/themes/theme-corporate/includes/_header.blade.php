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
				<a href="http://aioneframework.com" target="_blank"><img src="http://aioneframework.com/resources/logo/aione-framework-logo-small.png" class="aione-float-left" style="height:40px;"></a>
			
			</div>
			<div class="ac l50 m50 s50 pv-5">
				<nav id="aione_nav" class="aione-nav horizontal slide-up">
					<ul id="aione_menu" class="aione-menu aione-float-right">
						<li class="aione-nav-item level0"><a href="index.html"><span class="nav-item-text" data-hover="Home">Home</span></a></li>
						<li class="aione-nav-item level0"><a href="about.html"><span class="nav-item-text" data-hover="About">About</span></a></li>
						<li class="aione-nav-item level0"><a href="http://aioneframework.com/docs" target="_blank"><span class="nav-item-text" data-hover="Docs">Docs</span></a></li>
						<li class="aione-nav-item level0"><a href="http://aioneframework.com/play" target="_blank"><span class="nav-item-text" data-hover="Play">Play</span></a></li>
						<li class="aione-nav-item level0"><a href="http://aioneframework.com/builder" target="_blank"><span class="nav-item-text" data-hover="Builder">Builder</span></a></li>
					</ul>
		        </nav>
	        </div>
		</div>
	</div>
</div><!-- .aione-header -->

	