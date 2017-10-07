
@extends('admin.layouts.main')
@section('content')
@if(!empty(Session::get('success')))
	<div id="card-alert" class="card green lighten-5"><div class="card-content green-text">{{Session::get('success')}}</div></div>
@endif
@if(!empty(Session::get('error')))
	<div id="card-alert" class="card red lighten-5"><div class="card-content red-text">{{Session::get('error')}}</div></div>
@endif
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Organizations',
	'add_new' => '+ Add New Organization',
	'route' => 'create.organization'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
	var options = {valueNames:[name]};
	var userList = new List('user',options);
</script>
@endsection
