@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Add New Organization',
    'add_new' => 'All Organizations',
    'route' => 'list.organizations'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
        {!! Form::open([ 'method' => 'POST', 'route' => 'save.organization' ,'class' => 'form-horizontal']) !!}
           
            {!! FormGenerator::GenerateForm('create_group_organization_form') !!}               
        {!! Form::close() !!}
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection
