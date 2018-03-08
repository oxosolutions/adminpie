<div class="aione-float-left pr-15	" style="width: 360px">
	<div>
		<?php $__currentLoopData = $survey['section']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surveyVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white " style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">
				<?php if(Session::has('field'.$form_id)): ?>
				<?php echo e($surveyVal['section_name']); ?>

				<?php else: ?>
					<a href="<?php echo e(route('set.survey',['form_id'=>$form_id ,  'id'=>$surveyVal['id'], 'slug'=>$surveyVal['section_slug'], 'type'=>'section' ])); ?>"><?php echo e($surveyVal['section_name']); ?> </a>
				<?php endif; ?>

				</div>
				<div class="font-size-13 line-height-20"><span id="<?php echo e($surveyVal['id']); ?>" >0</span>/ <span id="sec_que_count_<?php echo e($surveyVal['id']); ?>"> <?php echo e(count($surveyVal['fields'])); ?> </span> Question</div>
				<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="progress_bar_<?php echo e($surveyVal['id']); ?> bg-light-blue bg-darken-2 percentage" style="width:0%">
							
							
						</div>
						<div class="progress_val_<?php echo e($surveyVal['id']); ?> grey aione-align-center line-height-15 percentage-text">0% completed</div>
					</div>
				</div>
				<?php if(Session::has('field'.$form_id) && !empty($surveyVal['fields'])): ?>
					<?php $__currentLoopData = $surveyVal['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
							$slug = str_replace('-', '_', $fields['field_slug']);
						 ?>	
					<div class="aione-border">
						<div class="aione-border-bottom p-10">
							<div class="font-size-16 line-height-26">
								<a href="<?php echo e(route('set.survey',['form_id'=>$form_id ,'id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ])); ?>"><?php echo e($fields['field_title']); ?></a>
							</div>
							<div class="grey font-size-13">
								this is the description of the question
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
	</div>