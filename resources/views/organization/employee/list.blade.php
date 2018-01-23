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
<style type="text/css">
.dataTables_filter,
.dataTables_length{
  display: inline-block;
  width: 50%;
}
.dataTables_filter input{
  width: 100%;
  padding-right: 15px
}

</style>
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
{{-- @include('common.list.datalist') --}}

@if(Session::has('import_new'))
    <div class="aione-table aione-border mt-20 mb-20">
       <h4 class="light-blue darken-4 p-10 bg-grey bg-lighten-4 m-0">Employees Import Report</h4>
           <table class="compact">
              <thead>
                <tr>
                    <th>Action</th>
                    <th>Employee Id</th>
                    <th>E-mail</th>
                    <th>Massage</th>
                </tr>
              </thead>
               <tbody>
                 @foreach(Session::get('import_new') as $keys => $vals) 
                <tr>
                  <td>New Employee</td>
                  <td>{{ $keys }}</td>
                  <td>{{ $vals }}</td>
                  <td>Upload Successfully</td>
                </tr>
               @endforeach
                
              </tbody>
            </table>  
</div>
       {{-- <ul>
            <li>Following Employee  Import Success fully</li>
               @foreach(Session::get('import_new') as $keys => $vals) 
                <li style="color: green; " > Employee : id {{ $keys  }} ,  email {{ $vals }} new employee created. </li>
               @endforeach
       </ul> --}}
@endif

@if(Session::has('alreadyInGroupNotOrg'))
       <ul>
            <li>Following User already working with other Organization Now they also associate with us.</li>
               @foreach(Session::get('alreadyInGroupNotOrg') as $keys => $vals) 
                <li> Employee : id {{ $keys  }} ,  email {{ $vals }} </li>
               @endforeach
       </ul>
@endif

@if(Session::has('newInsertAlreadyEmployeeId'))
       <ul>
            <li>Following Record Employee Id already Assign to other employee.</li>
               @foreach(Session::get('newInsertAlreadyEmployeeId') as $keys => $vals) 
                <li> Employee : id {{ $keys  }} ,  email {{ $vals }} </li>
               @endforeach
       </ul>
@endif

@if(Session::has('emptyRow'))
       <ul>
            <li>Following .</li>
               @foreach(Session::get('emptyRow') as $keys => $vals) 
                <li style="color: Red; ">  {{ $vals }} </li>
               @endforeach
       </ul>
@endif

@if(Session::has('updateRecord'))
       <ul>
            <li>Following .</li>
               @foreach(Session::get('updateRecord') as $keys => $vals) 
                <li style="color: yellow; ">  {{ $vals }} update successfully.</li>
               @endforeach
       </ul>
@endif




<div class="">
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
</div>
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

{!! Form::open(['route'=>'store.employee' , 'class'=> 'form-horizontal','method' => 'post'])!!}
@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Employee','button_title'=>'Save Employee','section'=>'addempsec1']])
{!!Form::close()!!}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection