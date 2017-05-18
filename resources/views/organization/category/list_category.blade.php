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
		{!! Form::open(['route'=>'store.leaveCat' , 'class'=> 'form-horizontal','method' => 'post'])!!}

			<div class="row no-margin-bottom">
				<div class="col s12 m2 l3 aione-field-wrapper">
					<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Department Title" />
				</div>
				

				<div class="col s12 m3 l3 aione-field-wrapper">
					<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Category
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

					@if(!empty($data))
						@foreach($data as $key => $val)

						<div class="card-panel shadow white z-depth-1 hoverable project"  >

							<div class="row valign-wrapper no-margin-bottom" >
								<div class="col l1 s2 center-align project-image-wrapper">
									<a href="{{-- {{route('add_project_info.project', ['id' => $projVal->id])}} --}}" data-toggle="popover" title="Popover title" data-content="TEST">
									{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
									<div class="defualt-logo">
										{{ucwords(substr($val->name, 0, 1))}}
									</div>
									</a>
								</div>
								
								<div class="col l11 s10 editable" >
									<div class="row" style="margin: 0">
										<div class="col l6">
											<input type="hidden" value="{{$val->id}}" class="id" >
											<input type="hidden" name="_token" value="{{csrf_token()}}" class="_token" >
											
											<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" >
												<h5 class="project-title black-text flow-text truncate" style="line-height: 35px">
													<span class="project-name name" contenteditable="true"> {{$val->name}}</span>
												</h5>
											</a>
										</div>
										
										<div class="col l6 right-align">
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
							<div class="row valign-wrapper no-margin-bottom">
								<div class="col l11 s10">
									<div class="col l12 right-align">
										@foreach($val->rule as $rkey =>$rVal)
											@php
												$dayys[$rVal->designation_id] = $rVal->days;
											
											@endphp
										@endforeach
										<h5>Leave Rules	</h5>
											{{-- {{dump($designation)}} --}}
											{!! Form::open(['route'=>'rule.leave'])!!}
											<input name="leave_category_id" type="hidden" value="{{$val->id}}" class="id" >
										<table>
											<tr><th>Designation</th> <th> Apply Before day</th></tr>
											
											@foreach($designation as $dkey => $dval)
												<tr>
													<td>
														<input name="designation_id[]" type="hidden" value="{{$dkey}}" class="id" >{{$dval}} </td> 
													<td>
														 {!! Form::select('days[]',[0,1,2,3,4,5,6,7],@$dayys[$dkey]) !!}
														 @php 
														 unset($dayys[$dkey]); 
														 @endphp	
													</td>
												</tr>
											@endforeach 
											
										</table>
										<input type="submit">
											{!! Form::close() !!}

									</div>
								</div>
							</div>
								
						</div>
						@endforeach
					@endif
				</div>
			</div>

			<div class="col s12 m12 l3">
				<a id="add_new" class="add-new" href="#">
					<div class="card shadow hoverable light-blue darken-2 no-margin-top">	
						<div class="card-content center-align p-10">
					      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i> New Leave Category</span>
					    </div>
					</div>
				</a>
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

		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.name').text();
			postedData['id'] 				= $(this).parents('.shadow').find('.id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/leave/categories/update',
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
			postedData['id'] 				= $(this).parents('.shadow').find('.id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/leave/categories/update',
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