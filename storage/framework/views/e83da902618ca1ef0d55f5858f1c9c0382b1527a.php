<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
	<!--Import materialize.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
	<link href="<?php echo e(asset('css/auth-v1-style.css?ref='.rand(544,44))); ?>" type="text/css" rel="stylesheet"  />
</head>
<body style="overflow-y: hidden;">
	<div class="row " style="margin-bottom: 0px;height: 100vh">
		<div class="col l8 grey lighten-1 left hide-on-small-only" style="padding: 0px">
			
			<div class="  brand-name">
				ADMIN<span>PIE</span>
			</div>
		</div>
		<div class="col l4 m4 s12 login-form" style="">
			
			
			
			<div class="display-1">
				Forgot Password
			</div>
			<div class="sub-title">
				Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy.
			</div>
			<div>
				<input type="email" name="" placeholder="Enter Your Email">
			</div>
			<div>
				<div style="display: inline-block;">
					<a style="line-height: 34px">Go to Login page</a>
				</div>
				<div style="display: inline-block;float: right">
					<button>Reset Password</button>	
				</div>

			</div>
			<div style="position: absolute;bottom: 0;right: 0;padding: 32px;font-size: 13px;color: #a9b5be;">
			Copyright &copy; OXO Solutions 2017
			</div>
		</div>
			
			
		
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
     <style type="text/css">

     </style>
   	<script type="text/javascript">
   		 $(document).ready(function(){
		    $('.modal').modal();
		  });
          
   	</script>
</body>
</html>