@extends('admin.layouts.main')

@section('content')
	{!!FormGenerator::GenerateForm('org_form')!!}
@endsection