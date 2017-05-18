@extends('layouts.main')
@section('content')
<style type="text/css">
	.arrow_sort{
		line-height: 43px;
		width: 43px;
		text-align: center;
		border: 1px solid #e8e8e8;
		border-radius: 2px;
		font-size: 18px
	}
	.alpha-sort a{
		color: black
	}
	.modal::-webkit-scrollbar {
    width: 6px;
}

 
.modal::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
.modal label{
	font-size: 16px !important;
}
</style>
<!-- PROJECTS -->
{{-- <div id="users">
  <input class="search" placeholder="Search" />
  <button class="sort" data-sort="name">
    Sort
  </button>

	<div class="list">
		<div>
			<h3 class="name">Jonny Stromberg</h3>
			<p class="born">1986</p>
		</div>
		<div>
			<h3 class="name">Jonas Arnklint</h3>
			<p class="born">1985</p>
		</div>
		<div>
			<h3 class="name">Martina Elm</h3>
			<p class="born">1986</p>
		</div>
		<div>
			<h3 class="name">Gustaf Lindqvist</h3>
			<p class="born">1983</p>
		</div>
	</div>

</div> --}}
<script type="text/javascript">
    var options = {
	  valueNames: [ 'project-name']
	};

	var userList = new List('find-project', options);
</script>
<div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 p-20 ml-10 mr-10 mb-20">
{!! Form::open(['route'=>'save.team', 'class'=> 'form-horizontal','method' => 'post'])!!}

	<div class="row no-margin-bottom">
		<div class="col s12 m2 l4 aione-field-wrapper">
			<input name="title" class="search no-margin-bottom aione-field" type="text" placeholder="Project Name" />
		</div>
		<div class="col s12 m3 l4 aione-field-wrapper">
			<textarea name="description" class="white" rows='2' placeholder="Add Some Description"></textarea>
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
					{{-- <select class="browser-default aione-field">
						<option value="1">ASC</option>
						<option value="2">DESC</option>
					</select> --}}
					<div class="alpha-sort">
						<a href="javascript:;" class="sort" data-sort="name"><i class="fa fa-sort-alpha-asc arrow_sort white"></i></a>
					</div>
				</div>
			</div>
			<div class="list">
				@foreach($team_data as $teamKey => $teamVal )
					<div class="card-panel white z-depth-1 shadow project " >
						<div class="row valign-wrapper no-margin-bottom  ">
							<div class="col l1 s2 center-align project-image-wrapper">
								<a href="{{route('info.team', ['id' => $teamVal->id])}}" data-toggle="popover" title="Popover title" data-content="TEST">
								{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
								<div class="image-alternate defualt-logo" >{{ucwords(substr($teamVal->title, 0, 1))}}</div>
								</a>
							</div>
							
							<div class="col l11 s10 ">
								<a href="{{route('info.team', ['id' => $teamVal->id])}}" data-toggle="popover" title="Popover title" data-content="TEST">
								<h3 class="project-title black-text flow-text truncate project-name">{{$teamVal->title}}</h3>
								</a>
								<p class="project-detail truncate">
								{{$teamVal->description}}
								</p>
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
				@endforeach
			</div>
		</div>




		<div class="col s12 m12 l3">

			<a id="add_new" class="add-new" href="#">
				<div class="card shadow light-blue darken-2 no-margin-top">	
					<div class="card-content center-align p-10 valign-wrapper">
				      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i><span>Add New Team</span></span>
				    </div>
				</div>
			</a>

			{{-- <div class="card hoverable">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2 ">Clients<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
						<div class="chips chips-initial chips-placeholder chips-autocomplete"></div>
			      </p>
			    </div>
			</div> --}}
			
			<div class="card shadow" style="margin-top: -10px;">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Clients<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	{{-- @foreach($clients as $client)
			      		<div class="chip">name<i class="close material-icons">close</i></div>
			      	@endforeach --}}
			      </p>
			    </div>
			</div>
			<div class="card shadow">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Categories<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      	{{-- @foreach($categories as $key => $category)
			      		<div class="chip">catg name<i class="close material-icons">close</i></div>
			      	@endforeach --}}
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

{{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_theme_primary">Launch <i class="icon-play3 position-right"></i></button> --}}


<div id="modal_theme_primary" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary" >
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h6 class="modal-title">Add New Client</h6>
			</div>

			<div class="modal-body">
			{!! Form::open(['route'=>'save.client', 'class'=> 'form-horizontal','method' => 'post'])!!}
				<div class="form-group">
				{!!Form::label('name', 'Enter Client Name:', ['class' => 'col-lg-3 control-label']);
				!!}
					{{-- <label class="col-lg-3 control-label">Enter Project Title:</label> --}}
					<div class="col-lg-9">
					{!!Form::text('name',null,['class' => 'form-control'])!!}
						{{-- <input type="text" name="name" class="form-control" placeholder="Enter Project Title"> --}}
					</div>
				</div>

				<div class="form-group">
				{!!Form::label('name', 'Enter Company Name:', ['class' => 'col-lg-3 control-label']);
				!!}
					{{-- <label class="col-lg-3 control-label">Enter Project Title:</label> --}}
					<div class="col-lg-9">
					{!!Form::text('company_name',null,['class' => 'form-control'])!!}
						{{-- <input type="text" name="name" class="form-control" placeholder="Enter Project Title"> --}}
					</div>
				</div>
				{{-- 'address', 'country', 'state', 'city', 'email', 'phone', 'additional_info' --}}
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
				<div class="form-group">
				{!! Form::label('adrs','Country' , ['class' => 'col-lg-3 control-label']) !!}
					<div class="col-lg-9">

					{!!Form::select('country', ['IND' => 'India', 'CAN' => 'Canada'], null, [ 'class' => 'form-control' ,'placeholder' => 'select country.'])!!}

					</div>
				</div>
				<div class="form-group">
				{!! Form::label('adrs','State' , ['class' => 'col-lg-3 control-label']) !!}
					<div class="col-lg-9">

					{!!Form::select('state', ['Pb' => 'punjab', 'HRY' => 'harayana'], null, [ 'class' => 'form-control' ,'placeholder' => 'select State.'])!!}

					</div>
				</div>
				<div class="form-group">
				{!! Form::label('adrs','City' , ['class' => 'col-lg-3 control-label']) !!}
					<div class="col-lg-9">

					{!!Form::select('city', ['ASR' => 'Amritsar', 'KAR' => 'Karnal'], null, [ 'class' => 'form-control' ,'placeholder' => 'select City'])!!}

					</div>
				</div>
				<div class="form-group">
				{!! Form::label('adrs','Address' , ['class' => 'col-lg-3 control-label']) !!}
					<div class="col-lg-9">

						{!!Form::text('address',null,['class' => 'form-control'  ])!!}

					</div>
				</div>
				<div class="form-group">
				{!! Form::label('phone','phone' , ['class' => 'col-lg-3 control-label']) !!}
					<div class="col-lg-9">

						{!!Form::text('phone',null,['class' => 'form-control'  ])!!}

					</div>
				</div>
				<div class="form-group">
				{!! Form::label('adrs','Additional information' , ['class' => 'col-lg-3 control-label']) !!}
					<div class="col-lg-9">

						{!!Form::textarea('additional_info',null,['class' => 'form-control'  ])!!}

					</div>
				</div>
				{{-- <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button> --}}
				<div class="right-align">
				{!! Form::button('Create User<i class="icon-arrow-right14 position-right"></i>', array('required','class'=>'btn waves-effect waves-light  noty-runner','data-layout'=>'top','data-type'=>'success','type'=>'submit')) !!}
				</div>
			{!!Form::close()!!}
			</div>

			
		</div>
	</div>
</div>








<script type="text/javascript">
$(document).ready(function(){


	$(document).on('click','.arrow_sort',function(e){
		e.preventDefault();
		if($(this).hasClass('fa-sort-alpha-asc')){
			$(this).removeClass('fa-sort-alpha-asc');
			$(this).addClass('fa-sort-alpha-desc');
		}else{
			$(this).removeClass('fa-sort-alpha-desc');
			$(this).addClass('fa-sort-alpha-asc');
		}
	});
	
	
});

</script>
<style type="text/css">
.add-new-wrapper{
	display:none;
	position: relative;
}
.add-new-wrapper.active{
	display:block;
}
.add-new-wrapper:after{
    content: "";
    position: absolute;
    bottom: -16px;
    right: 100px;
    border-right: 12px solid transparent;
    border-left: 12px solid transparent;
    border-top: 16px solid #0288d1;
}
.project{
	/*
	-moz-transition: all .25s;
	-webkit-transition: all .25s;
	transition: all .25s;
	*/
}
/*.project .project-title{
	margin-top: 0;
}
.project .project-data{
	display:none;
}
.list-view .project{
	padding: 8px;
}

.list-view .projects-tags{
	display:none;
}
.list-view .projects-categories{
	display:none;
}
.list-view .project .project-image {
	width: 50%;
}
.list-view .project .project-title{
	margin-bottom: 0;
}
.list-view .project .project-detail{
	display:none;
}

.grid-view .project{
	width: 48.5%;
	float:left;
	margin-right: 3%;
}
.grid-view .project:nth-child(odd){
	margin-right: 0;
}

.grid-view .project .project-data{
	display:block;
}*/
.modal-dialog{
	margin: 0px !important;
	width: 100%;
}
.modal .modal-content {
     padding: 0px; 
}
#modal_theme_primary{
	padding-right: 0px !important;
}
</style>
<script type="text/javascript">
	$('.add-new').click(function(e){
		e.preventDefault();
		$('.add-new-wrapper').toggleClass('active'); 
	});
</script>

	
@endsection