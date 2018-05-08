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
        if($from == 'create_password'){
            $route = 'save.create.password';
        }else{
            $route = 'update.pass';
        }
    @endphp
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => $route]) !!}
        @if($from == 'create_password')
            <h5 class="aione-align-center">Create Password</h5>
        @else
            <h5 class="aione-align-center">Reset Password</h5>
        @endif
		{!! FormGenerator::GenerateForm('organization_user_reset_password_form',['type'=>'inset'])!!}
        {!! Form::hidden('reset_create_token',request()->token) !!}
	{!! Form::close() !!}	
@include('common.page_content_primary_end')	
@endsection