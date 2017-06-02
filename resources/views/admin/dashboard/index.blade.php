@extends('admin.layouts.main')
@section('content')
	<div>
		<div class="row">
		@foreach($model as $key => $value)
			<div class="col l3 pr-7">
				<div class="card shadow" style="margin-top: 0px;">
					<div class="row center-align aione-widget-header" ><h5 style="margin: 0px"><a href="{{route('list.'.$key)}}" style="display: block">{{ucfirst($key)}}</a></h5></div>
					<div class="row center-align aione-widget-content" >{{$value['count']}}</div>
					<div class="row center-align aione-widget-footer" >
						<a href="{{route('list.'.$key)}}" class="btn" style="background-color: #005A8B">All {{$key}}</a>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	</div>

	<style type="text/css">
		.aione-widget-header{
			border-bottom: 1px solid #e8e8e8;cursor: pointer;
		}
		.aione-widget-header a{
			padding: 10px;color: black
		}
		.aione-widget-content{
			border-bottom: 1px solid #e8e8e8;padding: 10px;font-size: 72px
		}
		.aione-widget-footer{
			padding: 10px
		}
	</style>
@endsection