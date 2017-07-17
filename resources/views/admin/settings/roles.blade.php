@extends('admin.layouts.main')
@section('content')
@include('admin.settings._tabs')
	{!!Form::open(['route'=>'save.settings','method'=>'POST'])!!}
		{!!FormGenerator::GenerateSection('setsec5',[],$model)!!}
		<input type="hidden" name="key" value="role">
		<button type="submit" class="btn blue">Save</button>
	{!!Form::close()!!}
@endsection