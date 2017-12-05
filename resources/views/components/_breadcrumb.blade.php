
<div class="row page-header">
	<div class="col s12 m12 l12">

		<div class="">
			<div class="card-content left-align white">
				<h4 class="p-20 no-margin">SMAART™ Framework</h4>
			</div>
		</div>
	</div>

	<div class="col s12 m12 l12">
		<nav id="" class="">
			<div class="nav-wrapper">
				<div class="col s12 m8 l9 pl-20">
					<a href="{{route('organization.dashboard')}}" class="breadcrumb"><i class="material-icons">home</i></a>
						@php
							$path1 = explode('/',Request::path());
							$path = explode('/',Request::path());
							$model = 'app\Model';
							 unset($path[0]); 
								// $title = $model.'\\'.ucfirst($path1[0]).'\\'.ucfirst($path1[1]);

						@endphp
						{{-- {{$title}} --}}
							{{-- {{$title::all()}} --}}
					@foreach($path as $key => $value)
						@if($value != 'list')

							@if(is_numeric($value))
							 	{{-- <a href="" class="breadcrumb">{{ucfirst($title)}}</a> --}}
							@else
							 	<a href="" class="breadcrumb">{{ucfirst($value)}}</a>
							@endif
						@endif
					@endforeach
				</div>
				<div class="col s12 m4 l3">
					<ul class="right hide-on-med-and-down views">
						<li><a href="#list-view" class="view" data-view="list-view"><i class="material-icons">view_list</i></a></li>
						
						<li><a href="#grid-view" class="view" data-view="grid-view"><i class="material-icons">view_module</i></a></li>

						<li><a href="#detail-view" class="view" data-view="detail-view"><i class="material-icons">view_stream</i></a></li>
					</ul>
				</div>

			</div>
		</nav>
	</div>
</div>