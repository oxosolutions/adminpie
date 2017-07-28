<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
</head>
<body>
	<div class="row valign-wrapper" style="margin-bottom: 0px;height: 100vh">
		<div class="col l8 grey lighten-1 login-bg" style="height: 100vh">
			
		</div>
		<div class="col l4 login-form">
			<div class="center-align brand-name">
				Admin<span>Pie</span>
			</div>
			<div class="row">
				<span class="heading">Sign in to your account</span>
			</div>
			<div>
				<input type="email" name="" placeholder="Enter Username">
			</div>
			<div>
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
			<a href="" class="btn blue full-width" >Sign In</a>
			<div>
				© 2017, All Right Reserved. OXO solutions
			</div>	
		</div>
			
			
		
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
     <style type="text/css">
     	.heading{
     		font-size: 18px;

     	}
     	.full-width{
     		width: 100%
     	}
     	.login-form{
     		height: 100vh;    box-shadow: 0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12);padding: 120px 60px !important;
     	}
     	.forgot-password{
     		line-height: 55px
     	}
     	.login-form .brand-name{
     		font-size: 26px;
   			font-weight: 900;
    		color: grey;
    		margin-bottom: 20px
   
     	}
     	.login-form .brand-name > span{
     		color: #03A9F4;
     	}
     	.login-bg{
     		background-image: url('{{asset('images/coloured-gradient.jpg') }}');
 		    background-size: cover;
     	}
     </style>
</body>
</html>