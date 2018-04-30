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
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.aioneframework.com/assets/css/aione.min.css"> --}}

	@if(@$bg_image)	
		<style type="text/css">
			.login-background, .login-theme-darlic .login-background{
				background: url( {{ asset($bg_image->value) }} );
			}
		</style>
	@endif
	
</head>
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide no-header no-sidebar login-theme-{{@$login_theme->value}} login-style-{{@$login_style->value}}">
		<div class="aione-row">
			<div id="aione_main" class="aione-main">
				<div class="aione-row">
					<div id="aione_content" class="aione-content">
						<div class="aione-row">
							<div class="login-background">
							</div>
							<div class="login-wrapper" >
								<div class="aione-row" >
									<div class="login-desc">
										<div class="" style="padding: 30px;">
                                            {{-- <div class="font-size-20 mb-10 mt-10 line-height-30 aione-align-center">
                                                Welcome to Lorem ipsum<br><spam class="font-size-16"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In blandit sollicitudin condimentum.</spam>
                                            </div>
                                            
                                            <div class="aione-border-top border-grey border-lighten-2 mv-15">
                                                
                                            </div>
                                            <div class="aione-align-center">
                                                <p class="line-height-22 font-size-17 aione-align-left">Do not have an account yet?</p>
                                                <button class="m-20 " >Register Now</button>
                                            </div>
                                            <div class="border-grey border-lighten-2 aione-border-top mb-15">
                                                
                                            </div>
                                            <div class="aione-align-center">
                                                <p class="line-height-22 font-size-17 aione-align-left">Click on the following button to go back to the website.</p>
                                                <button class="m-20 aione-button"><i class="fa fa-arrow-left mr-10"></i>Go to Website</button>
                                            </div> --}}
                                            <div class="login-site-title">
                                            	Welcome to Lorem ipsum
                                            </div>
                                            <div class="site-description">
                                            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam convallis, leo vel porta placerat, augue nisi sodales enim, dapibus sollicitudin nisl lacus et nulla. Quisque ullamcorper libero nec sagittis accumsan.
                                            </div>
                                        </div>
									</div>
									<div class="login-form">
										@include('common.auth-header')
										@yield('content')	
									</div>
								</div>
							</div>
							<div class="login-footer" >
								<div class="aione-row" >
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


