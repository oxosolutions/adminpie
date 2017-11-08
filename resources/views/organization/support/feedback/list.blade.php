@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Feedbacks',
	'add_new' => '+ Add Feedback',
	'route' => 'add.feedback'
); 

@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	@include('common.list.datalist')
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

	@if(@$data != null)
		{!! Form::model($data , ['route'=>'update.feedback','method' => 'POST']) !!}
		<input type="hidden" name="id" value="{{ $data->id }}">
		<script type="text/javascript">
			window.onload = function(){
				$('#add_new_model').modal('open');
			};
		</script>
	@else
		{!! Form::open(['route'=>'create.feedback','method' => 'POST']) !!}
	@endif
	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'Add_feedback']])
	{!! Form::close() !!}


	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection