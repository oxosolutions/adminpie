@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Customers',
    'add_new' => 'All Customer',
    'route' => 'list.client'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
        {!! Form::open(['route'=>'save.client', 'class'=> 'form-horizontal','method' => 'post'])!!}
            {!! FormGenerator::GenerateForm('create_client_form') !!}
        {!!Form::close()!!}
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    {{-- <div class="row">
	   <div class="col-md-12">
	   
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">
						<div class="panel-body">
							@include ('organization.client._form')
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div> 
	   </div>
    </div>--}}
@endsection()