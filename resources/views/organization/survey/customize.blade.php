@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Customize <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
); 
$id = "";

@endphp 

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.survey._tabs')
    @if(!empty($error))
		 <div class="aione-message warning">
		 	{{$error}}
		 </div>
    
    @else
   @if(!empty($form['forms_meta']))
		@php
			$model =	collect($form['forms_meta'])->mapWithKeys(function($item){
						return [$item['key']=>$item['value']];
				});
		@endphp
		{!! Form::model($model, ['route'=>'save.custom.survey']) !!}

  	@else
	    {!! Form::open(['route'=>'save.custom.survey']) !!}
	   @endif
	      {!! Form::hidden('form_id',$form['id']) !!}      
	      {!! FormGenerator::GenerateForm('custom_code') !!}
	    {!! Form::close() !!}
	@endif
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection