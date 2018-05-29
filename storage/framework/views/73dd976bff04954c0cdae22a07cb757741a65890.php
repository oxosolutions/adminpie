<?php $__env->startSection('content'); ?>
<?php
	// $isEmployee = App\Model\Organization\Employee::where('user_id' , $model->id)->first();
	$isEmployee = is_employee(@request()->route()->parameters()['id']);
	$isAdmin = is_admin();

	$user_id = $model->id;
?>

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

	<div class="ar">
		<div class="ac l60">
			<div class="aione-border mb-25">
				<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
					Basic Details
					
				</div>
				<div class="p-10">
					<div class="ar basic-details">
						<div class="ac l30 profile-pic p-10">
							<img src="<?php echo e(asset(get_profile_picture($user_id,'medium'))); ?>" >
						</div>
						
						<div class="ac l70 p-10">
							<div class="aione-table">
								<table class="Bordered">
									<tbody>
										<tr>
											<td>Name</td>
											<td><?php echo e(@$model->name); ?></td>
										</tr>
										<tr>
											<td>Email</td>
											<td><?php echo e(@$model->email); ?></td>
										</tr>
										
										<tr>
											<td>Shift</td>
											<td>
												<div class="">
													<?php echo e(@App\Model\Organization\Shift::where('id',$model->user_shift)->first()->name); ?>

												</div>
												<div class="">
													<?php echo e(@App\Model\Organization\Shift::where('id',$model->user_shift)->first()->from); ?> - <?php echo e(@App\Model\Organization\Shift::where('id',$model->user_shift)->first()->to); ?>

												</div>
				                                
												<div class="">
													<?php if(json_decode(@App\Model\Organization\Shift::where('id',$shift)->first()->working_days)): ?>

														<?php $__currentLoopData = json_decode(@App\Model\Organization\Shift::where('id',$shift)->first()->working_days); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														
														<div class="active" title="<?php echo e(ucfirst($v)); ?>"><?php echo e(ucfirst($v[0])); ?></div>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
								<div class=" right-align" id="modal-wrapper">
									
										<?php
											$meta_data = array_column(json_decode($model['metas'],true), 'value','key');
											$shift = null;
											if(isset($meta_data['user_shift'])){
												$shift = App\Model\Organization\Shift::where(['id' => $meta_data['user_shift']])->pluck('id','name');
											}
											$userData = [];
											$userData['about_me'] = $model->about_me;
											$userData['shift'] = $shift;
											$userData['email'] = $model->email;
											$userData['name'] = $model->name;
										?>
									<div id="modal1" class="modal modal-fixed-footer" style="overflow-y: hidden;">
									<?php echo Form::model(@$userData,['route'=>'update.profile','method'=>'post']); ?>

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
										<input type="hidden" name="id" value="<?php echo e(@$model->id); ?>">
										<div class="modal-content" style="padding: 20px;padding-bottom: 60px">
											<div class="col s12 m2 l12 aione-field-wrapper">
											<?php echo FormGenerator::GenerateField('name',['type'=>'inset']); ?>

											</div>
											<div class="col s12 m2 l12 aione-field-wrapper">
											 <?php echo FormGenerator::GenerateField('email',['type'=>'inset']); ?>

											 </div>
											 <div class="col s12 m2 l12 aione-field-wrapper">
											 <?php echo FormGenerator::GenerateField('about_me',['type'=>'inset']); ?>

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
									
						</div>
					</div>

					
					
				</div>
			</div>
			<div class="aione-border" >
				<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
					Recent Activities
					<a href="<?php echo e(route('account.activities')); ?>" class=" aione-button aione-float-right font-size-14 " style="margin-top: -6px">View All</a>
				</div>
				<div class="ar ">
					
						
						<?php $__currentLoopData = $user_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="ar aione-border-bottom p-10" >
								
								<div class="ac l50 ">
									<?php $__currentLoopData = json_decode($value->text); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($loop->index == 0 ): ?>
											<?php echo e(str_replace('{id?}','id',$val)); ?>

										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<div class="ac l20  ">
									<?php $__currentLoopData = json_decode($value->text); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($loop->index == 2 ): ?>
											<?php echo e($val); ?>

										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<div class="ac l10">
									<span class="green white-text box"><?php echo e($value->type); ?></span>
								</div>
								<!-- <div class="col l2">
									<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text">ACCOMPLISHED</span>
								</div> -->
								<div class="ac l20 aione-align-center" style="font-size: 13px">
									2 hour ago
								</div>	
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

										
				</div>
			</div>
		</div>
		<div class="ac l40">

			<div class="aione-border mb-25" >
				<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
					Contact Details
					<a href="#modal2" class="aione-button aione-float-right font-size-14 edit-button" style="margin-top: -6px">Edit</a>
					<?php echo Form::model(@$model,['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH']); ?>

					<input type="hidden" name="meta_table" value="usermeta" />
					<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'Contact Details','button_title'=>'Save ','section'=>'empsec2']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo Form::close(); ?>

				</div>
				<?php if(@$model !=null): ?>
					<?php if(!$model->metas->isEmpty()): ?>
						<div class="aione-table p-10">
							<table>
								<tbody>
									<?php $__currentLoopData = $model->metas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($v->key == 'contact_no' || $v->key == 'alternative_number' || $v->key == 'permanent_address' || $v->key == 'present_address'): ?>
										<tr>
											<td>
												<?php echo e(ucfirst(str_replace('_',' ',$v->key))); ?>

											</td>
											<td>
												<?php echo e($v->value); ?>	
											</td>
										</tr>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
						
					<?php endif; ?>
				<?php endif; ?>
			</div>
				<?php
					$roles = array_keys(@$model->user_role_rel->groupBy('role_id')->toArray());
					//if role has permission to this widget
				?>
                <?php if($isEmployee && request()->id != null): ?>
                    <?php if(check_widget_permission('employee_details')): ?>
                        <div class="aione-border mb-25" >
                            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
                                Employee Details
                                <?php if(@$isAdmin): ?>
                                    <a href="#modal3" class="aione-button font-size-14 aione-float-right edit-button " style="margin-top: -6px">Edit</a>
                                   
                                <?php endif; ?>
                                <?php echo Form::model(@$model->toArray(),['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH']); ?>

                                <input type="hidden" name="meta_table" value="employeemeta" />
                                
                                <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Employee Details','button_title'=>'Save ','section'=>'empsec7']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php echo Form::close(); ?>

                            </div>
                            <div class="aione-table p-10">
                                <table>
                                    <tbody>
                                        <?php $__currentLoopData = FormGenerator::GetSectionFieldsName('empsec7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;
                                            </td>
                                            <td>                                        
                                                <?php
                                                    $fieldData = str_replace(' ', '_', strtolower($field));
                                                ?>
                                                <?php if($fieldData == 'designation'): ?>
                                                    <?php echo e(@App\Model\Organization\Designation::find($model->designation)->name); ?>

                                                <?php elseif($fieldData == 'department'): ?>
                                                    <?php echo e(@App\Model\Organization\Department::find($model->$fieldData)->name); ?>

                                                <?php elseif($fieldData == 'user_shift'): ?>
                                                    <?php echo e(@App\Model\Organization\Shift::find($model->$fieldData)->name); ?>

                                                <?php elseif($fieldData == 'pay_scale'): ?>
                                                    <?php echo e(@App\Model\Organization\Payscale::find($model->$fieldData)->title); ?>

                                                 <?php elseif($fieldData == 'leave_category'): ?>
                                                    <?php echo e(@$model->leave_category_name); ?>

                                                <?php else: ?>
                                                    <?php echo e($model->$fieldData); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            
                        </div>

                        <div class="aione-border info-card" >
                            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
                                Bank Details
                                <?php if($isAdmin): ?>
                                    <a href="#modal4" class="aione-float-right font-size-14 edit-button aione-button" style="margin-top: -6px">Edit</a>
                                <?php endif; ?>
                                <?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

                            
                                <input type="hidden" name="meta_table" value="employeemeta" />
                                <?php if(count(request()->route()->parameters()) >0 ): ?>
                                    <input type="hidden" name="empId" value="<?php echo e(request()->route()->parameters()['id']); ?>" />
                                <?php endif; ?>
                                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php echo Form::close(); ?>

                            </div>
                            
                            <div class="aione-table p-10" >
                                <?php
                                    $data = [];
                                ?>
                                <?php $__currentLoopData = str_replace(' ','_',FormGenerator::GetSectionFieldsName('empsec6')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        array_push($data , strtolower($v));
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <table>
                                    <tbody> 
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <tr >
                                                <td  >
                                                    <?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;
                                                </td>
                                                <td  >
                                                    <?php echo e($model[strtolower($field)]); ?>

                                                </td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                            
                        
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if($isEmployee && request()->id == null): ?>
                    <?php if(check_widget_permission('employee_details')): ?>
                        <div class="aione-border mb-25" >
                            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
                                Employee Details
                                <?php if(@$isAdmin): ?>
                                    <a href="#modal3" class="aione-button font-size-14 aione-float-right edit-button " style="margin-top: -6px">Edit</a>
                                <?php endif; ?>
                                <?php echo Form::model(@$model->toArray(),['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH']); ?>

                                <input type="hidden" name="meta_table" value="employeemeta" />
                                
                                <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Employee Details','button_title'=>'Save ','section'=>'empsec7']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php echo Form::close(); ?>

                            </div>
                            <div class="aione-table p-10">
                                <table>
                                    <tbody>
                                        <?php $__currentLoopData = FormGenerator::GetSectionFieldsName('empsec7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;
                                            </td>
                                            <td>                                        
                                                <?php
                                                    $fieldData = str_replace(' ', '_', strtolower($field));
                                                ?>
                                                <?php if($fieldData == 'designation'): ?>
                                                    <?php echo e(@App\Model\Organization\Designation::find($model->designation)->name); ?>

                                                <?php elseif($fieldData == 'department'): ?>
                                                    <?php echo e(@App\Model\Organization\Department::find($model->$fieldData)->name); ?>

                                                <?php elseif($fieldData == 'user_shift'): ?>
                                                    <?php echo e(@App\Model\Organization\Shift::find($model->$fieldData)->name); ?>

                                                <?php elseif($fieldData == 'pay_scale'): ?>
                                                    <?php echo e(@App\Model\Organization\Payscale::find($model->$fieldData)->title); ?>

                                                <?php else: ?>
                                                    <?php echo e($model->$fieldData); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            
                        </div>

                        <div class="aione-border info-card" >
                            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
                                Bank Details
                                <?php if($isAdmin): ?>
                                    <a href="#modal4" class="aione-float-right font-size-14 edit-button aione-button" style="margin-top: -6px">Edit</a>
                                <?php endif; ?>
                                <?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

                            
                                <input type="hidden" name="meta_table" value="employeemeta" />
                                <?php if(count(request()->route()->parameters()) >0 ): ?>
                                    <input type="hidden" name="empId" value="<?php echo e(request()->route()->parameters()['id']); ?>" />
                                <?php endif; ?>
                                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php echo Form::close(); ?>

                            </div>
                            
                            <div class="aione-table p-10" >
                                <?php
                                    $data = [];
                                ?>
                                <?php $__currentLoopData = str_replace(' ','_',FormGenerator::GetSectionFieldsName('empsec6')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        array_push($data , strtolower($v));
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <table>
                                    <tbody> 
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <tr >
                                                <td  >
                                                    <?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;
                                                </td>
                                                <td  >
                                                    <?php echo e($model[strtolower($field)]); ?>

                                                </td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                            
                        
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

				<?php if($isAdmin && $isEmployee && request()->id == null): ?>
					<div class="aione-border mb-25" >
						<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
							Employee Details
							<?php if(@$isAdmin): ?>
								<a href="#modal3" class="aione-button font-size-14 aione-float-right edit-button " style="margin-top: -6px">Edit</a>
							<?php endif; ?>
							<?php echo Form::model(@$model->toArray(),['route'=>['update.profile.meta',@$model->id],'method'=>'PATCH']); ?>

							<input type="hidden" name="meta_table" value="employeemeta" />
							
							<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Employee Details','button_title'=>'Save ','section'=>'empsec7']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php echo Form::close(); ?>

						</div>
						<div class="aione-table p-10">
							<table>
								<tbody>
									<?php $__currentLoopData = FormGenerator::GetSectionFieldsName('empsec7'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td>
											<?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;
										</td>
										<td>										
											<?php
												$fieldData = str_replace(' ', '_', strtolower($field));
											?>
											<?php if($fieldData == 'designation'): ?>
												<?php echo e(@App\Model\Organization\Designation::find($model->designation)->name); ?>

											<?php elseif($fieldData == 'department'): ?>
												<?php echo e(@App\Model\Organization\Department::find($model->$fieldData)->name); ?>

											<?php elseif($fieldData == 'user_shift'): ?>
												<?php echo e(@App\Model\Organization\Shift::find($model->$fieldData)->name); ?>

											<?php elseif($fieldData == 'pay_scale'): ?>
												<?php echo e(@App\Model\Organization\Payscale::find($model->$fieldData)->title); ?>

											<?php else: ?>
												<?php echo e($model->$fieldData); ?>

											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
						
						
					</div>

					<div class="aione-border info-card" >
						<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
							Bank Details
							<?php if($isAdmin): ?>
								<a href="#modal4" class="aione-float-right font-size-14 edit-button aione-button" style="margin-top: -6px">Edit</a>
							<?php endif; ?>
							<?php echo Form::model($model,['route'=>['update.profile.meta',$model->id],'method'=>'PATCH']); ?>

						
							<input type="hidden" name="meta_table" value="employeemeta" />
							<?php if(count(request()->route()->parameters()) >0 ): ?>
								<input type="hidden" name="empId" value="<?php echo e(request()->route()->parameters()['id']); ?>" />
							<?php endif; ?>
								<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal4','heading'=>'Bank Details','button_title'=>'Save ','section'=>'empsec6']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php echo Form::close(); ?>

						</div>
						
						<div class="aione-table p-10" >
							<?php
								$data = [];
							?>
							<?php $__currentLoopData = str_replace(' ','_',FormGenerator::GetSectionFieldsName('empsec6')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php
									array_push($data , strtolower($v));
								?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<table>
								<tbody>	
									<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<tr >
											<td  >
												<?php echo e(ucfirst(str_replace('_', ' ',$field))); ?>: &nbsp;
											</td>
											<td  >
												<?php echo e($model[strtolower($field)]); ?>

											</td>
										</tr>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
										
					
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
		<?php if(!$errors->isEmpty()): ?>
			<script type="text/javascript">
				$(window).load(function(){
				$('#modal1').modal('open');
					// console.log($('.error-red').parents('#modal-wrapper').find('.edit-button').html());
				});
			</script>
		<?php endif; ?>						
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>