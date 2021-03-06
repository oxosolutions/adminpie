@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

<div> 
	<div class="aione-row">
		<div class="site-logo">
		</div>
		<div class="site-title">
			{!! env('ADMIN_LOGIN_TITLE') !!}
		</div>
		<div class="site-tagline">
			{!! env('ADMIN_LOGIN_DESCRIPTION') !!}
		</div>
	@if(Session::has('login_fails'))
	<div class="row error">
		<span><i class="fa fa-ban"></i></span>
		{{Session::get('login_fails')}}<a href="">recover your password</a>
	</div>
	@endif
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => 'org.login.post']) !!}
	{!! FormGenerator::GenerateForm('organization_user_login_form')!!}
	@if(session()->has('csrf_error'))
		<div style="text-align: center; color: red;">{{session('csrf_error')}}</div>
	@endif
	{!!Form::close()!!}

	<div id="aione_footer" class="aione-footer">
		<div class="wrapper">
			{!! env('ADMIN_LOGIN_COPYRIGHT') !!}
		</div><!-- .aione-row -->
	</div>

	</div>
	</div> 
	<style type="text/css">
	.login-wrapper .site-title {
    	font-size: 26px;
    }
    .login-wrapper .site-tagline{
    	font-size: 18px;
    }
</style>
</div> 
@include('common.page_content_primary_end')
@endsection