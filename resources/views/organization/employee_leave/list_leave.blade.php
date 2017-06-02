@extends('layouts.main')
@section('content')
	
<style type="text/css">

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

			

				<div class="card-panel shadow white z-depth-1 hoverable project"  >

					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST">
							
							<div class="defualt-logo">
								
							</div>
							</a>
						</div>
						
						<div class="col l11 s10 editable" >
							<div class="row" style="margin: 0">
								<div class="col l4">
									<input type="hidden" value="" class="id" >
									<input type="hidden" name="_token" value="{{csrf_token()}}" class="_token" >
									
									<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate" style="line-height: 35px">
											<span class="project-name name" contenteditable="true"> </span>
										</h5>
									</a>
								</div>
								<div class="col l2">
									<p class="project-detail truncate from" style="line-height: 35px;margin-bottom: 0px">
										<span  contenteditable="true"></span>
									</p>
								</div>
								<div class="col l1">
									
										<span  contenteditable="true">To</span>
									
								</div>
								<div class="col l2">
									<p class="project-detail truncate to" style="line-height: 35px;margin-bottom: 0px">
										<span  contenteditable="true">  </span>
									</p>
								</div>
								<div class="col l3 right-align">
									<div class="switch">
									    <label>
											
												{{-- @if($val->status == '0')
													<input type="checkbox">
												@else
													<input type="checkbox" checked="checked">
												@endif --}}
											
									      <span class="lever"></span>
									      
									    </label>
									  </div>
								</div>
							</div>
						</div>
					</div>
						
				</div>
			
			</div>
		</div>

		<div class="col s12 m12 l3 pl-7">
			
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add Leave
			</a>
			
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['route'=>'store.leave' , 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="name" class="no-margin-bottom aione-field " type="text" placeholder="Leave Title" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
						{!! Form::select('employee_id',@$employee,null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee'])!!}
						
						</div>

						<div class="col s12 m2 l12 aione-field-wrapper">
						{!! Form::select('leave_category_id',@$leave_cat,null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select leave Type'])!!}
						
						</div>

						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="from" class="no-margin-bottom aione-field " type="text" placeholder="From dd-mm-year" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="to" class="no-margin-bottom aione-field"  type="text" placeholder="To dd-mm-year" />
						</div>
						

						<div class="col s12 m3 l12 aione-field-wrapper">
							<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save leave
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
				{!!Form::close()!!}
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
/*.add-new-wrapper:after{
    content: "";
    position: absolute;
    bottom: -16px;
    right: 100px;
    border-right: 12px solid transparent;
    border-left: 12px solid transparent;
    border-top: 16px solid #0288d1;
}*/
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
			$('.fade-background').fadeToggle(300);
		});
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});

		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/leave/update',
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
			postedData['name'] 			= $(this).parents('.shadow').find('.name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/leave/update',
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