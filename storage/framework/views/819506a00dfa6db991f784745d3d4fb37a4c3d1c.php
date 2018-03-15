<?php $__env->startSection('sidebar'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
			'show_page_title' => 'yes',
			'show_add_new_button' => 'no',
			'show_navigation' => 'yes',
			'page_title' => 'View Survey',
			'add_new' => '+ Add Feedback'
		);
 ?>
<style type="text/css">
	.indicater-wrapper{
		position: absolute;right: 0;bottom:0;left:0;font-size: 9px;cursor: pointer
	}
	.indicater-wrapper .indicater{
		width: 100%;height: 4px;position: relative;
	}
	.indicater-wrapper .percentage{
		position: absolute;min-height: 4px;left: 0;width: 30%
	}
	.indicater-wrapper .percentage-text{
		display: none;
		position: absolute;
		width: 100%
	}

	.indicater-wrapper.active .percentage-text{
		display: block;
		color: #ccc
	}
	.indicater-wrapper.active .indicater{
		height: 15px;margin-top: 10px
	}
	.indicater-wrapper.active .percentage{
		min-height: 15px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.indicater-wrapper').click(function(){
			$(this).toggleClass('active');
		})
	})
</script>


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
				<?php if(!empty($error['survey_authorization_required'])): ?>
		<a href="<?php echo e(route('org.login')); ?>"> Login </a>
				<?php endif; ?>

<?php else: ?> 
		<div>
			<?php if(!empty($survey)): ?>
			<div class="na" style="display: inline-block; width:300px; float: left; border:1px solid grey;">
			<ul>

				<?php $__currentLoopData = $survey['section']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surveyVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<?php if(Session::has('section')): ?>
					<li>  <a href="<?php echo e(route('set.survey',['id'=>$surveyVal['id'], 'slug'=>$surveyVal['section_slug'], 'type'=>'section' ])); ?>">  <?php echo e($surveyVal['section_name']); ?> </a></li>
				<?php else: ?>
					<li>    <?php echo e($surveyVal['section_name']); ?> </li>
				<?php endif; ?>
					<?php if(!empty($surveyVal['fields'])): ?>
					<ul style="margin-left: 20px">
					
						<?php $__currentLoopData = $surveyVal['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
								$slug = str_replace('-', '_', $fields['field_slug']);
						 ?>
							<?php if(!empty($current_data)): ?>
								<?php if(array_key_exists($slug , array_filter($current_data))): ?>
									<li style="background-color: rgba(0, 128, 0, 0.2);" class="fill_<?php echo e($slug); ?>">
								<a href="<?php echo e(route('set.survey',['id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ])); ?>">
									<?php echo e($fields['field_title']); ?> 
								</a>
								</li>
									<li style="background-color: rgba(0, 128, 0, 0.2);"  class="ans_<?php echo e($slug); ?>"> 
											Answer: <?php echo e($current_data[$slug]); ?>

									</li>
								<?php else: ?>
									<li  class="fill_<?php echo e($fields['field_slug']); ?>"> 
										<a href="<?php echo e(route('set.survey',['id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ])); ?>">
											<?php echo e($fields['field_title']); ?> 
										</a>

									</li>
									<li class="ans_<?php echo e($fields['field_slug']); ?>"> 
											Answer: Not filled yet.
									</li>
								<?php endif; ?>
							<?php else: ?>
								<li  class="fill_<?php echo e($fields['field_slug']); ?>">
									<a href="<?php echo e(route('set.survey',['id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ])); ?>"> <?php echo e(substr($fields['field_title'], 0,40)); ?> 
									</a> 
								</li>
									<li class="ans_<?php echo e($fields['field_slug']); ?>"> 
											Answer: Not filled yet.
									</li>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
					<?php endif; ?>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
			</div> 
			<?php endif; ?>

		</div>

			<div class="aione-progress-bar">
				<div class="aione-progress-bg">
					<div class="aione-progress-inside" >

					</div>
				</div>
			</div>
			<input id="viewType" type="hidden" name="type" value="survey">
			<?php echo e(dump($slug)); ?>

				<?php echo Form::model($slug,['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post']); ?>

					<input type="hidden" name="form_id" value="<?php echo e($form_id); ?>" >
					<input type="hidden" name="ip_address" value="<?php echo e(Request::ip()); ?>" >
					<input type="hidden" name="survey_submitted_from" value="web" >
					<?php 
					 if(Auth::guard('org')->check()){
						echo "<input type='hidden' name='survey_submitted_by' value='".Auth::guard('org')->user()->id."' >";
					 }
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
 						//$first_field_key = array_shift($field_keys);
 						$get_field_id = array_shift($field_keys);
 					}

					 ?>
					<div style="display: inline-block; width: 900px; float: right; border:1px solid grey;">
						<div class="survey-forms">
							<?php if(Session::has('field')): ?>
								<input type="hidden" name="field_id" value="<?php echo e($get_field_id); ?>" >
								<?php if(!empty($current_data)): ?>
								
								<?php echo FormGenerator::GenerateField($fields[$get_field_id],$current_data,'','org'); ?>


								<?php else: ?>
								<?php echo FormGenerator::GenerateField($fields[$get_field_id],[],'','org'); ?>


								<?php endif; ?>

							<?php elseif(Session::has('section')): ?>
								<input type="hidden" name="section_id" value="<?php echo e($section_id); ?>" >
								<?php echo FormGenerator::GenerateSection($section_slug,[],'','org'); ?>

							<?php else: ?>					
								<?php echo FormGenerator::GenerateForm($survey_slug,[],'','org'); ?>

								<input type="hidden" name="survey_status" value="completed" >
							<?php endif; ?>
						</div>
						<?php echo e(dump($slug)); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>