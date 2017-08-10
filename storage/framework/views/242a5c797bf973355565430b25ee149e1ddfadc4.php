<?php $__env->startSection('content'); ?>
<?php 
	// $isEmployee = App\Model\Organization\Employee::where('user_id' , $model->id)->first();
	$isEmployee = is_employee(@request()->route()->parameters()['id']);
	$isAdmin = is_admin();
 ?>
<style type="text/css">
	.edit-button{
		display: block;width: 30px;line-height: 30px;text-align: center;float: right;
	}
	.mb-0{
		margin-bottom: 0px
	}
	.mt-14{
		margin-top: 14px;
	}
	.subhead{
		position: relative;
	}
	.subhead:after{
		 content: '';position: absolute;left: 0;display: inline-block;height: 1em;width: 100%;border-bottom: 2px solid #BDBDBD;margin-top: 6px;
	}
	.activity-header{
		padding: 10px;
	}
	.activity-header > h5,a{
		display: inline-block;

	}
	.activity-header > a{
		float:right;

	}
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
		margin-top: -32px
	}
	.basic-details .profile-pic{
		padding:14px;position: relative;
	}
	.basic-details .abc{
		position: relative;
	}
	.basic-details img{
		width:100%;
	}
	.basic-details .preloader-wrapper{
		position: absolute;top: 50%;left: 50%;margin-top: -17px;margin-left: -17px;width: 34px;height: 34px;display: none
	}
	.p-14{
		padding: 14px !important;
	}
	.pb-5{
		padding:0px 0px 5px 0px;
	}
	.pt-5{
		padding:5px 0px 0px 0px
	}
	.mt{
		margin-top: 14px
	}
	.pv-5{
		padding:5px 0px
	}
	.activities .month{
		 font-size: 16px ;font-weight: 700
	}
	.activities .date{
		padding:4px 18px;
	}
	.activites .day{
		font-size: 28px;line-height: 30px;font-weight: 700
	}
	.activites .box{
		padding: 4px 8px; font-size: 10px;border-radius: 3px
	}
	.pv-10{
		padding:10px 0px
	}
	.info-card{
		margin-top: 14px
	}
	.info-card .subhead-wrapper,.details-wrapper{
		padding: 5px !important;
	}
	.info-card .headline-text{
		font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8;
	}
	#card-alert{
		position: absolute;
	    top: 10px;
	    width: 98%;
	}
	#card-alert i{
		float: right;
		cursor: pointer
	}
</style>

