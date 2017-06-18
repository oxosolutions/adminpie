@extends('layouts.main')
@section('content')
	<div class="row">
		@include('organization.profile._tabs')
		<div class="row">
			<div class="fade-background">
			</div>
			<div id="projects" class="projects list-view">
				<div class="row">
					<div class="col s12 m9 l12 pr-7" >
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
						<div class="list row" id="list" >
							
								<div class="row" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
									<div class="col s9">Name</div>
									<div class="col s3">Recieved Date</div>
									
								</div>
								<div class="divider"></div>
								<div class="row hover-me" style="padding:14px;background-color: #F9F9F9">
									<div class="row valign-wrapper">
										<div class="col s9">
											<div class="row valign-wrapper">
												<div class="col">
													<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
														A
													</div>	
												</div>
												<div class="col" style="padding-left: 10px">
													<div style="" class="">Product confirmation mail</div>
													<div class="options">
														<a href="" style="padding-right:10px">View Details</a>
							                        	<a style="padding-right:10px;color: red" href="javascript:;" onclick="return confirm('Are you sure?')"  class="delete" data-toggle="popover" title="Click here to delete this Module">Delete</a>
													</div>
												</div>
											</div>

										</div>
										<div class="col s3">
											2017/06/09
										</div>
										
									</div>
								</div>
								
								<div class="row hover-me" style="padding:14px;">
									<div class="row valign-wrapper">
										<div class="col s9">
											<div class="row valign-wrapper">
												<div class="col">
													<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
														A
													</div>	
												</div>
												<div class="col" style="padding-left: 10px">
													<div style="" class="">Profile updated succesfully</div>
													<div class="options">
														<a href="" style="padding-right:10px">View Details</a>
							                        	<a style="padding-right:10px;color: red" href="javascript:;" onclick="return confirm('Are you sure?')"  class="delete" data-toggle="popover" title="Click here to delete this Module">Delete</a>
													</div>
												</div>
											</div>

										</div>
										<div class="col s3">
											2017/06/09
										</div>
										
									</div>
								</div>
								
								<div class="row hover-me" style="padding:14px;background-color: #F9F9F9">
									<div class="row valign-wrapper">
										<div class="col s9">
											<div class="row valign-wrapper">
												<div class="col">
													<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
														A
													</div>	
												</div>
												<div class="col" style="padding-left: 10px">
													<div style="" class="">Welcome to AdminPie</div>
													<div class="options">
														<a href="" style="padding-right:10px">View Details</a>
														
							                        	<a style="padding-right:10px;color: red" href="javascript:;" onclick="return confirm('Are you sure?')"  class="delete" data-toggle="popover" title="Click here to delete this Module">Delete</a>
													</div>
												</div>
											</div>

										</div>
										<div class="col s3">
											2017/06/09
										</div>
										
									</div>
								</div>
								
								<div class="row hover-me" style="padding:14px;">
									<div class="row valign-wrapper">
										<div class="col s9">
											<div class="row valign-wrapper">
												<div class="col">
													<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
														A
													</div>	
												</div>
												<div class="col" style="padding-left: 10px">
													<div style="" class="">Successfull Registration</div>
													<div class="options">
														<a href="" style="padding-right:10px">View Details</a>
														
							                        	<a style="padding-right:10px;color: red" href="javascript:;" onclick="return confirm('Are you sure?')"  class="delete" data-toggle="popover" title="Click here to delete this Module">Delete</a>
													</div>
												</div>
											</div>

										</div>
										<div class="col s3">
											2017/06/09
										</div>
										
									</div>
								</div>
							
							
								
						</div>
					</div>

					
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		.options{
		position: absolute;
		font-size: 14px;
		display: none;
		margin-top:-3px;
	}
	.hover-me:hover .options{
		display: block
	}
	</style>
@endsection