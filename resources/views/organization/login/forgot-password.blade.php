@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	<div class="login-wrapper">
		<div class="aione-row">
			@if(Session::has('forgot-error'))
				<div class="row error">
					<span><i class="fa fa-ban"></i></span>
					{{Session::get('forgot-error')}}
				</div>
			@endif
			<div class="display-1">
				
			</div>
			<div class="sub-title">
				
			</div>
			{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => 'forgot']) !!}
			{{-- <div>
				<input type="email" name="email" placeholder="Enter Your Email">
			</div> --}}
			{!! FormGenerator::GenerateForm('organization_user_forgot_password_form',['type'=>'inset'])!!}
			{{-- <div class="row">
				<div class="col l6">
					<a style="line-height: 34px" href="{{ route('org.login.post') }}">Go to Login page</a>
				</div>
				<div class="col l6 right-align">
					<button type="submit">Reset Password</button>	
				</div>
			</div> --}}
			
			{!! Form::close() !!}
			<div class="copyright">
			Copyright &copy; OXO Solutions 2017
			</div>
		</div>		
	</div>
@include('common.page_content_primary_end')

	
@endsection