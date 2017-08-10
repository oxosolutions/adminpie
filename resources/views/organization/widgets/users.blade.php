@php
	$model = "App\Model\Organization\User";
@endphp
@extends('layouts.widget')

@section('front')

	<div class="front" >
		<div class="card shadow mt-0 fix-height" >
			<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#">{{ucfirst($data['widgets']->slug)}}</a></h5></div>
			<div class="row center-align aione-widget-content mb-10" >
					{{$model::all()->count()}}
			</div>
			<div class="row aione-widget-footer mb-10" >
				<button href="#" class="all blue white-text">All {{$data['widgets']->slug}}</button>
				<button href="#" class="recent blue white-text flip-btn-1">Recent {{$data['widgets']->slug}}</button>
			</div>
		</div>
	</div>
@overwrite

@section('back')
	<div class="back">
		<div class="card shadow mt-0 fix-height" > 
			<div class="row center-align aione-widget-header m-0" ><h5 class="m-0"><a href="#">{{ucfirst('Recent '.$data['widgets']->slug)}}</a></h5>
				<a href="#" class="btn-unflip-1 btn-unflip"><i class="material-icons dp48">clear</i></a>
			</div>
			<div class="row aione-widget-list m-0" >
				<ul class="recent-five">
				@php
					$data2 = $model::orderBy('id','DESC')->limit(5)->get();
				@endphp
				@if($data2 == null || $data2->isEmpty())
					{{dump("No Data Found")}}
				@else
					@foreach($data2 as $k => $v)
						<li class="waves-effect">
							{{$v->email}}
							<a href="{{route('account.profile',$v->id)}}">view</a>
						</li>
						<div class="divider"></div>
					@endforeach
				@endif
					
				</ul>
			</div>
		</div>
	</div>
@overwrite