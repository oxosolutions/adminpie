@extends('layouts.main')
@section('content')

@php

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Import Dataset',
	'add_new' => 'All Datasets',
	'route' => 'list.dataset'
	); 
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
	
		{!!Form::open(['route'=>'upload.dataset','files'=>true])!!}
		{!! FormGenerator::GenerateForm('import_dataset_form') !!}
		{!!Form::close()!!}
	@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
     
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
	<style type="text/css">
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	textarea{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.btn{
		background-color: #0288D1;
	}
	.select-dropdown{
		margin-bottom: 0px !important;
	    border: 1px solid #a8a8a8 !important;
	    
	}
	.select-wrapper input.select-dropdown{
		height: 30px;
    	line-height: 30px;
	}
	.file-path{
		margin-bottom: 0px !important
	}
	.mb-10{
		margin-bottom:15px !important; 
	}
	</style>
	<script type="text/javascript">
		$(".url,.file_on_server,.import_from_survey").hide();
		$(document).ready(function(){
		    $('input[type="radio"]').click(function(){
		        var inputValue = $(this).attr("value");
		        if(inputValue == 'import_from_survey'){
		        	$(".box2").hide();
		        }else{
		        	$(".box2").show();
		        }
		        var targetBox = $("." + inputValue);
		        $(".box").not(targetBox).hide();
		        $(targetBox).show();
		    });
		    $('.action_type').change(function(){
		    	if($(this).val() == 'append' || $(this).val() == 'replace'){
		    		$('.datasets_list').prop('disabled',false);
		    		$('select').material_select();
		    	}else{
		    		$('.datasets_list').prop('disabled',true);
		    		$('select').material_select();
		    	}
		    });
		});
</script>
@endsection