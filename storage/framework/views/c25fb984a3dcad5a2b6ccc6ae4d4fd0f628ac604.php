<?php $__env->startSection('content'); ?>

<div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 p-20 ml-10 mr-10 mb-20">
	<div class="row no-margin-bottom">
		<?php echo Form::open(['method' => 'POST','class' => '','route' => 'save.category']); ?>

		
		<div class="col s12 m3 l3 aione-field-wrapper">
			<div class="form-group">
				<?php echo Form::text('name', null, array('required','class'=>'form-control','placeholder'=>'Enter category')); ?>

			</div>
		</div>
		<div class="col s12 m3 l3 aione-field-wrapper">
			<div class="form-group">
				<?php echo Form::textarea('description', null, array('required','class'=>'form-control','placeholder'=>'Enter description')); ?>

			</div>
		</div>
		<div class="col s12 m3 l3 aione-field-wrapper right-align pt-10">
			<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action">Save Category
				<i class="material-icons right">save</i>
			</button>
		</div>
		<?php echo Form::close(); ?>

	</div>
</div>
 
<div id="projects" class="projects list-view">
	<div class="row" id="find-project">
		<div class="col s12 m12 100">
			<div class="row no-margin-bottom">
				<div class="col s12 m8 l6 no-padding-left aione-field-wrapper">
					<input class="search  aione-field" placeholder="Search" />
				</div>
				<div class="col s6 m2 l2 aione-field-wrapper">
					<select class="browser-default aione-field">
						<option value="" disabled selected>Sort By</option>
						<option value="1">Name</option>
						<option value="2">Date</option>
					</select>
				</div>
				<div class="col s6 m2 l1 no-padding-right aione-field-wrapper">
					<div class="alpha-sort">
						<a href="javascript:;" data-sort="project-titlename"><i class="fa fa-sort-alpha-asc arrow_sort white"></i></a>
					</div>
				</div>
				<div class="col l3">
					<a id="add_new" class="add-new" href="#">
						<div class="card shadow light-blue darken-2 no-margin-top">	
							<div class="card-content center-align p-10">
						      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i> Add New User</span>
						    </div>
						</div>
					</a>
				</div>
			</div>
			
			

			<div class="list">
			<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<div class="card-panel shadow white z-depth-1 hoverable project" data-site="<?php echo e($category->name); ?>">
					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="javascript:;" data-toggle="popover" title="Popover title" data-content="TEST">
							<div class="defualt-logo ">
								<?php echo e(ucwords(substr($category->name, 0, 1))); ?>

							</div>
							</a>
						</div>
						
						<div class="col l11 s10">
							<a href="javascript:;" data-toggle="popover" title="Popover title" data-content="TEST">
								<h5 class="project-title black-text flow-text truncate"><span class="project-name edit" id="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></span></h5>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">


	 
</script>
<style type="text/css">
	.edit input{
		width: 30% !important;
	}
</style>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>