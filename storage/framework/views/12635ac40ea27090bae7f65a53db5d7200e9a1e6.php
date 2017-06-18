
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
			<div class="list" id="list">
			<?php if(!empty($pages)): ?>
				<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pKey =>$pVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="card-panel shadow white z-depth-1 hoverable project"  >

					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="" data-toggle="popover" title="Popover title" data-content="TEST">
							
							<div class="defualt-logo">
								A
							</div>
							</a>
						</div>
						
						<div class="col l11 s10 " >
							<div class="row valign-wrapper" style="margin: 0">
								<div class="col l4">
									<input type="hidden" value="<?php echo e($pVal->id); ?>" class="page_id" >
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="page_token" >
									
									<a href="<?php echo e(route('edit.pages',['id'=>$pVal->id])); ?>" data-toggle="popover" title="Popover title" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate" style="line-height: 35px">
											<span class="project-name holiday_name" ><?php echo e($pVal->title); ?></span>
										</h5>
									</a>
								</div>
								<div class="col l4">
									<div class="project-detail truncate holiday_date " style="line-height: 35px;margin-bottom: 0px">
										<span  ><?php echo e($pVal->created_at); ?></span>
									</div>
								</div>
								<div class="col l4 right-align">
									<div class="switch">
									    <label>
											
											
												<?php if($pVal->status == '0'): ?>
													<input type="checkbox">
												<?php else: ?>
													<input type="checkbox" checked="checked">
												<?php endif; ?>
												
										    <span class="lever"></span>
									      
									    </label>
									  </div>
								</div>
							</div>
						</div>
					</div>

					<div class="row  project-data">
						<div class="col s12">
							<h3 class="project-title black-text flow-text truncate">Description </h3>
							<p class="project-detail">
							jhsjaksjkhsah
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
			<?php endif; ?>	
			</div>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#" class="btn add-new display-form-button" >
				Add New Page
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				<?php echo Form::open(['route'=>'store.page' , 'class'=> 'form-horizontal','method' => 'post']); ?>


					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12  input-field">
							<?php echo Form::text('title',null,['class' => 'validate','placeholder'=>'Enter Title','id'=>'attendence-title']); ?>

							<label for="attendence-title">Enter title</label>

						</div>
						<div class="col s12 m2 l12 aione-field-wrapper input-field">
							 <?php echo Form::select('categories', ['L' => 'sports', 'S' => 'entertainment'], 'S'); ?>

					        
			   
						</div>
						

						<div class="col s12 m3 l12 aione-field-wrapper right-align" style="padding: 10px">
							<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" >Save Page
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
				<?php echo Form::close(); ?>


			</div>
			<div class="card-panel shadow mt-22" >
				clients
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

 $(document).on('change', '.switch > label > input',function(e){
      e.preventDefault();
      var postedData = {};
      postedData['id']        = $(this).parents('.shadow').find('.page_id').val();
      postedData['status']      = $(this).prop('checked');
      postedData['_token']      = $('.shadow').find('.page_token').val();

      $.ajax({
        url:route()+'pages/status/update',
        type:'POST',
        data:postedData,
        success: function(res){
          console.log('data sent successfull');
        }
      });
      $('.editable h5 ,.editable p').removeClass('edit-fields');
    });

	$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>