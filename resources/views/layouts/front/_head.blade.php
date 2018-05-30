<head>
	@include('components._head')
	@include('layouts.front._css')
	@if($is_survey)
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/surveys.css?ref='.rand(1111,9999)) }}">
	@endif
	@if($is_visualization)
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/visualizations.css?ref='.rand(1111,9999)) }}">
	@endif
	{!! @$design_settings['custom_content_head']!!}
	<style>
		.my-class{
			display: none;
		}
		{!! @$meta['css_code']!!}
	</style>
	<style>
		{!! @$design_settings['custom_css']!!}
	</style>
</head>