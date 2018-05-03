@extends('layouts.front')
@section('content')

@if(Session::get('success'))
    <section class="container">
        <div class="ar">
            <div class="ac l100">
                <div class="aione-message success">
                    <h5><i class="ion-checkmark"></i> {{ Session::get('success') }}</h5>
                </div>        
            </div>
        </div>
    </section>
@endif
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
</style>


@php
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
@endphp
<div class="" style="max-width: 1120px;margin: 0 auto;">
    @if($error['status'] == false)
        <div class="aione-border aione-align-center border-width-3 p-50 font-size-30 grey lighten-2 mt-30" style="border-style: dashed;">
            <i class="fa fa-exclamation-triangle mr-20"></i>{{ $error['message'] }}
        </div>
        @if($error['type'] == 'auth')
        <div class="aione-align-center">
            <a href="{{route('org.login')}}?backto={{request()->url()}}" class="aione-button custom-effect bg-blue-grey bg-darken-4 white">Login Now</a>
        </div>
            
        @endif
    @endif


    <div id="aione_form_wrapper_{{$survey_model->id}}" class="aione-form-wrapper aione-form-theme-{{@$survey_form_settings->form_theme}} aione-form-label-position-{{@$survey_form_settings->form_label_position}} aione-form-style-{{@$survey_form_settings->form_style}} {{@$aione_form_border}} {{@$aione_form_field_border}} {{@$aione_form_section_border}}">
        <div class="aione-row">
            {{-- All Form Header Settings --}}
            @if( (@$survey_form_settings->form_show_title && !empty($form_title)) || (@$survey_form_settings->form_show_description && !empty($survey_model->form_description)))
                <div id="aione_form_header" class="aione-form-header">
                    <div class="aione-row">
                        @if(@$survey_form_settings->form_show_title && !empty($survey_model->form_title))
                            <h1 class="aione-form-title aione-align-{{@$survey_form_settings->form_title_align}}">{{$survey_model->form_title}}</h1>
                        @endif
                        @if(@$survey_form_settings->form_show_description && !empty($survey_model->form_description))
                            <h2 class="aione-form-description aione-align-{{@$survey_form_settings->form_description_align}}">{{$survey_model->form_description}}</h2>
                        @endif
                    </div> <!-- .aione-row -->
                </div> <!-- .aione-form-header -->
            @endif
            {{-- Settings End here --}}


            {{-- If Survey by Section --}}
            @if($data['displayBy'] == 'section' && $error['status'] == true)
                
                @php
                    $sectionIndex = (request()->section)?request()->section:0;
                @endphp
                <div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
                    <div class="aione-float-left pr-15  " style="width: 360px">
                        <div class="sections-wrap">
                            <!-- Survey Section -->
                            @foreach($data['sections'] as $key => $section)
                                @php
                                    $completedSections = session()->get('completed_sections');
                                    if($completedSections != null && in_array($key,$completedSections)){
                                        $progressPercentage = 100;
                                        $completedClass = 'completed';
                                    }else{
                                        $progressPercentage = 0;
                                        $completedClass = '';
                                    }
                                @endphp
                                <div class="item mb-10 {{ ($sectionIndex == $key)?'active':'' }} {{$completedClass}}" onclick="window.location.href='{{ route('embed.survey',['token'=>request()->token]).'?section='.$key }}'" style="cursor: pointer;">
                                    <div class="pv-15 pl-16 pr-10 aione-border  bg-white " style="position:relative;">
                                        <div class="font-size-20 light-blue darken-2 font-weight-600 truncate " >
                                            {{ $section['title'] }}
                                        </div>
                                        <div class="font-size-13 line-height-20">
                                            {{ $section['title'] }}
                                        </div>
                                        <div class="indicater-wrapper" >
                                            <div class="bg-light-blue bg-lighten-4 indicater">

                                                <div class="bg-light-blue bg-darken-2 percentage {{$completedClass}}" style="width:{{$progressPercentage}}%">
                                                </div>
                                                <div class="grey aione-align-center line-height-15 percentage-text">
                                                    30% completed
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if(isset($data['sections'][$sectionIndex]))
                        {{-- {{ Session::put('record_id',null) }} --}}
                        <div class="aione-float-left " style="width: calc( 100% - 360px )">
                            <div class="aione-border  bg-white mb-20">
                                <div class="aione-border-bottom pv-20 ph-30 light-blue darken-2 font-size-18 bg-white">
                                    {{ @$data['sections'][$sectionIndex]['title'] }}
                                </div>
                                {!! Form::model(@$prefill) !!}
                                    {!! Form::hidden('section',request()->section) !!}
                                    {!! Form::hidden('number_of_fields',count($data['fields'])) !!}
                                    @php
                                        $preFillCount = 0;
                                        $prefilledSlug = [];
                                        $OptionsArray = [];
                                        $OptionsArray['form_id'] = $data['form_id'];
                                        $OptionsArray['from'] = @$data['sections'][$sectionIndex]['section_type'];
                                        $OptionsArray['loop_index'] = 0;
                                    @endphp
                                    <div class="div-for-section">
                                        <div class="parent_div_for_append">
                                            <div class="mb-30 persist-area single-section">
                                                @foreach($data['fields'] as $key => $fieldSlug)
                                                    {!! FormGenerator::GenerateField($fieldSlug, $OptionsArray, null, 'org') !!}
                                                 
                                                    @php
                                                        if(@$prefill[$fieldSlug] != null){
                                                            $prefilledSlug[] = $fieldSlug;
                                                            $preFillCount++;
                                                        }
                                                    @endphp
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                        @if(@$data['sections'][$sectionIndex]['section_type'] == 'repeater')
                                            <input type="button" class="aione-button add_more" value="Add More" />
                                        @endif
                                    </div>
                                    {!! Form::hidden('prefilled_count',$preFillCount) !!}
                                    {!! Form::hidden('prefilled_names',json_encode($prefilledSlug)) !!}
                                    {!! Form::submit('Submit',['class'=>'m-0 bg-light-blue bg-darken-3 ']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endif
                    <div class="clear"></div>
                </div>

            @endif
            {{-- Endif Survey by section --}}


            {{-- If Survey by survey (full form) --}}
            @if($data['displayBy'] == 'survey' && $error['status'] == true)
                <div class="m-20 aione-border p-15 bg-white surveyDiv" style="position: relative;">
                    {!! Form::model(@$prefill) !!}
                    @foreach($data['sections'] as $key => $section)
                        @php
                            $OptionsArray = [];
                            $OptionsArray['form_id'] = $data['form_id'];
                            $OptionsArray['from'] = $section['section_type'];
                            $OptionsArray['loop_index'] = 0;
                        @endphp
                        <div class="div-for-section">
                            <div class="parent_div_for_append">
                                <div class="mb-30 persist-area single-section">
                                    <div class="p-10 font-size-20 light-blue darken-2 aione-border-bottom persist-header" >
                                        {{ $section['section_title'] }}
                                    </div>
                                    <div class="p-10 ar">
                                        @foreach($section['fields'] as $field_key => $field)
                                            {!! FormGenerator::GenerateField($field, $OptionsArray, null, 'org') !!}
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            @if($section['section_type'] == 'repeater')
                                <input type="button" class="aione-button add_more" value="Add More" />
                            @endif
                        </div>
                    @endforeach
                    <div class="bg-white p-10 aione-border-top " style="">
                        {!! Form::submit('Submit',['style'=>'','class'=>' m-0 bg-light-blue bg-darken-3 aione-button']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            @endif
           {{-- Endif Survey by survey (full form) --}}


            {{-- If Survey by question --}}
            @if($data['displayBy'] == 'question' && $error['status'] == true)
                @php
                    $sectionIndex = (request()->section)?request()->section:0;
                    $questionIndex = (request()->question)?request()->question:0;
                @endphp
                <div class="ar">
                    <div class="ac l25" >
                        @foreach($data['sections'] as $key => $section)
                            <div class="item mb-10 {{ ($sectionIndex == $key)?'active':'' }}" onclick="" style="cursor: pointer;">
                                <div class="pv-15 ph-10 aione-border  bg-white " style="position:relative;">
                                    <div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">
                                        {{ $section['title'] }}
                                    </div>
                                    <div class="font-size-13 line-height-20">
                                        {{ $section['description'] }}
                                    </div>
                                    <div class="indicater-wrapper" >
                                        <div class="bg-light-blue bg-lighten-4 indicater">
                                            @php
                                                $onePercent = 100/count($data['fields']);
                                                if($sectionIndex == $key){
                                                    $percent = ($data['field_record']['index'])*$onePercent;
                                                }else{
                                                    $percent = 0;
                                                }
                                            @endphp
                                            <div class="bg-light-blue bg-darken-2 percentage" style="width:{{ $percent }}%">
                                            </div>
                                            <div class="grey aione-align-center line-height-15 percentage-text">
                                                30% completed
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="ac l75 bg-white">
                        <div>
                            @if(isset($data['field_record']['field']))
                                @php
                                    $prev = $route.'?section='.$sectionIndex.'&question='.($data['field_record']['index']-1);
                                    $next = $route.'?section='.$sectionIndex.'&question='.($data['field_record']['index']+1);
                                    $totalFields = count($data['fields']) - 1;
                                    $nextSection = $route.'?section='.($sectionIndex+1);
                                    $prevSection = $route.'?section='.($sectionIndex-1);
                                    if($sectionIndex != 0){
                                        $prevSectionLastQuest  = count($data['sections'][$sectionIndex-1]['fields'])-1;
                                    }
                                @endphp
                                {!! Form::model(@$prefill,['route'=>['embed.survey',request()->token,'section='.$sectionIndex,'question='.$questionIndex],'id'=>'question_form']) !!}
                                    {!! Form::hidden('prev_next_section',null,['class'=>'prev_next_section']) !!}
                                    {!! Form::hidden('prev_next_question',null,['class'=>'prev_next_question']) !!}
                                    @if(@$data['sections'][$sectionIndex]['section_type'] == 'repeater')
                                        <div class="div-for-section">
                                            <div class="parent_div_for_append">
                                                <div class="mb-30 persist-area single-section">
                                                    @php
                                                        $OptionsArray = [];
                                                        $OptionsArray['form_id'] = $data['form_id'];
                                                        $OptionsArray['from'] = $data['sections'][$sectionIndex]['section_type'];
                                                        $OptionsArray['loop_index'] = 0;
                                                    @endphp
                                                    @foreach($data['sections'][$sectionIndex]['fields'] as $key => $fieldSlug)
                                                        {!! FormGenerator::GenerateField($fieldSlug, $OptionsArray, null, 'org') !!}
                                                    @endforeach
                                                    <hr/>
                                                </div>
                                            </div>
                                            <input type="button" class="aione-button add_more" value="Add More" />
                                        </div>
                                    @else
                                        {!! FormGenerator::GenerateField($data['field_record']['field'], ['form_id'=>$data['form_id']], null, 'org') !!}
                                    @endif
                                    <div class="actions" >
                                        @if(@$data['sections'][$sectionIndex]['section_type'] == 'repeater')
                                            <button class=" next_section" data-section="{{ ($sectionIndex+1) }}" data-question="0">Next Section</button>
                                        @else
                                            @if($data['field_record']['index'] >= 1)
                                                <button class="aione-float-left prev" data-section="{{ $sectionIndex }}" data-question="{{ ($data['field_record']['index']-1) }}">Previous</button>
                                            @elseif($sectionIndex != 0)
                                                <button class="aione-float-left prev_section" data-section="{{ ($sectionIndex-1) }}" data-question="{{ $prevSectionLastQuest }}">Prev Section</button>
                                            @endif
                                            @if($data['field_record']['index'] != $totalFields)
                                                <button class="aione-float-right next" data-section="{{ $sectionIndex }}" data-question="{{ ($data['field_record']['index']+1) }}">Next</button>
                                            @else
                                                <button class=" next_section" data-section="{{ ($sectionIndex+1) }}" data-question="0">Next Section</button>
                                            @endif
                                        @endif
                                        <div style="clear: both">
                                          
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            @endif
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
            @endif
            {{-- Endif Survey by question --}}

        </div>
    </div>
</div>
<script type="text/javascript">
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
@endsection