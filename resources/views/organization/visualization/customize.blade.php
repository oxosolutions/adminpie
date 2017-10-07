@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Customize',
  'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('organization.visualization._tabs')
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
    	@php
    		if(!@$model->isEmpty()){
    			$model['css_code'] = $model->where('key','css_code')->first()->value;
    			$model['js_code'] = $model->where('key','js_code')->first()->value;
    		}
    	@endphp
    	{!!Form::model($model,['route'=>['update.customize.visualization',$id]])!!}
          {!! FormGenerator::GenerateForm('custom_code') !!}
        {!!Form::close()!!}
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection