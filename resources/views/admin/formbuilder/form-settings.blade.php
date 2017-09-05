@if(Auth::guard('admin')->check() == true)
	@php
		$layout = 'admin.layouts.main';
		$route = 'save.form.settings';
	@endphp
@else
	@php
		$layout = 'layouts.main';
		$route = 'org.save.form.settings';
	@endphp
@endif
@extends($layout)
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Form Settings',
	'add_new' => '+ Apply leave'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('admin.formbuilder._tabs')
	{!!Form::model(@$model,['route'=>[$route,@$model['id']]])!!}
		{!! FormGenerator::GenerateForm('form_setting_form',['type'=>'inset']) !!}
	{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection