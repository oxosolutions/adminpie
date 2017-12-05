@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Orders',
    'add_new' => '+ Add New Organization'

); 
@endphp
<style type="text/css">
	#aione_form_wrapper_292{
		width: 91%;
		float: left;
	}
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
{!! Form::open(['method' => 'get']) !!}
	<div>
		<div class="organization-wise-order">
			{!! FormGenerator::GenerateForm('organization_wise_order') !!}
			<button style="padding: 7px 26px 9px 24px;"><i class="fa fa-search"></i></button>
		</div>
	</div>
{!! Form::close() !!}
    @if(!empty($showColumns))
    	@include('common.list.datalist')
    @endif
	    
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection