<!DOCTYPE html>
<html lang="en">
@php
	$site_logo = App\Model\Organization\OrganizationSetting::getSettings('logo');
	$site_title = App\Model\Organization\OrganizationSetting::getSettings('title');

@endphp
	@php
		$slug = request()->route()->parameters();
		$meta = [];
	@endphp
	@if(@$slug['slug'])
		@php
			$data = App\Model\Organization\Page::where('slug',$slug)->with('pageMeta')->first();
		@endphp
		@foreach(@$data->pageMeta->toArray() as $k => $v)
			@php
				$meta[$v['key']] = $v['value'];
			@endphp
		@endforeach
	@endif

	@if(@$meta['select_menu'])
		@php
			$menu = App\Model\Organization\Cms\Menu\Menu::where('id',$meta['select_menu'])->with('menuItem')->get();

			
		@endphp
	@endif
@include('layouts.front._head')
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-theme-arcane">
		<div class="aione-row">
			@if(@$meta['show_topbar'] == 1)
				@include('layouts.front._topbar')
			@endif
			@if(@$meta['show_header'] == 1)
				@include('layouts.front._header')
			@endif
			<div id="aione_main" class="aione-main ">
				<div class="aione-row">
					<div id="aione_sidebar" class="aione-sidebar">
						<div class="aione-row">
							@if(@$meta['show_sidenav'] == 1)
								@include('layouts.front._sidebar')
							@endif
						</div><!-- .aione-row -->
					</div><!-- #aione_sidebar -->
					<div id="aione_content" class="aione-content" >
						<div class="aione-row">
					        @yield('content')
							{{-- @yield('pagetitle') --}}
              				<div class="clear"></div><!-- .clear -->							
							{{-- @include('components._footer') --}}
						@if(@$meta['show_footer'] == 1)
							@include('layouts.front._footer')
						@endif
						</div><!-- .aione-row -->
					</div><!-- #aione_content -->
					<div class="clear"></div><!-- .clear -->
					<div class="clear"></div><!-- .clear -->
				</div><!-- .aione-row -->
			</div><!-- #aione_main -->
			<div class="clear"></div><!-- .clear -->
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->
	
	@include('components._footerscripts')

</body>
</html>