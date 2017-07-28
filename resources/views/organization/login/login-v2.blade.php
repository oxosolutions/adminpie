<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
	<!--Import materialize.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
</head>
<body style="overflow-y: hidden;">
	<div class="row " style="margin-bottom: 0px;height: 100vh">
		<div class="col l8 grey lighten-1 left hide-on-small-only">
			<div class="row valign-wrapper" style="margin-bottom: 0px;height: 100vh">
				<div style="background-color: rgba(0, 0, 0, 0.3);padding: 40px;">
					<h2>Lorem ipsum</h2>
					<p>Vivamus sit amet turpis id tellus dapibus fermentum et in nibh. Donec volutpat neque et lorem semper pellentesque. Integer a pellentesque justo. Duis ut suscipit eros</p>	
					<div class="row">
						<a href="#" data-target="modal1" class="waves-effect btn blue">Learn More</a>
						<a href="#modal1" data-target="modal1" class="waves-effect waves-teal btn-flat" style="color: white;border: 1px solid;margin-left: 10px">Our Features</a>
						<div id="modal1" class="modal modal-fixed-footer">
						
						    <div class="modal-content">
								<h4>Modal Header</h4>
								<p>A bunch of text</p>
						    </div>
						    <div class="modal-footer">
								<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
						    </div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col l4 m4 s12 login-form" style="overflow-y: scroll">
			<div class="row center-align brand-name">
				Admin<span>Pie</span>
			</div>
			{{-- <div class="row error">
				<span><i class="fa fa-ban"></i></span>
				Sorry, that password isn't right. We can help you <a href="">recover your password</a> 
			</div>
			<div class="row error-1">
				<span><i class="fa fa-ban"></i></span>
				Whoops, looks like you forgot your password there  
			</div> --}}
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
     	html, body {
   height: 100%;
   width: 100%;
   margin: 0;
   padding: 0;
}
     	.heading{
     		font-size: 18px;

     	}
     	.full-width{
     		width: 100%
     	}
     	.login-form{
     		height: 100%;    box-shadow: 0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12);padding: 100px 60px !important;
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
     	.left{
     		height: 100%;
     		background-image: url('{{ asset('images/bg-v2.jpg') }}');
     		color: white;

     	}
     	.login-fields{
     		position: relative;
     	}
     	.login-fields i{
     		position: absolute;
		    left: 10px;
		    color: #808080;
		    font-size: 22px;
		    line-height: 46px;
     	}
     	.login-fields input{
     		padding-left: 38px !important;
     	}
     	.error{
     		background-color: #FED0C8;
     		    padding: 14px;

     	}
     	.error-1{
     		background-color: #FFEFBE;
     		    padding: 14px;

     	}
     </style>
   	<script type="text/javascript">
   		 $(document).ready(function(){
		    $('.modal').modal();
		  });
          
   	</script>
</body>
</html>