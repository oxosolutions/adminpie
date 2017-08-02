@extends('layouts.main')
@section('content')
@php
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Attachments',
    'add_new' => '+ Add Attachment'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div>
@include('organization.project._tabs')
@include('common.list.datalist')
{!! Form::open(['method' => 'post' , 'route' => 'upload.attachment.project' , 'files' => true])!!}
	@if(request()->route()->parameters())
	    <input type="hidden" name="project_id" value="{{request()->route()->parameters()['id']}}">	
	@endif
	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Upload Attachemnt','button_title'=>'upload','section'=>'prosec6']])
{!! Form::close()!!}			
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection	