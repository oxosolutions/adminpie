@extends('layouts.main')
@section('content')

<div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 p-20 ml-10 mr-10 mb-20">
	<div class="row no-margin-bottom">
		{!! Form::open(['method' => 'POST','class' => '','route' => 'store.user']) !!}
		<div class="col s12 m2 l3 aione-field-wrapper">
			<div class="form-group">
				{!!Form::select('user_type[]',App\Model\Organization\UsersType::userTypes(), null, ['class'=>'select2','style'=>'display:block','multiple'=>'multiple','data-placeholder'=>'Select User type'])!!}
			</div>
		</div>
		<div class="col s12 m3 l3 aione-field-wrapper">
			<div class="form-group">
				{!! Form::text('name', null, array('required','class'=>'form-control','placeholder'=>'Enter your name')) !!}
			</div>
		</div>
		<div class="col s12 m3 l3 aione-field-wrapper">
			<div class="form-group">					
				 {!! Form::text('email', null, array('required','class'=>'form-control','placeholder'=>'Your e-mail address')) !!}
			</div>
		</div>
		<div class="col s12 m3 l3 aione-field-wrapper">
			 {!! Form::password('password', array('required','class'=>'form-control','placeholder'=>'Enter password')) !!}
		</div>
		<div class="col s12 m3 l3 aione-field-wrapper right-align pt-10">
			<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action">Save User
				<i class="material-icons right">save</i>
			</button>
		</div>
		{!! Form::close() !!}
	</div>
</div>
 
<div id="projects" class="projects list-view">
	<div class="row" id="find-project">
		<div class="col s12 m12 l9">
			<div class="row no-margin-bottom">
				<div class="col s12 m8 l8 no-padding-left aione-field-wrapper">
					<input class="search  aione-field" placeholder="Search" />
				</div>
				<div class="col s6 m2 l2 aione-field-wrapper">
					<select class="browser-default aione-field">
						<option value="" disabled selected>Sort By</option>
						<option value="1">Name</option>
						<option value="2">Date</option>
					</select>
				</div>
				<div class="col s6 m2 l2 no-padding-right aione-field-wrapper">
					<div class="alpha-sort">
						<a href="javascript:;" data-sort="project-titlename"><i class="fa fa-sort-alpha-asc arrow_sort white"></i></a>
					</div>
				</div>
			</div>
			<div class="list">
			@foreach($userList as $key => $users)
			
				<div class="card-panel shadow white z-depth-1 hoverable project" data-site="{{$users->name}}">
					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title="Popover title" data-content="TEST">
							{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
							<div class="defualt-logo ">
								{{ucwords(substr($users->name, 0, 1))}}
							</div>
							</a>
						</div>
						
						<div class="col l11 s10">
							<a href="{{route('info.user', ['id' => $users->id])}}" data-toggle="popover" title="Popover title" data-content="TEST">
							<h5 class="project-title black-text flow-text truncate"><span class="project-name">{{$users->name}}</span></h5>
							</a>
							<p class="project-detail truncate">
								{{$users->description}}
							</p>
						</div>
					</div>

					<div class="row  project-data">
						<div class="col s12">
							<h3 class="project-title black-text flow-text truncate">DATA </h3>
							<p class="project-detail">
							Research based scientific framework to collect, manage, process and visualize big data to fulfill day to day needs of Research Organizations and Enterprises. 
							</p>
						</div>
					</div>

					<div class="card-action projects-tags">
							<span>Tags :</span>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Php Programmer</a>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Laravel</a>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Experianced</a>						
					</div>
					<div class="card-action projects-categories">
							<span>categories :</span>						
							<span class="badge">Management</span>						
							<span class="badge">HR</span>						
							<span class="badge">Hiring</span>				
					</div>
				</div>
			@endforeach
			</div>
		</div>
		<div class="col s12 m12 l3">

			<a id="add_new" class="add-new" href="#">
				<div class="card shadow light-blue darken-2 no-margin-top">	
					<div class="card-content center-align p-10">
				      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i> Add New User</span>
				    </div>
				</div>
			</a>

			
			<div class="card shadow">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Clients<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      </p>
			    </div>
			</div>
			<div class="card shadow">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Categories<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
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

<script type="text/javascript">




	$('.add-new').click(function(e){
		e.preventDefault();
		$('.add-new-wrapper').toggleClass('active'); 
	});
    var options = {
	  valueNames: [ 'project-name']
	};

	var userList = new List('find-project', options);
	 
</script>

@endsection



