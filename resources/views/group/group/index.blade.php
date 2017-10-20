@extends('admin.layouts.main')
@section('content')
@if(!empty(Session::get('success')))
  <div class="aione-message success">
    {{Session::get('success')}}
  </div>
@endif
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Groups',
  'add_new' => '+ Create Group',
  'route' => 'create.group'
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
