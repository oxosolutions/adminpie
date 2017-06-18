@extends('admin.layouts.main')
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
			
		</div>
		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="" class="btn add-new display-form-button" >
				Add Section
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['route'=>['create.sections' , request()->form_id] , 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom">
			            <div class="input-field col l12">
							<input placeholder="Enter section name" name="section_name" id="user_name" type="text" >
							<label for="user_name">Section Name</label>
			 
			            </div>

			            <div class="input-field col l12">
			              	<input placeholder="Enter slug" name="section_slug" id="emailId" type="text" >
			              	<label for="emailId">Slug</label>
			              	
			            </div>

			            <div class="input-field col l12">
			              <input placeholder="Enter description" name="section_description" id="roleId" type="text" >
			              <label for="roleId">Description</label>
			            </div>
		@if(@$errors->has())
          @foreach($errors->all() as $kay => $err)
            <div style="color: red">{{$err}}</div>
          @endforeach
        @endif
			            <div class="col s12 m12 l12 aione-field-wrapper center-align">
			              <button class="save_user btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save
			                <i class="material-icons right">save</i>
			              </button>
			            </div>
			        </div>
				{!!Form::close()!!}

			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="list" id="list">
		@php $index = 1; @endphp
			@foreach($section as $key => $value)	
				<div class="card-panel shadow white z-depth-1 hoverable project"  >
					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="javascript:void(0)" data-toggle="popover" title="Click here to view details" data-content="TEST">
							<div class="defualt-logo">
								{{ucfirst($value->section_name[0])}}
							</div>
							</a>
						</div>
						
						<div class="col l11 s10 editable " >
							<div class="row m-0 valign-wrapper">
								<div class="col s6 m6 l6">
									<input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
									
									<a href="" data-toggle="popover" title="click here to edit the section name" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate line-height-35">
											<span class="project-name shift_name font-size-14" contenteditable="true" >{{$value->section_name}}</span>
										</h5>
									</a>
								</div>
								
								<div class="col l6 right-align">
									<div class="row valign-wrapper">
										<div class="col l4">
											{{$value->section_slug}}
										</div>
										<div class="col l4">
											<span class="blue white-text" style="padding: 2px 4px">{{count($value->fields)}}</span>
										</div>
										<div class="col l4">
											<a class='dropdown-button btn blue ' href='javascript:;' data-activates='d{{$index}}'>Actions</a>
											<ul id='d{{$index}}' class='dropdown-content'>
											    <li><a href="#">Delete</a></li>
											    <li><a class="field" href="{{route('list.field',['form_id'=>$value->form_id,'section_id'=>$value->id])}}">Fields</a></li>
											</ul>
										</div>

									</div>
																
								</div>
							</div>
						</div>
					</div>
						
				</div>	
				@php $index++; @endphp		
			@endforeach
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