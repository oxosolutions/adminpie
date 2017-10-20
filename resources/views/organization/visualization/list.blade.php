@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Visualizations',
  'add_new' => '+ Add Visualization',
  'route' => 'create.visual'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
    @include('common.list.datalist')
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
     {{--  {!!Form::open(['route'=>'save.visualization'])!!}
    	   @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Visualization','button_title'=>'Save & Next','section'=>'vissec1']])
      {!!Form::close()!!} --}}
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection