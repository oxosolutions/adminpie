@extends('admin.layouts.main')
@section('content')

{{-- page header is not working here  --}}
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Users',
    'add_new' => '+ Add User',
    'route' => 'admin.add.user'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
  @include('common.page_content_primary_start')
  {{-- <div class="list" id="list">       
  </div>  --}}
  @include('common.list.datalist')
@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
   <!--  <style type="text/css">
      .options{
        display: block !important;
      }
    </style> -->
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection