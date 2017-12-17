@php
	$is_page = 0;
	if(request()->route()->uri == "page/{slug}"){
		$is_page = 1;
	}

	$design_settings = get_design_settings();
	$design_settings = json_decode(json_encode($design_settings),true);
	if(request()->route()->uri == "page/{slug}"){
		$post_slug = request()->route()->parameters();
		$post = get_post($post_slug,false,true);
		$meta = get_post_meta($post_slug,false,true);

		if(@$meta != null && @$meta != ''){
			foreach($meta as $key => $value){
				if(@$design_settings != null && @$design_settings != ''){
					if($value != '' && $value != null){
						$design_settings[$key] = $value;
					}
				}
			}
		}
	}
@endphp
<!DOCTYPE html>
<html lang="en">
@include('layouts.themes.theme-docs.includes._head')
<body>
	<div id="aione_wrapper" class="aione-wrapper layout-header-top aione-layout-wide aione-theme-corporate">
		<div class="wrapper">
			
			@if(@$design_settings['show_header'] == 1)
				@include('layouts.themes.theme-corporate.includes._header')
			@endif
			<div id="aione_main" class="aione-main fullwidth">
				<div class="wrapper">
					@if(@$design_settings['show_slider'] == 1)
						@include('layouts.themes.theme-docs.includes._slider')
					@endif
					@if(@$design_settings['show_page_title'] == 1)
						@include('layouts.themes.theme-docs.includes._pagetitle')
					@endif
					<div id="aione_content" class="aione-content">
						<div class="wrapper">
							<div id="aione_page_content" class="aione-page-content">
								<div class="wrapper">

									@yield('content')
              						<div class="clear"></div><!-- .clear -->

								</div>
							</div>
						</div><!-- .wrapper -->
					</div><!-- .aione-content -->
					@if(@$design_settings['show_footer_widgets'] == 1)
						@include('layouts.themes.theme-corporate.includes._footer')
					@endif
					@if(@$design_settings['show_copyright'] == 1)
						@include('layouts.themes.theme-docs.includes._copyright')
					@endif
				</div><!-- .wrapper -->
			</div><!-- .aione-main -->

		</div><!-- .wrapper -->
	</div><!-- .aione-wrapper -->
	<script type="text/javascript">
		{!! @$meta['js_code']!!}
	</script>
	<script type="text/javascript">
		{!! @$design_settings['js_code']!!}
	</script>
</body>
</html>