<?php $__env->startSection('content'); ?>
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
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="list" id="list">
							<div class="card-panel shadow white z-depth-1 hoverable project"  >
							    <div class="row valign-wrapper">
							        <div class="col s7">
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
							         <div class="col s3">
							            <?php echo e($val->total_days); ?> Days
							        </div>
							        
							        <div class="col s3">
							            <?php echo e($val->from); ?> to <?php echo e($val->to); ?>

							        </div>

							        <?php if($val->status ==1): ?>
								        <div class="col s2 right-align">
								           	<span class="teal white-text" style="padding: 2px 5px">Approved</span>
								        </div>
								    <?php else: ?>
											 <div class="col s2 right-align">
								           	<span class="teal white-text" style="padding: 2px 5px">Un-Approved</span>
								        </div>
								    <?php endif; ?>  
							    </div>
							    
							</div>
						
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					
					<div class="col s12 m3 l3 pl-7" >
						<a id="add_new" href="#" class="btn add-new display-form-button" >
							Apply Leave
						</a>
						<div id="add_new_wrapper" class="add-new-wrapper add-form ">
						

								<?php echo Form::open(['route'=>'list.employeeleave' , 'class'=> 'form-horizontal','method' => 'post']); ?>

								<input type="hidden" name="apply_by" value="employee">
								<div class="row no-margin-bottom">
									<div class="col s12 m2 l12 aione-field-wrapper">
										<input name="reason_of_leave" class="no-margin-bottom aione-field " type="text" placeholder="Reason of leave" />
									</div>

									<div class="col s12 m2 l12 aione-field-wrapper">
									<?php echo Form::textarea('description',null,['rows'=>'5', "class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Description']); ?>

									
									</div>

									<div class="col s12 m2 l12 aione-field-wrapper">
									<?php echo Form::select('leave_category_id',$leave_rule->pluck('name','id'),null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select leave Type']); ?>

									
									</div>

									<div class="col s12 m2 l12 aione-field-wrapper">
										<input  type="date" class="datepicker" name="from" class="no-margin-bottom aione-field " type="text" placeholder="From dd-mm-year" />
									</div>
									<div class="col s12 m2 l12 aione-field-wrapper">
										<input name="to" class="datepicker no-margin-bottom aione-field"  type="date" placeholder="To dd-mm-year" />
									</div>
									

									<div class="col s12 m3 l12 aione-field-wrapper">
										<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save leave
											<i class="material-icons right">save</i>
										</button>
									</div>
								</div>
							<?php echo Form::close(); ?>

						
						</div>

					
						<div class="row" style="padding-top: 10px">
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;font-weight: 500;">
									Leave rules for you
								</div>
							</div>
						<?php $__currentLoopData = $leave_rule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruleKey => $ruleVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									<div class="row">
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

									<div class="row">
									<?php if($metaVal['key'] =="number_of_day"): ?>
										<div class="col l4" style="border-right:1px solid #e8e8e8">
											<div style="font-weight: 500;padding: 6px">
												Total
											</div>
											<div style="padding: 6px">
												<?php echo e($metaVal['value']); ?>

											</div>
										</div>
										<div class="col l4" style="border-right:1px solid #e8e8e8">
											<div style="font-weight: 500;padding: 6px">
												Used
											</div>
											<div style="padding: 6px">
												<span class="green white-text" style="padding: 2px 5px;border-radius: 4px"><?php echo e($used_leave); ?></span>
											</div>
										</div>
										<div class="col l4">
											<div style="font-weight: 500;padding: 6px">
												left
											</div>
											<div style="padding: 6px">
												<span class="orange white-text" style="padding: 2px 5px;border-radius: 4px"><?php echo e(@$metaVal['value'] - $used_leave); ?></span>
											</div>
										</div>
									<?php endif; ?>
									
										
									
									
										
									
									</div>
									<?php if($metaVal['key'] =="apply_before" ): ?>
										<div class="divider"></div>
										<div class="row">
											<div class="col l6">Apply Before</div>
											<div class="col l6"><?php echo e($metaVal['value']); ?> Days</div>
										</div>
									<?php endif; ?>
									<?php if($metaVal['key'] =="valid_for" ): ?>
										<div class="divider"></div>
										<div class="row">
											<div class="col l6">Yearly/Monthly</div>
											<div class="col l6"><?php echo e(ucfirst($metaVal['value'])); ?></div>
										</div>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									<div class="row">
										<div class="col l6">Title</div>
										<div class="col l6">Dummy static</div>
									</div>
									<div class="divider"></div>
									<div class="row">
										<div class="col l4" style="border-right:1px solid #e8e8e8">
											<div style="font-weight: 500;padding: 6px">
												Total
											</div>
											<div style="padding: 6px">
												54
											</div>
										</div>
										<div class="col l4" style="border-right:1px solid #e8e8e8">
											<div style="font-weight: 500;padding: 6px">
												Used
											</div>
											<div style="padding: 6px">
												<span class="green white-text" style="padding: 2px 5px;border-radius: 4px">6</span>
											</div>
										</div>
										<div class="col l4">
											<div style="font-weight: 500;padding: 6px">
												left
											</div>
											<div style="padding: 6px">
												<span class="orange white-text" style="padding: 2px 5px;border-radius: 4px">6</span>
											</div>
										</div>
									</div>
									<div class="divider"></div>
									<div class="row">
										<div class="col l6">Apple Before</div>
										<div class="col l6">6 days</div>
										<div class="col l6">Apple Before</div>
										<div class="col l6">6 days</div>
									</div>
								</div>
							</div>
							
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									Nunc pellentesque quam vel arcu dictum, non posuere eros ultricies.
								</div>
							</div>
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									Pellentesque ornare augue egestas lacus elementum, eget eleifend eros pharetra.
								</div>
							</div>
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									Suspendisse vel massa sed nulla pretium eleifend in vel orci.
								</div>
							</div>
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									Suspendisse vel massa sed nulla pretium eleifend in vel orci.
								</div>
							</div>
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									Suspendisse vel massa sed nulla pretium eleifend in vel orci.
								</div>
							</div>
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									Suspendisse vel massa sed nulla pretium eleifend in vel orci.
								</div>
							</div>
							<div class="card" style="margin: 0px;margin-bottom: 5px">
								<div class="row" style="padding: 10px;">
									Suspendisse vel massa sed nulla pretium eleifend in vel orci.
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	
	</div>
	<div class="row">
		<div class="row">
		


        	<div class="col l9">
        		<div class="" style="border:1px solid #e8e8e8">
        			<div class="row" style="font-size: 20px;padding:10px">
	        			Leave Detail
	        		</div>
	        		<div class="divider"></div>
	        		<div class="row" style="padding: 10px">
	        			<div class="col l4" style="font-weight: 500">Leave type</div>
	        			<div class="col l8">Medical leave</div>
	        		</div>
	        		<div class="row"  style="padding: 10px">
	        			<div class="col l4"  style="font-weight: 500">From</div>
	        			<div class="col l8">12 march 2017</div>
	        		</div>
	        		<div class="row" style="padding: 10px">
	        			<div class="col l4"  style="font-weight: 500">To</div>
	        			<div class="col l8">18 march 2017</div>
	        		</div>
	        		<div class="row" style="padding: 10px">
	        			<div class="col l4"  style="font-weight: 500">Reason</div>
	        			<div class="col l8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu nisi porttitor, porta dui id, consequat tortor. Praesent tempus arcu a massa porta venenatis. Cras dignissim luctus leo, at varius metus laoreet nec.</div>
	        		</div>
	        		<div class="row" style="padding: 10px">
	        			<div class="col l4" style="font-weight: 500">Link to sent mail</div>
	        			<div class="col l8"><a href="https://docs.google.com/spreadsheets/d/1T5KjGZAj9cf4nEwiTVHU9IsfA-z-SpLL1qoeSUP97Cs/edit#gid=2012486982" class="truncate">https://docs.google.com/spreadsheets/d/1T5KjGZAj9cf4nEwiTVHU9IsfA-z-SpLL1qoeSUP97Cs/edit#gid=2012486982</a></div>
	        		</div>
        		</div>
	        		
        	</div>
        
        	<div class="col l3">
        		<div class="row" style="border: 1px solid #e8e8e8">
        			<div class="row" style="padding: 10px;font-size: 20px">
        				Leaves Stats
        			</div>
        			<div class="divider"></div>
        			<div class="row">
        				<div class="col l4" style="padding: 5px">Leaves</div>
        				<div class="col l4" style="padding: 5px">Used</div>
        				<div class="col l4" style="padding: 5px">left</div>
        			</div>
        			<div class="row">
        				<div class="col l4" style="padding: 5px">EL (12)</div>
        				<div class="col l4 " style="padding: 5px"><span class="red white-text" style="padding: 2px 5px;border-radius: 4px">6</span></div>
        				<div class="col l4" style="padding: 5px"><span class="green white-text" style="padding: 2px 5px;border-radius: 4px">6</span></div>
        			</div>
        			<div class="row">
        				<div class="col l4" style="padding: 5px">EL (12)</div>
        				<div class="col l4 " style="padding: 5px"><span class="red white-text" style="padding: 2px 5px;border-radius: 4px">6</span></div>
        				<div class="col l4" style="padding: 5px"><span class="green white-text" style="padding: 2px 5px;border-radius: 4px">6</span></div>
        			</div>
        		</div>
        	</div>
        
        </div>
	</div>
	<script type="text/javascript">
		$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});

		$(".datepicker").pickadate({
			selectMonths:true,
			selectYear:15,
			min: new Date(new Date().getFullYear(),new Date().getMonth()+1,new Date().getDate())
		});

	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>