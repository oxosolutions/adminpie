<?php $__env->startSection('content'); ?>
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
		color: #676767
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
<div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
    <?php echo $__env->make('organization.survey.survey_draw.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(!empty($survey) && empty($error)): ?>
    	<?php echo $__env->make('organization.survey.survey_draw.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    	<div class="aione-float-left aione-border" style="width: calc( 100% - 360px )">
    		<?php if(!empty($current_data)): ?>
    			<?php echo Form::model($current_data,['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post']); ?>

    		<?php else: ?>
                <?php echo Form::open(['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post']); ?>

    		<?php endif; ?>
        		<input type="hidden" name="form_id" value="<?php echo e($form_id); ?>" >
    			<input type="hidden" name="ip_address" value="<?php echo e(Request::ip()); ?>" >
    			<input type="hidden" name="survey_submitted_from" value="web" >
        		<?php 
    				if(Auth::guard('org')->check()){
    					echo "<input type='hidden' name='survey_submitted_by' value='".Auth::guard('org')->user()->id."' >";
    				}
    				if(Session::has('section'.$form_id)){
    					$section_array = Session::get('section'.$form_id);
    					$key = array_keys($section_array);
    					if(count($key)==1){
    						echo '<input type="hidden" name="survey_status" value="completed" >';
    					}else{
    						echo '<input type="hidden" name="survey_status" value="incompleted" >';
    					}
    					$section_id = array_shift($key);
    					//dd($section_id, $section_array);
    					$section_slug = $section_array[$section_id];
    				}
    				if(Session::has('field'.$form_id)){
    					$fields = Session::get('field'.$form_id);
    					$field_keys = array_keys($fields);
    					if(count($field_keys)==1){
    						echo '<input type="hidden" name="survey_status" value="completed" >';
    					}else{
    						echo '<input type="hidden" name="survey_status" value="incompleted" >';
    					}
    						$get_field_id = array_shift($field_keys);
    				}
        		 ?>
    			<?php if(Session::has('field'.$form_id)): ?>
        			<?php if(Session::has('wild_field'.$form_id)): ?>
        				
        			<input id="field_id" type="hidden" name="field_id" value="<?php echo e(Session::get('wild_field'.$form_id)['field_id'.$form_id]); ?>" >
        			<?php echo FormGenerator::GenerateField(Session::get('wild_field'.$form_id)['field_slug'.$form_id],[],'','org'); ?>


        			<?php else: ?>
        				<input id="field_id" type="hidden" name="field_id" value="<?php echo e($get_field_id); ?>" >
        				
        				<?php echo FormGenerator::GenerateField($fields[$get_field_id],[],'','org'); ?>


                    <?php endif; ?>
                        <script type="text/javascript"> $("#field_682").show();</script>
    			<?php elseif(Session::has('section'.$form_id)): ?>
    				<div class="sec">
    					<?php if(Session::has('wild_section'.$form_id)): ?>
 						<input id="sec_id"  type="hidden" name="section_id" value="<?php echo e(Session::get('wild_section'.$form_id)['section_id'.$form_id]); ?>" >
    					   <?php echo FormGenerator::GenerateSection(Session::get('wild_section'.$form_id)['section_slug'.$form_id], [],'','org'); ?>

    					<?php else: ?>
    						<?php echo e($section_id); ?>

    						<input id="sec_id"  type="hidden" name="section_id" value="<?php echo e($section_id); ?>" >
    					   <?php echo FormGenerator::GenerateSection($section_slug, $current_data,'','org'); ?>

    					<?php endif; ?>
    				</div>
    			<?php else: ?>					
    				<?php echo FormGenerator::GenerateForm($survey_slug,[],'','org'); ?>

    				<input type="hidden" name="survey_status" value="completed" >
    			<?php endif; ?>
        		
    			<input type="submit" value="<?php echo e(@$survey_setting['form_save_button_text']); ?>">
    		<?php echo Form::close(); ?>

    	</div>
    <?php endif; ?>
</div>
<script type="text/javascript">

$(document).ready(function(){
    field_id = $("#field_id").val();
    setTimeout(function(){ 
    $("#field_"+field_id).show(); 
     }, 10);

	$('div.sec').on('blur','input:text, textarea',function(){
		$inputFields =  $("div.sec input, textarea , select");
		var items = 0;
		$.each($inputFields, function($field) {
				if($inputFields[$field].value.length > 0) { ++items; }
			//console.log('val '+ $inputFields[$field].value, 'count'+items);
			 });
		sec_id = $("#sec_id").val();
		sec_count =  $("#sec_que_count_"+sec_id).text();
		percent = items/sec_count*100;
		$("#"+sec_id).text(items);
		$(".progress_bar_"+sec_id).css('width',percent+'%');
		$(".progress_val_"+sec_id).text(percent+'% Completed');
	});

		// $('div.sec').on('change','select', function(){
			
		// 	$inputFields =  $("div.sec select, input, textarea");
		// 	var items = 0;
  //   		$.each($inputFields, function($field) {
  //   			console.log($field);
  //     			if($inputFields[$field].value.length > 0) { ++items; }
  //  			 });
  //   		sec_id = $("#sec_id").val();
  //   		sec_count =  $("#sec_que_count_"+sec_id).text();
  //   		percent = items/sec_count*100;
  //   		$("#"+sec_id).text(items);
  //   		$(".progress_bar_"+sec_id).css('width',percent+'%');
  //   		$(".progress_val_"+sec_id).text(percent+'% Completed');

		// });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>