@extends('admin.layouts.main')
@section('content')

	{{-- <div class="row">
		@foreach($model as $key => $value)
			<div class="col s12 m6 l3">
				<div class="card hoverable">	
					<div class="card-content">
						<span class="card-title activator center-align">{{ucfirst($key)}}</span>
						<div class="divider"></div>
						<p class="p-20">
							<h1 class="center-align">{{$value['count']}}</h1>
						</p>
				    </div>
				</div> 
			</div>	
		@endforeach
	</div> --}}
	<div>
		<div class="row">
			<div class="col l3 pr-7">
				<div class="card shadow" style="margin-top: 0px;">
					<div class="row center-align aione-widget-header" ><h5 style="margin: 0px">Organizations</h5></div>
					<div class="row center-align aione-widget-content" >12</div>
					<div class="row center-align aione-widget-footer" >
						<a href="{{Route('list.organization')}}" class="btn" style="background-color: #005A8B">All Organizations</a>
					</div>
				</div>
			</div>
			<div class="col l3 pr-7 pl-7">
				<div class="card shadow" style="margin-top: 0px;">
					<div class="row center-align aione-widget-header" ><h5 style="margin: 0px">Users</h5></div>
					<div class="row center-align aione-widget-content" >46</div>
					<div class="row center-align aione-widget-footer" >
						<a href="" class="btn" style="background-color: #005A8B">All Users</a>
					</div>
				</div>
			</div>
			<div class="col l3 pr-7 pl-7">
				<div class="card shadow" style="margin-top: 0px;">
					<div class="row center-align aione-widget-header" ><h5 style="margin: 0px">Forms</h5></div>
					<div class="row center-align aione-widget-content" >87</div>
					<div class="row center-align aione-widget-footer" >
						<a href="{{Route('list.form')}}" class="btn" style="background-color: #005A8B">All Forms</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<style type="text/css">
		.aione-widget-header{
			border-bottom: 1px solid #e8e8e8;padding: 10px
		}
		.aione-widget-content{
			border-bottom: 1px solid #e8e8e8;padding: 10px;font-size: 72px
		}
		.aione-widget-footer{
			padding: 10px
		}
	</style>
@endsection