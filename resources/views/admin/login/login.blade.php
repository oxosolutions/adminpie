@extends('layouts.app')
@section('content')
	{{-- <form class="modal-body"> --}}
{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => ['login.post']]) !!}

<div class="" style="">
	<div class="container-body">
		<div class="form">
		{{-- <h1 class="center white">Login</h1> --}}
		<h1 class="center white">Login to your account <small class="display-block">Your credentials</small></h1>
				{{-- <input type="text" name="" placeholder="Username"> --}}
			<div class="has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
				{!! Form::email('email',null,['class' => 'form-control' , 'placeholder' => 'Username']) !!}			
				@if ($errors->has('email'))
		            <span class="help-block">
		                <strong>{{ $errors->first('email') }}</strong>
			        </span>
		        @endif
			</div>
			<div class="has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
				{!! Form::password('password',['class' => 'form-control' , 'placeholder' => 'Password']) !!}			
				@if ($errors->has('email'))
		            <span class="help-block">
		                <strong>{{ $errors->first('email') }}</strong>
			        </span>
		        @endif
			</div>
				
				{{-- <input type="password" name="" placeholder="Password"> --}}
				{!! Form::button('Let me Signin...<i class="icon-arrow-right14 position-right"></i>',['type'=> 'submit','class' => 'btn bg-blue btn-block submit']) !!}
				{{-- <input type="submit" class="submit" name="submit" value="Let me Signin... "> --}}
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection
<style type="text/css">
	input{
		background-color: #D1D2EA;
		padding: 10px;
		border:none;
		color: #292A3C;
		width: 300px;
		margin-top:10px !important;
		font-size: 16px;
	}
	.form{
		width: 320px;
	}
	.center{
		text-align: center;
	}
	.white{
		color: white;
	}
	.submit{
		background-color: #609EDA;
		width: 320px;
		font-size: 16px;
		color: white;
		margin-top: 10px !important
	}
	.form{
		margin: 0px auto;
	}
	.login-container .page-container .login-form {
	    width: 400px !important;
	}
	.login-cover{
		background:url({{asset('images/new-york-background.jpg')}}) !important;
		background-size:100% !important;
		background-repeat: no-repeat !important;
	}
	.panel{
		background-color: transparent !important;
		border:0px !important;
	}
	.form h1{
		font-size: 30px;
		font-family: Lucida Sans Unicode;
	}
</style>