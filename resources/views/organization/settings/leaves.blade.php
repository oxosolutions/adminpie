@extends('layouts.main')
@section('content')
@include('organization.settings._header')
@include('common.pagecontentstart')
		@include('common.page_content_primary_start')
			@include('organization.settings._tabs')
{{-- 	{!!Form::model($model,['route'=>'save.organization.settings','method'=>'POST','files'=>true])!!} --}}
		{!!FormGenerator::GenerateSection('leasetsec1',['details'=>'You can change your organization settings like email, title and logo.','title'=>'Settings'])!!}
	{{-- {!!Form::close()!!} --}}
	@include('common.page_content_primary_end')
		@include('common.page_content_secondry_start')
		@include('common.page_content_secondry_end')
	@include('common.pagecontentend')
@endsection