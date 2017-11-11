<!DOCTYPE html>
<html lang="en">
@php

$is_page = $is_post = $is_survey = $is_visualization = 0; 

if(request()->route()->uri == "page/{slug}"){
	$is_page = 1;
}
if(request()->route()->uri == "survey/{token}"){
	$is_survey = 1;
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
	if(request()->route()->uri == "survey/{token}"){
		$token = request()->route()->parameters()['token'];
		$survey_meta = get_survey_meta($token);

		if(@$survey_meta != null && @$survey_meta != ''){
			foreach($survey_meta as $key => $value){
				if(@$design_settings != null && @$design_settings != ''){
					if($value != '' && $value != null){
						$design_settings[$key] = $value;
					}
				}
			}
		}
	}
@endphp
@include('layouts.front._head')

<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-{{@$design_settings['layout']}} aione-theme-arcane">
		<div class="aione-row">
			@if(@$design_settings['show_header'] == 1)
				@include('layouts.front._header')
			@endif
			@if(@$design_settings['show_page_title'] == 1)
				@include('layouts.front._pagetitle')
			@endif
			@if(@$design_settings['show_slider'] == 1)
				@include('layouts.front._slider')
			@endif


			<div id="aione_main" class="aione-main ">
				<div class="aione-row">
					<div id="aione_content" class="aione-content" >
						<div class="aione-row">
					        @yield('content')
              				<div class="clear"></div><!-- .clear -->
						</div><!-- .aione-row -->
					</div><!-- #aione_content -->
					<div class="clear"></div><!-- .clear -->
				</div><!-- .aione-row -->
			</div><!-- #aione_main -->


			@if(@$design_settings['show_footer_widgets'] == 1)
				@include('layouts.front._footer')
			@endif
			@if(@$design_settings['show_copyright'] == 1)
				@include('layouts.front._copyright')
			@endif
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->
	@include('components._footerscripts')
	<script type="text/javascript">
		{!! @$meta['js_code']!!}
	</script>
	{{-- <script type="text/javascript">
		{!! @$design_settings['js_code']!!}
	</script> --}}

</body>

</html>