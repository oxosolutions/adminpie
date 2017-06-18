@extends('admin.layouts.main')

@section('content')
	
<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row" >
		<div class="col s12 m9 l9 pr-7" >
			<div class="row no-margin-bottom">
				<div class="col s12 m12 l6  pr-7 tab-mt-10" >
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
			<div class="list" id="list" style="display: none">
				<div class="card" style="padding:5px 10px;margin-bottom: 5px;font-size: 13px;font-weight: 500;">
					<div class="row">
						<div class="col s7">Name</div>
						<div class="col s3">Status</div>
						<div class="col s2">Others</div>	
					</div>
				</div>
				<div class="card-panel shadow white z-depth-1 hoverable project"  >
					<div class="row valign-wrapper">
						<div class="col s7">
							<div class="row valign-wrapper">
								<div class="col">
									<div class="defualt-logo" style="text-align: center">
										A
									</div>	
								</div>
								<div class="col" style="padding-left: 10px">
									<div style="font-weight: 500;" class="">This is the title </div>
									<div class="options">
										<a href="" style="padding-right:10px">Edit</a>
										<a href="" style="padding-right:10px">View</a>
										<a href="" style="padding-right:10px;color: red">Delete</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col s3">
							a
						</div>
						<div class="col s2">
							a
						</div>	
					</div>
				</div>
				<div class="card-panel shadow white z-depth-1 hoverable project"  >
					<div class="row valign-wrapper">
						<div class="col s7">
							<div class="row valign-wrapper">
								<div class="col">
									<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
										A
									</div>	
								</div>
								<div class="col" style="padding-left: 10px">
									<div style="font-weight: 500;" class="">List With date and badge</div>
									<div class="options">
										<a href="" style="padding-right:10px">Edit</a>
										<a href="" style="padding-right:10px">View</a>
										<a href="" style="padding-right:10px;color: red">Delete</a>
									</div>
								</div>
							</div>

						</div>
						<div class="col s3">
							2017/06/09
						</div>
						<div class="col s2 right-align">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
						</div>	
					</div>
					
				</div>
				<div class="card-panel shadow white z-depth-1 hoverable project"  >
					<div class="row valign-wrapper">
						<div class="col s7">
							<div class="row valign-wrapper">
								<div class="col">
									<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
										A
									</div>	
								</div>
								<div class="col" style="padding-left: 10px">
									<div style="font-weight: 500;" class="">list with button and badge</div>
									<div class="options">
										<a href="" style="padding-right:10px">Edit</a>
										<a href="" style="padding-right:10px">View</a>
										<a href="" style="padding-right:10px;color: red">Delete</a>
									</div>
								</div>
							</div>

						</div>
						<div class="col s3">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green darken-1 white-text">ACCOMPLISHED</span>
						</div>
						<div class="col s2 right-align">
							<a href="" class="btn blue">More</a>
						</div>	
					</div>
					
				</div>
				<div class="card-panel shadow white z-depth-1 hoverable project"  >
					<div class="row valign-wrapper">
						<div class="col s7">
							<div class="row valign-wrapper">
								<div class="col">
									<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
										A
									</div>	
								</div>
								<div class="col" style="padding-left: 10px">
									<div style="font-weight: 500;" class="">list with Switch</div>
									<div class="options">
										<a href="" style="padding-right:10px">Edit</a>
										<a href="" style="padding-right:10px">View</a>
										<a href="" style="padding-right:10px;color: red">Delete</a>
									</div>
								</div>
							</div>

						</div>
						<div class="col s3">
							
						</div>
						<div class="col s2 right-align">
							<div class="switch">
								<label>
									     
									<input type="checkbox">
									<span class="lever"></span>
									    
								</label>
							</div>
						</div>	
					</div>
					
				</div>
			</div>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add 
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				

			</div>
			
		</div>
	</div>
	<div class="row" style="display: none">
		<div class="list" id="list">
			<div class="card list-header" style="padding:5px 10px;margin-bottom: 5px;font-size: 13px;font-weight: 500;">
				<div class="row">
					<div class="col s7">Name</div>
					<div class="col s3">Status</div>
					<div class="col s2">Others</div>	
				</div>
			</div>
			<div class="card-panel shadow white z-depth-1 hoverable project"  >
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="defualt-logo" style="text-align: center">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">This is the title </div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col s3">
						a
					</div>
					<div class="col s2">
						a
					</div>	
				</div>
			</div>
			<div class="card-panel shadow white z-depth-1 hoverable project"  >
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
				
			</div>
			<div class="card-panel shadow white z-depth-1 hoverable project"  >
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">list with button and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green darken-1 white-text">ACCOMPLISHED</span>
					</div>
					<div class="col s2 right-align">
						<a href="" class="btn blue">More</a>
					</div>	
				</div>
				
			</div>
			<div class="card-panel shadow white z-depth-1 hoverable project"  >
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">list with Switch</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						
					</div>
					<div class="col s2 right-align">
						<div class="switch">
							<label>
								     
								<input type="checkbox">
								<span class="lever"></span>
								    
							</label>
						</div>
					</div>	
				</div>
				
			</div>
			<div class="row">
				Detailed View design
			</div>
			<div class="card-panel shadow white z-depth-1 hoverable project"  >
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 48px;line-height: 48px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">list with Switch</div>
								<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu felis sodales nibh aliquet pretium.</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						
					</div>
					<div class="col s2 right-align">
						<div class="switch">
							<label>
								     
								<input type="checkbox">
								<span class="lever"></span>
								    
							</label>
						</div>
					</div>	
				</div>
				
			</div>
			<div class="row">
				Grid View
			</div>
			<div class="card-panel shadow white z-depth-1 hoverable project"  >
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 48px;line-height: 48px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">list with Switch</div>
								<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu felis sodales nibh aliquet pretium.</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						
					</div>
					<div class="col s2 right-align">
						<div class="switch">
							<label>
								     
								<input type="checkbox">
								<span class="lever"></span>
								    
							</label>
						</div>
					</div>	
				</div>
				
			</div>
			<div class="row">
				
			</div>
		</div>
	</div>
	{{-- <div class="row">
		<div class="list" id="list" style="margin-top: 14px;border:1px solid #e8e8e8;">
			<div class="row" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
				<div class="col s7">Name</div>
				<div class="col s3">Status</div>
				<div class="col s2">Others</div>	
			</div>
			<div class="divider"></div>
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			<div class="divider"></div>
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			<div class="divider"></div>
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			<div class="divider"></div>
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="list" id="list" style="margin-top: 40px;border:1px solid #e8e8e8;">
			<div class="row" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
				<div class="col s7">Name</div>
				<div class="col s3">Status</div>
				<div class="col s2">Others</div>	
			</div>
			<div class="divider"></div>
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
		</div>
	</div> --}}
	<div class="row">
		<div class="list" id="list" style="margin-top: 40px;border:1px solid #e8e8e8;">
			<div class="row list-header" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
				<div class="col s7">Name</div>
				<div class="col s3">Status</div>
				<div class="col s2 right-align">Others</div>	
			</div>
			<div class="divider"></div>
			<div class="row hover-me" style="padding:14px;background-color: #F9F9F9">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3 extra-option">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3 extra-option">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me" style="padding:14px;background-color: #F9F9F9">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3 extra-option">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3 extra-option">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="row">
		<div class="list" id="list" style="margin-top: 40px;border:1px solid #e8e8e8;">
			<div class="row" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
				<div class="col s7">Name</div>
				<div class="col s3">Status</div>
				<div class="col s2">Others</div>	
			</div>
			<div class="divider"></div>
			<div class="row hover-me hover-me-1" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me hover-me-1" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me hover-me-1" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
			
			<div class="row hover-me hover-me-1" style="padding:14px;">
				<div class="row valign-wrapper">
					<div class="col s7">
						<div class="row valign-wrapper">
							<div class="col">
								<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
									A
								</div>	
							</div>
							<div class="col" style="padding-left: 10px">
								<div style="font-weight: 500;" class="">List With date and badge</div>
								<div class="options">
									<a href="" style="padding-right:10px">Edit</a>
									<a href="" style="padding-right:10px">View</a>
									<a href="" style="padding-right:10px;color: red">Delete</a>
								</div>
							</div>
						</div>

					</div>
					<div class="col s3">
						2017/06/09
					</div>
					<div class="col s2 right-align">
						<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange darken-1 white-text">PENDING</span>
					</div>	
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col l4 " id="new-search">
			<form>
		        <div class="input-field">
		          	<input id="search" type="search" required style="background-color: #ffffff">
		          	<label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
		          	<i class="material-icons icon-close">close</i>
		        </div>
	      	</form>
		</div>
		<div>
			
		</div>
	</div>
	<div style="height: 300px"> --}}
		
	</div>
