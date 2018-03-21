@if(Auth::guard('admin')->check() == true)
	@php
		$layout = 'admin.layouts.main';
		$route = 'create.form';
	@endphp
@else
	@php
		$layout = 'layouts.main';
		$route = 'org.create.form';
	@endphp
@endif
@extends($layout)
@section('content')
@php
$title = (@$title != '')?$title:'Forms';
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => $title,
	'add_new' => ($title == 'Survey')?'+ Add Survey':'+ Add Form',
	'route' => ($title == 'Survey')?'create.survey':$route,
	'second_button_title' => ($title == 'Survey')?'Import Survey':'Import Form',
	'second_button_route' => 'import.survey'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
		@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection
