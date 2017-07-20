<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Widgets',
	'add_new' => '+ Apply leave'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
			<?php if(!empty($data)): ?>
				<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<div class="card-panel shadow white z-depth-1 hoverable project"  >

					<div class="row valign-wrapper no-margin-bottom">
						<div class="col l1 s2 center-align project-image-wrapper">
							<a href="" data-toggle="popover" title=" <?php echo e($val->title); ?>" data-content="TEST">
							
							<div class="defualt-logo">
								<?php echo e(ucwords(substr($val->title, 0, 1))); ?> 
							</div>
							
							</a>
						</div>
						
						<div class="col l11 s10 editable " >
							<div class="row m-0 valign-wrapper">
								<div class="col s8 m8 l8">
									<input type="hidden" value="<?php echo e($val->id); ?>" class="shift_id" >
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="shift_token" >
									
									<a href="#" data-toggle="popover" title="Popover title" data-content="TEST" >
										<h5 class="project-title black-text flow-text truncate line-height-35">
											<span class="project-name shift_name font-size-14" contenteditable="true" > <?php echo e($val->title); ?></span>
										</h5>
									</a>
									
								</div>
								<div class="col s4 m4 l4 right-align">
									<a   href="<?php echo e(route('edit.widget',['id'=>$val->id])); ?>">edit</a>
								</div>
								
								<div class="col s4 m4 l4 right-align">
									<a onclick="confirm('Are you sure want to delete?')" href="<?php echo e(route('delete.widget',['id'=>$val->id])); ?>"><i class="fa fa-trash red-text" style="font-size:18px"></i></a>
								</div>
								<div class="col l4 right-align">
									<input type="hidden" name="id" value="<?php echo e($val->id); ?>" class="id" >

					                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="token" >
					                  <div class="switch">
					                      <label>
					                      
					                        <?php if($val->status == '0'): ?>
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
						
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
			</div>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="<?php echo e(route('create.widget')); ?>" class="btn add-new display-form-button" >
				Add Widget
			</a>
			
			
		</div>
	</div>
</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">

  $(document).on('change', '.switch > label > input',function(e){
      e.preventDefault();
      var postedData = {};
      postedData['id']        = $(this).parents('.shadow').find('.id').val();
      postedData['status']      = $(this).prop('checked');
      postedData['_token']      = $('.shadow').find('.token').val();

      $.ajax({
        url:route()+'/widget/status/update',
        type:'POST',
        data:postedData,
        success: function(res){
          console.log('data sent successfull');
        }
      });
      $('.editable h5 ,.editable p').removeClass('edit-fields');
    });


	// $('.add-new').off().click(function(e){
	// 		e.preventDefault();
	// 		$('.add-new-wrapper').toggleClass('active');
	// 		$('.fade-background').fadeToggle(300);
	// 	});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>