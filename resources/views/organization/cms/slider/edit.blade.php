@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Create Slider' ,
	'add_new' => 'All Slider',
	'route' => 'create.slider'
	); 
@endphp
@php
	// dump($model->toArray());
	// $index = 0;
	// $data = [];
	// $count = count(json_decode($model->toArray()['files']));
	// // foreach ($model->toArray() as $key => $value) {

		
	// // 	$data['name'] = $value['name'];
	// // 	$data['description'] = $value['description'];
	// // 	$data['file'] = json_decode($value['files'])[$index];
	// // 	$data['heading'] = json_decode($value['heading'])[$index];
	// // 	$data['subheading'] = json_decode($value['subheading'])[$index];
	// // 	$index++;
	// // }
	// 	$data['title'] = $model['name'];
	// 	$data['description'] = $model['description'];
	// for ($i=0; $i < $count ; $i++) { 
		
	// 	$data['sliderform'][$i]['file'] = json_decode($model['files'])[$i];
	// 	$data['sliderform'][$i]['heading'] = json_decode($model['heading'])[$i];
	// 	$data['sliderform'][$i]['subheading'] = json_decode($model['subheading'])[$i];
	// }
	// dump($data);
	dd($model);
	$slider = $model['slider'];
	unset($model['slider']);
	$model['slider'] = json_decode($slider);

@endphp 
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

	@if($model != '')
		{!! Form::model($model,['route' => 'save.slider' , 'method' => 'post' ,'files' => true]) !!}
	@else

	@endif
	{!! Form::open(['route' => 'save.slider' , 'method' => 'post' ,'files' => true]) !!}
		{!! FormGenerator::GenerateForm('create_slider_form') !!}
		<button type="submit"> Save </button>
	{!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection