@extends('layouts.main')
@section('content')

@php

$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Designations',
	'add_new' => '+ Add Designation'
); 

	$id = "";
	@endphp	

		@if(@$data)
			@foreach(@$data as $k => $v)
				@php
					$newData = $v->name;
					$id = $v->id;
				@endphp
			@endforeach
			
				<script type="text/javascript">
				$(window).load(function(){
					document.getElementById('modal-edit').click();
				});
			</script>
		@endif
		@php
			@$model = ['name' => @$newData];
			
	@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
		

@include('common.page_content_primary_start')

	@include('common.list.datalist')

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

	@if(@$newData == 'undefined' || @$newData == '' || @$newData == null)
		{!! Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']) !!}

	@endif
	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add designation','button_title'=>'Save Designation','section'=>'titlesection']])
	 {!!Form::close()!!}
	@if(@$model)
		{!! Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']) !!}
			<input type="hidden" name="id" value="{{$id}}">
			<a href="#modal_edit" style="display: none" id="modal-edit"></a>
			@include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit designation','button_title'=>'update Designation','section'=>'titlesection']])
		{!!Form::close()!!}
	@endif
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection