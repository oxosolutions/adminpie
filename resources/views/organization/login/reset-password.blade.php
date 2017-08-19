@extends('layouts.login')
@section('content')
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div class="login-wrapper">
	<div class="aione-row">
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => 'update.pass']) !!}
		
		{!! FormGenerator::GenerateForm('organization_user_reset_password_form',['type'=>'inset'])!!}

		{{-- <div class="form-group has-feedback has-feedback-left">
			
			{!! Form::password('password',['class' => 'form-control' , 'placeholder' => 'Password']) !!}
			@if ($errors->has('password'))
	            <span class="help-block">
	                <strong>{{ $errors->first('password') }}</strong>
		        </span>
	        @endif
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>
		<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }} has-feedback-left">
		
			{!! Form::password('confirmPassword',['class' => 'form-control' , 'placeholder' => 'Confirm Password']) !!}
			@if ($errors->has('confirmPassword'))
	            <span class="help-block">
	                <strong>{{ $errors->first('confirmPassword') }}</strong>
		        </span>
	        @endif
	        
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>

		

		<div class="form-group">
			
			{!! Form::button('Proceed<i class="icon-arrow-right14 position-right"></i>',['type'=> 'submit','class' => 'btn bg-blue btn-block']) !!}
		</div>

 --}}		
	{!! Form::close() !!}
	</div>		
</div>
@include('common.page_content_primary_end')

	
@endsection