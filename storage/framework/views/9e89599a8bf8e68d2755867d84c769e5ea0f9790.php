<div id="projects" class="projects list-view">
    <div class="row">
		<div class="col s12 m9 l12 pr-7" >
			<div class="row no-margin-bottom">
				<div class="col s12 m12 l5  pr-7 tab-mt-10" >
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
				<div class="col s6 m6 l2  aione-field-wrapper pl-7 tab-mt-10">
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

				<div class="col s6 m6 l2 pl-7 right-float tab-mt-10 tab-pl-10">
					<div class="row aione-switch-view">
						<ul class="right  views m-0" >
							<li class="inline-block" sty><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
							
							

							<li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>


							<li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
						</ul>
					</div>
				</div>
				
			</div>
			<div class="list" id="notes">
				
			</div>
		</div>
		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add Note
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form " style="background-color: #ffc;">
				<div class="row no-margin-bottom" id="notes">	  
			    	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			        <input type="text" name="title" placeholder="Title ">
			        <textarea id="textarea1" class="materialize-textarea" style="border: 1px solid rgb(161, 161, 161);"></textarea>
					<div class="col s12 m6 l12 aione-field-wrapper">
						<button class="btn waves-effect blue save-note" type="submit">Save Note
							<i class="material-icons right">save</i>
						</button>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
</div>
<style type="text/css">
	#notes > ul > li .fa-times{
		display:none;
	}
	#notes > ul > li:hover .fa-times{
		display: block;
	}
</style>