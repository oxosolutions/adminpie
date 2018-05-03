@php
	if(@$settings != null){
		$login_theme = @$settings->where('key' , 'login_theme')->first();
		$login_style = @$settings->where('key' , 'login_style')->first();
		$Site_title = @$settings->where('key' , 'title')->first();
		$bg_image = @$settings->where('key' , 'bg_image')->first();
		$login_footer_content = @$settings->where('key' , 'login_footer_content')->first();
	}
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>{{@$Site_title->value}}</title>

	<!-- Global stylesheets --> 
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css?ref='.rand(544,44)) }}"> 

	@if(@$bg_image)	
		<style type="text/css">
			.login-background, .login-theme-darlic .login-background{
				background: url( {{ asset($bg_image->value) }} );
			}
		</style>
	@endif
</head>
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide no-header no-sidebar login-theme-{{@$login_theme->value}} login-style-{{@$login_style->value}} 00">
		<div class="wrapper">
			<div id="aione_main" class="aione-main">
				<div class="wrapper">
					<div id="aione_content" class="aione-content">
						<div class="wrapper">
							<div class="login-background">
							</div>

							<div class="login-wrapper" >
								<div class="aione-row" >
									@include('common.auth-header')
									@yield('content')
								</div> 
							</div> 
							<div class="login-footer" >
								<div class="wrapper" >
									{!! @$login_footer_content->value !!}
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


