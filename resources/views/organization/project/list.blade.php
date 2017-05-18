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
</style>
<!-- PROJECTS -->
<div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 create-fields">
{!! Form::open(['route'=>'save.project', 'class'=> 'form-horizontal','method' => 'post'])!!}

	<div class="row no-margin-bottom">
		<div class="col s12 m2 l3 aione-field-wrapper">
			<input name="name" class="search no-margin-bottom aione-field" type="text" placeholder="Project Name" />
		</div>

		
		<div class="col s12 m3 l3 aione-field-wrapper">
			<select name="category" class="browser-default aione-field">
				<option value="" disabled selected>Project Category</option>
				@foreach($categories as $category)
					<option value="{{$category->id}}" >{{$category->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col s12 m3 l3 aione-field-wrapper right-align">
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
					<input class="search-project aione-field" placeholder="Search" />
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
			<div class="list" id="list">
				
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
			      <p class="p-20">
			      	@foreach($clients as $client)
			      		<div class="chip">{{$client->name}} <i class="close material-icons">close</i></div>
			      	@endforeach
			      </p>
			      	<div class="input-field col s12">
			         
			          <input type="text" id="autocomplete-input" class="autocomplete">
			          
			        </div>
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

<script type="text/javascript">
	window.tag = '{!!json_encode($tags)!!}';
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
		 $('.chips').material_chip();
			    $('.chips-autocomplete').material_chip({
    autocompleteOptions: {
      data: {
        'Apple': null,
        'Microsoft': null,
        'Google': null
      },
      limit: Infinity,
      minLength: 1
    }
  });
        
		$('.add-new').click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active'); 
		});

			var classArray = [];
			var myclass = [];



		$(document).on('click','.new-sort',function(e){
			$(this).parents('.shadow').length ;
			var i = 0;
			$('.shadow').each(function(i,e){
				myclass.push([$(this).attr('class')]);
			});
			
			if(myclass[0] < myclass[1]){
				console.log(myclass[0] < myclass[1]);
			}else{

			}
		});

	

	});
		
	</script>

	
@endsection