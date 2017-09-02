@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'no',
    'page_title' => "Add Survey",
    'add_new' => 'All Surveys',
    'route' => 'list.survey'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
   
    <div id="add_survey_form" class="add-survey-form">
    {!! Form::open([ 'method' => 'POST', 'route' => 'org.create.forms' ,'class' => 'form-horizontal']) !!}
    {!! FormGenerator::GenerateForm('add_survey_form') !!}
        <input type="hidden" name="type" value="{{@$type}}">
         @if(@$errors->has())
          @foreach($errors->all() as $kay => $err)
            <div style="color: red">{{$err}}</div>
          @endforeach
        @endif
    {!! Form::close() !!} 
    </div>
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection
