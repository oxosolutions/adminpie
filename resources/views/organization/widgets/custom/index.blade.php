@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Widgets',
    'add_new' => '+ Add Widget',
    'route' => 'create.widgets'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
        @include('common.list.datalist')
    @include('common.page_content_primary_end')
@include('common.pagecontentend')

    
@endsection