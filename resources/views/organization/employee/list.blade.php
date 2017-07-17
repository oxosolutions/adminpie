@extends('layouts.main')
@section('content')
	<style type="text/css">
		.error-red{
			color: red
		}
		.display_block{
			display: block !important;
		}
	</style>
	@if(@$errors->has())
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
	'page_title' => 'Employees',
	'add_new' => '+ Add Employee'
); 
@endphp
@include('common.pageheader',$page_title_data) 
{!! Form::open(['route'=>'store.employee' , 'class'=> 'form-horizontal','method' => 'post'])!!}
@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Employee','button_title'=>'Save Employee','section'=>'addempsec1']])
{!!Form::close()!!}
@include('common.list.datalist')

@endsection