@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Ticket',
	'add_new' => 'All Ticket',
	'route' => 'add.ticket'
);
@endphp 
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	{{-- {{dd(App\Model\Organization\user::rolewiseUsers())}} --}}
    {!! Form::open(['route'=>'save.ticket','method'=>'POST','files'=>true]) !!}
	   {!! FormGenerator::GenerateForm('add_ticket_form') !!}
	   {!! FormGenerator::GenerateForm('add_ticket_on_behalf_form') !!}
    {!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
    $(document).ready(function(){
        $('input[name=related_image]').attr('multiple','multiple').attr('name',$('input[name=related_image]').attr('name')+'[]');
    });
</script>
@endsection


