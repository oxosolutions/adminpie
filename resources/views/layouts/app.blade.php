<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('LTR/default/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/plugins/forms/validation/validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/pages/login_validation.js') }}"></script>
	<script type="text/javascript" src="{{ asset('LTR/default/assets/js/jquery-ui.min.js') }}"></script>

	<!-- /theme JS files -->

</head>

<body class="login-container login-cover">
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="content pb-20">

					<div class="panel panel-body login-form">
						@yield('content')
					</div>

				</div>
			</div>
		</div>
	</div>
</body>
</html>
