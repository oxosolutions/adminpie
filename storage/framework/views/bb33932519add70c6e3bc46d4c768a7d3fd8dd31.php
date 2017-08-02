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
			
			
			<div class="row">
				<span class="heading">Sign in to your account</span>
			</div>
			<div class="row login-fields">
				<i class="fa fa-user"></i>
				<input type="email" name="" placeholder="Enter Username">
			</div>
			<div class="row login-fields">
				<i class="fa fa-unlock-alt"></i>
				<input type="password" name="" placeholder="Enter Password">
			</div>
			<div class="row">
				<div class="col l6">
					<p>
						<input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
						<label for="filled-in-box">Remember me</label>
				    </p>
				</div>
				<div class="col l6 forgot-password right-align">
					<a href="">Forgot Password</a>
				</div>
			</div>
			<div class="row">
				<a href="" class="btn blue full-width sign-in" >Sign In</a>	
			</div>
			<div>
				© 2017, All Right Reserved. OXO solutions
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