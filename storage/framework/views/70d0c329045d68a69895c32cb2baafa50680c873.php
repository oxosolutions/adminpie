
<div class="ar">
	<div class="ac l24">
		<nav id="aione_nav" class="aione-nav light vertical">
		    <div class="aione-nav-background">
		    </div>
		    <ul id="aione_menu" class="aione-menu sortable ui-sortable">
		      	<?php $__currentLoopData = $survey['section']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surveyVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			        <li class="aione-nav-item level0 has-children ui-sortable-handle nav-item-selected">
			            
			            <a href="javascript:;">
			                <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-address-book-o">
			                    </i></span>
			                <span class="nav-item-text">
			                    <?php echo e($surveyVal['section_name']); ?>

			                </span>
			                <span class="nav-item-arrow"></span>
			            </a>
			            <?php if(!empty($surveyVal['fields'])): ?>
				            <ul class="side-bar-submenu">
				            	<?php $__currentLoopData = $surveyVal['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php 
										$slug = str_replace('-', '_', $fields['field_slug']);
									 ?>
									<?php if(!empty($current_data)): ?>
										<?php if(array_key_exists($slug , array_filter($current_data))): ?>
											<li class="aione-nav-item level1 ui-sortable-handle fill_<?php echo e($slug); ?>">
							                    <a href="">
							                        <span class="nav-item-text"><?php echo e($fields['field_title']); ?> <?php echo e($slug); ?></span>
							                    </a>
							                </li>
										<?php else: ?>
											<li class="aione-nav-item level1 ui-sortable-handle fill_<?php echo e($fields['field_slug']); ?>">
							                    <a href="">
							                        
							                        <span class="nav-item-text"><?php echo e($fields['field_title']); ?> <?php echo e($fields['field_slug']); ?></span>
							                    </a>
							                </li>
										<?php endif; ?>
									<?php else: ?>
						                <li class="aione-nav-item level1 ui-sortable-handle fill_<?php echo e($fields['field_slug']); ?>">
						                    <a href="http://admin.scolm.com/modules/76/355">
						                        
						                        <span class="nav-item-text"><?php echo e(substr($fields['field_title'], 0,40)); ?> </span>
						                        <span style="margin-left: -18px" class="pl-18 display-block font-size-12 ans_<?php echo e($fields['field_slug']); ?>"> 
													Answer: Not filled yet.
												</span>
						                    </a>
						                </li>
						            <?php endif; ?>
				                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				            </ul>
			            <?php endif; ?>
			        </li>
		       	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    </ul>
		</nav>
		
	</div>
	<div class="ac l76">
		<div class="aione-border p-10">
			<?php if(Session::has('sucess')): ?>
				<div class="aione-message success">
					<ul class="aione-messages aione-align-center">
						<li class="aione-align-center"><?php echo e(Session::get('sucess')); ?></li>
					</ul>
				</div>
			<?php endif; ?>

				<?php if(isset($survey_setting['survey_timer'])  && ($survey_setting['survey_timer']==true)): ?>
					<?php if(isset($survey_setting['timer_type']) && ($survey_setting['timer_type']=="survey_expiry_time")): ?>
						<h3>  <?php echo e($survey_setting['survey_time_lefts']); ?> Survey Expired</h3>
				 	<?php endif; ?>
				<?php endif; ?>
				<?php if(!empty($error)): ?>
						<?php if(is_array($error)): ?>
							<div class="aione-message error">
							    <ul class="aione-messages">
							        <li><?php echo e(implode($error)); ?> </li>
							    </ul>
							</div>
						<?php else: ?>
							<div class="aione-message error">
							    <ul class="aione-messages">
							        <li><?php echo e($error); ?> </li>
							    </ul>
							</div>
						<?php endif; ?>
				<?php else: ?>

				<!-- Sidebar Questions -->
				
				<!-- Sidebar Questions end-->
					
					<input id="viewType" type="hidden" name="type" value="survey">
						<?php echo Form::model($slug,['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post']); ?>

							<input type="hidden" name="form_id" value="<?php echo e($form_id); ?>" >
							<input type="hidden" name="ip_address" value="<?php echo e(Request::ip()); ?>" >
							<input type="hidden" name="survey_submitted_from" value="web" >

							<?php 

							 if(Auth::guard('org')->check()){
								echo "<input type='hidden' name='survey_submitted_by' value='".Auth::guard('org')->user()->id."' >";
							 }

							// dump(Session::all());
							if(Session::has('section')){
								$section_array = Session::get('section');
								$key = array_keys($section_array);
								if(count($key)==1){
									echo '<input type="hidden" name="survey_status" value="completed" >';
								}else{
									echo '<input type="hidden" name="survey_status" value="incompleted" >';
								}
								$section_id = array_shift($key);
								$section_slug = $section_array[$section_id];
							}
							if(Session::has('field')){
								$fields = Session::get('field');
								$field_keys = array_keys($fields);
								if(count($field_keys)==1){
									echo '<input type="hidden" name="survey_status" value="completed" >';
								}else{
									echo '<input type="hidden" name="survey_status" value="incompleted" >';
								}
		 						$first_field_key = array_shift($field_keys);
							}
							 ?>
							<div>
								<div class="survey-forms">
									<?php if(Session::has('field')): ?>
										<input type="hidden" name="field_id" value="<?php echo e($first_field_key); ?>" >

										<?php echo FormGenerator::GenerateField($fields[$first_field_key]['field_slug'],[],'','org'); ?>

									
									<?php elseif(Session::has('section')): ?>
										<input type="hidden" name="section_id" value="<?php echo e($section_id); ?>" >
										<?php echo FormGenerator::GenerateSection($section_slug,[],'','org'); ?>

									<?php else: ?>					
										<?php echo FormGenerator::GenerateForm($survey_slug,[],'','org'); ?>

										<input type="hidden" name="survey_status" value="completed" >

									<?php endif; ?>
								</div>
								<input type="hidden" name="form_slug" value="<?php echo e($slug); ?>" >
								<input type="submit" value="<?php echo e(@$survey_setting['form_save_button_text']); ?>">
							<?php echo Form::close(); ?>

						</div>
				<?php endif; ?>
				<div id="append">
					
				</div>
				<script>
		$(document).ready(function(){
			$('input:checkbox').each(function(){
				name = $(this).attr('name');
				newone =  name.replace('[]', '');
				$(this).addClass(newone);
			});

					$('.survey-form').on('change','select',function(){
						slug = $(this).attr('name');
						$(".fill_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
						$(".ans_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
						ansVal = $(this).val();
						$(".ans_"+slug).html('Answer:'+ansVal);

					});

					$('.survey-form').on('click','input:radio',function(){
						slug = $(this).attr('name');
						$(".fill_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
						$(".ans_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
						ansVal = $(this).val();
						$(".ans_"+slug).html('Answer:'+ansVal);

					});

					$('.survey-form').on('click','input:checkbox',function(){
							slug = $(this).attr('name');
							newone =  slug.replace('[]', '');
							$(".fill_"+newone).css({'background':'rgba(0, 128, 0, 0.2)'});
							classs = $(this).attr('class');
							$(".ans_"+newone).html('');
							$(".ans_"+newone).append('Answer :');
							$('.'+classs+':checked').each(function(){
								     opt_values = $(this).val();
								     $(".ans_"+newone).append('<br>selected options:  '+opt_values);
								}); 
							$(".ans_"+newone).css({'background':'rgba(0, 128, 0, 0.2)'});
					});

				$('.survey-form').on('blur','input:text, textarea',function(){
					
						types = $(this).attr('type');
						countQues =0;
						slug = $(this).attr('name');
						ansVal = $(this).val();
						if(ansVal!=''){
							$(".fill_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
							$(".ans_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
							$(".ans_"+slug).html('Answer: '+ansVal);
						}
					});
		});
		</script>
		</div>
	</div>
</div>







	