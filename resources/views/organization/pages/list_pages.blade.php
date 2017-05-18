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

<div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2  create-fields">
	{!! Form::open(['route'=>'store.page' , 'class'=> 'form-horizontal','method' => 'post'])!!}

		<div class="row no-margin-bottom">
			<div class="col s12 m2 l4  input-field">
				{!!Form::text('title',null,['class' => 'validate','placeholder'=>'Enter Title','id'=>'attendence-title','style'=>'color:#fff'])!!}
				<label for="attendence-title">Enter title</label>

			</div>
			<div class="col s12 m2 l4 aione-field-wrapper input-field">
				 {!!Form::select('categories', ['L' => 'sports', 'S' => 'entertainment'], 'S')!!}
		        {{-- <select multiple>
			      <option value="" disabled selected>Choose your option</option>
			      <option value="1">Option 1</option>
			      <option value="2">Option 2</option>
			      <option value="3">Option 3</option>
			    </select>
			    <label>Materialize Multiple Select</label> --}}
   
			</div>
			

			<div class="col s12 m3 l4 aione-field-wrapper right-align" style="padding: 10px">
				<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" >Save Page
					<i class="material-icons right">save</i>
				</button>
			</div>
		</div>
	{!!Form::close()!!}
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l9 "  style="padding: 0px">
			<div class="row no-margin-bottom">
				<div class="col s12 m8 l8 no-padding-left aione-field-wrapper" style="padding: 0px">
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

		<div class="col s12 m12 l3">
			<a id="add_new" class="add-new" href="#">
				<div class="card shadow hoverable light-blue darken-2 no-margin-top" >	
					<div class="card-content center-align " style="padding: 10px">
				      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i> New Page</span>
				    </div>
				</div>
			</a>
			{{-- <div class="card shadow">	
				<div class="card-content">
			      <span class="card-title activator blue-text text-darken-2">Clients<i class="material-icons">priority_high</i></span>
			      <div class="divider"></div>
			      <p class="p-20">
			      </p>
			    </div>
			</div> --}}
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
.list-view .project .project-detail{
    display:block;
}
[contenteditable]:focus{
	outline: 0px solid transparent;
}
.edit-fields{
	border:1px solid #e8e8e8;padding: 5px;
}
.shadow l4{
	min-width: 100%;
}
</style>
	<script type="text/javascript">
	$(document).ready(function(){

		$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active'); 
		});

		// $(document).on('blur', '.edit-fields',function(e){
		// 	e.preventDefault();
		// 	var postedData = {};
		// 	//postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
		// 	//postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
		// 	postedData['id'] 				= $(this).parents('.shadow').find('.page_id').val();
		// 	postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
		// 	postedData['_token'] 			= $('.shadow').find('.page_token').val();

		// 	$.ajax({
		// 		url:route()+'/page/update',
		// 		type:'POST',
		// 		data:postedData,
		// 		success: function(res){
		// 			console.log('data sent successfull');
		// 		}
		// 	});
		// 	$('.editable h5 ,.editable p').removeClass('edit-fields');
		// });
		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
			//postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			//postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.page_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.page_token').val();

			$.ajax({
				url:route()+'/page/update',
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