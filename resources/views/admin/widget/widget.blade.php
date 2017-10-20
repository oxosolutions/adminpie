@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Add Widget',
    'add_new' => 'All Widgets',
    'route' => 'list.widgets'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

@php
$url = url()->current();
@endphp

@if(str_contains($url,'edit'))

    {!! Form::model($data,['route' => 'edit.widget']) !!}
    <input type="hidden" name="id" value="{{$id}}">
@else
    {!! Form::open(['route' => 'create.widget']) !!}
@endif

    {!! FormGenerator::GenerateForm('add_edit_widget_form') !!}
    
{!! Form::close() !!}


@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection

