@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Create Template',
	'add_new' => '+ Add Email'
); 
@endphp	
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@if(@$model != null || @$model != "")
		{!! Form::model($model ,['route'=>'update.template' , 'class'=> 'form-horizontal','method' => 'post','files' => true]) !!}
		<input type="hidden" name="id" value="{{request()->route()->parameters()['id']}}">
	@else
		{!! Form::open(['route'=>'save.template' , 'class'=> 'form-horizontal','method' => 'post','files' => true]) !!}
	@endif
		{!!FormGenerator::GenerateForm('email-template')!!}
		@if(@$model != null)
			@foreach($model->templateMeta as $k => $v)
				@if($v->value != '') 
					@php
						$exploded = explode('.',$v->value);
					@endphp
					@if(@$exploded[1] == 'png' || @$exploded[1] == 'jpg' || @$exploded[1] == 'jpeg')
						<img src="{{ asset('/files/organization_'.get_organization_id().'/emailAttachments/'.$v->value) }}" width="10%">
					@endif
				@endif
			@endforeach
		@endif
		{!! Form::file('attachment[]',['multiple'=>'multiple']) !!}
		<button type="submit">Save</button>
	{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection