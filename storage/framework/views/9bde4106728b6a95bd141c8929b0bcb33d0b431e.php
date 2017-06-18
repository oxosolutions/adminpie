<?php $__env->startSection('content'); ?>
	
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
			<div class="list">
			<?php $__currentLoopData = $userList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<div class="card-panel shadow white z-depth-1 hoverable project" data-site="<?php echo e($users->name); ?>">
					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="" data-toggle="popover" title="Popover title" data-content="TEST">
							
							<div class="defualt-logo ">
								<?php echo e(ucwords(substr($users->name, 0, 1))); ?>

							</div>
							</a>
						</div>
						
						<div class="col l11 s10">
							<a href="<?php echo e(route('info.user', ['id' => $users->id])); ?>" data-toggle="popover" title="Popover title" data-content="TEST">
							<h5 class="project-title black-text flow-text truncate"><span class="project-name"><?php echo e($users->name); ?></span></h5>
							</a>
							<p class="project-detail truncate">
								<?php echo e($users->description); ?>

							</p>
						</div>
					</div>

					<div class="row  project-data">
						<div class="col s12">
							<h3 class="project-title black-text flow-text truncate">DATA </h3>
							<p class="project-detail">
							Research based scientific framework to collect, manage, process and visualize big data to fulfill day to day needs of Research Organizations and Enterprises. 
							</p>
						</div>
					</div>

					<div class="card-action projects-tags">
							<span>Tags :</span>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Php Programmer</a>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Laravel</a>						
							<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" class="chip">Experianced</a>						
					</div>
					<div class="card-action projects-categories">
							<span>categories :</span>						
							<span class="badge">Management</span>						
							<span class="badge">HR</span>						
							<span class="badge">Hiring</span>				
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add New User
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				<?php echo Form::open(['method' => 'POST','class' => '','route' => 'store.user']); ?>

					<div class="col s12 m2 l3 aione-field-wrapper">
						<div class="form-group">
							<?php echo Form::select('user_type[]',App\Model\Organization\UsersType::userTypes(), null, ['class'=>'select2','style'=>'display:block','multiple'=>'multiple','data-placeholder'=>'Select User type']); ?>

						</div>
					</div>
					<div class="col s12 m3 l3 aione-field-wrapper">
						<div class="form-group">
							<?php echo Form::text('name', null, array('required','class'=>'form-control','placeholder'=>'Enter your name')); ?>

						</div>
					</div>
					<div class="col s12 m3 l3 aione-field-wrapper">
						<div class="form-group">					
							 <?php echo Form::text('email', null, array('required','class'=>'form-control','placeholder'=>'Your e-mail address')); ?>

						</div>
					</div>
					<div class="col s12 m3 l3 aione-field-wrapper">
						 <?php echo Form::password('password', array('required','class'=>'form-control','placeholder'=>'Enter password')); ?>

					</div>
					<div class="col s12 m3 l3 aione-field-wrapper right-align pt-10">
						<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action">Save User
							<i class="material-icons right">save</i>
						</button>
					</div>
					<?php echo Form::close(); ?>


			</div>
			<div class="card-panel shadow mt-22" >
				clients
			</div>
		</div>
	</div>
</div>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>