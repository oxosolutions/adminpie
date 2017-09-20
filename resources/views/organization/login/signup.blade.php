@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	
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
				{!! FormGenerator::GenerateSection('organization_user_registration_form_section_1',['type'=>'inset'])!!}
				<button type="submit">Register</button>
			{!! Form::close() !!}

			<div class="aione-align-center" style="margin: 10px 0 20px 0">
				Have you forgotten your password? <br>
				<a class="aione-login-reset-password-link display-block bold" href="{{ route('forgot.password') }}">Reset your password ?</a>
			</div>
			<div class="aione-align-center">
				Already have a user account?
				<a class="aione-login-signup-link display-block bold" href="/login">Login Here</a>
			</div>
		
@include('common.page_content_primary_end')

	
@endsection