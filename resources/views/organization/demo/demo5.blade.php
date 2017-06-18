@extends('layouts.main')
@section('content')

<style type="text/css">
	#col_header{

	}
	.col-block{
		width:25px;
		height:25px;
		text-align: right;
		display: inline-block;
		margin-right: 15px;
	}
</style>

<!-- main-content-->
<div class="card" style="margin-top: 0px;padding:10px">
@php
$colors = array("red", "green", "blue", "yellow"); 

foreach ($colors as $value) {
    echo "$value <br>";
}
@endphp
</div>



@endsection