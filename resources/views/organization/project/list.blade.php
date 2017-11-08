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
	'route' => 'create.project',
	'add_new' => '+ Add Project'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection