@extends('layouts.main')
@section('content')
<style type="text/css">
	.aione-404-error{
		text-align: center;
	    background: #ededed;
		padding: 20px;
		min-height: 547px;
	}
</style>
<div id="aione_wrapper" class="aione-wrapper aione-404-error">
	<div id="aione_main " class="aione-main ">
		<h1>404</h1>
		<h2>Page not found</h2>
    </div>
	{{-- <div id="aione_footer" class="aione-footer">
		<p>Got to <a href="http://adminpie.com/">Homepage</a> or contact <a href="http://adminpie.com/contact/">Administrator</a></p>
    </div> --}}
	<div id="aione_footer" class="aione-footer">
		<a href="{{ url()->previous() }}" class="aione-button aione-button-goBack">Go Back</a>
	</div>
</div>
@endsection