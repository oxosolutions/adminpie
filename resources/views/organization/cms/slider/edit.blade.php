@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Slider <span>'.'test'.'</span>' ,
	'add_new' => 'All Slider',
	'route' => 'create.slider'
	); 
	$id = request()->route()->parameters()['id'];
@endphp
@php
	$slider = $model['slider'];
	$model['slider'] = json_decode($slider , true);
	$model['setting'] = json_decode($model['setting'] , true);
	$newModel = [];
	$arrayModel = $model->toArray();

	if(!empty($arrayModel['slider'])){
		foreach($arrayModel['slider'] as $sliderKey => &$singleSlider){
			if(empty($singleSlider['file'])){
				$singleSlider['file'] = '';
			}
		}
	}
@endphp 
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.cms.slider._tabs')

	<div class="ar">
		<div class="ac l70 ">
			<div class="aione-border p-10">
				@if($arrayModel != '')
					{!! Form::model($arrayModel,['route' => 'slider.update' , 'method' => 'post' ,'files' => true]) !!}
				@else
					{!! Form::open(['route' => 'slider.update' , 'method' => 'post' ,'files' => true]) !!}
				@endif	
				<input type="hidden" name="slider_id" value="{{ $arrayModel['id'] }}">

				<div class=" bg-white aione-border bg-lighten-5 mb-10">
			        <div class="aione-title aione-border-top aione-border-right aione-border-left">
			            <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
			                Edit Slider
			            </h5>
			        </div>
			        <div class="p-10">
						{!! FormGenerator::GenerateForm('create_slider_form') !!}
			        </div>
			    </div>
			    <div class="aione-border mb-10">
			        <div class="aione-title aione-border-top aione-border-right aione-border-left">
			            <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
			                Slides
			            </h5>
			        </div>
			        <div class="p-10">
						{!! FormGenerator::GenerateForm('cms_slides_form',[],$arrayModel) !!}
			        </div>
			    </div>
				<button type="submit">Save</button>
			    {!! Form::close() !!}
			</div>
				

		</div>
		<div class="ac l30 ">
			<div class="aione-border p-10">
				<div class="mb-10 aione-border">
			        <div class="aione-title aione-border-top aione-border-right aione-border-left">
			            <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
			                Slider Settings
			            </h5>
			        </div>
			        <div>
				        @if($model['setting'] != null)
						{!! Form::model($model['setting'],['route' => 'settings.save' , 'method' => 'post']) !!}
			        @else
						{!! Form::open(['route' => 'settings.save' , 'method' => 'post']) !!}
			        @endif
						<input type="hidden" name="slider_id" value="{{ $id }}">
			        	{!! FormGenerator::GenerateForm('slider_settings_form') !!}
			    	{!! Form::close() !!}

			        </div>
			    </div>
			</div>
				
		</div>
	</div>
			
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection