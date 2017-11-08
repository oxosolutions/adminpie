@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Survey Settings <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Feedback'
); 
@endphp
@if(Auth::guard('admin')->check() == true)
@php

$route = 'save.form.settings';
@endphp
@else
@php

$route = 'org.save.form.settings';
@endphp
@endif
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('organization.survey._tabs')
	@include('common.page_content_primary_start')
		@if(!@$permission)
		<div class="aione-message warning">
            	{{ __('survey.survey_with_no_permisson') }}
        </div>
		@else
			<div class="survey-settings-wrapper">
				<div class="ar">
					<div class="ac l50 m50 s100">
						{!! Form::model($model,['route' => ['save.survey.settings',request()->route()->parameters()['id']], 'class'=> 'form-horizontal','method' => 'post'])!!}
							{!! FormGenerator::GenerateForm('Survey_Setting_Form') !!}
						{!! Form::close() !!}		
					</div>
					<div class="ac l50 m50 s100"> 
						{!!Form::model(@$model,['route'=>[$route,request()->route()->parameters()['id']]])!!}
							{!! FormGenerator::GenerateForm('form_setting_form',['type'=>'inset']) !!}
						{!!Form::close()!!}
					</div>
				</div>
			</div> <!-- .survey-settings-wrapper -->
		@endif
		
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection