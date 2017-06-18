
<?php $__env->startSection('content'); ?>
	<style type="text/css">
		.error-red{
			color: red
		}
		.display_block{
			display: block !important;
		}
	</style>


<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m3 l3 pl-7">

			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Employee
			</a>
			<div id="modal1" class="modal">
				<?php echo Form::open(['route'=>'store.employee' , 'class'=> 'form-horizontal','method' => 'post']); ?>

					<div class="modal-header">
						<h5>Add employee</h5>
					</div>
					<div class="modal-content" style="padding: 10px">
						<div class="col s12 m12 l12 aione-field-wrapper">
							<input name="name" class="no-margin-bottom aione-field " type="text" placeholder="name" />
								<div class="error-red">
									<?php if(@$errors->has()): ?>
										<?php echo e($errors->first('name')); ?>

									<?php endif; ?>
								</div>
						</div>
						<div class="col s12 m12 l12 aione-field-wrapper">
							<input name="email" class="no-margin-bottom aione-field " type="email" placeholder="email" />
							<div class="error-red">
								<?php if(@$errors->has()): ?>
									<?php echo e($errors->first('email')); ?>

								<?php endif; ?>
							</div>
						</div>

						<div class="col s12 m12 l12 aione-field-wrapper">
							<input name="password" class="no-margin-bottom aione-field " type="text" placeholder="password" />
							<div class="error-red">
								<?php if(@$errors->has()): ?>
									<?php echo e($errors->first('password')); ?>

								<?php endif; ?>
							</div>
						</div>

						<div class="col s12 m12 l12 aione-field-wrapper">
							<input name="employee_id" class="no-margin-bottom aione-field " type="text" placeholder="employee ID" />
							<div class="error-red">
								<?php if(@$errors->has()): ?>
									<?php echo e($errors->first('employee_id')); ?>

								<?php endif; ?>
							</div>
						</div>
						<div class="col s12 m12 l12 aione-field-wrapper">
							<?php echo Form::select('designation',$designation,null,['class'=>"no-margin-bottom aione-field"]); ?>

						</div>
						

						
					</div>
					<div class="modal-footer">
						<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Employee
							<i class="material-icons right">save</i>
						</button>
					</div>
				<?php echo Form::close(); ?>

			</div>
			
		</div>

	</div>
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
			<div class="row no-margin-bottom">
				<!-- <div class="col s12 m6 l7 aione-field-wrapper pr-7">
					<input class="search-employee aione-field" placeholder="Search" />
				</div> -->
				<div class="col s12 m6 l7  pr-7" >
					
					<nav>
					    <div class="nav-wrapper">
					      	<form>
						        <div class="input-field">
						          	<input id="search" class="search-employee" type="search" required style="background-color: #ffffff">
						          	<label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
						          	<i class="material-icons icon-close">close</i>
						        </div>
					      	</form>
					    </div>
					</nav>
				</div>
				<div class="col s12 m6 l3  aione-field-wrapper pl-7">
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
				
				<div class="col l2 pl-7 right-float  hide-on-med-and-down">
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
		
			
			</div>
		</div>

		
	</div>
</div>
<script type="text/javascript">
	 $('#modal1').modal();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>