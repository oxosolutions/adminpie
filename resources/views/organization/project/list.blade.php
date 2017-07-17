@extends('layouts.main')
@section('content')
@php
	$id = "";
@endphp
@if(@$data)
	@foreach(@$data as $key => $value)
		
		@php
			$data = ['name' => $value->name , 'category' => $value->category];
			$id = $value->id;
		@endphp
	@endforeach
	<script type="text/javascript">
		$(window).load(function(){
			document.getElementById('add_new').click();
		});
	</script>
@endif
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Projects',
	'add_new' => '+ Add Projecct'
); 
@endphp
@include('common.pageheader',$page_title_data) 
<div id="projects" class="projects list-view">
	<div class="row" >
	
		@include('common.list.datalist')
	</div>
	<div class="row" >
		
		@if(@$data)
			{!! Form::model(@$data,['route'=>'update.project', 'class'=> 'form-horizontal','method' => 'post'])!!} 
			<input type="hidden" name="id" value="{{$id}}">
		@else
			{!! Form::open(['route'=>'save.project', 'class'=> 'form-horizontal','method' => 'post'])!!}
		@endif
		@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Projects','button_title'=>'Save','section'=>'prosec1']])
	
		{!!Form::close()!!}
	</div>
</div>	
@endsection