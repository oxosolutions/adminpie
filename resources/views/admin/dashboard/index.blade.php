@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Dashboard',
	'add_new' => ''
); 
@endphp
<style type="text/css">
	.aione-widget{
		float: left;
	    width: 23%;
	    min-height: 160px;
	    padding: 0;
	    margin: 0 2% 2% 0;
	    position: relative;
	    color: #666666;
	}
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	<div class="aione-dashboard">
		<!-- Dashboard Widgets -->
		<div class="ar">
				@foreach($model as $key => $value)
				@php
					$count = $value['count'];
					$route = $value['route'];
					// $list = $value['list'];
				@endphp
					<!-- Dashboard Widget -->

					@include('organization.widgets.commonWidget')
					<!-- Dashboard Widget -->
				@endforeach
		</div>
	</div>
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection