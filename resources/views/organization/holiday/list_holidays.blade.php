@extends('layouts.main')
@section('content')
	
<style type="text/css">
	/*.arrow_sort{
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
		
	}*/
</style>
<div class="fade-background">
</div>

<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l9 pr-7" >
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
			@if(!empty($data))
				@foreach($data as $key => $val)

				<div class="card-panel shadow white z-depth-1 hoverable project"  >

					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title="Popover title" data-content="TEST">
							{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
							<div class="defualt-logo">
								{{ucwords(substr($val->title, 0, 1))}}
							</div>
							</a>
						</div>
						
						<div class="col l11 s10 editable" >
							<div class="row valign-wrapper" style="margin: 0">
								<div class="col l4">
									<input type="hidden" value="{{$val->id}}" class="holiday_id" >
									<input type="hidden" name="_token" value="{{csrf_token()}}" class="holiday_token" >
									
									<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate" style="line-height: 35px">
											<span class="project-name holiday_name" contenteditable="true"> {{$val->title}}</span>
										</h5>
									</a>
								</div>
								<div class="col l4">
									<p class="project-detail truncate holiday_date " style="line-height: 35px;margin-bottom: 0px;margin-top:0px">
										<span  contenteditable="true">{{date('d F Y',strtotime($val->date_of_holiday))}}</span>
									</p>
								</div>
								<div class="col l4 right-align">
									<div class="switch">
									    <label>
											
												@if($val->status == '0')
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
							{{$val->description}}
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

		<div class="col s12 m12 l3 pl-7">
			
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add New Holiday
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['route'=>'store.holiday' , 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="title" class="no-margin-bottom aione-field" type="text" placeholder="Holiday Name" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="date_of_holiday" class="no-margin-bottom aione-field datepicker" type="date" placeholder="Holiday Date" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<textarea name="description" class="no-margin-bottom aione-field" placeholder="Holiday Description" /></textarea>
						</div>

						<div class="col s12 m3 l12 aione-field-wrapper">
							<button class="btn blue" type="submit" name="action">Save Holiday
								
							</button>
						</div>
					</div>
				{!!Form::close()!!}
			</div>
			

		</div>

	</div>
</div>

<style type="text/css">

</style>
	<script type="text/javascript">
	$(document).ready(function(){

		$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active'); 
			$('.fade-background').fadeToggle(300);
		});
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});


		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.holiday_id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('.holiday_token').val();

			$.ajax({
				url:route()+'/holiday/update',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});
		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
			postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.holiday_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.holiday_token').val();

			$.ajax({
				url:route()+'/holiday/update',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});
		$('.editable h5 , .editable p').click(function(e){
			e.preventDefault();
			if (e.which == 13) {        
		        e.preventDefault();
		    }
			$(this).addClass('edit-fields');
		});
		
	});
		
	</script>
@endsection