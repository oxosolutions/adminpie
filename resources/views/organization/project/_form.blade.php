@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Create Project',
	// 'add_new' => '+ Add New Team' 
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	@if(@$data)
		{!! Form::model(@$data,['route'=>'update.project', 'class'=> 'form-horizontal','method' => 'post'])!!} 
			<input type="hidden" name="id" value="{{$id}}">
	@else	
		{!! Form::open(['route'=>'save.project', 'class'=> 'form-horizontal','method' => 'post'])!!}
	@endif
		{!! FormGenerator::GenerateForm('addproject') !!}

			{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Projects','button_title'=>'Save','section'=>'prosec1']]) --}}
	{!!Form::close()!!}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

<script type="text/javascript">
	 $('.chips').material_chip();
 
  $('.chips-placeholder').material_chip({
    placeholder: 'Enter a tag',
    secondaryPlaceholder: '+Tag',
  });
      
</script>

@endsection