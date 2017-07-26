@extends('layouts.main')
@section('content')

        

<style type="text/css">

h1 {
    font-size: 7rem;
	color: #fff;
	font-weight: bold;
}

h2 {
    font-size: 5rem;
    color: #d8d8d8;
}
.aione-header h1{
	font-size: 3rem;
	color:#666666;
}
/*.aione-main{
	background-color: #ffffff;
	padding:30px;
}*/
.aione-main h1 {
	text-shadow: 0 1px 0 #ccc, 
	0 2px 0 #c9c9c9, 
	0 3px 0 #bbb, 
	0 4px 0 #b9b9b9, 
	0 5px 0 #aaa, 
	0 6px 1px rgba(0,0,0,.1), 
	0 0 5px rgba(0,0,0,.1), 
	0 1px 3px rgba(0,0,0,.3), 
	0 3px 5px rgba(0,0,0,.2), 
	0 5px 10px rgba(0,0,0,.25), 
	0 10px 10px rgba(0,0,0,.2), 
	0 20px 20px rgba(0,0,0,.15);

}
.aione-main h2 {
	font-size: 4rem;
}
.aione-footer{
	color:#666666;
	font-size:1rem;
	padding:20px;
}
.aione-footer a{
	color:#454545;
	text-decoration:none;
}
.aione-footer a:hover{
	color:#333333;
}
/*.aione-main p{
	color: #454545;
	margin: 30px;
}*/
</style>
@php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'no',
'show_navigation' => 'no',
'page_title' => 'Access Denied',
'add_new' => '+ Add Role'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	
	

<div id="aione_wrapper" class="aione-wrapper" style="text-align: center">
	{{-- <div id="aione_header" class="aione-header">
		<h1>AdminPie</h1>
    </div> --}}
	<div id="aione_main" class="aione-main">
		<h1>Access Denied</h1>
		<!-- <h2>Page not found</h2> -->

		<p>You don't have permission to access this page.Please contact you administrator</p>
		<center style="margin: 20px"><button onclick="goBack()" class="btn"><i class="fa fa-reply" aria-hidden="true"></i> Return Back</button></center>

    </div>
{{-- 	<div id="aione_footer" class="aione-footer">
		<p>Got to <a href="http://adminpie.com/">Homepage</a> or contact <a href="http://adminpie.com/contact/">Administrator</a></p>
    </div> --}}
	
</div>
<script type="text/javascript">
	function goBack() {
	    window.history.back();
	}
</script>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection



