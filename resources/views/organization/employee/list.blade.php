@extends('layouts.main')
@section('content')
	@if(@$errors->has())
		<script type="text/javascript">
			window.onload = function(){
                $('#add_new_model').modal('open');
            }
		</script>
	@endif
	
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Employees',
	'add_new' => '+ Add Employee',
	'second_button_title' => 'Export Employees',
	'second_button_route' => 'export.employee',
	'third_button_title' => 'Import Employees',
	'third_button_route' => 'import.employee'
); 

	 if(check_route_permisson('hrm/employee/save')==false){
	 	$page_title_data['show_add_new_button'] ='no';
	 }
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
{{-- @include('common.list.datalist') --}}
	<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>User</th>
                <th>Employe ID</th>
                <th>Name</th>
                <th>Departments</th>
                <th>Designation</th>
                <th>Email ID</th>
                <th>Created</th>
                <th>Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>User</th>
                <th>Employe ID</th>
                <th>Name</th>
                <th>Departments</th>
                <th>Designation</th>
                <th>Email ID</th>
                <th>Created</th>
                <th>Status</th>
            </tr>
        </tfoot>
        <tbody>
            
        </tbody>
    </table>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

{!! Form::open(['route'=>'store.employee' , 'class'=> 'form-horizontal','method' => 'post'])!!}
@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Employee','button_title'=>'Save Employee','section'=>'addempsec1']])
{!!Form::close()!!}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection