@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Products',
	'add_new' => 'All Product',
	'route' => 'list.products'
); 
@endphp
@include('common.pageheader',$page_title_data)
	
{!! Form::open(['route'=>'save.product' , 'class'=> 'form-horizontal','method' => 'post'])!!}
	{!!FormGenerator::GenerateForm('create_product_form')!!}
{!!Form::close()!!}


@endsection()