<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Profile',
	'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php if(Session::has('success-password')): ?>
			
			<div id="card-alert" class="card green lighten-5"><div class="card-content green-text">Password Change Successfully<i class="material-icons dp48">clear</i></div></div>
			
			
		<?php endif; ?>
		<div class="row">
		<div class="col l9 pr-7">
			<div class="card mt-14">
				<div class="row basic-details">
					<div class="col l3 profile-pic">
						<?php 
							if(count(request()->route()->parameters()) > 0){
								$id = request()->route()->parameters()['id'];
							}else{
								if(Auth::guard('admin')->check()){
									$id = Auth::guard('admin')->user()['id'];
								}else{
									$id = Auth::guard('org')->user()['id'];
								}
							}
						 ?>
						<?php echo Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1']); ?>

							<div class="abc" >
								<img src="<?php echo e(asset(@get_profile_picture($id,'medium'))); ?>" >
							
							<?php 
								$parameters = request()->route()->parameters();
							 ?>
							<?php if(count($parameters) > 0): ?>
								<?php 
						            $id = request()->route()->parameters()['id'];
							   	 ?>
							   	<input type="hidden" name="user_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
							<?php endif; ?>
								<a href="" class="upload-image">Change Image</a>	
								<input type="file" name="aione-dp"
								onchange="document.getElementById('form1').submit()" class="chooser">
							</div>
						<?php echo Form::close(); ?>

							<?php if($model->profilePic != null || $model->profilePic != "" || !empty($model->profilePic)): ?>
								<a href="<?php echo e(route('profile.picture.delete',$id)); ?>">Remove Image</a>	
							<?php endif; ?>
						
						

						<div class="preloader-wrapper image-spinner big active" style="">
							      <div class="spinner-layer spinner-blue">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-red">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-yellow">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>

							      <div class="spinner-layer spinner-green">
							        <div class="circle-clipper left">
							          <div class="circle"></div>
							        </div><div class="gap-patch">
							          <div class="circle"></div>
							        </div><div class="circle-clipper right">
							          <div class="circle"></div>
							        </div>
							      </div>
							    </div>
					</div>
					
					<div class="col l9 p-14">
						<div class="row pb-5" >
							<div class="col l3"><strong>Name:</strong></div>
							<div class="col l5"><?php echo e(@$model->name); ?></div>
							<div class="col l4 right-align" id="modal-wrapper">
								<a class="grey-text darken-1 edit-button waves-effect" data-target="modal1"><i class="fa fa-pencil"></i></a>
								
								
									
								<div id="modal1" class="modal modal-fixed-footer" style="overflow-y: hidden;">
								<?php echo Form::model($model,['route'=>['update.profile',$model->id],'method'=>'PATCH',]); ?>

									<div class="modal-header white-text  blue darken-1" ">
										<div class="row" style="padding:15px 10px;margin: 0px">
											<div class="col l7 left-align">
												<h5 style="margin:0px">Profile</h5>	
											</div>
											<div class="col l5 right-align">
												<a href="javascript:;" name="closeModel"  id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
											</div>	
										</div>
									</div>
									<div class="modal-content" style="padding: 20px;padding-bottom: 60px">
										<div class="col s12 m2 l12 aione-field-wrapper">
										<?php echo FormGenerator::GenerateField('editempsec1f1',['type'=>'inset']); ?>

										</div>
										<div class="col s12 m2 l12 aione-field-wrapper">
										 <?php echo FormGenerator::GenerateField('editempsec1f2',['type'=>'inset']); ?>

										 </div>
										 <div class="col s12 m2 l12 aione-field-wrapper">
										 <?php echo FormGenerator::GenerateField('empsec1f8',['type'=>'inset']); ?>

										 </div>
										 <div class="col s12 m2 l12 aione-field-wrapper">
											
											<?php if(@request()->route()->parameters()['id']): ?>
												<?php if($isEmployee): ?>
													<?php echo Form::select('shift',App\Model\Organization\Shift::listshifts(),null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Select Shift']); ?>

												<?php endif; ?>

											<?php endif; ?>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn blue" type="submit" name="action">save
										</button>
									</div>	
									<?php echo Form::close(); ?>

								</div>

								
							</div>
						</div>
						
						<div class="row pt-5" >
							<div class="col l3"><strong>Email</strong></div>
							<div class="col l9"><?php echo e(@$model->email); ?></div>
						</div>
						<div class="row pt-5" >
							<div class="col l3"><strong>About Me</strong></div>
							<div class="col l9"><?php echo e(@$model->about_me); ?></div>
						</div>
														
					</div>
				</div>
				
				<?php if($isEmployee ): ?>
				
					<?php $__currentLoopData = @$model->metas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $Shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($Shift->key == 'shift'): ?>
							<div class="row" style="padding: 0px 12px;">
								<div class="col l3">
									Shift
								</div>
								<div class="col l3">
									<?php echo e(App\Model\Organization\Shift::where('id',$Shift->value)->first()->name); ?>

								</div>
								<div class="col l3">
									<?php echo e(App\Model\Organization\Shift::where('id',$Shift->value)->first()->from); ?> - <?php echo e(App\Model\Organization\Shift::where('id',$Shift->value)->first()->to); ?>

								</div>
								<div class="col l3 week-days">
									<?php $__currentLoopData = json_decode(App\Model\Organization\Shift::where('id',$Shift->value)->first()->working_days); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									
									<div class="active" title="<?php echo e(ucfirst($v)); ?>"><?php echo e(ucfirst($v[0])); ?></div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<style type="text/css">
									.week-days > .active{
										border-color: #2196f3;
									}
									.week-days > .active:hover{
										background-color:#2196f3;
										color: white;

									}
									.week-days > div{
									    display: inline-block;
									    width: 24px;
									    text-align: center;
									    font-size: 13px;
									    line-height: 24px;
									    border: 1px solid #e8e8e8;
									    border-radius: 50%;
									    font-weight: 700;
									    color: #676767;
									    cursor: pointer;
									}
									.week-days > div:last-child{
										color: red
									}
								</style>
							</div>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>	
				
			</div>
			<div class="card mt-14" >
				
				<div class="row ">
					<div class="row activities">
						<div class="activity-header">						
							<h5>Recent Activities</h5>
							<a href="<?php echo e(route('account.activities')); ?>" class=" btn-success" style="">View All</a>
						</div>
						
						<?php $__currentLoopData = $user_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="row valign-wrapper mb-0 pv-5" >
								<div class="col l1 blue white-text center-align date" >
									<div class="row mb-0 month ">
										<?php echo e(date_format($value->created_at , "M")); ?>

									</div>
									<div class="row mb-0 day" >
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
									<span class="green white-text box"><?php echo e($value->type); ?></span>
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
			<div class="card mt-14 " >
				<div class="row center-align mb-0 pv-10" >
				<?php if(@$errors->get('new_password') || @$errors->get('confirm_password')): ?>
					<script type="text/javascript">
						$(window).load(function(){
							document.getElementById('add_new').click();
						});
					</script>
				<?php endif; ?>
					<a href="#modal9" class="btn blue " id="add_new">Change Password</a>	
					<?php echo Form::open(['route' => 'change.password' , 'method' => 'post']); ?>

					<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal9','heading'=>'Change Password','button_title'=>'Update','section'=>'changepasssec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php 
						if(Auth::guard('admin')->check()){
				            $id = Auth::guard('admin')->user()->id;
				        }elseif(request()->route()->parameters()){
				            $id = request()->route()->parameters()['id'];
				        }else{
				            $id = Auth::guard('org')->user()->id;
				        }
					 ?>
					<input type="hidden" name="id" value="<?php echo e($id); ?>">
					<?php echo Form::close(); ?>

				</div>
				
			</div>
			<div class="card info-card" >
				<div class="row valign-wrapper mb-0">
					<div class="col l10 headline-text" >Contact Detail</div>
					<div class="col l2" id="modal-wrapper">
						<a href="#modal2" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
						<?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

						<input type="hidden" name="meta_table" value="usermeta" />
						<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'Contact Details','button_title'=>'Save ','section'=>'empsec2']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<?php echo Form::close(); ?>

					</div>
					
				</div>
				<?php if(!$model->metas->isEmpty()): ?>
					<div class="row" >
						<?php $__currentLoopData = $model->metas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($v->key == 'contact_no' || $v->key == 'alternative_number' || $v->key == 'permanent_address' || $v->key == 'present_address'): ?>
								<div class="row mb-0" >
									<div class="col l12 subhead-wrapper" >
										<span class="subhead"><?php echo e(ucfirst(str_replace('_',' ',$v->key))); ?></span>
									</div>
									<div class="col l12 details-wrapper" >
										<?php echo e($v->value); ?>

									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				<?php endif; ?>
			</div>
				<?php 
					$roles = array_keys($model->user_role_rel->groupBy('role_id')->toArray());
					//if role has permission to this widget
				 ?>
				<?php if($isEmployee || $isAdmin): ?>
					<div class="card info-card" >

							<div class="row valign-wrapper mb-0">
								<div class="col l10 headline-text" >Employee Detail</div>
								<div class="col l2 " id="modal-wrapper">
										<?php if($isAdmin): ?>
											<a href="#modal3" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
										<?php endif; ?>
									<?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

									<input type="hidden" name="meta_table" value="employeemeta" />
									
									<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Employee Details','button_title'=>'Save ','section'=>'empsec7']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									<?php echo Form::close(); ?>

								</div>
								
							</div>
							<div class="row" >
								<?php $__currentLoopData = FormGenerator::GetSectionFieldsName('empsec7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="row mb-0" >
										<div class="col l12 subhead-wrapper" >
											<span class="subhead"><?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;</span>
										</div>
										<div class="col l12 details-wrapper" >
											<?php if($field == 'designation'): ?>
												&nbsp;<?php echo e(@App\Model\Organization\Designation::find($model[strtolower($field)])->name); ?>

										<?php elseif($field == 'department'): ?>
												&nbsp;	<?php echo Form::close(); ?><?php echo e(@App\Model\Organization\Department::find($model[strtolower($field)])->
													name); ?>

											<?php else: ?>
												&nbsp;&nbsp;<?php echo e($model[strtolower($field)]); ?>

											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
					</div>

					<div class="card info-card" >
						<div class="row valign-wrapper mb-0">
							<div class="col l10 headline-text" >Bank Details</div>
							<div class="col l2" id="modal-wrapper">
								<?php if($isAdmin): ?>
									<a href="#modal4" class="grey-text darken-1 edit-button waves-effect"><i class="fa fa-pencil"></i></a>
								<?php endif; ?>
								<?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

							
								<input type="hidden" name="meta_table" value="employeemeta" />
								<?php if(count(request()->route()->parameters()) >0 ): ?>
									<input type="hidden" name="empId" value="<?php echo e(request()->route()->parameters()['id']); ?>" />
								<?php endif; ?>
									<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo Form::close(); ?>

							</div>
							
						</div>
						<div class="row" >
							<?php 
								$data = [];
							 ?>
							<?php $__currentLoopData = str_replace(' ','_',FormGenerator::GetSectionFieldsName('empsec6')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php 
									array_push($data , strtolower($v));
								 ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<div class="row mb-0">
									<div class="col l12 subhead-wrapper" >
										<span class="subhead"><?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;</span>
									</div>
									<div class="col l12 details-wrapper" >
										<?php echo e($model[strtolower($field)]); ?>

									</div>
								</div>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
						</div>
					</div>
				<?php endif; ?>
				<?php if(@$model['employ_info']): ?>
					<?php if(count(array_intersect(json_decode($model->employ_info['user_type']), [2,4])) != 0): ?>
						
					<?php endif; ?>
				<?php endif; ?>

			
			
		</div>
	</div>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
		
	$(document).ready(function(){
		$('#modal1').modal({
			 dismissible: false
		});
		$('#modal2').modal({
			 dismissible: false
		});
		$('#modal3').modal({
			 dismissible: false
		});
		$('#modal4').modal({
			 dismissible: false
		});

	})
	$(document).on('click','closeDialog',function(){
		$('#modal1').modal('close');
	})
	$(document).on('click','.fa-close',function(){
		$('#modal9').modal('close');
	});
	$(document).on('click','.chooser',function(){
		$('.image-spinner').show();
	});
	$(document).on('click','#card-alert i',function(){
		$('#card-alert').remove();
	});

	</script>
		<?php if(@$errors->has()): ?>
			<script type="text/javascript">
				$(window).load(function(){
				$('#modal1').modal('open');
					// console.log($('.error-red').parents('#modal-wrapper').find('.edit-button').html());
				});
			</script>
		<?php endif; ?>						
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>