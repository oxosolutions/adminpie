@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

<div class="login-wrapper" >
<div class="aione-row" >
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
	

<div class="">
				<a href="{{ route('forgot.password') }}">Forgot Password</a>
			</div>
{!!Form::close()!!}

		@include('components._footer')

	</div>
</div> 
</div> 
@include('common.page_content_primary_end')
@endsection