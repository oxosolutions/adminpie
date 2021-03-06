<?php $__env->startSection('content'); ?>
<?php if(Session::get('success')): ?>
    <section class="container">
        <div class="ar">
            <div class="ac l100">
                <div class="aione-message success">
                    <h5><i class="ion-checkmark"></i> <?php echo e(Session::get('success')); ?></h5>
                </div>        
            </div>
        </div>
    </section>
<?php endif; ?>
<style >
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
        width: 330px;
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
        background-color: white;
        z-index: 99;
        min-height: 100px;
        max-height: calc( 100vh - 100px );
        overflow: scroll;
     }
     .clock-wrap
     {
        right: 0px;
        top: 0px;
        padding-right:3px;
        margin-top: 28px;
        width: 131px;
        height: 133px;
        padding-left: 15px;
        position: absolute;
        position: fixed;
     }
     .time-wrap
     {
        position: absolute;
        right: 0px;
        top: 145px;
        padding-right: 13px;
        padding-top: 22px;
        position: fixed;
        font-size: 20px;
     }
     .custom-effect{
        padding: 10px 20px;
        margin: 20px auto
     }
     .custom-effect:hover{
        background: #cfd8dc
     }
     .view-by-question .item.active > div{
        background: #0288d1;
     }
     .view-by-question .item.active > div .section-title{
        color: white;
        margin-bottom: 12px;
     }
     .view-by-question .item.active > div .indicater-wrapper{
        display: block;
        padding: 10px;
     }
     .view-by-question .item > div .indicater-wrapper{
        display: none;
     }
     .view-by-question .indicater-wrapper .indicater{
        height: 8px;
     }
     .view-by-question .indicater-wrapper .percentage{
        min-height: 8px;
        background: grey
     }
</style>


<?php
    $route = route('embed.survey',['token'=>request()->token]);
    $survey_model = App\Model\Organization\forms::get_id_from_token_of_survey(request()->token);
    $survey_form_settings = (object) get_form_meta($survey_model->id,null,true,false);
    if(@$survey_form_settings->form_border){
        $aione_form_border = "aione-form-border";
    }
    if(@$survey_form_settings->form_secion_show_border){
        $aione_form_section_border = "aione-form-section-border";
    }
    if(@$survey_form_settings->form_field_show_border){
        $aione_form_field_border = "aione-form-field-border";
    }
    $survey_start_time = session()->get('survey_started_time');
    if($survey_start_time == null){
        $survey_start_time = \Carbon\Carbon::now();
        session()->put('survey_started_time',$survey_start_time);
    }
    // session()->put('survey_started_time');
