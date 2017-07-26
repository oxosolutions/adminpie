<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Leaves',
	'add_new' => '+ Apply leave'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row">
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row">
			<div class="fade-background">
			</div>
			<div id="projects" class="projects list-view">
				<div class="row">
					<div class="col s12 m9 l9 pr-7" >
						<div class="row no-margin-bottom">
							<div class="col s12 m12 l6  pr-7 tab-mt-10" >
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
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="list" id="list">
							<div class="card-panel shadow white z-depth-1 hoverable project"  >
							    <div class="row valign-wrapper">
							        <div class="col s4">
							            <div class="row valign-wrapper">
							                <div class="col">
							                    <div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
							                       A
							                    </div>  
							                </div>
							                <input type="hidden" value="" class="id" >
							                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="shift_token" >
							                <div class="col" style="padding-left: 10px">
							                    <div style="font-weight: 500;" class=""><?php echo e($val->reason_of_leave); ?></div>
							                    <div class="project-description"></div>
							                    <div class="aione-list-options">
							                        <a href="" style="padding-right:10px">View</a>
							                    </div>
							                </div>
							            </div>

							        </div>
							         <div class="col s2">
							            <?php echo e($val->total_days); ?> Days
							        </div>
							        <div class="col s3">
							            <?php echo e($val->from); ?> to <?php echo e($val->to); ?>

							        </div>
							        <?php if($val->status ==1): ?>
								        <div class="col s3 right-align">
								           	<span class="teal white-text" style="padding: 2px 5px">Approved</span>
								        </div>
								    <?php else: ?>
											 <div class="col s3 right-align">
								           	<span class="teal white-text" style="padding: 2px 5px">Un-Approved</span>
								        </div>
								    <?php endif; ?>  
							    </div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<div class="col s12 m3 l3 pl-7" >
						
						<?php echo Form::open(['route'=>'list.employeeleave' , 'class'=> 'form-horizontal','method' => 'post']); ?>

								<input type="hidden" name="apply_by" value="employee">
						<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Apply Leave','button_title'=>'Save leave','section'=>'accleasec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<?php echo Form::close(); ?>

					
						
							<div class="card title-card" >
								
									Leave rules for you
								
							</div>
						<?php $__currentLoopData = $leave_rule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruleKey => $ruleVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="card">
								<div class="row mb-0" >
									<div class="row mb-0 p-10">
										<div class="col l6">Title</div>
										<div class="col l6"><?php echo e($ruleVal['name']); ?></div>
									</div>
									<div class="divider"></div>

									<?php $__currentLoopData = $ruleVal['meta']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metakey =>$metaVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php 	$used_leave =0;
										if(!empty($leave_count_by_cat[$ruleVal->id])){
											$used_leave = $leave_count_by_cat[$ruleVal->id]->sum('total_days');
										}
									 ?>
									<div class="row mb-0" >
									<?php if($metaVal['key'] =="number_of_day"): ?>
										<div class="col l4" style="border-right:1px solid #e8e8e8">
											<div class="center-align" style="font-weight: 500;padding: 6px">
												Total
											</div>
											<div class="center-align" style="padding: 6px">
												<?php echo e($metaVal['value']); ?>

											</div>
										</div>
										<div class="col l4" style="border-right:1px solid #e8e8e8">
											<div class="center-align" style="font-weight: 500;padding: 6px">
												Used
											</div>
											<div class="center-align" style="padding: 6px">
												<span class="green white-text" style="padding: 2px 5px;border-radius: 4px"><?php echo e($used_leave); ?></span>
											</div>
										</div>
										<div class="col l4">
											<div class="center-align" style="font-weight: 500;padding: 6px">
												left
											</div>
											<div class="center-align" style="padding: 6px">
												<span class="orange white-text" style="padding: 2px 5px;border-radius: 4px"><?php echo e(@$metaVal['value'] - $used_leave); ?></span>
											</div>
										</div>
									<?php endif; ?>
									
									</div>
									<?php if($metaVal['key'] =="apply_before" ): ?>
										<div class="divider"></div>
										<div class="row mb-0 p-10" >
											<div class="col l6">Apply Before</div>
											<div class="col l6"><?php echo e($metaVal['value']); ?> Days</div>
										</div>
									<?php endif; ?>
									<?php if($metaVal['key'] =="valid_for" ): ?>
										<div class="divider"></div>
										<div class="row mb-0 p-10" style="">
											<div class="col l6">Yearly/Monthly</div>
											<div class="col l6"><?php echo e(ucfirst($metaVal['value'])); ?></div>
										</div>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							
						
						
					</div>
				</div>
			</div>
		</div>
	
	</div>
	
	<script type="text/javascript">

		$(".datepicker").pickadate({
			selectMonths:true,
			selectYear:15,
			min: new Date(new Date().getFullYear(),new Date().getMonth(),new Date().getDate())
		});

	</script>
	<style type="text/css">
		.title-card{
			padding:10px;
		}
		.card{
			margin: 0px;margin-bottom: 10px
		}
		.mb-0{
			margin-bottom: 0px;
		}
		.p-10{
			padding: 10px
		}
	</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>