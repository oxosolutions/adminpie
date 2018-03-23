@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Define <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.dataset._tabs')
    <button onclick="window.location.href='{{route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'xls'])}}'">Export as XLS</button>
    <button onclick="window.location.href='{{route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'csv'])}}'">Export as CSV</button>
    <button onclick="window.location.href='{{route('clone.dataset',request()->route()->parameters()['id'])}}'">Clone</button>
    <button>Merge Dataset</button>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection