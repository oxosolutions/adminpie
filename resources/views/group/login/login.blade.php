@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

<div> 
	<div class="aione-row" >
		<div class="site-logo" >
		</div>
		<div class="site-title" >
			{!! env('GROUP_LOGIN_TITLE') !!}
		</div>
		<div class="site-tagline" >
			{!! env('GROUP_LOGIN_DESCRIPTION') !!}
		</div>
	@if(Session::has('login_fails'))
		<div class="aione-message error">
			{{Session::get('login_fails')}} 
		</div>
	@endif
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => 'group.post']) !!}
	{!! FormGenerator::GenerateForm('organization_user_login_form')!!}
	@if(session()->has('csrf_error'))
		<div style="text-align: center; color: red;">{{session('csrf_error')}}</div>
	@endif
	{!!Form::close()!!}

	<div id="aione_footer" class="aione-footer">
		<div class="aione-row">
			{!! env('GROUP_LOGIN_COPYRIGHT') !!}
		</div><!-- .aione-row -->
	</div>

	</div>
	</div> 
</div>
<style type="text/css">
	.login-background{
	    background-image: url(assets/images/bg-pattern.png),linear-gradient(to bottom,#168dc5,#096996);
		background-size: auto,auto;
	    background-repeat: repeat,no-repeat;
	    background-attachment: fixed,scroll;
	}
	.login-wrapper .site-title {
    	font-size: 26px;
    }
    .login-wrapper .site-title span{
    	color:#0f79ab;
    }
    .login-wrapper .site-tagline{
    	font-size: 18px;
    }
</style>
@include('common.page_content_primary_end')
@endsection