{{-- <!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Internal Server Error</title>
	<meta name="keywords" content="AdminPie,404, page not found">
	<meta name="description" content="AdminPie 404 page not found">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
   	<!-- Main CSS
   	================================================== -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/aione.css?ref='.rand(1111,9999)) }}">


	<!-- Google web font
   ================================================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	
<style type="text/css">
abbr,address,article,aside,audio,b,blockquote,body,canvas,caption,cite,code,dd,del,details,dfn,div,dl,dt,em,fieldset,figcaption,figure,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,html,i,iframe,img,ins,kbd,label,legend,li,mark,menu,nav,object,ol,p,pre,q,samp,section,small,span,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,ul,var,video {
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: 0 0;
}

body {
    line-height: 1;
	background:#f2f2f2;
	
}

* {
    box-sizing: border-box;
}

html {
   
    font-size: 16px;
    font-family: 'Open Sans',sans-serif;
    color: #757575;
}
.aione-error-title{
	font-size: 30px;
	line-height: 2;
}
.aione-error-desc{
	line-height: 1.5
}
.aione-wrapper{
	padding: 10%
}
.error-content{
	display: none;
}
</style>
	
</head>
<body>
<div id="aione_wrapper" class="aione-wrapper"> --}}
@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
		'show_page_title' => 'yes',
		'show_add_new_button' => 'no',
		'show_navigation' => 'yes',
		'page_title' => 'Internal error',
		'add_new' => '+ Add Task'
	);
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	<div class="ar ">
		<div class="ac l70 error-detail-wrapper">
			<div class="aione-error-title">
				<h4>Something went wrong!</h4>
			</div>
			<div class="aione-error-desc">
				You have experienced Internal Server Error. This might happen due to many reasons. You should try again.
			</div>
			<div style="padding: 30px 0">
				{{-- <button onclick="window.location.href='{{url()->previous()}}'"><i class="fa fa-arrow-left" style="margin-right: 16px"></i>Go Back	</button> --}}
				<button class="show-details" style="background-color: transparent;border: 1px solid;color: #454545">View Error Details</button>
			</div>
			<div>
				
					

			</div>
		</div>
		<div class="ac l30 aione-align-center">
			<img src="{{asset('assets/images/robot-msg-error.png')}}" style="width: 200px">
		</div>
	</div>

	<div class="ar" style="background-color: white;max-height: 400px;overflow: auto">
		<div class="error-header" style="border-bottom: 3px solid #DF8220">
			<p style="font-weight: 300;padding: 20px"><span style="color:#0073AA;font-weight: 500">Error: </span><code style="font-size: 14px">{{ $exception->getMessage() }}</code></p>

		</div>
		<div class="error-content" style="padding: 20px;">
			<code>ERROR CODE : [ {{ $exception->getCode() }} ]</code><br>
			@php

				$filePath = explode('/',$exception->getFile());
				$count = count($filePath);
			@endphp
			<code>ERROR LOCATION : [ {{ $filePath[$count-3].'/'.$filePath[$count-2].'/'.$filePath[$count-1] }} on <b>line: {{$exception->getLine()}}</b> ]</code>

		</div>
		
		@foreach($exception->getTrace() as $key => $trace)

			<div class="error-content" style="padding: 15px; border-top:1px solid #CCC; ">
				@php
					$class = explode('\\',@$trace['class']);
					$class = $class[count($class)-1];
					$file = explode('/',@$trace['file']);
					$file = $file[count($file)-1];
				@endphp
				<code>at <span style="color: red; font-weight: 100;">{{$class}}-><b>{{$trace['function']}}</b></span>()</code><br>
				
				<code>in <b>{{@$file}}</b> (line {{@$trace['line']}})</code>

			</div>

		@endforeach
		{{-- <div class="error-action" style="padding: 20px;text-align: right">
			<a href="" >View Details</a>
			<span style="clear: both"></span>
		</div> --}}
	</div>
	
		@include('common.page_content_primary_end')
		@include('common.page_content_secondry_start')
		@include('common.page_content_secondry_end')
		@include('common.pagecontentend')




    	
   
	
</div>
<script type="text/javascript">
	$(document).ready(function() {
		
		$('.show-details').click(function(){
			console.log('abc');	
			$('.error-content').slideToggle();
		})
	})
</script>
@endsection
{{-- 
</body>
</html> --}}