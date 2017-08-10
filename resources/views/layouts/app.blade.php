{{-- <!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
	<link href="{{ asset('css/auth-v1-style.css?ref='.rand(544,44)) }}" type="text/css" rel="stylesheet"  />
</head>
<body style="overflow-y: hidden;">
	<div class="row " style="margin-bottom: 0px;height: 100vh">
		<div class="col l8 m6 grey lighten-1 left hide-on-small-only" style="padding: 0px">
			<div class="brand-name">
				ADMIN<span>PIE</span>
			</div>
		</div>
		<div class="col l4 m6 s12 login-form" style="">
			@yield('content')
		</div>
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
</body>
</html>


 --}}










<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
	<link href="{{ asset('css/auth-v1-style.css?ref='.rand(544,44)) }}" type="text/css" rel="stylesheet"  />
</head>
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-theme-arcane">
		<div class="aione-row">
			<div id="aione_main" class="aione-main ">
				<div class="aione-row">
					<div id="aione_content" class="aione-content">
						<div class="aione-row">
							@yield('content')
						</div><!-- .aione-row -->
					</div><!-- #aione_content -->
					<div class="clear"></div><!-- .clear -->
				</div><!-- .aione-row -->
			</div><!-- #aione_main -->
			<div class="clear"></div><!-- .clear -->
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
</body>
</html>
