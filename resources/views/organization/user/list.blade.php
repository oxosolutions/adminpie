@extends('layouts.main')
@section('content')
	
<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
			
			<div class="list">
				<div class="col s12 m9 l12 pr-7" style="margin-top: 14px">
			
					@include('common.list.datalist')

				</div>
			</div>
		</div>

		<div class="col s12 m3 l12 pl-7" >
			<a href="#modal1"  class="btn" >
				Add New User
			</a>
			{!! Form::open(['method' => 'POST','class' => '','route' => 'store.user']) !!}
			@include('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add new user','button_title'=>'Save User','section'=>'usesec1']])
			{!! Form::close() !!}
	{{-- 		<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['method' => 'POST','class' => '','route' => 'store.user']) !!}
					<div class="col s12 m2 l3 aione-field-wrapper">
						<div class="form-group">
							{!!Form::select('user_type[]',App\Model\Organization\UsersType::userTypes(), null, ['class'=>'select2','style'=>'display:block','multiple'=>'multiple','data-placeholder'=>'Select User type'])!!}
						</div>
					</div>
					<div class="col s12 m3 l3 aione-field-wrapper">
						<div class="form-group">
							{!! Form::text('name', null, array('required','class'=>'form-control','placeholder'=>'Enter your name')) !!}
						</div>
					</div>
					<div class="col s12 m3 l3 aione-field-wrapper">
						<div class="form-group">					
							 {!! Form::text('email', null, array('required','class'=>'form-control','placeholder'=>'Your e-mail address')) !!}
						</div>
					</div>
					<div class="col s12 m3 l3 aione-field-wrapper">
						 {!! Form::password('password', array('required','class'=>'form-control','placeholder'=>'Enter password')) !!}
					</div>
					<div class="col s12 m3 l3 aione-field-wrapper right-align pt-10">
						<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action">Save User
							<i class="material-icons right">save</i>
						</button>
					</div>
					{!! Form::close() !!}

			</div> --}}
			
		</div>
	</div>
</div>



@endsection



