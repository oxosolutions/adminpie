@extends('layouts.main')
@section('content')
<style type="text/css">
	#card-alert{
		position: absolute;
	    top: 10px;
	    width: 98%;
	}
	#card-alert i{
		float: right;
		cursor: pointer
	}
</style>
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Import Attendance',
	'add_new' => '+ Add Designation'
); 
@endphp
@include('common.pageheader',$page_title_data)



@if(Session::has('success'))
<div id="card-alert" class="card green lighten-5"><div class="card-content green-text">
<span class="alert">{{ Session::get('success') }}</span>
<i class="material-icons dp48">clear</i></div></div>
@endif


@if(Session::has('error'))
<p class="alert">{{ Session::get('error') }}</p>
@endif
@include('common.pagecontentstart')
@include('common.page_content_primary_start')



<div class="aione-table aione-border mt-20 mb-20">
       <h4 class="light-blue darken-4 p-10 bg-grey bg-lighten-4 m-0">Import Attendance Files </h4>
           <table class="compact">
              <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>name</th>
                    <th>Created at</th>
                </tr>
              </thead>
               <tbody>
                 @foreach($data as $keys => $vals) 
                <tr>
                  <td>{{$vals->id}}</td>
                  <td>{{$vals->title}}</td>
                  <td>{{$vals->name}}</td>
                  <td>{{$vals->created_at}}</td>
                </tr>
               @endforeach
                
              </tbody>
            </table>  
</div>


@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
	
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
</style>
<script type="text/javascript">
	$(document).on('click','#card-alert i',function(){
		$('#card-alert').remove();
	});
</script>

@endsection