</div>
<style type="text/css">
	#new-search input[type=search]{
		border: 1px solid #A8AFB1;
	}
	#new-search .input-field input[type=search]+label{
		left: 7px;
	}
	#new-search .input-field input[type=search]{
	    padding-left: 30px;	
	}
	#new-search .icon-search{
		line-height: 18px !important;
	}
	#new-search .icon-close{
		display: none;
	}
	.hover-me-1:hover{
		background-color: #f9f9f9;
	}
	.options{
		position: absolute;
		font-size: 14px;
		display: none;
		margin-top:-3px;
	}
	.card-panel:hover .options{
		display: block
	}
	.hover-me:hover .options{
		display: block
	}

	.switch label .lever{
			width: 30px !important;
			height:16px !important;
		}
		.switch label .lever:after{
			width: 14px !important;
			height: 14px !important;
			left: 1px ;
			top:1px !important;
		}
		.switch label input[type=checkbox]:checked+.lever:after{
			    background-color: white !important;
		}
		.switch label input[type=checkbox]:checked+.lever:after{
			left: 15px;
		}
		.switch label input[type=checkbox]:checked+.lever{
			background-color: #6DAD25 !important;
		}
		.grid-view .hover-me{
			float: left;
    		width: 32%;
    		border: 1px solid #e8e8e8;
    		background-color: white !important;
    		margin-top:14px !important;
    		
		}
		.grid-view .list-header{
			display: none;
		}
		.grid-view .hover-me:nth-child(3n+1){
			margin-left: 7px;
			margin-right: 7px;
		}
		.grid-view .hover-me:nth-child(3n+2){
			margin-left: 7px;
			
		}
		.grid-view .hover-me:nth-child(3n+0){
			margin-right: 7px;
		}
		.grid-view .extra-option{
			display: none;
		}
</style>
@endsection