
@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	
		{{-- 	@if (Session::has('success'))
			 <div class="aione-message success">{{ Session::get('success') }}</div>
			@endif

			@if (Session::has('exist_email'))
	 				<div class="aione-message warning">{{ Session::get('exist_email') }}</div>
			@endif --}}
	@php
		$userRegStatus = get_organization_meta('enableuserregisteration');
	@endphp
	
		@if ($errors->any())
		    <div class="aione-message error">
		        <ul class="aione-messages">
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		@if(@$userRegStatus != 'no')
			{!! Form::open(['route'=>'signup.user'])!!}
				{!! FormGenerator::GenerateSection('organization_user_registration_form_section_1',['type'=>'inset'])!!}
				@if(@$form_slug != '' && $form_slug != null)
					{!! FormGenerator::GenerateForm($form_slug,['type'=>'inset'],[],'org')!!}
				@endif

				@if($settings->where('key' ,'user_role_default') != '' && !$settings->where('key' ,'user_role_default')->isEmpty())
					@if( $settings->where('key' ,'user_role_default')->first()->value != null)
						<input type="hidden" name="role" value="{{$settings->where('key' ,'user_role_default')->first()->value}}">
					@else
						<input type="hidden" name="role" value="2">
					@endif
				@endif

			<button type="submit">Register1</button>
			{!! Form::close() !!}
		@else
			<div class="aione-border font-size-20 aione-align-center mv-100" style="padding: 20px;">
				{{__('auth.registration_disabled')}}
			</div>
		@endif
		<div class="aione-align-center" style="margin: 10px 0 20px 0">
			Have you forgotten your password? <br>
			<a class="aione-login-reset-password-link display-block bold" href="{{ route('forgot.password') }}">Reset your password</a>
		</div>
		<div class="aione-align-center">
			Already have a user account?
			<a class="aione-login-signup-link display-block bold" href="/login">Login Here</a>
		</div>
	
@include('common.page_content_primary_end')

	
@endsection