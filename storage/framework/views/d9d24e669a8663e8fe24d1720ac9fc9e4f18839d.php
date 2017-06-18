<?php $__env->startSection('content'); ?>
	<div class="row">
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
							<div class="col s9 pr-7" style="border:1px solid #e8e8e8;"> 
								<div class="row" style="padding:5px 10px;font-size: 13px;font-weight: 500;">
									<div class="col s6">Name</div>
									<div class="col s2">Recieved Date</div>
									<div class="col s2 right-align">Payment method</div>
									<div class="col s2 right-align">Download Salary Slip</div>	
								</div>
								<div class="divider"></div>
								<div class="row hover-me" style="padding:14px;background-color: #F9F9F9">
									<div class="row valign-wrapper">
										<div class="col s6">
											<div class="row valign-wrapper">
												<div class="col">
													<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
														A
													</div>	
												</div>
												<div class="col" style="padding-left: 10px">
													<div style="" class="">June,2017</div>
													<div class="options">
														<a href="" style="padding-right:10px">View Details</a>
														
													</div>
												</div>
											</div>

										</div>
										<div class="col s2">
											2017/06/09
										</div>
										<div class="col s2 right-align">
											<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="teal darken-1 white-text">BANK</span>
										</div>	
										<div class="col s2 right-align">
											<a href="">Download</a>
										</div>	
									</div>
								</div>
								
								<div class="row hover-me" style="padding:14px;">
									<div class="row valign-wrapper">
										<div class="col s6">
											<div class="row valign-wrapper">
												<div class="col">
													<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
														A
													</div>	
												</div>
												<div class="col" style="padding-left: 10px">
													<div style="" class="">May,2017</div>
													<div class="options">
														<a href="" style="padding-right:10px">View Details</a>
													</div>
												</div>
											</div>

										</div>
										<div class="col s2">
											2017/06/09
										</div>
										<div class="col s2 right-align">
											<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="teal darken-1 white-text">BANK</span>
										</div>	
										<div class="col s2 right-align">
											<a href="">Download</a>
										</div>	
									</div>
								</div>
								
								<div class="row hover-me" style="padding:14px;background-color: #F9F9F9">
									<div class="row valign-wrapper">
										<div class="col s6">
											<div class="row valign-wrapper">
												<div class="col">
													<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
														A
													</div>	
												</div>
												<div class="col" style="padding-left: 10px">
													<div style="" class="">April,2017</div>
													<div class="options">
														<a href="" style="padding-right:10px">View Details</a>
													</div>
												</div>
											</div>

										</div>
										<div class="col s2">
											2017/06/09
										</div>
										<div class="col s2 right-align">
											<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="teal darken-1 white-text">BANK</span>
										</div>	
										<div class="col s2 right-align">
											<a href="">Download</a>
										</div>	
									</div>
								</div>
								
								<div class="row hover-me" style="padding:14px;">
									<div class="row valign-wrapper">
										<div class="col s6">
											<div class="row valign-wrapper">
												<div class="col">
													<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
														A
													</div>	
												</div>
												<div class="col" style="padding-left: 10px">
													<div style="" class="">March,2017</div>
													<div class="options">
														<a href="" style="padding-right:10px">View Details</a>
													</div>
												</div>
											</div>

										</div>
										<div class="col s2">
											2017/06/09
										</div>
										<div class="col s2 right-align">
											<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="teal darken-1 white-text">BANK</span>
										</div>	
										<div class="col s2 right-align">
											<a href="">Download</a>
										</div>	
									</div>
								</div>
							</div>
							<div class="col s3 pl-7">
								<div class="card">
									<div class="row">
										<h6>Salary Structure</h6>
									</div>
									<div class="divider"></div>
									<div class="row">
										<div class="row" style="padding: 10px 0px">
											<div class="col l6">Basic</div>
											<div class="col l6">17625</div>
										</div>
										<div class="row" style="padding: 10px 0px">
											<div class="col l6">Grade pay</div>
											<div class="col l6">6600</div>
										</div>
										<div class="row" style="padding: 10px 0px">
											<div class="col l6">TA</div>
											<div class="col l6">3500</div>
										</div>
										<div class="row" style="padding: 10px 0px">
											<div class="col l6">DA</div>
											<div class="col l6">500</div>
										</div>
										<div class="row" style="padding: 10px 0px">
											<div class="col l6">HRA</div>
											<div class="col l6">1000</div>
										</div>
										<div class="row" style="padding: 10px 0px">
											<div class="col l6">Bonus</div>
											<div class="col l6">100000</div>
										</div>
									</div>
									<div class="divider"></div>
									<div>
										<div class="row" style="padding: 10px 0px">
											<div class="col l6"><strong>Total</strong></div>
											<div class="col l6"> &#8377;<span>374623</span></div>
										</div>
									</div>
								</div>
								<div class="card" >
									<div class="row" style="padding: 10px">Total Earning</div>
									<div class="divider"></div>
									<div class="row" style="padding: 10px">
										 &#8377;<span>3,12,74,623</span>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>