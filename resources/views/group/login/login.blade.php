@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

<div> 
	<div class="aione-row" >
		<div class="site-logo" >
		</div>
		<div class="site-title" >
			Login
		</div>
		<div class="site-tagline" >
		</div>
	@if(Session::has('login_fails'))
		<div class="aione-message error">
			{{Session::get('login_fails')}} 
		</div>
	@endif
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => 'group.post']) !!}
	{!! FormGenerator::GenerateForm('group_login_form',['type'=>'inset'])!!}
	@if(session()->has('csrf_error'))
		<div style="text-align: center; color: red;">{{session('csrf_error')}}</div>
	@endif
	{!!Form::close()!!}

	{{-- @include('components._footer') --}}

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
</style>
@include('common.page_content_primary_end')
@endsection