@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.category.update';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'category.update';
  @endphp
@endif
@extends($layout)

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simple-iconpicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/simple-iconpicker.min.js') }}"></script>
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Menus : ',
	'add_new' => '+ Add Designation'
); 
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

    {!! Menu::render() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
    {!! Menu::scripts() !!}
@endsection