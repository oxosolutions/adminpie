@extends('layouts.app')
@section('content')
	{{-- <form class="modal-body"> --}}
	{!! Form::open(['method' => 'POST','class' => 'modal-body','route' => 'admin.login.post']) !!}
		<div class="text-center">
			<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
			<h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
		</div>

		<div class="form-group has-feedback has-feedback-left">
			{{-- <input type="text" class="form-control" placeholder="Username"> --}}
			{!! Form::email('email',null,['class' => 'form-control' , 'placeholder' => 'Username']) !!}
			<div class="form-control-feedback">
				<i class="icon-user text-muted"></i>
			</div>
		</div>
		<div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }} has-feedback-left">
			{{-- <input type="text" class="form-control" placeholder="Password"> --}}
			{!! Form::password('password',['class' => 'form-control' , 'placeholder' => 'Password']) !!}
			@if ($errors->has('email'))
	            <span class="help-block">
	                <strong>{{ $errors->first('email') }}</strong>
		        </span>
	        @endif
	        
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>

		<div class="form-group login-options">
			<div class="row">
				<div class="col-sm-6">
					<label class="checkbox-inline">
						{!! Form::checkbox('remember',null,['class' => 'styled' ,  'checked' => 'checked']) !!}
						Remember
					</label>
				</div>

				<div class="col-sm-6 text-right">
					<a href="">Forgot password?</a>
				</div>
			</div>
		</div>

		<div class="form-group">
			
			{!! Form::button('Login<i class="icon-arrow-right14 position-right"></i>',['type'=> 'submit','class' => 'btn bg-blue btn-block']) !!}
		</div>

		<div class="content-divider text-muted form-group"><span>or sign in with</span></div>
			<ul class="list-inline form-group list-inline-condensed text-center">
				<li><a href="#" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>
				<li><a href="#" class="btn border-pink-300 text-pink-300 btn-flat btn-icon btn-rounded"><i class="icon-dribbble3"></i></a></li>
				<li><a href="#" class="btn border-slate-600 text-slate-600 btn-flat btn-icon btn-rounded"><i class="icon-github"></i></a></li>
				<li><a href="#" class="btn border-info text-info btn-flat btn-icon btn-rounded"><i class="icon-twitter"></i></a></li>
			</ul>
	{!! Form::close() !!}
@endsection