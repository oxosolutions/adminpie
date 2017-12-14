@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Import Employees',
	'add_new' => '+ Add Employee',

	
); 

$body_text="";
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

@if(Session::has('import_new'))
               	@php
                 foreach(Session::get('import_new') as $keys => $vals) {
                	$body_text .="<tr> <td>Employee Added</td> <td>".$keys."</td> <td>".$vals."</td> <td>Record added successfully	</td> </tr>";
 					}
               @endphp
@endif

@if(Session::has('alreadyInGroupNotOrg'))
				@php
                 foreach(Session::get('alreadyInGroupNotOrg') as $keys => $vals) {
                	$body_text .="<tr> <td>Employee Updated</td> <td>".$keys."</td> <td>".$vals."</td> <td> User associated with this organization</td> </tr>";
 					}
               @endphp
      
@endif

@if(Session::has('newInsertAlreadyEmployeeId'))
				@php
                 foreach(Session::get('newInsertAlreadyEmployeeId') as $keys => $vals) {
                	$body_text .="<tr> <td>Error Occurred </td> <td>".$keys."</td> <td>".$vals."</td> <td>Duplicate Employee ID </td> </tr>";
 					}
               @endphp
       
@endif

@if(Session::has('emptyRow'))
				@php
                 foreach(Session::get('emptyRow') as $keys => $vals) {
                	$body_text .="<tr> <td>Error Occurred </td><td> </td> <td></td> <td>".$vals."Missing required values </td> </tr>";
 					}
               @endphp
       
@endif

@if(Session::has('updateRecord'))
				@php
                 foreach(Session::get('updateRecord') as $keys => $vals) {
                	$body_text .="<tr> <td>Employee updated</td> <td>".$keys."</td> <td>".$vals."</td> <td>Record updated successfully</td> </tr>";
 					}
               @endphp
       
@endif
@if(Session::has('import_new') || Session::has('alreadyInGroupNotOrg') || Session::has('emptyRow') || Session::has('updateRecord'))
<div class="aione-table aione-border mt-20 mb-20">
       <h4 class="light-blue darken-4 p-10 bg-grey bg-lighten-4 m-0">Employees Import Report</h4>
<table class="compact">
              <thead>
                <tr>
                    <th>Action</th>
                    <th>Employee Id</th>
                    <th>E-mail</th>
                    <th>Message</th>
                </tr>
              </thead>
               <tbody>
               	{!! $body_text !!}
               </tbody>
           </table>
     </div>
@endif







{!! Form::open(['route'=>'import.employee.post' , 'class'=> 'form-horizontal','method' => 'post','files'=>true])!!}

		<div class="row no-margin-bottom">
			{!! FormGenerator::GenerateForm('import_employees_form') !!}
		</div>
	@if(Session::get('errors'))
		{{dump(Session::get('errors'))}}
	@endif
{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection