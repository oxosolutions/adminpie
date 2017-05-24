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
	.modal::-webkit-scrollbar-track {
	    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	}
	.modal{
		max-height: 59% !important
	}
 
	.modal::-webkit-scrollbar-thumb {
 		 background-color: darkgrey;
 	 	 outline: 1px solid slategrey;
	}
	.chips .input{
		width: 100% !important;
	}
	textarea{
		background-color: #ffffff;
		border:1px solid #e8e8e8;
		padding: 0px;
		text-indent: 1em;
		
	}
</style>

<div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 p-20 ml-10 mr-10 mb-20">
	{!! Form::open(['class'=> 'form-horizontal','method' => 'post'])!!}

		<div class="row no-margin-bottom">
			<div class="col s12 m2 l3 aione-field-wrapper">
				<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Attendence Title" />
			</div>
			
			<div class="col s12 m2 l3 aione-field-wrapper">
				<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Holiday Description" /></input>
			</div>
			<div class="col l6">
				<div class="file-field input-field" style="margin: 0">
					<div class="btn">
					<span>File</span>
					<input type="file" multiple>
					</div>
					<div class="file-path-wrapper">
					<input disabled class="file-path validate " type="text" placeholder="Upload one or more files" style="background-color: #fff">
					</div>
			    </div>
			</div>

			<div class="col s12 m3 l12 aione-field-wrapper right-align">
				<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action">Save
					<i class="material-icons right">save</i>
				</button>
			</div>
		</div>
	{!!Form::close()!!}
</div>
<div id="projects" class="projects list-view">
	<div class="row">
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
						<a href="javascript:;" class="sort" ><i class="fa fa-sort-alpha-asc arrow_sort white"></i></a>
					</div>
				</div>
			</div>
			<div class="list" id="list">
				<div class="card-panel shadow white z-depth-1 hoverable project">
					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title="Popover title" data-content="TEST">
							{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
							<div class="defualt-logo ">
								{{ucwords(substr('Republic Day', 0, 1))}}
							</div>
							</a>
						</div>
						
						<div class="col l11 s10">
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST">
							<h5 class="project-title black-text flow-text truncate"><span class="project-name">Republic day</span></h5>
							</a>
							<p class="project-detail truncate">
								26 jabuary 2017
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
			</div>
		</div>

		<div class="col s12 m12 l3">
			<a id="add_new" class="add-new" href="#">
				<div class="card shadow hoverable light-blue darken-2 no-margin-top">	
					<div class="card-content center-align p-10">
				      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i>Add new attendence</span>
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
.modal-dialog{
	margin: 0px !important;
	width: 100%;
}
.modal .modal-content {
     padding: 0px; 
}
#modal1,#modal2{
	padding-right: 0px !important;
}
.modal-body{
	    padding-bottom: 12px;
}
.element-item{
	left: 1px !important;
	float: left;
	clear: both
}
.none{
	display: none
}
</style>
	<script type="text/javascript">
	$(document).ready(function(){

		$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active'); 
		});

	});
		
	</script>
@endsection