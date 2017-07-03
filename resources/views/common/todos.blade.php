<div class="col l12">
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
							          	<a href=""><i class="material-icons icon-close">close</i></a>
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
				<div class="list " id="list">
					<div class="card-panel shadow white z-depth-1 hoverable project"  >
						<div class="row valign-wrapper no-margin-bottom">
							<div class="col l1 s2 center-align project-image-wrapper">
								
								{{-- <img src="{{ asset('assets/images/sgs_sandhu.jpg') }}" alt="" class="project-image circle responsive-img">  --}}
								<div class="defualt-logo-todo">
									x
								</div>
								</a>
							</div>					
							<div class="col l11 s10 editable " >
								<div class="row m-0 valign-wrapper">
									<div class="col s8 m8 l8">
										@php
											$url = $_SERVER['REQUEST_URI'];
											$pathArray = explode('/',$url);
										@endphp

											<input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
											<input type="hidden" name="project_id" value="{{@$pathArray[3]}}" class="project_id" >
										<input type="hidden" name="user_id" value="{{Auth::guard('org')->user()->id}}" class="user_id" >
											<h5 class="project-title black-text flow-text truncate line-height-35">
												<input type="text" name="todo-name" style="margin-bottom: 0px;font-size: 24px" placeholder="What need to be done?" class="todo-names">
											</h5>
									</div>
									
									<div class="col s4 m4 l4 right-align ph-20 priority_level">
										<select >
											<option disabled selected>Select Priority</option>
											<option value="Low">Low</option>
											<option value="Medium">Medium</option>
											<option value="High">High</option>
									    </select>
										<div class="priority-error" style="position: absolute;border: 1px solid #e8e8e8;background-color: #e8e8e8;padding:10px;box-shadow: 3px 5px 17px #e8e8e8;margin-top: 10px;">Please Select Priority ..!
										</div>
									</div>
								</div>
							</div>
						</div>
							
					</div>
					<div id="list_todo"></div>
					<div style="padding: 20px 0px;display: none;" class="empty-records">
						<div style="padding: 20px;text-align: center;font-size: 28px;color: #e8e8e8;border:2px dashed  #e8e8e8; ">
							<span>No Result Found</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col s12 m3 l3 pl-7" >
				{{-- <a id="add_new" href="#" class="btn add-new display-form-button" >
					Add Todo
				</a> --}}
				<div id="add_new_wrapper" class="add-new-wrapper add-form ">
					

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Note Title" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<textarea  name="name" class="no-margin-bottom aione-field" type="text" placeholder="Description" ></textarea>
						</div>
						

						<div class="col s12 m6 l12 aione-field-wrapper">
							<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Documentation
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
				

				</div>
				<div class="card" style="padding: 12px 0px 0px 0px;margin: 0px" >
					<center style="border-bottom: 1px solid #e8e8e8;padding-bottom: 12px;">Categories</center>
					<div>
						<div>

							<div class="row waves-effect " style="padding:5px 10px;width: 100%;">
								<label class="">
									<div class="col l10" style="font-size: 15px;color: black;line-height: 30px">
										All
									</div>
									<div class="col l2 ">
										<input name="categories" type="radio" id="all" />
										<label for="all"></label>
									</div>
								</label>
							</div>
							
							<div class="divider"></div>
							<div class="row waves-effect" style="padding:5px 10px;width: 100%;">
								<label>
									<div class="col l10" style="font-size: 15px;color: black;line-height: 30px">
										Completed
									</div>
									<div class="col l2 ">
										<input name="categories" type="radio" id="completed" />
										<label for="completed"></label>
									</div>
								</label>
							</div>
							<div class="divider"></div>
							<div class="row waves-effect" style="padding:5px 10px;width: 100%;">
								<label>
									<div class="col l10" style="font-size: 15px;color: black;line-height: 30px">
										In-Completed
									</div>
									<div class="col l2 ">
										<input name="categories" type="radio" id="in-completed" />
										<label for="in-completed"></label>
									</div>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="card" style="padding: 12px 0px 0px 0px;margin: 0px;margin-top: 14px" >
					<center style="border-bottom: 1px solid #e8e8e8;padding-bottom: 12px;">Priority</center>
					<div >
						<div>

							<div class="row waves-effect" style="padding:5px 10px; width: 100%;">
								<label>
									<div class="col l10" style="font-size: 15px;color: black;line-height: 30px">
										High
									</div>
									<div class="col l2">
										<input name="priority" type="radio" id="high" />
										<label for="high"></label>
									</div>
								</label>
							</div>
							
							<div class="divider"></div>
							<div class="row waves-effect" style="padding:5px 10px; width: 100%;">
								<label>
									<div class="col l10" style="font-size: 15px;color: black;line-height: 30px">
										medium
									</div>
									<div class="col l2 ">
										<input name="priority" type="radio" id="medium" />
										<label for="medium"></label>
									</div>
								</label>
							</div>
							<div class="divider"></div>
							<div class="row waves-effect" style="padding:5px 10px; width: 100%;">
								<label>
									<div class="col l10" style="font-size: 15px;color: black;line-height: 30px">
										low
									</div>
									<div class="col l2 ">
										<input name="priority" type="radio" id="low" />
										<label for="low"></label>
									</div>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>