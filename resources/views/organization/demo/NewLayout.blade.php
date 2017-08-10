@extends('layouts.main')
@section('content')
	<div id="aione_page_header" class="aione-page-header">
		<div class="row">
			<div class="aione-page-title-container"> 
				<h3 class="aione-page-title">Test Global Functions</h3>
				
				<div class="clear"></div>
			</div> <!-- .aione-page-title-container -->
			
			<div class="clear"></div>
		</div> <!-- .row -->
	</div> <!-- #aione_page_header -->
	<div class="main-content">
	
	<h3 class="settings-title">get_organization_id()</h3>
	<pre  class="settings-meta">
		{{get_organization_id()}}
	</pre>
	
	<h3 class="settings-title">get_user_id()</h3>
	<pre  class="settings-meta">
		{{get_user_id()}}
	</pre>
	
	<h3 class="settings-title">get_profile_picture()</h3>
	<pre  class="settings-meta">
		{{print_r(get_profile_picture())}}
	</pre>
	
	<h3 class="settings-title">delete_user_meta('user_profile_picture')</h3>
	<pre  class="settings-meta">It will delete user meta
	</pre>
	
	<h3 class="settings-title">upload_base_path()</h3>
	<pre  class="settings-meta">
		{{upload_base_path()}}
	</pre>
	
	<h3 class="settings-title">upload_path()</h3>
	<pre  class="settings-meta">
		<p>upload_path()</p>
		{{upload_path()}}
		<p>upload_path('user_profile_picture')</p>
		{{upload_path('user_profile_picture')}}
		<p>upload_path('dataset_import_files')</p>
		{{upload_path('dataset_import_files')}}
	</pre>
	<h3 class="settings-title">generate_filename()</h3>
	<pre  class="settings-meta">
		<p>generate_filename()</p>
		{{generate_filename()}}
		<p>generate_filename(40,true)</p>
		{{generate_filename(40,true)}}
		<p>generate_filename(40,false)</p>
		{{generate_filename(40,false)}}
		<p>generate_filename(10,true)</p>
		{{generate_filename(10,true)}}
		<p>generate_filename(10,false)</p>
		{{generate_filename(10,false)}}
	</pre>
	{{--
	<h3 class="settings-title">get_user_meta()</h3>
	<pre  class="settings-meta">
		<p>get_user_meta()</p>
		{{get_user_meta()}}
		<p>get_user_meta(true,true)</p>
		{{print_r(get_user(true,true,2))}}
	</pre>
	<h3 class="settings-title">get_user()</h3>
	<pre  class="settings-meta">
		<p>get_user()</p>
		{{get_user()}}
		<p>get_user(true,true)</p>
		{{print_r(get_user(true,true,2))}}
	</pre>
	
--}}
		
	</div>
<style type="text/css">
h3{
	margin: 20px 0 0 0;
    color: #03A9F4;
}
pre{
	padding: 20px 0;
    margin: 16px 0;
    border: 1px solid #e8e8e8;
    text-indent: 0px;
    background: #f8f8f8;
}
pre p{
	padding: 0 20px;
    color: #F44336;
}
</style>
@endsection