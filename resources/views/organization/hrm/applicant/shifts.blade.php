@extends('layouts.main')
@section('content')
<script type="text/javascript">
	
</script>

<div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 p-20 ml-10 mr-10 mb-20">
{!! Form::open(['route'=>'save.project', 'class'=> 'form-horizontal','method' => 'post'])!!}

	<div class="row no-margin-bottom">
		<div class="col s12 m2 l3 aione-field-wrapper">
			<input name="name" class="search no-margin-bottom aione-field" type="text" placeholder="Project Name" />
		</div>

		
		<div class="col s12 m3 l3 aione-field-wrapper">
			<select name="category" class="browser-default aione-field">
				<option value="" disabled selected>Project Category</option>
				
			</select>
		</div>
		<div class="col s12 m3 l3 aione-field-wrapper">
			<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action">Save Project
				<i class="material-icons right">save</i>
			</button>
		</div>
	</div>
			{!!Form::close()!!}

</div>
<div id="projects" class="projects list-view">
	<div class="row"  id="find-project">
		
		<div class="col s12 m12 l9 " >
			<div class="row no-margin-bottom">
				<div class="col s12 m8 l8 no-padding-left aione-field-wrapper">
					<input class="search aione-field" placeholder="Search" />
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
			<div class="list" >
				<div class="card-panel white z-depth-1 shadow project " >
					<div class="row valign-wrapper no-margin-bottom  ">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST">
							{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
							<div class="image-alternate defualt-logo" >SA</div>
							</a>
						</div>
						
						<div class="col l2 s10 ">
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST">
							<h3 class="project-title black-text flow-text truncate project-name">Shift A</h3>

							</a>

							<p class="project-detail truncate">
							this desc
							</p>
							
						</div>
						<div class="col l9">
							<div class="col l6 valign-wrapper">Time : 6:00 am to 2:00pm</div>
							<div class="col l6">
							 
									{{-- <span><input type="checkbox" id="test1" /><label for="test1">Sunday</label></span>
									<span><input type="checkbox" id="test2" /><label for="test2">Monday</label></span>
									<span><input type="checkbox" id="test3" /><label for="test3">Tuesday</label></span>
									<span><input type="checkbox" id="test4" /><label for="test4">Wednesday</label></span>
									<span><input type="checkbox" id="test5" /><label for="test5">Thrusday</label></span>
									<span><input type="checkbox" id="test6" /><label for="test6">Friday</label></span>
									<span><input type="checkbox" id="test7" /><label for="test7">Saturday</label></span> --}}
									<div class="input-field col s12">
									    <select multiple class="shift-select">
									      
									        <option value="1">Sunday</option>
									        <option value="2">Monday</option>
									        <option value="2">Tuesday</option>
									        <option value="2">Wednesday</option>
									        <option value="2">Thrusday</option>
									        <option value="2">Friday</option>
									        <option value="2">Saturday</option>
									      
									    </select>
									   
									</div>
								 
								
							</div>
						</div>
					</div>
					<div class="row  project-data">
						<div class="col s12">
							<h3 class="project-title black-text flow-text truncate">DATA </h3>
							<p class="project-detail">
							Research based scientific framework to collect, manage, process and visualize big data to fulfill day to day needs of Research Organizations and Enterprises. Research based scientific
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
			</div>
			
		</div>




		<div class="col s12 m12 l3">

			<a id="add_new" class="add-new" href="#">
			<div class="card shadow hoverable light-blue darken-2 no-margin-top">	
				<div class="card-content center-align p-10">
			      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i> Add New Project</span>
			    </div>
			</div>
			</a>
			<div class="card shadow" style="margin-top:-10px">	
				<div class="card-content">
					<span class="card-title activator blue-text text-darken-2 left-align">Clients<i class="material-icons">priority_high</i> 
						<a class="btn-floating btn-small waves-effect waves-light blue right-align" data-toggle="modal" data-target="#modal1" style="float: right;line-height: 48px"><i class="material-icons">add</i></a>
					</span>
			   

			      <div class="divider"></div>
			     {{--  <p class="p-20">
			      	@foreach($clients as $client)
			      		<div class="chip">{{$client->name}} <i class="close material-icons">close</i></div>
			      	@endforeach
			      </p>
			      	<div class="input-field col s12">
			         
			          <input type="text" id="autocomplete-input" class="autocomplete">
			          
			        </div> --}}
			        <div class="chips chips-autocomplete"></div>
			        <div style="clear: both">
			        	
			        </div>
			    </div>
			</div>
			<div class="card shadow">	
				<div class="card-content">
					<span class="card-title activator blue-text text-darken-2">Categories<i class="material-icons">priority_high</i>
						<a class="btn-floating btn-small waves-effect waves-light blue right-align" style="float: right;line-height: 48px" href="{{route('categories.project')}}"><i class="material-icons">add</i></a>
					</span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	{{-- @foreach($categories as $key => $category)
			      		<div class="chip">{{$category->name}} <i class="close material-icons">close</i></div>
			      	@endforeach --}}
			      	<div class="chips chips-autocomplete"></div>
			      </p>
			    </div>
			</div>

			<div class="card shadow">	
				<div class="card-content">
					<span class="card-title activator blue-text text-darken-2">Tags<i class="material-icons">priority_high</i>
					</span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	{{-- @foreach($tags as $key => $tag)
			      		<div class="chip">{{$tag}} <i class="close material-icons">close</i></div>
			      	@endforeach --}}
			      	<div class="chips chips-autocomplete projects-chips"></div>
			      </p>
			    </div>
			</div>
		</div>
	</div>
</div>
<!-- PROJECTS -->

{{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_theme_primary">Launch <i class="icon-play3 position-right"></i></button> --}}


<div id="modal1" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary" >
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title">Add New Client</h6>
			</div>

			<div class="modal-body">
			{!! Form::open(['route'=>'add_client.project', 'class'=> 'form-horizontal','method' => 'post'])!!}
				<div class="form-group">
					{!!Form::label('name', 'Name:', ['class' => 'col-lg-3 control-label']);
					!!}
					{{-- <label class="col-lg-3 control-label">Enter Project Title:</label> --}}
					<div class="col-lg-9">
					{!!Form::text('name',null,['class' => 'form-control'])!!}
						{{-- <input type="text" name="name" class="form-control" placeholder="Enter Project Title"> --}}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('email','Email' , ['class' => 'col-lg-3 control-label']) !!}
					<div class="col-lg-9">

						{!!Form::text('email',null,['class' => 'form-control'  ])!!}

					</div>
				</div>
				<div class="form-group">
					{!! Form::label('password','Password' , ['class' => 'col-lg-3 control-label']) !!}
					<div class="col-lg-9">

						{!!Form::password('password',null,['class' => 'form-control'  ])!!}

					</div>
				</div>
				
				<div class="right-align">
				{{-- {!! Form::button('Create User<i class="icon-arrow-right14 position-right"></i>', array('required','class'=>'btn waves-effect waves-light  noty-runner','data-layout'=>'top','data-type'=>'success','type'=>'submit')) !!} --}}
				<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
				</div>
			{!!Form::close()!!}
			</div>

			
		</div>
	</div>
</div>

@endsection
