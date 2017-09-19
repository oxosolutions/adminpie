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
				{!! FormGenerator::GenerateForm('organization_user_registration_form',['type'=>'inset'])!!}

			{!! Form::close() !!}
		
@include('common.page_content_primary_end')

	
@endsection