?>
<input type="hidden" name="meta_value" value="<?php echo e(json_encode($meta)); ?>" />
<input type="hidden" name="started_time" value="<?php echo e($survey_start_time->format('Y-m-d H:i:s')); ?>" />
<div class="" style="max-width: 1120px;margin: 0 auto;">
    <?php if($error['status'] == false): ?>
        <div class="aione-border aione-align-center border-width-3 p-50 font-size-30 grey lighten-2 mt-30" style="border-style: dashed;">
            <i class="fa fa-exclamation-triangle mr-20"></i><?php echo e($error['message']); ?>

        </div>
        <?php if($error['type'] == 'auth'): ?>
        <div class="aione-align-center">
            <a href="<?php echo e(route('org.login')); ?>?backto=<?php echo e(request()->url()); ?>" class="aione-button custom-effect bg-blue-grey bg-darken-4 white">Login Now</a>
        </div>
            
        <?php endif; ?>
    <?php endif; ?>


    <div id="aione_form_wrapper_<?php echo e($survey_model->id); ?>" class="aione-form-wrapper aione-form-theme-<?php echo e(@$survey_form_settings->form_theme); ?> aione-form-label-position-<?php echo e(@$survey_form_settings->form_label_position); ?> aione-form-style-<?php echo e(@$survey_form_settings->form_style); ?> <?php echo e(@$aione_form_border); ?> <?php echo e(@$aione_form_field_border); ?> <?php echo e(@$aione_form_section_border); ?>">
        <div class="aione-row">
            
            <?php if( (@$survey_form_settings->form_show_title && !empty($form_title)) || (@$survey_form_settings->form_show_description && !empty($survey_model->form_description))): ?>
                <div id="aione_form_header" class="aione-form-header">
                    <div class="aione-row p-10 m-10 bg-white">
                        <?php if(@$survey_form_settings->form_show_title && !empty($survey_model->form_title)): ?>
                            <h1 class="aione-form-title aione-align-<?php echo e(@$survey_form_settings->form_title_align); ?>"><?php echo @$survey_model->form_title; ?></h1>
                        <?php endif; ?>
                        <?php if(@$survey_form_settings->form_show_description && !empty($survey_model->form_description)): ?>
                            <h2 class="aione-form-description aione-align-<?php echo e(@$survey_form_settings->form_description_align); ?>"><?php echo @$survey_model->form_description; ?></h2>
                        <?php endif; ?>
                    </div> <!-- .aione-row -->
                </div> <!-- .aione-form-header -->
            <?php endif; ?>
            


            
            <?php if($data['displayBy'] == 'section' && $error['status'] == true): ?>
                
                <?php
                    $sectionIndex = (request()->section)?request()->section:0;
                ?>
                <div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
                    <div class="aione-float-left pr-15  " style="width: 360px">
                        <div class="sections-wrap">
                            <!-- Survey Section -->
                            <?php $__currentLoopData = $data['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $completedSections = session()->get('completed_sections');
                                    $partiallySections = session()->get('partial_sections');
                                    if($completedSections != null && in_array($key,$completedSections)){
                                        $progressPercentage = 100;
                                        $completedClass = 'completed';
                                    }else{
                                        $progressPercentage = 0;
                                        $completedClass = '';
                                    }
                                    if($partiallySections != null && in_array($key,$partiallySections)){
                                        $partiallClass = 'partially-completed';
                                    }else{
                                        $progressPercentage = 0;
                                        $partiallClass = '';
                                    }
                                ?>
                                <div class="item mb-10 <?php echo e(($sectionIndex == $key)?'active':''); ?> <?php echo e($completedClass); ?> <?php echo e($partiallClass); ?>" onclick="window.location.href='<?php echo e(route('embed.survey',['token'=>request()->token]).'?section='.$key); ?>'" style="cursor: pointer;">
                                    <div class="pv-15 pl-16 pr-10 aione-border  bg-white " style="position:relative;">
                                        <div class="font-size-20 light-blue darken-2 font-weight-600 truncate " >
                                            <?php echo e($section['title']); ?>

                                        </div>
                                        <div class="font-size-13 line-height-20">
                                            <?php echo $section['description']; ?>

                                        </div>
                                        <div class="indicater-wrapper" >
                                            <div class="bg-light-blue bg-lighten-4 indicater">

                                                <div class="bg-light-blue bg-darken-2 percentage <?php echo e($completedClass); ?>" style="width:<?php echo e($progressPercentage); ?>%">
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
                        
                        <div class="aione-float-left " style="width: calc( 100% - 360px )">
                            <div class="aione-border  bg-white mb-20">
                                <div class="aione-border-bottom pv-20 ph-30 light-blue darken-2 font-size-18 bg-white">
                                    <?php echo e(@$data['sections'][$sectionIndex]['title']); ?>

                                    <div class="grey darken-1">
                                        
                                     <?php echo @$data['sections'][$sectionIndex]['description']; ?>

                                    </div>
                                </div>
                                <?php echo Form::model(@$prefill); ?>

                                    <?php echo Form::hidden('section',request()->section); ?>

                                    <?php echo Form::hidden('number_of_fields',count($data['fields'])); ?>

                                    <?php
                                        $preFillCount = 0;
                                        $prefilledSlug = [];
                                        $OptionsArray = [];
                                        $OptionsArray['form_id'] = $data['form_id'];
                                        $OptionsArray['from'] = @$data['sections'][$sectionIndex]['section_type'];
                                        $OptionsArray['loop_index'] = 0;
                                    ?>
                                    <div class="div-for-section">
                                        <div class="parent_div_for_append">
                                            <div class="mb-30 persist-area single-section">
                                                <?php $__currentLoopData = $data['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $fieldSlug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo FormGenerator::GenerateField($fieldSlug, $OptionsArray, null, 'org'); ?>

                                                 
                                                    <?php
                                                        if(@$prefill[$fieldSlug] != null){
                                                            $prefilledSlug[] = $fieldSlug;
                                                            $preFillCount++;
                                                        }
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <textarea class="form_conditions" style="display: none;"><?php echo e(json_encode(FormGenerator::GetCurrentFormConditions())); ?></textarea>
                                            </div>
                                            
                                        </div>
                                        <?php if(@$data['sections'][$sectionIndex]['section_type'] == 'repeater'): ?>
                                            <input type="button" class="aione-button add_more" value="Add More" />
                                        <?php endif; ?>
                                    </div>
                                    <?php echo Form::hidden('prefilled_count',$preFillCount); ?>

                                    <?php echo Form::hidden('prefilled_names',json_encode($prefilledSlug)); ?>

                                    <?php echo Form::submit('Submit',['class'=>'m-0 bg-light-blue bg-darken-3 ']); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="clear"></div>
                </div>

            <?php endif; ?>
            


            
            <?php if($data['displayBy'] == 'survey' && $error['status'] == true): ?>
                <div class="m-20 aione-border p-15 bg-white surveyDiv" style="position: relative;">
                    <?php echo Form::model(@$prefill); ?>

                    <?php $__currentLoopData = $data['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $OptionsArray = [];
                            $OptionsArray['form_id'] = $data['form_id'];
                            $OptionsArray['from'] = $section['section_type'];
                            $OptionsArray['loop_index'] = 0;
                        ?>
                        <div class="div-for-section">
                            <div class="parent_div_for_append">
                                <div class="mb-30 persist-area single-section">
                                    <div class="p-10 font-size-20 light-blue darken-2 aione-border-bottom persist-header" >
                                        <?php echo e($section['section_title']); ?>

                                    </div>
                                    <div class="p-10 ar">
                                        <?php $__currentLoopData = $section['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo FormGenerator::GenerateField($field, $OptionsArray, null, 'org'); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                </div>
                            </div>
                            <?php if($section['section_type'] == 'repeater'): ?>
                                <input type="button" class="aione-button add_more" value="Add More" />
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white p-10 aione-border-top " style="">
                        <?php echo Form::submit('Submit',['style'=>'','class'=>' m-0 bg-light-blue bg-darken-3 aione-button']); ?>

                    </div>
                    <?php echo Form::close(); ?>

                </div>
            <?php endif; ?>
           


            
            <?php if($data['displayBy'] == 'question' && $error['status'] == true): ?>
                <?php
                    $sectionIndex = (request()->section)?request()->section:0;
                    $questionIndex = (request()->question)?request()->question:0;
                ?>

                <div class="ar view-by-question">
                    <div class="ac l25" >
                        <?php $__currentLoopData = $data['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $completedSections = session()->get('completed_sections');
                                $partiallySections = session()->get('partial_sections');
                                if($completedSections != null && in_array($key,$completedSections)){
                                    $progressPercentage = 100;
                                    $completedClass = 'completed';
                                }else{
                                    $progressPercentage = 0;
                                    $completedClass = '';
                                }
                                if($partiallySections != null && in_array($key,$partiallySections)){
                                    $partiallClass = 'partially-completed';
                                }else{
                                    $progressPercentage = 0;
                                    $partiallClass = '';
                                }
                            ?>
                            <div class="item mb-10 <?php echo e(($sectionIndex == $key)?'active':''); ?> <?php echo e($completedClass); ?>" onclick="" style="cursor: pointer;">
                                <div class="pv-15 ph-10 aione-border  bg-white " style="position:relative;">
                                    <div class="font-size-20  truncate section-title" title="Basic detail section for personal information">
                                        <?php echo e($section['title']); ?>

                                    </div>
                                    <div class="font-size-13 line-height-20">
                                        <?php echo e($section['description']); ?>

                                    </div>
                                    <div class="indicater-wrapper" >
                                        <div class="bg-white indicater">
                                            <?php
                                                $onePercent = 100/count($data['fields']);
                                                if($sectionIndex == $key){
                                                    $percent = ($data['field_record']['index'])*$onePercent;
                                                }else{
                                                    $percent = 0;
                                                }
                                            ?>
                                            <div class="bg-light-blue bg-darken-2 percentage" style="width:<?php echo e($percent); ?>%">
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
                    <div class="ac l75 bg-white">
                        <div>
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
                                <?php echo Form::model(@$prefill,['route'=>['embed.survey',request()->token,'section='.$sectionIndex,'question='.$questionIndex],'id'=>'question_form']); ?>

                                    <?php echo Form::hidden('prev_next_section',null,['class'=>'prev_next_section']); ?>

                                    <?php echo Form::hidden('prev_next_question',null,['class'=>'prev_next_question']); ?>

                                    <?php if(@$data['sections'][$sectionIndex]['section_type'] == 'repeater'): ?>
                                        <div class="div-for-section">
                                            <div class="parent_div_for_append">
                                                <div class="mb-30 persist-area single-section">
                                                    <?php
                                                        $OptionsArray = [];
                                                        $OptionsArray['form_id'] = $data['form_id'];
                                                        $OptionsArray['from'] = $data['sections'][$sectionIndex]['section_type'];
                                                        $OptionsArray['loop_index'] = 0;
                                                    ?>
                                                    <?php $__currentLoopData = $data['sections'][$sectionIndex]['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $fieldSlug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo FormGenerator::GenerateField($fieldSlug, $OptionsArray, null, 'org'); ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <hr/>
                                                </div>
                                            </div>
                                            <input type="button" class="aione-button add_more" value="Add More" />
                                        </div>
                                    <?php else: ?>
                                        <?php echo FormGenerator::GenerateField($data['field_record']['field'], ['form_id'=>$data['form_id']], null, 'org'); ?>

                                    <?php endif; ?>
                                    <div class="actions" >
                                        <?php if(@$data['sections'][$sectionIndex]['section_type'] == 'repeater'): ?>
                                            <button class="next_section" data-section="<?php echo e(($sectionIndex+1)); ?>" data-question="0">Next Section</button>
                                        <?php else: ?>
                                            <?php if($data['field_record']['index'] >= 1): ?>
                                                <button class="aione-float-left prev" data-section="<?php echo e($sectionIndex); ?>" data-question="<?php echo e(($data['field_record']['index']-1)); ?>">Previous</button>
                                            <?php elseif($sectionIndex != 0): ?>
                                                <button class="aione-float-left prev_section" data-section="<?php echo e(($sectionIndex-1)); ?>" data-question="<?php echo e($prevSectionLastQuest); ?>">Prev Section</button>
                                            <?php endif; ?>
                                            <?php if($data['field_record']['index'] != $totalFields): ?>
                                                <button class="aione-float-right next" data-section="<?php echo e($sectionIndex); ?>" data-question="<?php echo e(($data['field_record']['index']+1)); ?>">Next</button>
                                            <?php else: ?>
                                                <button class="next_section" data-section="<?php echo e(($sectionIndex+1)); ?>" data-question="0">Next Section</button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <div style="clear: both">
                                          
                                        </div>
                                    </div>
                                <?php echo Form::close(); ?>

                            <?php endif; ?>
                            <script type="text/javascript">
                                $('.prev, .next, .next_section, .prev_section').click(function(e){
                                    e.preventDefault();
                                    var prev_next_section = $(this).data('section');
                                    var prev_next_question = $(this).data('question');
                                    console.log(prev_next_question,prev_next_section);
                                    $('.prev_next_section').val(prev_next_section);
                                    $('.prev_next_question').val(prev_next_question);
                                    $('#question_form').submit();
                                });
                            </script>
                        </div>
                    </div>
                    
                </div>
            <?php endif; ?>
            

        </div>
    </div>
</div>
<div style="position: fixed; top: 0; right: 5%; z-index: 999;">
    <h4>Remaining:  <span id="day">(00 Day's)</span> <span id="time">00:00:00</span></h4>
</div>
<script src="<?php echo e(asset('js/moment.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $('.indicater-wrapper').click(function(){
            $(this).toggleClass('active');
        });
        var prefilledCount = parseInt($('input[name=prefilled_count]').val());
        var totalFields = parseInt($('input[name=number_of_fields]').val());
        var onePercentCount = 100/totalFields;
        var initialPercent = parseInt(onePercentCount*prefilledCount);
        $('.active').find('.percentage').css('width',initialPercent+'%');
        try{
            var filledArray = JSON.parse($('input[name=prefilled_names]').val());
        }catch(e){
            var filledArray = [];
        }

        $('input,select,textarea').on('blur change',function(){
            if($(this).val().trim() != '' && $.inArray($(this).attr('name'),filledArray) === -1){
                filledArray.push($(this).attr('name'));
                initialPercent = initialPercent+onePercentCount;
                if(initialPercent > 100){
                    initialPercent = 100;
                }
                $('.active').find('.percentage').css('width',initialPercent+'%');
            }else if($.inArray($(this).attr('name'),filledArray) !== -1 && $(this).val().trim() == ''){                
                var tempArray = [];
                var elem = $(this);
                $.each(filledArray, function(key,value){
                    if(value != elem.attr('name')){
                        tempArray.push(value);
                    }
                });
                filledArray = tempArray;
                initialPercent = initialPercent-onePercentCount;
                $('.active').find('.percentage').css('width',initialPercent+'%');
            }
        });
        var survey_meta = $('input[name=meta_value]').val();
        var started_time = $('input[name=started_time]').val();
        var even_odd = 0;
        var timerInterval = setInterval(function(){
            $.ajax({
                type: 'GET',
                url: route()+'/timer',
                data: {data:survey_meta, start_time:started_time},
                success: function(result){
                    if(parseInt(result.days) <= 0 && parseInt(result.hours) <= 0 && parseInt(result.minutes) <= 0 && parseInt(result.seconds) <= 0){
                        clearInterval(timerInterval);
                        $('#day').text('(00 Day\'s)');
                        $('#time').text('00:00:00');
                        $('.next, .next_section').trigger('click');
                    }else{
                        if(even_odd == 0){
                            $('#day').text('('+result.days+' Day\'s)');
                            $('#time').text(result.hours+':'+result.minutes+':'+result.seconds);
                            even_odd = 1;
                        }else{
                            $('#day').text('('+result.days+' Day\'s)');
                            $('#time').text(result.hours+' '+result.minutes+' '+result.seconds);
                            even_odd = 0;
                        }
                    }
                }
            });
        },1000);

        $('.add_more').click(function(){
            var htmlForRepeat = '<div class="mb-30 persist-area single-section section-repeater">'+$(this).parent('.div-for-section').find('.single-section:first').html()+'</div>';
            var repeaterLength = $(this).parent('.div-for-section').find('.single-section').length;
            console.log(repeaterLength);
            $(this).parents('.div-for-section').find('.parent_div_for_append').append(htmlForRepeat);
            $(this).parents('.div-for-section').find('.single-section:last').find('input,select,textarea').each(function(index){
                if($(this).attr('name') != undefined){
                    $(this).attr('name',$(this).attr('name').replace(/\[[0-9]+\]/,'['+repeaterLength+']'));
                }
            });
        });
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>