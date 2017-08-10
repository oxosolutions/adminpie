@extends('layouts.app')
@section('content')
<div class="row " style="margin-bottom: 0px;height: 100vh">
	<div class="col l8 m6 grey lighten-1 left hide-on-small-only" style="padding: 0px">
		
	</div>
	<div class="col l4 m6 s12 login-form" style="">
		<style type="text/css">
			.login-form{
				    padding: 32px 32px 32px 32px !important;
			}
		</style>
		@if (Session::has('success'))
		 <div class="alert alert-info">{{ Session::get('success') }}</div>
		@endif

		@if (Session::has('exist_email'))
 				<div class="alert alert-info">{{ Session::get('exist_email') }}</div>
		@endif
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
			{!! Form::open(['route'=>'signup.user'])!!}
			<div class="row">
				<span class="display-1">Register</span>

			</div>
			<div class="sub-title">
				Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy.
			</div>
			
			<div class="row login-fields">
				
				<input type="text" name="name" placeholder="Name">
			</div>
			<div class="row login-fields">
				
				<input type="email" name="email" placeholder="Username">
			</div>
			<div class="row login-fields">
				
				<input type="password" name="password" placeholder="Password">
			</div>
			<div class="row login-fields">
				
				<input type="password" name="confirm-password" placeholder="Confirm Password">
			</div>
			
			<div class="row">
				<div class="col l7 m7 s6">
					<a style="line-height: 34px" href="{{ route('org.login.post') }}">Go to Login page</a>
				</div>
				<div class="col l5 m5 s6 right-align">
					<button type="submit">Register Now</button>	
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>

	
@endsection