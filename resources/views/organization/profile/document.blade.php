@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Documents',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.profile._tabs')
	{{-- @include('common.list.datalist') --}}
	<div class="aione-table">
		<table>
			<tbody>
				@foreach($documents as $k => $v)
					<tr class="aione-list">
						<td >
							{{ $v->title }}
						</td>
						<td >
							<a href="{{ route('document.download',$v->id) }}">DOWNLOAD</a>
							<a href="{{ route('delete.user.document',$v->id) }}" class="red">DELETE</a>
						</td>
					</tr>
					<div class="clear"></div>
				@endforeach

			</tbody>
		</table>
	</div>
		
		 
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