@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col l2">
		<div class="card shadow p-10">
			<img src="{{asset('assets/images/Employee1.png')}}" style="width:152px">
			<div class="form-group row valign-wrapper">
				<div class="col l3">
					{!!Form::label('name', 'Name:', ['class' => ' control-label']);
			!!}
				</div>
				<div class="col l9">
					{!! Form::text('name', null, array('required','class'=>'form-control')) !!}
				</div>
			</div>
			<div class="row center-align">
				<div class="col l3">
					Type:
				</div>
				<div class="col l9">
					admin
				</div>
			</div>
		</div>
	</div>
	<div class="col l8">
		<div class="card shadow p-10">
			<div class="row" style="margin-bottom: 10px">
				<div class="col l6">
					<h6>Basic Information</h6>	
				</div>
				<div class="col l6 right-align">
					<a class="btn" href="#">VIEW</a>
				</div>
			</div>
			<div class="divider"></div>
			<div class="form-group row valign-wrapper">
				<div class="col l3">
					{!!Form::label('email', 'Email:', ['class' => ' control-label']);
			!!}
				</div>
				<div class=" col l9">
					{!! Form::text('name', null, array('required','class'=>'form-control')) !!}
				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					{!!Form::label('phone', 'Phone:', ['class' => 'control-label']);!!}
				</div>
				<div class=" col l9">
					{!!Form::number('phone',null,['class' => 'form-control'])!!}
				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					{!!Form::label('dob', 'Date of Birth:', ['class' => 'control-label']);!!}
				</div>
				<div class=" col l9">
					{!!Form::date('dob',null,['class' => 'datepicker'])!!}
				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					{!!Form::label('gender', 'Gender:', ['class' => 'control-label']);!!}
				</div>
				<div class=" col l9">
					{!!Form::text('gender',null,['class' => 'form-control'])!!}
				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					{!!Form::label('address', 'Address:', ['class' => 'control-label']);!!}
				</div>
				<div class=" col l9">
					{!!Form::text('address',null,['class' => 'form-control'])!!}
				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					{!!Form::label('country', 'Country:', ['class' => 'control-label']);!!}
				</div>
				<div class=" col l9">
					{!!Form::text('country',null,['class' => 'form-control'])!!}
				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					{!!Form::label('state', 'State:', ['class' => 'control-label']);!!}
				</div>
				<div class=" col l9">
					{!!Form::text('state',null,['class' => 'form-control'])!!}
				</div>
			</div>
		
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					{!!Form::label('city', 'City:', ['class' => 'control-label']);!!}
				</div>
				<div class=" col l9">
					{!!Form::text('city',null,['class' => 'form-control'])!!}
				</div>
			</div>
			<div class="col l12 form-group valign-wrapper">
				<div class="col l3">
					{!!Form::label('zip', 'Zip:', ['class' => 'control-label']);!!}
				</div>
				<div class=" col l9">
					{!!Form::number('zip',null,['class' => 'form-control'])!!}
				</div>
			</div>
			<div class="row l12 right-align">
				<a class="btn" href="#">save</a>
			</div>
			<div style="clear: both">
				
			</div>
		</div>
			
		</div>
	</div>
	<div class="col l2">
		<div class="card shadow p-10">
			<div class="row" style="margin-bottom: 10px">
				<div class="col l12">
					<h6>Settings</h6>
				</div>
			</div>
			<div class="divider"></div>
			<div class="center-align">
				<a href="">Remove as employee</a>
			</div>
		</div>
	</div>
</div>
@endsection()