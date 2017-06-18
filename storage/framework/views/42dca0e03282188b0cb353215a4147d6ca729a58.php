<?php $__env->startSection('content'); ?>
<?php if(!empty(Session::get('success'))): ?>
	<div id="card-alert" class="card green lighten-5"><div class="card-content green-text"><?php echo e(Session::get('success')); ?></div></div>
	
<?php endif; ?>

<div class="fade-background">

</div>
<div id="search" class="projects list-view">
	<div class="row" id="find-project">
		<div class="col s12 m12 l12 " >
			<div class="row no-margin-bottom">
				<div class="col s12 m12 l6  pr-7 tab-mt-10" >
					<!-- <input class="search aione-field" placeholder="Search" /> -->
					<nav>
					    <div class="nav-wrapper">
					      	<form>
						        <div class="input-field">
						          	<input id="search" class="search" type="search" required style="background-color: #ffffff">
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
			<?php $__currentLoopData = $org_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<div class="card-panel shadow white z-depth-1 hoverable project"  >

					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							
							
							<div class="defualt-logo"  data-toggle="popover" title="Click to view details" >
								<?php echo e(ucwords(substr($val->name, 0, 1))); ?>

							</div>
							
						</div>
						
						<div class="col l11 s10 editable " >
							<div class="row m-0 valign-wrapper">
								<div class="col s8 m8 l5">
									
									<a href="#" data-toggle="popover" title="Click here to edit the organization name" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate line-height-35">
											<span class="project-name shift_name font-size-14 name" contenteditable="true" > <?php echo e($val->name); ?></span>
										</h5>
									</a>
								</div>
								<div class="col s8 m8 l3">
									
									<a href="#" data-toggle="popover" title="Organization slug" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate line-height-35">
											<span class="project-name shift_name font-size-14 name" > <?php echo e($val->slug); ?></span>
										</h5>
									</a>
								</div>
								<div class="col s4 m4 l4 right-align">
									<div class="switch">
										<a  href="<?php echo e(route('edit.organization', ['id'=>$val->id])); ?>" data-toggle="popover" title="Click here to edit this Organization">  edit</a>
									    
									 </div>
								</div>
								<div class="col s4 m4 l4 right-align">
									<div class="switch">
										<a onclick="return confirm('Are your sure to Delete Organization?')"  href="<?php echo e(route('delete.organization', ['id'=>$val->id])); ?>" data-toggle="popover" title="Click here to delete this Organization">  <i class="fa fa-trash red-text" aria-hidden="true"></i></a>
									    
									 </div>
								</div>
							</div>
						</div>
					</div>
						
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</div>
		</div>

		
	</div>
</div>
<script type="text/javascript">
	var options = {valueNames:[name]};
	var userList = new List('user',options);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>