@php
	$model = "App\Model\Organization\Client";
@endphp
@extends('layouts.widget')

@section('front')

	<div class="front" >
		<div class="card shadow mt-0 fix-height" >
			<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#"></a></h5></div>
			<div class="row center-align aione-widget-content mb-10" >
			
			</div>
			<div class="row aione-widget-footer mb-10" >
				<button href="#" class="all blue white-text">All </button>
				<button href="#" class="recent blue white-text flip-btn-1">Recent </button>
			</div>
		</div>
	</div>
@overwrite

@section('back')
	<div class="back">
		<div class="card shadow mt-0 fix-height" > 
			<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#"></a></h5>
				<a href="#" class="btn-unflip-1 btn-unflip"><i class="material-icons dp48">clear</i></a>
			</div>
			<div class="row aione-widget-list m-0" >
				
			</div>
		</div>
	</div>
@overwrite