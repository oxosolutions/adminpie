<!DOCTYPE html>
<html lang="en">
@php

$user_id = @get_user_id();
if(@$user_id !== null){
	$user_roles_array = @get_user_roles();
	$user_roles = array();
	if(!empty(@$user_roles_array)){
		foreach($user_roles_array as $user_role){
			$user_roles[] = $user_role;
		}
	}
	$user_roles = implode(" ",$user_roles);

	$login_status = 'user-logged-in';
} else {
	$login_status = 'user-not-logged-in';
}


$is_login = $is_page = $is_post = $is_survey = $is_visualization = 0; 
$login_page_class='';
if(
	request()->route()->uri == "login"
	|| request()->route()->uri == "register"
	|| request()->route()->uri == "forgot-password"
	|| request()->route()->uri == "create/password/{token}"
	){
	$is_login = 1;
	$login_style = @get_organization_meta('login_style');
	$login_page_class = 'login-page';
}

if(request()->route()->uri == "page/{slug}"){
	$is_page = 1;
}
if(request()->route()->uri == "survey/{token}"){
	$is_survey = 1;
}
if(request()->route()->uri == "visualization/view/{id}"){
	$is_visualization = 1;
}
if(@$is_visualization){
	$current_id = request()->route()->parameters()['id'];
	$settings = App\Model\Organization\VisualizationMeta::where('visualization_id',$current_id)->get()->toArray();
	if(@$settings != null){
		$visual_settings = [];
		foreach ($settings as $key => $value) {
			$visual_settings[$value['key']] = $value['value'];
		}
	}
	
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
		$meta = $survey_meta;
	}
@endphp

@include('layouts.front._head')

<body>
	<div id="aione_wrapper" data-user-id="{{@$user_id}}" data-user-role="{{@$user_roles}}" class="{{@$login_status}} aione-wrapper aione-layout-{{@$design_settings['layout']}} aione-theme-arcane">
		<div class="aione-row">

			@if(@$design_settings['show_header'] == 1)

				{{-- @if(@$visual_settings['enable_header']  == 1) --}}
					@include('layouts.front._header')
				{{-- @endif --}}
			@endif
			@if(@$design_settings['show_slider'] == 1)
				@include('layouts.front._slider')
			@endif
			@if(@$design_settings['show_page_title'] == 1)
				@include('layouts.front._pagetitle')
			@endif


			<main id="aione_main" class="aione-main {{@$login_page_class}} {{@$login_style}}">
				<div class="aione-row">
					<div id="aione_content" class="aione-content" >
						<div class="aione-row">
					        @yield('content')
              				<div class="clear"></div><!-- .clear -->
						</div><!-- .aione-row -->
					</div><!-- #aione_content -->
					<div class="clear"></div><!-- .clear -->
				</div><!-- .aione-row -->
			</main><!-- #aione_main --> 


			@if(@$design_settings['show_footer_widgets'] == 1)
				{{-- @if(@$visual_settings['show_footer'] == 1) --}}
					@include('layouts.front._footer')
				{{-- @endif --}}
			@endif
			@if(@$design_settings['show_copyright'] == 1)
				{{-- @if(@$visual_settings['enable_copyright']) --}}
					@include('layouts.front._copyright')
				{{-- @endif --}}
			@endif
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->
	@include('components._footerscripts')
	<script >
		{!! @$meta['js_code']!!}
	</script>
	{{-- <script type="text/javascript">
		{!! @$design_settings['js_code']!!}
	</script> --}}

</body>

</html>