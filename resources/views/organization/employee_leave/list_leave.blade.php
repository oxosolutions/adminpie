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

			@if(!empty($data))
				@foreach($data as $key => $val)

				<div class="card-panel shadow white z-depth-1 hoverable project"  >

					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title=" {{$val->reason_of_leave}}" data-content="TEST">
							{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
							<div class="defualt-logo">
								{{ucwords(substr($val->reason_of_leave, 0, 1))}}
							</div>
							</a>
						</div>
						
						<div class="col l11 s10 editable " >
							<div class="row m-0 valign-wrapper">
								<div class="col s8 m8 l8">
									<input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
									
									<a class="update" leave_id="{{$val->id}}" reason_of_leave="{{$val->reason_of_leave}}" description="{{$val->description}}" total_day_of_leave="{{$val->total_day_of_leave}}" from="{{$val->from}}" to="{{$val->to}}" href="#" data-toggle="popover" title="Popover title" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate line-height-35">
											<span class="project-name shift_name font-size-14" contenteditable="true" > {{$val->reason_of_leave}}</span>
										</h5>
									</a>
								</div>
								
								<div class="col s4 m4 l4 right-align">
								{!! Form::open(['route'=>'list.employeeleave' , 'class'=> 'form-horizontal','method' => 'delete' ,'id'=>'form-delete'])!!}
								<input type="hidden" name="delete_id" value="{{$val->id}}">
								<button type="submit"> Delete </button>
								{!! Form::close() !!}

									<div class="switch">
									    <label>
											
												@if($val->approved_status == '0')
													<span style="color:red;"> Pending for approve ...</span>
												@else
													<span style="color:green;">Approved</span>
												@endif
											
									      
									      
									    </label>
									  </div>
								</div>
							</div>
						</div>
					</div>
						
				</div>
				@endforeach
			@endif
			</div>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add Leave
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['route'=>'list.employeeleave' , 'class'=> 'form-horizontal','method' => 'post' ,'id'=>'form'])!!}
					<input id="methods" type="hidden" name="_method" value="NULL">

					<input class="empty" id="leave_id" type="hidden" name="leave_id" value="NULL">

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input class="empty" id="reason_of_leave" name="reason_of_leave" class="no-margin-bottom aione-field" type="text" placeholder="Reason of leave" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input class="empty" id="description" name="description" class="no-margin-bottom aione-field" type="text" placeholder="Description" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input class="empty datepicker" id="total_day_of_leave" name="total_day_of_leave"  type="date" placeholder="Day of leave" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input class="empty datepicker" id="from" name="from"  type="date" placeholder="From" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input class="empty datepicker" id="to" name="to" type="date" placeholder="To" />
							
						</div>
						
						<div class="col s12 m6 l12 aione-field-wrapper">
							<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Leave
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
				{!!Form::close()!!}

			</div>
			
		</div>
	</div>
</div>
<script type="text/javascript">
		 $('.datepicker').pickadate({
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 15 // Creates a dropdown of 15 years to control year
		  });
		$('.update').off().click(function(e){
			e.preventDefault();
			$("#methods").val('patch');
			$('#leave_id').val($(this).attr('leave_id'));
			$('#reason_of_leave').val($(this).attr('reason_of_leave'));
			$('#description').val($(this).attr('description'));
			$('#total_day_of_leave').val($(this).attr('total_day_of_leave'));
			$('#from').val($(this).attr('from'));
			$('#to').val($(this).attr('to'));
			// $('#reason_of_leave').val($(this).attr('leave_id'));
			// $(this).attr('description');
			// $(this).attr('total_day_of_leave');
			// $(this).attr('from');
			// $(this).attr('to');
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});

		$('.add-new').off().click(function(e){
			e.preventDefault();
			$(".empty").val("");
			$("#methods").val('post');

			//$("#form").attr('method','post');
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});


</script>

@endsection