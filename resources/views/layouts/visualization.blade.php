<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Visualizations | SMAART&trade; Framework</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="{{asset('/css/visualization-style.css')}}">
		@include('components._head')
		<script type="text/javascript">
			function route(){

				return '{{url('/')}}';
			}
		</script>
	</head>
	<body>
		@yield('content') 
	</body>
	@include('components._footerscripts')
	<script type="text/javascript" src="{{asset('js/common.js')}}"></script>
</html>
