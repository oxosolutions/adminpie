@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

	@if(Session::has('login_fails'))
	<div class="row error">
		<span><i class="fa fa-ban"></i></span>
		{{Session::get('login_fails')}}<a href="">recover your password</a> 
	</div>
	@endif
	@if(Session::has('password-changed'))
	<div class="row error">
		<span><i class="fa fa-ban"></i></span>
		{{Session::get('password-changed')}}<a href="">recover your password</a> 
	</div>
	@endif
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => 'org.login.post']) !!}
		
		{!! FormGenerator::GenerateForm('organization_user_login_form',['type'=>'inset'])!!}
			<div class="aione-align-center" style="margin: 10px 0 20px 0">
				Have you forgotten your password? <br>
				<a class="aione-login-reset-password-link display-block bold" href="{{ route('forgot.password') }}">Reset your password</a>
			</div>
			<div class="aione-align-center">
				If you do not have a user account?
				<a class="aione-login-signup-link display-block bold" href="{{ route('register') }}">Signup Here</a>
			</div>
			@if(session()->has('csrf_error'))
				<div style="text-align: center; color: red;">{{session('csrf_error')}}</div>
			@endif
	{!!Form::close()!!}


		{{-- @include('components._footer') --}}

	</div>

@include('common.page_content_primary_end')
@include('common.pagecontentend')
@endsection