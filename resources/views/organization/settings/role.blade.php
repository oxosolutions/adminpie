@extends('layouts.main')

@section('content')

	@include('organization.settings._tabs')
{{-- 	{!!Form::model($model,['route'=>'save.organization.settings','method'=>'POST','files'=>true])!!} --}}
		{!!FormGenerator::GenerateSection('rolsetsec1',['details'=>'You can change your organization settings like email, title and logo.','title'=>'Settings'])!!}
	{{-- {!!Form::close()!!} --}}
@endsection