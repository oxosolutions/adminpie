@extends('layouts.main')
@section('content')
<a href="#modal1" class="aione-button blue">add category</a>
{!!Form::open(['route'=>'save.category','method'=>'POST'])!!}
@include('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add Category','button_title'=>'Save','section'=>'prosec5']])
{!!Form::close()!!}
@include('common.list.datalist')
<style type="text/css">
	a.aione-button{
		color: #58666e!important;
	    background-color: #fcfdfd !important;
	    background-color: #fff;
	    border-color: #dee5e7;
	    border-bottom-color: #d8e1e3;
	  	padding: 5px 10px;
	    box-shadow: 0 1px 1px rgba(90,90,90,0.1);
		border-radius: 2px;
		display: inline-block;
		border: 1px solid transparent;
		outline: 0!important;
		white-space: nowrap;
		cursor: pointer;
		background-image: none;
		-webkit-appearance: button;
		text-transform: uppercase;
	}
	a.aione-button:hover{
		color: #58666e!important;
		background-color: #edf1f2 !important;
		border-color: #c7d3d6 !important;
	}
</style>
@endsection