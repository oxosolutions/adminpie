@extends('layouts.main')
@section('content')

<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m9 l9 pr-7" >
			<div class="row no-margin-bottom">
				<div class="col s12 m12 l6  pr-7 tab-mt-10" >
					<!-- <input class="search aione-field" placeholder="Search" /> -->
					<nav>
					    <div class="nav-wrapper">
					      	<form>
						        <div class="input-field">
						          	<input id="search" type="search" required style="background-color: #ffffff" class="search-project">
						          	<label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
						          	<i class="material-icons icon-close">close</i>
						        </div>
					      	</form>
					    </div>
					</nav>
				</div>
				<div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10">
					<div class="row aione-sort" style="">
						<select class="col  browser-default aione-field" >
							<option value="" disabled selected>Sort By</option>
							<option value="1">Name</option>
							<option value="2">Date</option>
						</select>
						<div class="col alpha-sort" style="width: 25%;padding-left:7px;">
							<a href="javascript:;" class="sort" ><i class="fa fa-sort-alpha-asc arrow_sort white" ></i></a>
						</div>
					</div>
				</div>

				<div class="col s6 m6 l3 pl-7 right-float tab-mt-10 tab-pl-10">
					<div class="row aione-switch-view">
						<ul class="right  views m-0" >
							<li class="inline-block" sty><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
							
							

							<li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>


							<li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="list" id="list">

		

				
			</div>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add Project
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['route'=>'save.project', 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="name" class="search no-margin-bottom aione-field" type="text" placeholder="Project Name" />
						</div>

						
						<div class="col s12 m3 l12 aione-field-wrapper">
							<select name="category" class="browser-default aione-field">
								<option value="" disabled selected>Project Category</option>
								@foreach($categories as $category)
									<option value="{{$category->id}}" >{{$category->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col s12 m3 l12 aione-field-wrapper center-align">
							<button class="btn blue" type="submit" name="action">Save Project
								
							</button>
						</div>
					</div>
				{!!Form::close()!!}

			</div>
			<div class="col s12 m12 l3">

		
				<!-- <div class="col l12 card shadow" style="margin-top:-10px">	
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
				<div class="col l12 card shadow">	
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
				</div> -->
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});

</script>
	
@endsection