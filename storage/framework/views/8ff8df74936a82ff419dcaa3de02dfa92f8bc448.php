<div class="aione-float-left pr-15	" style="width: 360px">
	<div>
		
		<?php $__currentLoopData = $survey['section']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surveyVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white " style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">  <a href="<?php echo e(route('set.survey',['id'=>$surveyVal['id'], 'slug'=>$surveyVal['section_slug'], 'type'=>'section' ])); ?>"><?php echo e($surveyVal['section_name']); ?> </a></div>
				<div class="font-size-13 line-height-20"><span id="<?php echo e($surveyVal['id']); ?>" >0 <?php echo e($surveyVal['id']); ?></span>/<?php echo e(count($surveyVal['fields'])); ?> Question</div>
				<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width:90%">
							
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">30% completed</div>
					</div>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
	</div>
	</div>