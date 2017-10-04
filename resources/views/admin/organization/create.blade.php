@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Add New Organization',
    'add_new' => '+ Add Designation'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
        <div class="card" style="margin-top:0px;padding: 10px ">
            
        {!! Form::open([ 'method' => 'POST', 'route' => 'save.organization' ,'class' => 'form-horizontal']) !!}

            {{-- @include('admin.organization._form')                 --}}
            {!! FormGenerator::GenerateForm('create_organization_form') !!}
            <div class="row right-align pv-10">
               {{--  <button type="submit" class="btn btn-primary blue"> create Organization <i class="icon-arrow-right14 position-right"></i></button>  --}} 
            </div>              
                            
        {!! Form::close() !!}        
        </div>
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection
