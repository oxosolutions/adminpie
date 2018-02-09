@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@php
		$userRegStatus = get_organization_meta('enableuserregisteration');
        $forgetPassword = get_organization_meta('enable_forgot_password');
	@endphp
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
            @if($forgetPassword == 1)
    			<div class="aione-align-center" style="margin: 10px 0 20px 0">
    				Have you forgotten your password? <br>
    				<a class="aione-login-reset-password-link display-block bold" href="{{ route('forgot.password') }}">Reset your password</a>
    			</div>
            @endif
            <div style="width:100%; text-align: center;">
                <img src="https://image.flaticon.com/icons/png/512/25/25231.png" style="width: 10%;" />
                <img src="https://image.flaticon.com/icons/png/512/25/25231.png" style="width: 10%;" />
                <img src="https://image.flaticon.com/icons/png/512/25/25231.png" style="width: 10%;" />
            </div>
			@if(@$userRegStatus != 'no')
				<div class="aione-align-center">
					If you do not have a user account?
					<a class="aione-login-signup-link display-block bold" href="{{ route('register') }}">Signup Here</a>
				</div>
			@endif

			@if(session()->has('csrf_error'))
				<div style="text-align: center; color: red;">{{session('csrf_error')}}</div>
			@endif
	{!!Form::close()!!}

		{{-- @include('components._footer') --}}

	</div>

@include('common.page_content_primary_end')
@include('common.pagecontentend')
@endsection