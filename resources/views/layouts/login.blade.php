@php
$login_theme = @get_organization_meta('login_theme');
$login_style = @get_organization_meta('login_style');
$site_title = @get_organization_meta('title');
$site_tagline = @get_organization_meta('tagline');
$bg_image = @get_organization_meta('bg_image');
$login_footer_content = @get_organization_meta('login_footer_content');

if(empty(@$site_title)){
	$site_title = @strip_tags ( @env('GROUP_LOGIN_TITLE') );
}
if(empty(@$login_theme)){
	$login_theme = 'clean';
}

@endphp
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>{!! @$site_title !!}</title>

	<!-- Global stylesheets --> 
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css?ref='.rand(544,44)) }}">
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.aioneframework.com/assets/css/aione.min.css"> --}}

	@if(@$bg_image)	
		<style type="text/css">
			.login-background, .login-theme-darlic .login-background{
				background: url( {{ asset(@$bg_image) }} );
			}
		</style>
	@endif
	
</head>
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide no-header no-sidebar login-theme-{{@$login_theme}} login-style-{{@$login_style}}">
		<div class="aione-row">
			<div id="aione_main" class="aione-main">
				<div class="aione-row">
					<div id="aione_content" class="aione-content">
						<div class="aione-row">
							<div class="login-background">
							</div>
							<div class="login-wrapper" >
								<div class="aione-row" >
									<div class="login-form">
										@include('common.auth-header')
										@yield('content')	
									</div>
								</div>
							</div>
							<div class="login-footer" >
								<div class="aione-row" >
									{!! @$login_footer_content !!}
								</div> 
							</div>
						</div><!-- .aione-row -->
					</div><!-- #aione_content -->
					<div class="clear"></div><!-- .clear -->
				</div><!-- .aione-row -->
			</div><!-- #aione_main -->
			<div class="clear"></div><!-- .clear -->
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->

</body>
</html>


