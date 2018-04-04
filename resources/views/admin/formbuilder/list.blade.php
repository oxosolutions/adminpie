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
$title = (@$title != '')?$title:__('forms.form_page_title_text');
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => $title,
	'add_new' => ($title == 'Survey')?__('forms.add_survey_button_text'):__('forms.add_form_button_text'),
	'route' => ($title == 'Survey')?'create.survey':$route,
	'second_button_title' => ($title == 'Survey')?__('forms.import_survey_button_text'):__('forms.import_form_button_text'),
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
