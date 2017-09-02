@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Modules',
  'add_new' => '+ Apply leave'
); 
@endphp
@include('common.pageheader',$page_title_data)
{!! FormGenerator::GenerateForm('Survey_Setting_Form') !!}
   
@endsection