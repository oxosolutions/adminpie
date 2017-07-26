@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Performance',
	'add_new' => '+ Add Designation'
); 
$id = "";
@endphp	
@include('common.pageheader',$page_title_data) 
<div class="row">
	@include('organization.profile._tabs')
	{{-- @include('common.notes') --}}
	<center><h1 style="font-size: 60px;">Coming Soon</h1></center>
</div>
@endsection