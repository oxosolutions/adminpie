@extends('layouts.main')
@section('content')
	<div class="row">
		<div class="col l12">
			<h5>Edit Details</h5>
			<div>
			{!! Form::model($page,['route'=>'update.page' ])!!}
				@include ('organization.pages._form')
			{!! Form::close()!!}
			</div>
		</div>
		
	</div>
@endsection()