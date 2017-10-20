@php
$data = [];

  $data['visualization_name'] = $model['name'];
  $data['select_dataset'] = $model['dataset_id'];
  $data['description'] = $model['description'];

    @endphp
@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Edit Visualization',
  'add_new' => '+ Add Visualization'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
   		{!!Form::model($model,['route'=>['update.visualization' , $model['id']]])!!}
        <input type="hidden" name="id" value="{{$model['id']}}">
	    	{!!FormGenerator::GenerateForm('edit_visualization_form')!!}	 
        <input type="submit" value="submit">
	    {!!Form::close()!!}
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
     
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection