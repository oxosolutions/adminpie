@extends('admin.layouts.main')
@section('content')
@include('admin.settings._tabs')
	{!!Form::open(['route'=>'save.settings','method'=>'POST'])!!}
		{!!FormGenerator::GenerateSection('setsec3',[],$model)!!}
		<input type="hidden" name="key" value="department">
		<button type="submit" class="btn blue">Save</button>
	{!!Form::close()!!}
@endsection