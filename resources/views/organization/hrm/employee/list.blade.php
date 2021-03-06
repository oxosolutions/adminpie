@extends('layouts.main')
@section('content')
	@if(@!empty($errors))
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
	'page_title' => __('organization/hrm.employee_list_page_title'),
	'add_new' => __('organization/hrm.employee_list_page_add_employee_button'),
  'route' => 'add.employee',
	'second_button_title' =>  __('organization/hrm.employee_list_page_export_employee_button'),
	'second_button_route' => 'export.employee',
	'third_button_title' => __('organization/hrm.employee_list_page_import_employee_button'),
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
@if(Session::has('import_new'))
    <div class="aione-table aione-border mt-20 mb-20">
       <h4 class="light-blue darken-4 p-10 bg-grey bg-lighten-4 m-0">Employees Import Report</h4>
           <table class="">
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
                <th>{{__('organization/hrm.employee_list_datatable_header_title_user')}}</th>
                <th>{{__('organization/hrm.employee_list_datatable_header_title_employe_id')}}</th>
                <th>{{__('organization/hrm.employee_list_datatable_header_title_name')}}</th>
                <th>{{__('organization/hrm.employee_list_datatable_header_title_departments')}}</th>
                <th>{{__('organization/hrm.employee_list_datatable_header_title_designation')}}</th>
                <th>{{__('organization/hrm.employee_list_datatable_header_title_email_id')}}</th>
                <th>{{__('organization/hrm.employee_list_datatable_header_title_created')}}</th>
                <th>{{__('organization/hrm.employee_list_datatable_header_title_status')}}</th>
            </tr>
        </thead>
        <!-- <tfoot>
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
        </tfoot> -->
        <tbody>
            
        </tbody>
    </table>
</div>
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
<style type="text/css">

.dataTables_filter,
.dataTables_length{
  display: inline-block;
  vertical-align: top;
}
.dataTables_filter{
  width: 70%;
}
.dataTables_length{
  width: 30%;
}
.dataTables_filter input{
  width: 97%;
  height: 36px;
  border: 1px solid #ccc;
}
.dataTable td > div > ul{
  display: none !important;
  position: absolute;
  left: 70px;
}
.dataTable td > div > ul > li{
  display: inline-block;
  margin-top: 6px;
}
.dataTable tr{
  position: relative;
}
.dataTable tr:hover td > div > ul{
  display: block !important
}
table{
    width: 100%;
    word-wrap: break-word;
    table-layout: fixed;
}
.dataTables_processing{
  padding:20px;
  background-color: white;
  position: fixed;
  top: calc(50% - 10px);
  left: calc(50% - 100px);
}
.dataTables_paginate{
  margin-top: 30px;
}
.current{
    background: #2e73aa !important;
    color: white !important;
    border: 1px solid #2e73aa !important;
}
.dataTables_paginate .previous, .dataTables_paginate .next {
    border: 1px solid #e8e8e8;
    padding: 8px 15px;
}
.dataTables_paginate .paginate_button{
    border: 1px solid #e8e8e8;
    padding: 8px 15px;
    margin: 2px;
    color: #6e6e6e;
}
.odd, .even{
    border-bottom: 1px solid #e8e8e8;
}
.sorting{                                         
  color:#2e73aa;
}
.sorting_asc, .actions{
  color:#2e73aa;
}
.actions .aione-status.active{
  
}
.actions{
  text-align: center;
}
#example{
    margin-top: 34px;
    border-top: 1px solid #e8e8e8;
}
.aione-page-content{
  margin: 34px 10px 20px 0;
}
  .aione-status.active{
        border-color: #9ccc65;
}
.aione-status{
  display: inline-block;
    box-sizing: border-box;
    width: 18px;
    height: 18px;
    border: 3px solid #ef5350;
    border-radius: 50%;
}
.aione-status.pending{
  border-color: orange;
}
</style>

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection