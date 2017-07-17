@extends('admin.layouts.main')
@section('content')
@include('admin.settings._tabs')
	{{-- {!!Form::open(['route'=>'save.settings.designation','method'=>'POST'])!!}
		{!!FormGenerator::GenerateSection('setsec2',[],$model)!!}
		<button type="submit" class="btn blue">Save</button>
	{!!Form::close()!!} --}}
	{!!FormGenerator::GenerateSection('setsec6',[],$model)!!}
@endsection