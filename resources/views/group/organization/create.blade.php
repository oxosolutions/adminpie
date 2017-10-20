@extends('group.layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Add Organization',
  'add_new' => 'All Organizations',
  'route' => 'list.groupOrganizations'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
            
        {!! Form::open([ 'method' => 'POST', 'route' => 'save.groupOrganization' ,'class' => 'form-horizontal']) !!}
            <input type="hidden" name="group_id" value="{{Auth::guard('group')->user()->group_id}}">
            {!! FormGenerator::GenerateForm('create_organization_form') !!}               
        {!! Form::close() !!}      
    
      @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection

