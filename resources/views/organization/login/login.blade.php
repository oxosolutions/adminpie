@php
    $layout = 'layouts.login';
    $login_theme = @get_organization_meta('login_theme');
    if(@$login_theme == 'front'){
	    $layout = 'layouts.front';
    }
@endphp

@extends($layout)
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
			{!! Form::hidden('back_to',@request()->backto) !!}
			{!! FormGenerator::GenerateForm('organization_user_login_form')!!}
            @if($forgetPassword == 1)
    			<div class="aione-align-center" style="margin: 10px 0 20px 0">
    				Have you forgotten your password? <br>
    				<a class="aione-login-reset-password-link display-block bold" href="{{ route('forgot.password') }}">Reset your password</a>
    			</div>
            @endif
            {{-- <div style="width:100%; text-align: center;">
                <a href="{{ route('social.login','github') }}"><img src="https://assets-cdn.github.com/images/modules/logos_page/Octocat.png" style="width: 9.5%;" /></a>
                <a href="{{ route('social.login','facebook') }}"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/F_icon.svg/2000px-F_icon.svg.png" style="width: 9%;" /></a>
                <a href="{{ route('social.login','twitter') }}"><img src="https://hivedigitalstrategy.com/wp-content/uploads/2014/05/twitter-logo-transparent.png" style="width: 9%;" /></a>
            </div> --}}
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