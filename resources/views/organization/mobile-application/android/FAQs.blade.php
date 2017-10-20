@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Android Application FAQs',
	'add_new' => 'Download',
	'route' => 'download.android',
); 
$post_meta = get_global_post_meta('android-application-faq',true);
$custom_css = @$post_meta['css_code'];
$custom_js = @$post_meta['js_code'];
@endphp	

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.mobile-application.android._tabs')
	{!! @get_global_post('android-application-faq')->content !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
<style type="text/css">
	{!! $custom_css !!}
</style>
<script type="text/javascript">
	{!! $custom_js !!}
</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection
