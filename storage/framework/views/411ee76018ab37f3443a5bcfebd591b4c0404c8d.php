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
    .sections-wrap > .item{
        opacity: 0.5;
    }
    .sections-wrap > .item:hover{
        opacity: 1;
    }
    .sections-wrap > .item.active{
        opacity: 1;
    }
     body{
            padding: 0;
            margin: 0;
            background-color: #f5f5f5;
         }
         .screen-wrapper{
            height: 100vh;
         } 
         .screen-wrapper > .header{
            right: 0;
            left: 0;
            top: 0;
            background: #168dc5;
            z-index: 999;
         }
         .screen-wrapper > .footer{
            
            bottom: 0;
            right: 0;
            left: 0;
            background: #e4e4e4;
         }
         .screen-wrapper > .content{
            top: 64px;
            right: 0;
            left: 280px;
            background-color: #f5f5f5;
            bottom: 50px;
            overflow: auto;
         }
         .screen-wrapper > .content > .page{
            background-color: white;
            min-height: 100%;

         }
         .screen-wrapper > .content > .page > .answer{
            min-height: 50vh
         }
         .survey-sidebar{
            position: absolute;
            top: 64px;
            bottom: 48px;
            left: 0;
            width: 280px;
            background-color: white;
            z-index: 99;
            min-height: 100px;
            max-height: calc( 100vh - 100px );
            overflow: scroll;
         }
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.indicater-wrapper').click(function(){
			$(this).toggleClass('active');
		})
	})
</script>
<?php 
    $route = route('embed.survey',['token'=>request()->token]);
 ?>
<div class="" style="max-width: 1120px;margin: 0 auto;">

    <?php if($error['status'] == false): ?>
        <div class="aione-border aione-align-center border-width-3 p-50 font-size-30 grey lighten-2 mt-30" style="border-style: dashed;">
            <i class="fa fa-exclamation-triangle mr-20"></i><?php echo e($error['message']); ?>

        </div>
    <?php endif; ?>

    <?php if($data['displayBy'] == 'section' && $error['status'] == true): ?>
        <?php 
            $sectionIndex = (request()->section)?request()->section:0;
         ?>
        <div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
            <div class="aione-float-left pr-15  " style="width: 360px">
                <div class="sections-wrap" style="position: fixed">
                    <!-- Survey Section -->
                    <?php $__currentLoopData = $data['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item mb-10 <?php echo e(($sectionIndex == $key)?'active':''); ?>" onclick="window.location.href='<?php echo e(route('embed.survey',['token'=>request()->token]).'?section='.$key); ?>'" style="cursor: pointer;">
                            <div class="pv-15 ph-10 aione-border  bg-white " style="position:relative;">
                                <div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">
                                    <?php echo e($section['title']); ?>

                                </div>
                                <div class="font-size-13 line-height-20">
                                    <?php echo e($section['title']); ?>

                                </div>
                                <div class="indicater-wrapper" >
                                    <div class="bg-light-blue bg-lighten-4 indicater">
                                        <div class="bg-light-blue bg-darken-2 percentage" style="width:50%">
                                        </div>
                                        <div class="grey aione-align-center line-height-15 percentage-text">
                                            30% completed
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <?php if(isset($data['sections'][$sectionIndex])): ?>
                <div class="aione-float-left " style="margin-left:380px;width: calc( 100% - 360px )">
                    <div class="aione-border  bg-white mb-20">
                        <div class="aione-border-bottom p-10 light-blue darken-2 font-size-18 bg-white">
                            <?php echo e(@$data['sections'][$sectionIndex]['title']); ?>

                        </div>
                        <?php echo Form::open(); ?>

                            <?php $__currentLoopData = $data['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $fieldSlug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo FormGenerator::GenerateField($fieldSlug, [], null, 'org'); ?>

                                <div class="aione-border-top mv-10"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo Form::submit('Submit',['class'=>'m-0 bg-light-blue bg-darken-3 ']); ?>

                        <?php echo Form::close(); ?>

                    </div>
                </div>
            <?php endif; ?>
            <div class="clear"></div>
        </div>

    <?php endif; ?>
    
    <?php if($data['displayBy'] == 'survey' && $error['status'] == true): ?>
        <script type="text/javascript">
            function UpdateTableHeaders() {
               $(".persist-area").each(function() {
               
                   var el             = $(this),
                       offset         = el.offset(),
                       scrollTop      = $(window).scrollTop(),
                       floatingHeader = $(".floatingHeader", this)
                   
                   if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
                       floatingHeader.css({
                        "visibility": "visible"
                       });
                   } else {
                       floatingHeader.css({
                        "visibility": "hidden"
                       });      
                   };
               });
            }

            // DOM Ready      
            $(function() {

               var clonedHeaderRow;

               $(".persist-area").each(function() {
                   clonedHeaderRow = $(".persist-header", this);
                   clonedHeaderRow
                     .before(clonedHeaderRow.clone())
                     .css("width", clonedHeaderRow.width())
                     .addClass("floatingHeader");
                     
               });
               
               $(window)
                .scroll(UpdateTableHeaders)
                .trigger("scroll");
               
            });
        </script>
        <style type="text/css">
            .floatingHeader {
              position: fixed;
              top: 0;
              visibility: hidden;
                              width: 81%;
                /*visibility: initial;*/
                z-index: 9;
                margin-left: -15px;
                background: white;
            }
        </style>
        <div class="m-20 aione-border p-15">
            <?php echo Form::open(); ?>

            <?php $__currentLoopData = $data['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-30 persist-area">
                    <div class="p-10 font-size-20 light-blue darken-2 aione-border-bottom persist-header" >
                        <?php echo e($section['section_title']); ?>

                    </div>
                    <div class="p-10">
                        <?php $__currentLoopData = $section['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo FormGenerator::GenerateField($field, [], null, 'org'); ?>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white p-10 aione-border-top " style="position:fixed;bottom: 0;left:0;right:0">
                <?php echo Form::submit('Submit',['style'=>'line-height:12px;margin-left:150px;','class'=>' m-0 bg-light-blue bg-darken-3 aione-button']); ?>

                                
            </div>
            <?php echo Form::close(); ?>

        </div>
        
    <?php endif; ?>

</div>

    <?php if($data['displayBy'] == 'question' && $error['status'] == true): ?>
        <?php 
            $sectionIndex = (request()->section)?request()->section:0;
         ?>
        <div class="screen-wrapper position-relative" style="position: relative;">
            <div class="header position-absolute aione-align-center" style="position: absolute;">
                <h3 class="white font-weight-300">Aioneframework Survey Collecter</h3>
            </div>
            <div class="survey-sidebar sections-wrap" >
                <?php $__currentLoopData = $data['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item mb-10 <?php echo e(($sectionIndex == $key)?'active':''); ?>" onclick="" style="cursor: pointer;">
                        <div class="pv-15 ph-10 aione-border  bg-white " style="position:relative;">
                            <div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">
                                <?php echo e($section['title']); ?>

                            </div>
                            <div class="font-size-13 line-height-20">
                                <?php echo e($section['description']); ?>

                            </div>
                            <div class="indicater-wrapper" >
                                <div class="bg-light-blue bg-lighten-4 indicater">
                                    <div class="bg-light-blue bg-darken-2 percentage" style="width:50%">
                                    </div>
                                    <div class="grey aione-align-center line-height-15 percentage-text">
                                        30% completed
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="content p-10 l-pv-10 l-ph-100 m-pv-10 m-ph-50 position-absolute" style="position: absolute;">
                <div class="page aione-shadow p-20" style="position: relative;">
                    <?php if(isset($data['field_record']['field'])): ?>
                        <?php 
                            $prev = $route.'?section='.$sectionIndex.'&question='.($data['field_record']['index']-1);
                            $next = $route.'?section='.$sectionIndex.'&question='.($data['field_record']['index']+1);
                            $totalFields = count($data['fields']) - 1;
                            $nextSection = $route.'?section='.($sectionIndex+1);
                            $prevSection = $route.'?section='.($sectionIndex-1);
                            if($sectionIndex != 0){
                                $prevSectionLastQuest  = count($data['sections'][$sectionIndex-1]['fields'])-1;
                            }
                         ?>
                        <?php echo FormGenerator::GenerateField($data['field_record']['field'], [], null, 'org'); ?>

                        <div class="actions" style="position: absolute;bottom: 0;left: 0;
                        right: 0;padding: 0 5px;">
                            <?php if($data['field_record']['index'] >= 1): ?>
                                <button class="aione-float-left" onclick="window.location.href='<?php echo e($prev); ?>'">Previous</button>
                            <?php elseif($sectionIndex != 0): ?>
                                <button class="aione-float-left" onclick="window.location.href='<?php echo e($prevSection.'&question='.$prevSectionLastQuest); ?>'">Prev Section</button>
                            <?php endif; ?>
                            <?php if($data['field_record']['index'] != $totalFields): ?>
                                <button class="aione-float-right" onclick="window.location.href='<?php echo e($next); ?>'">Next</button>
                            <?php else: ?>
                                <button class="aione-float-right" onclick="window.location.href='<?php echo e($nextSection); ?>'">Next Section</button>
                            <?php endif; ?>
                            <div style="clear: both">
                              
                            </div>
                        </div>
                    <?php endif; ?>
                 </div>
            </div>
            <div style="position: absolute;" class="footer font-size-18 aione-border-top position-absolute p-15 aione-align-center">
             &copy; All rights reserved by OXO solutions
            </div>
        </div>
    <?php endif; ?>














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
    					$section_slug = $section_array[$section_id];
    				}
    				if(Session::has('field'.$form_id)){
                        $preserve = Session::get('preserve_field'.$form_id);
    					$fields = Session::get('field'.$form_id);
                        $filter_field = array_filter($fields);
    					$field_keys = array_keys($filter_field);
    					if(count($field_keys)==1){
    						echo '<input type="hidden" name="survey_status" value="completed" >';
    					}else{
    						echo '<input type="hidden" name="survey_status" value="incompleted" >';
    					}

                        $get_field_id = array_shift($field_keys); //current ques key
                        if(Session::has('wild_field'.$form_id)){
                            $wild =  Session::get('wild_field'.$form_id);
                            $field_idss = $wild['field_id'.$form_id];

                            $keys = array_keys($preserve);
                            $key = array_search($field_idss, $keys);
                            if(isset($preserve[$key+1])){
                                $next_fields_id = $keys[$key+1];
                            }
                         }else{
                             $keys = array_keys($filter_field);
                            $key = array_search($get_field_id, $keys);
                            if(isset($filter_field[$key+1])){
                                $next_fields_id = $keys[$key+1];
                            }
                         }

                       

                    }
        		 ?>
    			<?php if(Session::has('field'.$form_id)): ?>
        			<?php if(Session::has('wild_field'.$form_id)): ?>
                    <script type="text/javascript">
                        $(".codition-<?php echo e(Session::get('wild_field'.$form_id)['field_id'.$form_id]); ?>").show(); 
                    </script>
        			<input id="field_id" type="hidden" name="field_id" value="<?php echo e(Session::get('wild_field'.$form_id)['field_id'.$form_id]); ?>" >
        			<?php echo FormGenerator::GenerateField(Session::get('wild_field'.$form_id)['field_slug'.$form_id],[],'','org'); ?>

                   
        			<?php else: ?>
        				<input id="field_id" type="hidden" name="field_id" value="<?php echo e($get_field_id); ?>" >
        				<?php echo FormGenerator::GenerateField($fields[$get_field_id],[],'','org'); ?>


                    <?php endif; ?>

                     <div class="font-size-16 line-height-26">
                            <a href="<?php echo e(route('set.survey',['form_id'=>$form_id ,'id'=>$next_fields_id, 'slug'=>$filter_field[$next_fields_id], 'type'=>'field' ])); ?>">Next</a>
                    </div>

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

    $("[type='checkbox'][value='996'], [type='checkbox'][value='998'] ").on('click', function(e){
        none = $(this).val();
         $(this).parent().siblings('.field-option').children("[type='checkbox']").prop('checked', false);
        console.log(1123);

    });

    $("[type='checkbox']").on('click', function(e){

         $(this).parent().siblings('.field-option').find("[type='checkbox'][value='996'], [type='checkbox'][value='998']").prop('checked', false);
    });

    // $("[type='checkbox'][value='998']").on('click', function(e){
    //     none = $(this).val();
    //     alert(none);

    // });
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