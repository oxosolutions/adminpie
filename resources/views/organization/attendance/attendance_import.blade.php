@extends('layouts.main')
@section('content')
<style type="text/css">
	#card-alert{
		position: absolute;
	    top: 10px;
	    width: 98%;
	}
	#card-alert i{
		float: right;
		cursor: pointer
	}
</style>
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Import Attendance',
	'add_new' => '+ Add Designation'
); 
@endphp
@include('common.pageheader',$page_title_data)



@if(Session::has('success'))
<div id="card-alert" class="card green lighten-5"><div class="card-content green-text">
<span class="alert">{{ Session::get('success') }}</span>
<i class="material-icons dp48">clear</i></div></div>
@endif


@if(Session::has('error'))
<p class="alert">{{ Session::get('error') }}</p>
@endif
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div class="row">
	{!! Form::open(['route'=>'upload.attendance', "files"=>true , 'class'=> 'form-horizontal','method' => 'post'])!!}
	<div class="row" style="padding:10px 0px">
		<div class="col l12 aione-field-wrapper">
			{!!Form::text('title',null,['class' => 'aione-field','id'=>'attendence-title','placeholder'=>'Enter title'])!!}
		</div>
	</div>
	<div class="row pv-10" >
		{!!Form::file('attendance_file',null,['class'=>'no-margin-bottom aione-field file-path validate','placeholder'=>'Select File to Upload','style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px'])!!}
	</div>
	<div  class="row">
		<button class="btn blue" type="submit" name="action" style="margin-top: 10px;">Upload Attendance
		</button>
	</div>
	{!!Form::close()!!}
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
	
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
</style>
<script type="text/javascript">
	$(document).on('click','#card-alert i',function(){
		$('#card-alert').remove();
	});
</script>

@endsection