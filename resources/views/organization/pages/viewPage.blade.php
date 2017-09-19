@extends('layouts.front')
@section('content')
	Titie = {{ $pageData->title }}<br>
	slug = {{ $pageData->slug }}<br>
	Description = {{ $pageData->description }}<br>
	{{-- content = {{ $pageData->content }}<br> --}}

{!! $pageData->content !!}
@endsection()
