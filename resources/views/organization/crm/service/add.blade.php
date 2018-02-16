@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Service',
	'add_new' => 'List Service',
	'route' => 'list.services'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		
	{!! Form::open(['route'=>'save.service' , 'class'=> 'form-horizontal','method' => 'post'])!!}
				{{-- <div >
					<ul>
						<li><label for="">Service Name</label> <input name="name" type="text"></li>
						@php
						$data = 'App\Model\Organization\Category';
						$product_type = $data::category_list_by_type("service");

						@endphp
						<li><label for="">Service type</label> {!! Form::select('type',$product_type,null,[])!!}</li>
						<li><label for="">Description</label><textarea name="description" id="" cols="30" rows="10"></textarea></li>
						<li><input type="submit" value="Save"></li>

					</ul>

				</div> --}}
				{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add client','button_title'=>'Save Client','section'=>'clisec1']]) --}}
				{!! FormGenerator::GenerateForm('add-service-form	') !!}
			{!!Form::close()!!}
		
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

	@include('common.page_content_secondry_end')
@include('common.pagecontentend')

	
@endsection