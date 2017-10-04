@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Emails',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.profile._tabs')
	{{-- @include('common.list.datalist') --}}
	<ul >
		@foreach($documents as $k => $v)
			<li class="aione-list">
				<div style="float: left;">
					{{ $v->title }}
				</div>
				<div style="float: right;">
					<a href="{{ route('document.download',$v->id) }}">DOWNLOAD</a>
					<a href="{{ route('delete.user.document',$v->id) }}" style="color: red">DELETE</a>
				</div>
			</li>
			<div class="clear"></div>
		@endforeach

	</ul> 
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
	<style type="text/css">
		.options{
			position: absolute;
			font-size: 14px;
			display: none;
			margin-top:-3px;
		}
		.hover-me:hover .options{
			display: block
		}
		.aione-list{
			padding: 15px
		}
	</style>

@endsection