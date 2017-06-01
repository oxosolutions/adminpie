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
						          	<input id="search" type="search" required style="background-color: #ffffff">
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
			@if(!empty($pages))
				@foreach($pages as $pKey =>$pVal)
				<div class="card-panel shadow white z-depth-1 hoverable project"  >

					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title="Popover title" data-content="TEST">
							{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
							<div class="defualt-logo">
								A
							</div>
							</a>
						</div>
						
						<div class="col l11 s10 " >
							<div class="row valign-wrapper" style="margin: 0">
								<div class="col l4">
									<input type="hidden" value="{{$pVal->id}}" class="page_id" >
									<input type="hidden" name="_token" value="{{csrf_token()}}" class="page_token" >
									
									<a href="{{route('edit.pages',['id'=>$pVal->id])}}" data-toggle="popover" title="Popover title" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate" style="line-height: 35px">
											<span class="project-name holiday_name" >{{$pVal->title}}</span>
										</h5>
									</a>
								</div>
								<div class="col l4">
									<div class="project-detail truncate holiday_date " style="line-height: 35px;margin-bottom: 0px">
										<span  >{{$pVal->created_at}}</span>
									</div>
								</div>
								<div class="col l4 right-align">
									<div class="switch">
									    <label>
											
											
												@if($pVal->status == '0')
													<input type="checkbox">
												@else
													<input type="checkbox" checked="checked">
												@endif
												
										    <span class="lever"></span>
									      
									    </label>
									  </div>
								</div>
							</div>
						</div>
					</div>

					<div class="row  project-data">
						<div class="col s12">
							<h3 class="project-title black-text flow-text truncate">Description </h3>
							<p class="project-detail">
							jhsjaksjkhsah
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
			@endif	
			</div>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add New Page
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['route'=>'store.page' , 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12  input-field">
							{!!Form::text('title',null,['class' => 'validate','placeholder'=>'Enter Title','id'=>'attendence-title','style'=>'color:#fff'])!!}
							<label for="attendence-title">Enter title</label>

						</div>
						<div class="col s12 m2 l12 aione-field-wrapper input-field">
							 {!!Form::select('categories', ['L' => 'sports', 'S' => 'entertainment'], 'S')!!}
					        {{-- <select multiple>
						      <option value="" disabled selected>Choose your option</option>
						      <option value="1">Option 1</option>
						      <option value="2">Option 2</option>
						      <option value="3">Option 3</option>
						    </select>
						    <label>Materialize Multiple Select</label> --}}
			   
						</div>
						

						<div class="col s12 m3 l12 aione-field-wrapper right-align" style="padding: 10px">
							<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" >Save Page
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
				{!!Form::close()!!}

			</div>
			<div class="card-panel shadow mt-22" >
				clients
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