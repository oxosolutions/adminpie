@extends('layouts.main')
@section('content')
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		<div class="pt-100 pl-10p pr-10p aione-align-center">
			<h3>Something's went wrong</h3>
			 <div class="aione-message warning">
	            {{ @$message }}
	        </div>
			<button class="m-10 aione-button" onclick="window.location.href='{{ url($link) }}'"><i class="fa fa-arrow-left"></i> Go Back</button>
			
		</div>
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection