<div class="col l12 mt-14">
	
	<div id="projects" class="projects list-view">
	    <div class="row">
			<div class="col s12 m9 l9 pr-7" >
				
				<div class="list " id="list">
					<div class="card-panel shadow white z-depth-1 hoverable project"  >
						<div class="row valign-wrapper mb-0">
							
							<div class="col l12 s10 editable " >
								<div class="row m-0 valign-wrapper ">
									<div class="col s6 m6 l6 aione-field-wrapper pr-7">
										<?php 
											$url = $_SERVER['REQUEST_URI'];
											$pathArray = explode('/',$url);
										 ?>

											<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="shift_token" >
											<input type="hidden" name="project_id" value="<?php echo e(@$pathArray[3]); ?>" class="project_id" >
										<input type="hidden" name="user_id" value="<?php echo e(Auth::guard('org')->user()->id); ?>" class="user_id" >
											<h5 class="project-title black-text flow-text truncate line-height-35">
												<input type="text" name="todo-name"  placeholder="What need to be done?" class="todo-names aione-field mb-0">
											</h5>
									</div>
									
									<div class="col s3 m3 l3 right-align ph-20 priority_level pr-7">
										<select class="browser-default priority_select">
											<option disabled selected>Select Priority</option>
											<option value="Low">Low</option>
											<option value="Medium">Medium</option>
											<option value="High">High</option>
									    </select>
										<div class="priority-error" >Please Select Priority ..!
										</div>
									</div>
									<div class="col s3 m3 l3">
										<button class="btn blue add-new-todo">Add</button>
									</div>
								</div>
							</div>
						</div>
							
					</div>
					<div id="list_todo"></div>
					<div class="empty-records">
						<div>
							<span>No Result Found</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col s12 m3 l3 pl-7" >
				
				<div id="add_new_wrapper" class="add-new-wrapper add-form ">
					

					<div class="row">
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
				<div class="card filters">
					<center>Categories</center>
					<div class="row waves-effect">
						<label class="">
							<div class="col l10 label">
								All
							</div>
							<div class="col l2 ">
								<input name="categories" type="radio" id="all" />
								<label for="all"></label>
							</div>
						</label>
					</div>
					<div class="divider"></div>
					<div class="row waves-effect" >
						<label>
							<div class="col l10 label" >
								Completed
							</div>
							<div class="col l2 ">
								<input name="categories" type="radio" id="completed" />
								<label for="completed"></label>
							</div>
						</label>
					</div>
					<div class="divider"></div>
					<div class="row waves-effect" >
						<label>
							<div class="col l10 label" >
								In-Completed
							</div>
							<div class="col l2 ">
								<input name="categories" type="radio" id="in-completed" />
								<label for="in-completed"></label>
							</div>
						</label>
					</div>
				</div>
				<div class="card filters"  >
					<center>Priority</center>
					<div class="row waves-effect" >
						<label>
							<div class="col l10 label" >
								High
							</div>
							<div class="col l2">
								<input name="priority" type="radio" id="high" />
								<label for="high"></label>
							</div>
						</label>
					</div>
					<div class="divider"></div>
					<div class="row waves-effect" >
						<label>
							<div class="col l10 label">
								medium
							</div>
							<div class="col l2 ">
								<input name="priority" type="radio" id="medium" />
								<label for="medium"></label>
							</div>
						</label>
					</div>
					<div class="divider"></div>
					<div class="row waves-effect" >
						<label>
							<div class="col l10 label">
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
<style type="text/css">
	.mt-14{
		margin-top: 14px;
	}
	.mb-0{
		margin-bottom: 0px;
	}
	.alpha-sort{
		width: 25%;padding-left:7px;
	}
	.todo-names{
		width: 99% !important
	}
	.priority-error{
		position: absolute;border: 1px solid #e8e8e8;background-color: #e8e8e8;padding:10px;box-shadow: 3px 5px 17px #e8e8e8;margin-top: 10px;
	}
	.empty-records{
		padding: 20px 0px;display: none;
	}
	.empty-records > div{
	padding: 20px;text-align: center;font-size: 28px;color: #e8e8e8;border:2px dashed  #e8e8e8;
	} 
	.filters{
		padding: 12px 0px 0px 0px;margin: 0px;margin-bottom: 14px;
	}
	.filters center{
		border-bottom: 1px solid #e8e8e8;padding-bottom: 12px;
	}
	.filters .row{
		margin-bottom: 0px;width: 100%;padding: 5px;
	}
	.filters .label{
		font-size: 15px;color: black;line-height: 30px
	}
	.mb-0{
		margin-bottom: 0px !important;
	}
	.add-new-todo{
		width: 100%;    height: 48px;
    line-height: 48px;
	}
</style>