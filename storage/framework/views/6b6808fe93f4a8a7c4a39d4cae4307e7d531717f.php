		<div class="ar">
			<div class="ac l75">
				<div class="aione-border mb-25">
					<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
						Add new todo	
					</div>
					<div class="pv-20 ph-10">
						<div class="ar">
							<div class="ac l75">

								<?php 
									$url = $_SERVER['REQUEST_URI'];
									$pathArray = explode('/',$url);
								 ?>

									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="shift_token" >
									<input type="hidden" name="project_id" value="<?php echo e(@$pathArray[3]); ?>" class="project_id" >
									<input type="hidden" name="user_id" value="<?php echo e(Auth::guard('org')->user()->id); ?>" class="user_id" >
								<?php echo FormGenerator::GenerateForm('add-todo-list-form'); ?>		
							</div>
							<div class="ac l25">
								<button class="add-new-todo" style="width: 100%">Add Todo</button>
							</div>
						</div>
								
					</div>
				</div>
				<div class="aione-border mb-25">
					<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
						All Todos	
					</div>
					<div class="pv-20 ph-10">
						<div class="aione-table">
							<table>
								<tbody id="list_todo">
									
								</tbody>
							</table>
						</div>
						
						<div class="empty-records">
							<div class="aione-message error">
								No Result Found
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ac l25">
				<div class="aione-border mb-25">
					<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
						Categories	
					</div>
					<div class="">
						<div class="filters">
							
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
					</div>
				</div>
				<div class="aione-border mb-25">
					<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
						Priority	
					</div>
					<div class="">
						<div class="p-0 filters "  >
							
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
	 .edit-mode{
	 	display: none
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
	.empty-records{
		display: none;
	}
</style>