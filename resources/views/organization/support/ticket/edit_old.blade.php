@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Ticket',
	'add_new' => 'List Tickets',
	'route' => 'active.tickets'
);
@endphp 
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    {!! Form::model($model,['route'=>['update.ticket','id'=>$model->id],'method'=>'POST','files'=>true]) !!}
	   {!! FormGenerator::GenerateForm('edit_ticket_form') !!}
    {!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection


