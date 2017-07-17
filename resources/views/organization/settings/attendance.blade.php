@extends('layouts.main')

@section('content')

	@include('organization.settings._tabs')
{{-- 	{!!Form::model($model,['route'=>'save.organization.settings','method'=>'POST','files'=>true])!!} --}}
		{!!FormGenerator::GenerateSection('attsetsec1')!!}
	{{-- {!!Form::close()!!} --}}
@endsection