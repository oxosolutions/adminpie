@extends('layouts.main')
@section('content')
<!-- PROJECTS -->
<style type="text/css">

</style>
<div id="projects" class="projects">
	<div class="row">
		<div class="col s12 m12 l12">
			<input class="search" placeholder="Search" />
			<button class="sort" data-sort="name">Sort by name</button>
			<button class="sort" data-sort="name">Sort by Date</button>
			<button class="sort" data-sort="name">Sort by Client</button>

		</div>
	</div>
	<div class="row">
	
		<div class="col s12 m12 l8">
			@foreach($employee as  $key => $Val )

				<div class="card-panel shadow white z-depth-1  project">
					<div class="row valign-wrapper" style="margin-bottom: 0px;">
						<div class="col l2 s2 center-align">
							<img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img"> <!-- notice the "circle" class -->
						</div>
						<div class="col l8 s8">
							<h3 class="project-title black-text flow-text truncate">{{$Val->name}}</h3>
							<p class="project-detail truncate">
							{{$Val->email}}
							</p>
						</div>
						<div class=" card-action col l2 S2">
							<div class="fixed-action-btn horizontal click-to-toggle">
						    <a class="btn-floating btn-large dark-grey" style="top:24px">
						      <i class="large material-icons">view_headline</i>
						    </a>
						    <ul style="top:46px">
						      <li><a href="{{route('view.client',$Val->id)}}" data-toggle="popover" title="Eye" data-content="TEST" class="btn-floating blue"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
						      <li><a href="{{route('edit.client', ['id' => $Val->id])}}" data-toggle="popover" title="Popover title" data-content="TEST" class="btn-floating green"><i class="material-icons">mode_edit</i></a></li>
						      <li><a href="{{route('delete.client',$Val->id)}}" data-toggle="popover" title="Popover title" data-content="TEST" class="btn-floating red"><i class="material-icons">delete</i></a></li>
						    </ul>
						  </div>
						</div>
					</div>
					<div class="row project-data">
						<div class="col s12 ">
							<h3 class="project-title black-text flow-text truncate">DATA </h3>
							<p class="project-detail">
							Research based scientific framework to collect, manage, process and visualize big data to fulfill day to day needs of Research Organizations and Enterprises. Research based scientific framework to collect, manage, process and visualize big data to fulfill day to day needs of Research Organizations and Enterprises. Research based scientific framework to collect, manage, process and visualize big data to fulfill day to day needs of Research Organizations and Enterprises.Research based scientific framework to collect, manage, process and visualize big data to fulfill day to day needs of Research Organizations and Enterprises.
							</p>
						</div>
					</div>

					<div class="card-action projects-tags">
							<span>Tags :</span>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Php Programmer</a>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Laravel</a>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Experianced</a>						
					</div>
					{{-- <div class="card-action projects-categories">
							<span>categories :</span>						
							<span class="badge">Management</span>						
							<span class="badge">HR</span>						
							<span class="badge">Hiring</span>				
					</div> --}}


					{{-- <div class="card-action">
						<a href="#" data-toggle="popover" title="Popover title" data-content="TEST">View</a>
						<a href="#" data-toggle="popover" title="Popover title" data-content="TEST">Edit</a>
						<a href="#" data-toggle="popover" title="Popover title" data-content="TEST">Delete</a>
						<a href="#" data-toggle="popover" title="Popover title" data-content="TEST">Archive</a>
					</div> --}}

					{{--<div class="card-action">
						<div class="fixed-action-btn horizontal click-to-toggle">
						    <a class="btn-floating btn-large dark-grey">
						      <i class="large material-icons">view_headline</i>
						    </a>
						    <ul>
						      <li><a href="{{route('view.client',$Val->id)}}" data-toggle="popover" title="Eye" data-content="TEST" class="btn-floating blue"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
						      <li><a href="{{route('edit.client', ['id' => $Val->id])}}" data-toggle="popover" title="Popover title" data-content="TEST" class="btn-floating green"><i class="material-icons">mode_edit</i></a></li>
						      <li><a href="{{route('delete.client',$Val->id)}}" data-toggle="popover" title="Popover title" data-content="TEST" class="btn-floating red"><i class="material-icons">delete</i></a></li>
						    </ul>
						  </div>
					</div> --}}
					
				</div>
			@endforeach



		</div>


		<div class="col s12 m12 l4">

			<div class="card shadow" style="margin-top: 5px;" >	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Clients<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
						<div class="chips chips-initial chips-placeholder chips-autocomplete"></div>
			      </p>
			    </div>
			</div>
			<div class="card shadow">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Categories<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	
			      	<div class="chip">Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Logo Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Graphics <i class="close material-icons">close</i></div>
			      	<div class="chip">Designer <i class="close material-icons">close</i></div>
			      </p>
			    </div>
			</div>

			<div class="card shadow">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Tags<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	
			      	<div class="chip">Custom Design <i class="close material-icons">close</i></div>
			      	<div class="chip">Logo <i class="close material-icons">close</i></div>
			      	<div class="chip">Amritsar <i class="close material-icons">close</i></div>
			      	<div class="chip">Restaurant<i class="close material-icons">close</i></div>
			      	<div class="chip">India<i class="close material-icons">close</i></div>
			      	<div class="chip">Custom<i class="close material-icons">close</i></div>
			      </p>
			    </div>
			</div>

		</div>
	</div>
</div>
<!-- PROJECTS -->
	
@endsection