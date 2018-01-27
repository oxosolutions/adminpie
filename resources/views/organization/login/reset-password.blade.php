@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    
    @php
        if($from == 'create_password'){
            $route = 'save.create.password';
        }else{
            $route = 'reset.password';
        }
    @endphp
	
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => $route]) !!}
        @if($from == 'create_password')
            <h4>Create Password</h4>
        @else
            <h4>Reset Password</h4>
        @endif
		{!! FormGenerator::GenerateForm('organization_user_reset_password_form',['type'=>'inset'])!!}
        {!! Form::hidden('reset_create_token',request()->token) !!}
	{!! Form::close() !!}	

@include('common.page_content_primary_end')

	
@endsection