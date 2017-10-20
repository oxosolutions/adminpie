@if(Auth::guard('admin')->check() == true)
	@php
		$layout = 'admin.layouts.main';
		$route = 'update.custom.map';
	@endphp
@else
	@php
		$layout = 'layouts.main';
		$route = 'org.update.custom.map';
	@endphp
@endif
@extends($layout)
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Custom Maps',
	'add_new' => '+ Add Custom Map'
);
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	{{-- @include('common.list.datalist') --}}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	{!! Form::model($model,['route'=>[$route,$model->id]]) !!}
		{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Custom Map','button_title'=>'Save','section'=>'custommapsection']]) --}}
			<input type="hidden" name="id" value="{{$model->id}}">
			<input type="hidden" name="type" value="{{$model->type}}">
			{!!FormGenerator::GenerateSection('custommapsection')!!}
			<input type="submit" value="submit">
	{!!Form::close()!!}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection