@extends('group.layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Edit Organization',
    'add_new' => '+ Add Designation'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
    @include('group.organization._tabs')
   
	{!!Form::model($org_data, ['route' => ['edit.organization', $org_data->id]])!!}
        {!! FormGenerator::GenerateForm('edit_organization_form') !!}           
    {!! Form::close() !!}        
  
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection
