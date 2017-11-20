@extends('group.layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Dashboard',
	'add_new' => '+ Add Dashboard'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div class="aione-dashboard">
		<!-- Dashboard Widgets -->
		<div class="ar">
			@foreach($model as $key => $value)
				<!-- Dashboard Widget -->
				<div class="ac s100 m50 l25 pt-15 pb-15">
					<div class="aione-widget aione-border bg-grey bg-lighten-5">
						<div class="aione-title">
							<h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 bg-grey bg-lighten-4"><a href="{{route($value['route'])}}" class="blue-grey darken-4">{{ucfirst($key)}}</a></h5>
						</div>
						<div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2"> 
							{{$value['count']}}
						</div>
						<div class="aione-align-center p-5 aione-border-top bg-grey bg-lighten-4"> 
							<a href="{{route($value['route'])}}" class="display-block p-10 white bg-blue-grey bg-darken-4">All {{$key}}</a>
						</div>
					</div>
				</div>
				<!-- Dashboard Widget -->
			@endforeach
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection