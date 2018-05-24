<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Structure <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
); 
if(!empty($survey_data)){
    $repeated_slug=[];
    $sections = $survey_data['section'];
    if(!empty($sections)){
	    $section_slugs = collect($sections)->groupBy('section_slug')->toArray();

		foreach ($section_slugs as $key => $value) {
			if(count($section_slugs[$key])>1){
				 $repeated_slug[$key] = array_column($value, 'section_name','id');

			}
		}
		
	    $setting = $survey_data['forms_meta'];
	   	$settings = array_column($setting,'value','key');
	   	unset($survey_data['section'][6]);
	  	$sections = $survey_data['section'];
	}
}
$index =1;
$warning = [];
$total_error_count = 0;
$total_warning_count = 0;
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.survey._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(!empty($not_valid_id)): ?>
 			<div class="aione-message warning">
            	<?php echo e($not_valid_id); ?>

        	</div>
		
    <?php elseif(!empty($survey_data)): ?>
		<?php if(empty($sections)): ?>
			 <div class="aione-message warning">
            	<?php echo e(__('survey.survey_section_miss')); ?>

        	</div>
   		<?php else: ?>

	   		<div class="ar pb-20">
	            <div class="ac s100 m50 l25">
	                <div class="aione-widget aione-border bg-grey bg-lighten-5">
	                    <div class="aione-title">
	                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Sections</h5>
	                    </div>
	                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2"><?php echo e(@$data['count']['sections']); ?></div>
	                </div>
	            </div>
	            <div class="ac s100 m50 l25">
	                <div class="aione-widget aione-border bg-grey bg-lighten-5">
	                    <div class="aione-title">
	                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Questions</h5>
	                    </div>
	                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2"><?php echo e(@$data['count']['fields']); ?></div>
	                </div>
	            </div>
	            <div class="ac s100 m50 l25">
	                <div class="aione-widget aione-border bg-grey bg-lighten-5">
	                    <div class="aione-title">
	                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Warnings</h5>
	                    </div>
	                        <div class="aione-align-center p-30 font-size-64 font-weight-600 orange darken-2 warning_count">0</div>
	                </div>
	            </div>
	            <div class="ac s100 m50 l25">
	                <div class="aione-widget aione-border bg-grey bg-lighten-5">
	                    <div class="aione-title">
	                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Errors</h5>
	                    </div>
	                    <div class="aione-align-center p-30 font-size-64 font-weight-600 red darken-2 error_count">0</div>
	                </div>
	            </div>
	        </div>

	        <div class="ar pb-20">
	            <div class="ac s100 m100 l100">
	            	<div class="aione-border">
		            	<div class="aione-title aione-border-bottom bg-grey bg-lighten-4">
							<h4 class="aione-align-left font-weight-400 m-0 pv-10 ph-15">Survey Structure</h4>
						</div>
						<div class="aione-accordion p-10">
						
		    				<?php if(!empty(@$sections)): ?>
			    				<?php $__currentLoopData = @$sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    					<div class="aione-item">
					                    <div class="aione-item-header font-size-16 font-weight-400 <?php echo e(@$section['section_slug']); ?>">
					                        <?php echo e(@$section['section_name']); ?>

											<span class="aione-float-right mr-40"><?php echo e(count(@$section['fields'])); ?> Questions</span>
					                    </div>
					                    <div class="aione-item-content p-0 aione-table">
											<table class="compact font-size-14">
											    <thead>
											    	<tr>
													    <th>Questions</th> 
													    <th>Slug</th>
													    <th>Type</th>
													    <th style="min-width: 100px">Options</th>
													    <th>Conditions</th>
													    <th>Validations</th>
												    </tr>
												</thead>
									       		
										      	<tbody >
										      	<?php if(!empty(@$section['fields'])): ?>
										      		<?php $__currentLoopData = @$section['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKey => $fieldVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										      		<?php 
										      			// $field_meta = array_column($fieldVal['field_meta'], 'value','key'));
										      			$field_slug[] = $fieldVal['field_slug'];
										      			$field_title[$fieldVal['field_slug']][]	= 	substr($fieldVal['field_title'], 0, 30);
										      			$field_id[$fieldVal['field_slug']][]	=   $fieldVal['id'];
										      			$sec_ids[$fieldVal['field_slug']][] 	=   $section['id'];
										      			
										      		 ?>
										      		<tr class='<?php echo e($fieldVal['field_slug']); ?>'>
										      			<td><?php echo e(@$fieldVal['field_title']); ?></td>
										      			<td><?php echo e(@$fieldVal['field_slug']); ?></td>
											      		<td><?php echo e(@$fieldVal['field_type']); ?></td> 
											      		
														<?php 
										            		$collection = collect($fieldVal['field_meta'])->mapWithKeys(function($item){
										                		return [$item['key']=>$item['value']];
										            		});
															$meta = $collection->toArray();
									            		 ?>
									            		<td>
									            		<?php if(in_array($fieldVal['field_type'], ['radio','select','checkbox'])): ?>
									            			 <span class="bg-cyan white p-4 show-details"><?php echo e(@count(json_decode($meta['field_options']))); ?> Options</span>
									            			 
									            			 <div class="option-details" style="min-width: 150px;max-width: 150px">
									            			 	<?php $__currentLoopData = $meta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metaKey=> $metaVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									            				<?php if($metaKey == 'field_options' && in_array($fieldVal['field_type'], ['radio','select','checkbox'])  ): ?>
									            				<?php 
									            					if($metaVal==null || count(json_decode($metaVal,true)) ==0 ) {
									            						$opt_miss_error[] =[$fieldVal['field_type'],$fieldVal['field_slug']]; 
									            						if(empty($error)){
									            							$error = [];
									            						}
									            						if(!array_key_exists($section['section_slug'], $error)){
																			 			$error[$section['section_slug']][] = $section['section_name'];
																			 		}
																			 		$error[$section['section_slug']]['field'][] =['qno'=>$loop->iteration,  'title'=>$fieldVal['field_title'], 'type'=>$fieldVal['field_type'], 'option'=>'Empty options'];
									            					}
									            				 ?>
									                				<?php $__currentLoopData = json_decode($metaVal,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optKey => $optVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									                			
																		<?php echo e($loop->iteration); ?>

																			<?php if(!empty($optVal['key']) && !empty($optVal['value'])): ?>
																		 		<?php echo e($optVal['key']); ?>-<?php echo e($optVal['value']); ?><br>
																		 		<?php else: ?>
																		 		<?php 
																			 		if(!array_key_exists($section['section_slug'], $warning)){
																			 			$warning[$section['section_slug']][] = $section['section_name'];
																			 		}
																			 		$warning[$section['section_slug']]['field'][] =['qno'=>$fieldVal['id'],  'title'=>$fieldVal['field_title'], 'type'=>$fieldVal['field_type'], 'option'=>'Empty option exist.'];

																		 		 ?> 
																					<span class='entry' > not key -  not val </span>
																					
																		 		<?php endif; ?>
									                				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									            				<?php endif; ?>
									            			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
									            			 </div>
									            		<?php else: ?>
			    				
									            		  <span class="bg-blue-grey white p-4">No Options</span>
									            		<?php endif; ?>
								            			</td>
								            			<td><?php if(!empty($meta['field_conditions'])): ?>
								            					<?php 
								            					 $meta_field_conditions = json_decode($meta['field_conditions'],true);
								            					if(!empty($meta_field_conditions)){
									            					foreach ($meta_field_conditions[0] as $codkey => $codvalue) {
									            						if(!empty($codvalue)){
									            							echo $codkey.':'.$codvalue.', ';
									            						}
									            					}
								            					}
								            					 ?>
								            				<?php endif; ?> 
								            			</td>	
								            			<td>
								            				<?php if(!empty($meta['field_validations'])): ?>
								            					<?php 
								            					$meta_validation = json_decode($meta['field_validations'],true);
								            					if(!empty($meta_validation)){
									            					foreach ($meta_validation[0] as $key => $value) {
									            						if(!empty($value)){
									            							echo $key.':'.$value.', ';
									            						}
									            					}
								            					}
								            					 ?>
								            				<?php endif; ?>
								            			</td>
										      		</tr>
										      		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
							            		<?php endif; ?>
									      		</tbody>
											</table>
					                    </div>
					                </div>
					    		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    	<?php endif; ?>
						</div>
					</div>
	            </div>
	        </div>
			
			<style type="text/css">
				.option-details{
					display: none;
				}
			</style>
			<script type="text/javascript">
				$(document).on('click','.show-details',function(e){
					e.preventDefault();
					console.log('hello');
					$(this).parent().find('.option-details').toggle();
				})
			</script>
			<?php 
				// dump($repet_field, $field_slug);
				$unique = array_unique($field_slug);
				$repeated_ques_slug = array_diff_assoc($field_slug, $unique);

				// $ids = array_map(function ($ar) {return $ar['field_slug'];}, $repet_field);
				// dump($ids);
			 ?>
			
			<div class="ar">
				<div class="ac l65">
					
	            	<div class="aione-border border-red mb-15">
		            	<div class="aione-title aione-border-bottom bg-grey bg-lighten-4">
							<h4 class="aione-align-left font-weight-400 m-0 pv-10 ph-15">Survey Structure Errors</h4>
						</div>
			    		
			    		<?php if(@$count_form_slug>1): ?>
			    				<div class="p-10">
			    					<div class="aione-border bg-red bg-lighten-4 font-size-16 font-weight-400 p-10">
				                        Survey slug already in use.
										<?php 
											$total_error_count++;
										 ?>
					                 </div>
			    				</div>
			    					
				    		
			    		<?php endif; ?>
			    		<?php if(count($repeated_slug)> 0): ?>
			    			<div class="aione-accordion p-10">
				    			<div class="aione-item">
			    					<div class="aione-item-header font-size-16 font-weight-400">
					                    Error Sections Slug	
					                </div>
					                <div class="aione-item-content p-0">
					                	<div class="aione-table">
					                		<table class="compact font-size-14">
						                		<thead>
						                			<tr>
						                				<th>ID</th>
						                				<th>Section</th>
						                				<th>Slug</th>
						                				<th>Action</th>
						                			</tr>
						                		</thead>
						                		<tbody>
						                			<?php $__currentLoopData = @$repeated_slug; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seckey => $secvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                			<tr>
						                				<td><?php echo e(implode(', ', array_keys($repeated_slug[$seckey]))); ?></td>
						                				<td class="truncate">
						                				<?php $__currentLoopData = $secvalue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyz => $valz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<a href="<?php echo e(route('survey.sections.list',$id)); ?>?sections=<?php echo e($keyz); ?>"><span class="nav-item-text"> <?php echo e($valz); ?> Edit</span></a> , 
						                				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                				</td>
						                				<td class="bg-red bg-lighten-4"><?php echo e($seckey); ?></td>
						                				<td><a href="" class="goToSection" id="<?php echo e($seckey); ?>">Go to section</a></td>
						                			</tr>
						                			<?php 
														$total_error_count++;
													 ?>
						                			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                		</tbody>
						                	</table>	
					                	</div>
					                	
					                </div>
					                
				    			</div>
			    			</div>
			    		<?php endif; ?>
						<div class="aione-accordion p-10">

							<?php if(!empty(@$repeated_ques_slug)): ?>
			    				<div class="aione-item">
			    					<div class="aione-item-header font-size-16 font-weight-400">
					                    Error Questions Slug
										<span class="aione-float-right mr-40"> </span>
					                </div>
					                <div class="aione-item-content p-0">
					                	<div class="aione-table">
					                		<table class="compact font-size-14">
						                		<thead>
						                			<tr>
						                				<th>ID</th>
						                				<th>Question</th>
						                				<th>Slug</th>
						                				<th>Action</th>
						                			</tr>
						                		</thead>
						                		<tbody>
						                	
						                			<?php $__currentLoopData = @$repeated_ques_slug; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quekey => $quevalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                			<tr>
						                				<td><?php echo e(implode(', ', $field_id[$quevalue])); ?></td>
						                				<td>
							                				<?php $__currentLoopData = $field_id[$quevalue]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKeys => $fieldValues): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							                				
							                					<a href="<?php echo e(route('survey.sections.list',$id)); ?>?sections=<?php echo e($sec_ids[$quevalue][$fieldKeys]); ?>&field=<?php echo e($fieldValues); ?>"><span class="nav-item-text"> <?php echo e($field_title[$quevalue][$fieldKeys]); ?> Edit</span></a> , 
							                				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							                			</td>
						                				
						                				<td class="bg-red bg-lighten-4"> <?php echo e($quevalue); ?></td>
						                				<td><a href="" class="goToQues" id="<?php echo e($quevalue); ?>" > Go to question</a></td>
						                			</tr>
						                			<?php 
														$total_error_count++;
													 ?>


						                			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                		</tbody>
						                	</table>	
					                	</div>
					                	
					                </div>
				    				
								</div>
				    		<?php endif; ?>
			    		

		    				<?php if(!empty(@$error)): ?>
			    				<?php $__currentLoopData = @$error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    					<div class="aione-item">
					                    <div style="background-color: #F44336;" class="aione-item-header font-size-16 font-weight-400">
					                        <?php echo e(@$error[$key][0]); ?>

											<span class="aione-float-right mr-40"> </span>
					                    </div>
					                    <div class="aione-item-content p-0 aione-table">
											<table class="compact">
											    <thead>
											    	<tr>
											    		<th>Question No</th>
													    <th>Questions</th> 
													    <th>Type</th>
													    <th>Options</th>
												    </tr>
												</thead>
										      	<tbody style="background-color: #F44336;" >
										      	<?php $__currentLoopData = @$value['field']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKey => $fieldVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										      	<tr style="background-color: #F44336;" >
										      		<td><?php echo e($fieldVal['qno']); ?></td>
										      		<td><?php echo e($fieldVal['title']); ?></td>
										      		<td><?php echo e($fieldVal['type']); ?></td>
										      		<td><?php echo e($fieldVal['option']); ?></td>
										      	</tr>
										      	<?php 
													$total_error_count++;
												 ?>

										      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										      	</tbody>
										    </table>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								
							<?php endif; ?>
						</div>
					</div>
						
			        <script type="text/javascript">
			        	$(".error_count").html(<?php echo e($total_error_count); ?>);
			        </script>
				 	<div class="">
		            	<div class="aione-border">
			            	<div class="aione-title aione-border-bottom bg-grey bg-lighten-4">
								<h4 class="aione-align-left font-weight-400 m-0 pv-10 ph-15">Survey Structure Warning</h4>
							</div>
							<div class="aione-accordion p-10">
							
			    				<?php if(!empty(@$warning)): ?>
				    				<?php $__currentLoopData = @$warning; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				    					<div class="aione-item">
						                    <div class="aione-item-header font-size-16 font-weight-400">
						                        <?php echo e(@$warning[$key][0]); ?>

												<span class="aione-float-right mr-40"> </span>
						                    </div>
						                     <div class="aione-item-content p-0 aione-table">
												<table class="compact">
												    <thead>
												    	<tr>
												    		<th>Question No</th>
														    <th>Questions</th> 
														    <th>Type</th>
														    <th>Options</th>
													    </tr>
													</thead>
											      	<tbody  >
											      	<?php $__currentLoopData = @$value['field']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKey => $fieldVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											      	<tr >
											      		<td><?php echo e($fieldVal['qno']); ?></td>
											      		<td><?php echo e($fieldVal['title']); ?></td>
											      		<td><?php echo e($fieldVal['type']); ?></td>
											      		<td><?php echo e($fieldVal['option']); ?></td>
											      	</tr>
											      	<?php 
											      	$total_warning_count++;
											      	 ?>

											      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											      	</tbody>
											     </table>
											</div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
									<div class="aione-message warning">
	            						<?php echo e(__('survey.survey_no_warning')); ?>

	        						</div>
								<?php endif; ?>
								</div>
							</div>
						
					</div>
					<script>
						$(".warning_count").html(<?php echo e(@$total_warning_count); ?>);
					</script>
				</div>
				<div class="ac l35">
			    		
			    			<div class="aione-border">
				    			<div class="aione-title">
			                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 bg-grey bg-lighten-4">Survey Settings</h5>
			                    </div>
				    			<div class="aione-table p-10">
				    				<?php if($setting_questions != null): ?>
					    				<table class="compact">
					    					<tbody>
					    						<?php $__currentLoopData = $setting_questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $settingKey => $settingVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					                                <?php if($settingKey=='_token'): ?>
					                                    <?php continue; ?>;
					                                <?php endif; ?>
					                                <?php if(!empty($settings[$settingKey])): ?>
					                                    <tr>
					                                        <td><?php echo e($index++); ?>. <?php echo e($settingVal['field_title']); ?></td>
					                                        <?php if($settingKey =='individual_list'): ?>
																<td>
					                                        		<?php $__currentLoopData = json_decode($settings[$settingKey],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ukey => $uval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
					                                        			<?php if(!empty($user = get_user(false ,true, $uval))): ?>
																				<?php echo e($user['name']); ?>, 
																			<?php else: ?>
																				User not exist.
					                                        			<?php endif; ?>
					                                        		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					                                        	</td>
					                                        	
															<?php elseif($settingKey =='role_list'): ?>
															<td>
																<?php $__currentLoopData = $roles = json_decode($settings[$settingKey],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rkey => $rval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																		<?php if(!empty($role_name = get_role($rval))): ?>
																			<?php echo e($role_name); ?>

																		<?php else: ?>
																			Role not exist.
																		<?php endif; ?>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</td>
															<?php else: ?>
					                                        	<?php if($settingVal['field_type']=='switch'): ?>
																	<?php if($settings[$settingKey]==1): ?>
																		<td>Yes </td>				
																	<?php else: ?>
																		<td>No  </td>
																	<?php endif; ?>
					                                        	<?php else: ?>
					                                        		<td><?php echo e($settings[$settingKey]); ?></td>
					                                        	<?php endif; ?>
					                                        <?php endif; ?>
					                                    </tr>
					                                <?php endif; ?>
					                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					                            
					    					</tbody>
					    				</table>
					    			<?php endif; ?>
				    			</div>	
			    			</div>	
			    	
			    		
				</div>
			</div>

			
	       
			        
  
    	<?php endif; ?>
	  <?php else: ?>
	     <div class="aione-message warning">
            <?php echo e(__('survey.survey_not_exit')); ?>

        </div>
 <?php endif; ?>
	
<script>
	$(document).on('click','.goToSection', function(e){
		e.preventDefault();
		id = $(this).attr('id');
		$('html, body').animate({
		    scrollTop: ($('.'+id).offset().top)
		},500);
		$("."+id).css('background-color','yellow');
		
			setTimeout(function(){
				$("."+id).css('background-color','white');
			},6000);
	});

	$(document).on('click','.goToQues', function(e){
		e.preventDefault();
		id = $(this).attr('id');
		className = $("."+id).closest('div.aione-table').closest('div.aione-item').addClass('active');
		$("."+id).css('background-color','yellow');

		$('html, body').animate({
		    scrollTop: ($('.'+id).offset().top)
		},1500);

		setTimeout(function(){
				$("."+id).css('background-color','white');
				className = $("."+id).closest('div.aione-table').closest('div.aione-item').removeClass('active');
			},10000);

	});



	
</script>



<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>