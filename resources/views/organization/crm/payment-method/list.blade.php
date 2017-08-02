@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Payment method		',
	'add_new' => '+ Add Payment Method'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('common.list.datalist')
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

	{!! Form::open(['route'=>'save.payment.method' , 'class'=> 'form-horizontal','method' => 'post'])!!}
				<div >
					<ul>
						<li><label for="">Payment Method Name</label> <input name="name" type="text"></li>
 						<li><input type="submit" value="Save"></li>

					</ul>

				</div>
				{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add client','button_title'=>'Save Client','section'=>'clisec1']]) --}}
			{!!Form::close()!!}
	
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')

	
@endsection