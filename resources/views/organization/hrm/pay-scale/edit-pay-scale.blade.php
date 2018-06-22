@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Pay Scale',
	'add_new' => 'List pay scale',
	'route' => 'list.payscale'
); 
@endphp	
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	{!! Form::model(@$data['data'],['route'=>['edit.payscale' , $data["data"]->id] , 'class'=> 'form-horizontal','method' => 'post']) !!}
		{!! FormGenerator::GenerateForm('organization_hrm_payscale_form') !!}
	{!!Form::close()!!}
	<div class="ar">
		<div class="ac l50">
			{!! FormGenerator::GenerateForm('organization_hrm_payscale_earnings_form') !!}
		</div>
		<div class="ac l50">
			{!! FormGenerator::GenerateForm('organization_hrm_payscale_deductions_form') !!}
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	<script type="text/javascript">
		$(document).ready(function(){
			var basic = $('.field-wrapper-basic_pay').find('input').val();
			$(document).on('change','field-wrapper-percentage input',function(){
				
			})
		})
	</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection