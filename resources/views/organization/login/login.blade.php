@extends('layouts.app')
@section('content')
@if(Session::has('login_fails'))
	<div class="login-error">
		{{Session::get('login_fails')}}
	</div>
@endif
	{{-- <form class="modal-body"> --}}
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => 'org.login.post']) !!}
		<div class="text-center">
			
			<h5 class="content-group" style="font-size: 26px;font-weight: 900;color: grey;margin-top: 0px">Admin<span style="color: #03A9F4">Pie</span></h5>
		</div>
		
		@if(Session::has('password-changed'))
		<span style="background-color: #CDF3CD;display: inline-block;width: 100%;padding: 10px;">
			{{Session::get('password-changed')}}
			</span>
		@endif
		
		<div class="form-group has-feedback has-feedback-left">
			{{-- <input type="text" class="form-control" placeholder="Username"> --}}
			{!! Form::email('email',null,['class' => 'form-control' , 'placeholder' => 'Username']) !!}
			<div class="form-control-feedback">
				<i class="icon-user text-muted"></i>
			</div>
		</div>
		<div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }} has-feedback-left">
			{{-- <input type="text" class="form-control" placeholder="Password"> --}}
			{!! Form::password('password',['class' => 'form-control' , 'placeholder' => 'Password']) !!}
			@if ($errors->has('email'))
	            <span class="help-block">
	                <strong>{{ $errors->first('email') }}</strong>
		        </span>
	        @endif
	        
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>

		<div class="form-group login-options">
			<div class="row">
				<div class="col-sm-6">
					<label class="checkbox-inline">
						{!! Form::checkbox('remember',null,['class' => 'styled' ,  'checked' => 'checked']) !!}
						Remember
					</label>
				</div>

				<div class="col-sm-6 text-right">
					<a href="{{ route('forgot.password') }}">Forgot password?</a>
				</div>
			</div>
		</div>

		<div class="form-group">
			
			{!! Form::button('Login<i class="icon-arrow-right14 position-right"></i>',['type'=> 'submit','class' => 'btn bg-blue btn-block']) !!}
		</div>

		
	{!! Form::close() !!}
	<div class="footer">
			© 2017, All Right Reserved. <a href="http://oxosolutions.com/" target="_blank"  style="color: white"><span>OXO solutions</span></a>
	</div>
	<style type="text/css">
		.login-cover{
			    background: url('{{ asset('assets/images/cool-bg.jpg') }}') no-repeat;
    background-size: cover;
		}
		.panel-body{
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -160px !important;
			    margin-top: -195px !important;
		}
		.footer{
			    position: fixed;
    bottom: 20px;
    text-align: center;
    color: white;
        background-color: hsla(0,0%,0%,0.3);
    padding: 10px;
		}
		.login-error{
		    background-color: #F7D4D4;
			padding: 10px;
			border-left: 3px solid #E26262;
		}
	</style>
@endsection