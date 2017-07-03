<?php $__env->startSection('content'); ?>

	<div class="row">
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="col l9 pr-7">
			<div class="card" style="margin-top: 14px">
				<div class="row">
					<div class="col l3" style="padding:14px;">
						<?php echo Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1']); ?>

							<div class="abc" style="position: relative;">
							<?php if($model->profilePic != null || $model->profilePic != "" || !empty($model->profilePic)): ?>
								<img src="<?php echo e(asset('ProfilePicture/'.$model->profilePic)); ?>" style="width: 100%">
							<?php else: ?>
								<img src="<?php echo e(asset('ProfilePicture/default-user.jpg')); ?>" style="width: 100%">
							<?php endif; ?>
								<a href="" class="upload-image">Change Image</a>	
								<input type="file" name="aione-dp"
								onchange="document.getElementById('form1').submit()" class="chooser">
							</div>
						<?php echo Form::close(); ?>

					</div>
					<style type="text/css">
						.chooser { position: absolute; z-index: 1; opacity: 0; cursor: pointer;margin-top: -36px}
						.upload-image{
							position: absolute;
						 	display: block;
						    background-color: rgba(33, 150, 243, 0.8);
						    color: white;
						    width: 100%;
						    text-align: center;
						    
						    padding: 4px;-webkit-transition: all 0.3s ease-in-out 0.5s;
						}
						.abc{
							overflow: hidden
						}
						.abc:hover .upload-image{
							margin-top: -36px
						}
					</style>
					<div class="col l9" style="padding:14px">
						<div class="row" style="padding:0px 0px 5px 0px">
							<div class="col l3"><strong>Name:</strong></div>
							<div class="col l5"><?php echo e($model->name); ?></div>
							<div class="col l4 right-align">
								<a href="#modal1" class=""><i class="fa fa-pencil"></i></a>
								<?php echo Form::model($model,['route'=>['update.profile',$model->id],'method'=>'PATCH',]); ?>

								<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Profile','button_title'=>'Save','section'=>'editempsec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								
								<?php echo Form::close(); ?>

							</div>
						</div>
						
						<div class="row" style="padding:5px 0px 0px 0px">
							<div class="col l3"><strong>About Me</strong></div>
							<div class="col l9"><?php echo e(@$model->about_me); ?></div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="card" style="margin-top: 14px">
				
				<div class="row ">
					<div class="row ">
						<div class="activity-header">						
							<h5>Recent Activities</h5>
							<a href="<?php echo e(route('account.activities')); ?>" class="btn btn-success">View All</a>
						</div>

						<?php $__currentLoopData = $user_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="row valign-wrapper" style="padding:5px 0px">
								<div class="col l1 blue white-text center-align">
									<div class="row " style="font-size: 16px ;font-weight: 700">
										<?php echo e(date_format($value->created_at , "M")); ?>

									</div>
									<div class="row" style="font-size: 28px;line-height: 30px;font-weight: 700">
										<?php echo e(date_format($value->created_at , "d")); ?>

									</div>
								</div>
								<div class="col l6 pl-7 truncate">
									<?php $__currentLoopData = json_decode($value->text); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($loop->index == 0 ): ?>
											<?php echo e(str_replace('{id?}','id',$val)); ?>

										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<div class="col l3 pl-7 truncate">
									<?php $__currentLoopData = json_decode($value->text); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($loop->index == 2 ): ?>
											<?php echo e($val); ?>

										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<div class="col l2">
									<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text"><?php echo e($value->type); ?></span>
								</div>
								<!-- <div class="col l2">
									<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
								</div> -->
								<div class="col l2 grey-text center-align" style="font-size: 13px">
									2 hour ago
								</div>	
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>					
				</div>
					 
			</div>
		</div>
		<div class="col l3 pl-7">
			<div class="card"  style="margin-top: 14px">
				<div class="row center-align" style="padding:10px 0px">
					<a href="#modal10" class="btn blue">Change Password</a>	
					
					<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal10','heading'=>'Change Password','button_title'=>'Update','section'=>'changepasssec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				
			</div>
			<div class="card" style="margin-top: 14px">
				<div class="row">
					<div class="col l10" style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Contact Detail</div>
					<div class="col l2">
						<a href="#modal2"><span><i class="fa fa-pencil"></i></span></a>
						<div id="modal2" class="modal modal-fixed-footer">
							<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
						    	<div class="row" style="padding:15px 10px">
						    		<div class="col l7">
						    			<h5 style="margin:0px">Contact Details</h5>	
						    		</div>
						    		<div class="col l5 right-align">
						    			<a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
						    		</div>
						    			
						    	</div>
						    	
						    </div>
						    <?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

						    	<input type="hidden" name="meta_table" value="usermeta" />
							    <div class="modal-content" style="background-color: white">
							    	
							    	<?php echo FormGenerator::GenerateSection('empsec2',['type' => 'inset']); ?>

							    </div>
							    <div class="modal-footer">
							    	
							    	<button class="btn blue" type="submit">Save
												<i class="material-icons right">save</i>
											</button>
							    </div>
							<?php echo Form::close(); ?>

						</div>
					</div>
					
				</div>
				<div class="row" style="padding: 0px 5px">
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Contact no.
						</div>
						<div class="col l8">
							<?php echo e($model->contact_no); ?>

						</div>
					</div>
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Email.
						</div>
						<div class="col l8">
							<a><?php echo e(@$model->email); ?></a>
						</div>
					</div>
					<div class="row" style="padding: 5px 0px ">
						<div class="col l4">
							Address
						</div>
						<div class="col l8">
							<?php echo e(@$model->permanent_address); ?>

						</div>
					</div>
				</div>
			</div>
			<?php if(count(array_intersect(json_decode($model->user_type), [2,4])) != 0): ?>
				<div class="card" style="margin-top: 14px">
					<div class="row">
						<div class="col l10" style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Employee Detail</div>
						<div class="col l2">
							<a href="#modal3"><span><i class="fa fa-pencil"></i></span></a>
							<div id="modal3" class="modal modal-fixed-footer">
								<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
							    	<div class="row" style="padding:15px 10px">
							    		<div class="col l7">
							    			<h5 style="margin:0px">Employee Details</h5>	
							    		</div>
							    		<div class="col l5 right-align">
							    			<a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
							    		</div>
							    			
							    	</div>
							    	
							    </div>
							    <?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

							    	<input type="hidden" name="meta_table" value="employeemeta" />
								    <div class="modal-content" style="background-color: white">
								    	
								    	<?php echo FormGenerator::GenerateSection('empsec7',['type' => 'inset']); ?>

								    </div>
								    <div class="modal-footer">
								    	
								    	<button class="btn blue" type="submit">Save
													<i class="material-icons right">save</i>
												</button>
								    </div>
								<?php echo Form::close(); ?>

							</div>
						</div>
						
					</div>
					<div class="row" style="padding: 0px 5px">
						<?php $__currentLoopData = FormGenerator::GetSectionFieldsName('empsec7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="row" style="padding: 5px 0px ">
								<div class="col l4">
									<?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;
								</div>
								<div class="col l8">
									<?php if($field == 'designation'): ?>
										&nbsp;<?php echo e(@App\Model\Organization\Designation::find($model[strtolower($field)])->name); ?>

									<?php elseif($field == 'department'): ?>
										&nbsp;<?php echo e(@App\Model\Organization\Department::find($model[strtolower($field)])->name); ?>

									<?php else: ?>
										&nbsp;&nbsp;<?php echo e($model[strtolower($field)]); ?>

									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
					</div>
				</div>
				<div class="card" style="margin-top: 14px">
					<div class="row">
						<div class="col l10" style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Bank Details</div>
						<div class="col l2">
							<a href="#modal4"><span><i class="fa fa-pencil"></i></span></a>
							<div id="modal4" class="modal modal-fixed-footer">
								<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
							    	<div class="row" style="padding:15px 10px">
							    		<div class="col l7">
							    			<h5 style="margin:0px">Bank Details</h5>	
							    		</div>
							    		<div class="col l5 right-align">
							    			<a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
							    		</div>
							    			
							    	</div>
							    	
							    </div>
							    <?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

							    	<input type="hidden" name="meta_table" value="employeemeta" />
								    <div class="modal-content" style="background-color: white">
								    	
								    	<?php echo FormGenerator::GenerateSection('empsec6',['type' => 'inset']); ?>

								    </div>
								    <div class="modal-footer">
								    	
								    	<button class="btn blue" type="submit">Save
													<i class="material-icons right">save</i>
												</button>
								    </div>
								<?php echo Form::close(); ?>

							</div>
						</div>
						
					</div>
					<div class="row" style="padding: 0px 5px">
						<?php $__currentLoopData = FormGenerator::GetSectionFieldsName('empsec6'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="row" style="padding: 5px 0px ">
								<div class="col l4">
									<?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;
								</div>
								<div class="col l8">
									<?php echo e($model[strtolower($field)]); ?>

								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
					</div>
				</div>
			<?php endif; ?>

			<div class="card" style="margin-top: 14px">
				<div class="row">
					<span style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Task Assigned</span>
				</div>
				<div class="row">
					<div class="row" style="padding: 10px 5px;">
						<div class="col l9">
							Design Issue	
						</div>
						<div class="col l3 center-align">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="red white-text ">High</span>
						</div>
						
					</div>
					<div class="divider">
						
					</div>
					<div class="row" style="padding: 10px 5px;">
						<div class="col l9">
							Backend task	
						</div>
						<div class="col l3 center-align">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange white-text ">Medium</span>
						</div>
						
					</div>
					<div class="divider">
						
					</div>
					<div class="row" style="padding: 10px 5px;">
						<div class="col l9">
							Testing in html	
						</div>
						<div class="col l3 center-align">
							<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text ">Low</span>
						</div>
						
					</div>
				</div>
			</div>
			<div class="card">
				<div class="row">
					<span style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">My Projects</span>
				</div>
				<div class="row">
					<div class="row" style="padding: 10px 5px;">
						<div class="col l12">
							Project 1	
						</div>
						
					</div>
					<div class="divider">
						
					</div>
					<div class="row" style="padding: 10px 5px;">
						<div class="col l12">
							Project 2	
						</div>
						
						
					</div>
					<div class="divider">
						
					</div>
					<div class="row" style="padding: 10px 5px;">
						<div class="col l12">
							Project #
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		 .aione-tabs{
		      border-bottom: 1px solid #e8e8e8;
		      padding-bottom: 4px;
		      padding: 0px;
		      margin: 0px;
		   }
		   .aione-tabs > .tab{
		     

		   }
		   .aione-tabs > .tab:hover{
		      background-color: #e8e8e8;
		          border-bottom: 1px solid #EEE;
		   }
		   .aione-tabs > .tab > a{
		    padding: 0px 20px; 
		    line-height: 40px;
		    display: inline-block; 
		    color: #0073aa;
		   }
		   .aione-active{
		      border: 1px solid #e8e8e8;
		      border-bottom: 1px solid #fff;
		      margin-bottom: -1px;
		   }
		   .aione-active a{
		      color: black !important;
		      font-weight: 500
		   }
	</style>
	<script type="text/javascript">
		  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();

  });
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>