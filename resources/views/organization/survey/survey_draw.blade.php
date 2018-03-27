@extends('layouts.front')
@section('content')
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
@php
    $route = route('embed.survey',['token'=>request()->token]);
@endphp
<div class="" style="max-width: 1120px;margin: 0 auto;">

    @if($error['status'] == false)
        <div class="aione-border aione-align-center border-width-3 p-50 font-size-30 grey lighten-2 mt-30" style="border-style: dashed;">
            <i class="fa fa-exclamation-triangle mr-20"></i>{{ $error['message'] }}
        </div>
    @endif

    @if($data['displayBy'] == 'section' && $error['status'] == true)
        
        @php
            $sectionIndex = (request()->section)?request()->section:0;
        @endphp
        <div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
            <div class="aione-float-left pr-15  " style="width: 360px">
                <div class="sections-wrap" style="position: fixed">
                    <!-- Survey Section -->
                    @foreach($data['sections'] as $key => $section)
                        <div class="item mb-10 {{ ($sectionIndex == $key)?'active':'' }}" onclick="window.location.href='{{ route('embed.survey',['token'=>request()->token]).'?section='.$key }}'" style="cursor: pointer;">
                            <div class="pv-15 ph-10 aione-border  bg-white " style="position:relative;">
                                <div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">
                                    {{ $section['title'] }}
                                </div>
                                <div class="font-size-13 line-height-20">
                                    {{ $section['title'] }}
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
                    @endforeach
                </div>
            </div>

            @if(isset($data['sections'][$sectionIndex]))
                {{-- {{ Session::put('record_id',null) }} --}}
                <div class="aione-float-left " style="margin-left:380px;width: calc( 100% - 360px )">
                    <div class="aione-border  bg-white mb-20">
                        <div class="aione-border-bottom p-10 light-blue darken-2 font-size-18 bg-white">
                            {{ @$data['sections'][$sectionIndex]['title'] }}
                        </div>
                        {!! Form::model(@$prefill) !!}
                            {!! Form::hidden('section',request()->section) !!}
                            @foreach($data['fields'] as $key => $fieldSlug)
                                {!! FormGenerator::GenerateField($fieldSlug, [], null, 'org') !!}
                                <div class="aione-border-top mv-10"></div>
                            @endforeach
                            {!! Form::submit('Submit',['class'=>'m-0 bg-light-blue bg-darken-3 ']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            @endif
            <div class="clear"></div>
        </div>

    @endif
    
    @if($data['displayBy'] == 'survey' && $error['status'] == true)
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
            {!! Form::model(@$prefill) !!}
            @foreach($data['sections'] as $key => $section)
                <div class="mb-30 persist-area">
                    <div class="p-10 font-size-20 light-blue darken-2 aione-border-bottom persist-header" >
                        {{ $section['section_title'] }}
                    </div>
                    <div class="p-10">
                        @foreach($section['fields'] as $field_key => $field)
                            {!! FormGenerator::GenerateField($field, [], null, 'org') !!}

                        @endforeach
                    </div>

                </div> 
            @endforeach
            <div class="bg-white p-10 aione-border-top " style="position:fixed;bottom: 0;left:0;right:0">
                {!! Form::submit('Submit',['style'=>'line-height:12px;margin-left:150px;','class'=>' m-0 bg-light-blue bg-darken-3 aione-button']) !!}
                                
            </div>
            {!! Form::close() !!}
        </div>
        
    @endif

</div>

    @if($data['displayBy'] == 'question' && $error['status'] == true)
        @php
            $sectionIndex = (request()->section)?request()->section:0;
            $questionIndex = (request()->question)?request()->question:0;
        @endphp
        <div class="screen-wrapper position-relative" style="position: relative;">
            <div class="header position-absolute aione-align-center" style="position: absolute;">
                <h3 class="white font-weight-300">Aioneframework Survey Collecter</h3>
            </div>
            <div class="survey-sidebar sections-wrap" >
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
                                    <div class="bg-light-blue bg-darken-2 percentage" style="width:50%">
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
            <div class="content p-10 l-pv-10 l-ph-100 m-pv-10 m-ph-50 position-absolute" style="position: absolute;">
                <div class="page aione-shadow p-20" style="position: relative;">
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
                            {!! FormGenerator::GenerateField($data['field_record']['field'], [], null, 'org') !!}
                            <div class="actions" style="position: absolute;bottom: 0;left: 0;
                            right: 0;padding: 0 5px;">
                                @if($data['field_record']['index'] >= 1)
                                    <button class="aione-float-left prev" {{-- onclick="window.location.href='{{ $prev }}'" --}} data-section="{{ $sectionIndex }}" data-question="{{ ($data['field_record']['index']-1) }}">Previous</button>
                                @elseif($sectionIndex != 0)
                                    {!! Form::hidden('prev_next_section',($sectionIndex-1)) !!}
                                    {!! Form::hidden('prev_next_question',$prevSectionLastQuest) !!}
                                    <button class="aione-float-left" {{-- onclick="window.location.href='{{ $prevSection.'&question='.$prevSectionLastQuest }}'" --}}>Prev Section</button>
                                @endif
                                @if($data['field_record']['index'] != $totalFields)
                                    <button class="aione-float-right next" {{-- onclick="window.location.href='{{ $next }}'" --}} data-section="{{ $sectionIndex }}" data-question="{{ ($data['field_record']['index']+1) }}">Next</button>
                                @else
                                    {!! Form::hidden('prev_next_section',$sectionIndex+1) !!}
                                    {!! Form::hidden('prev_next_question',0) !!}  {{-- $nextSection --}}
                                    <button class="aione-float-right" {{-- onclick="window.location.href='{{ $nextSection }}'" --}}>Next Section</button>
                                @endif
                                <div style="clear: both">
                                  
                                </div>
                            </div>
                        {!! Form::close() !!}
                    @endif
                    <script type="text/javascript">
                        $('.prev').click(function(e){
                            e.preventDefault();
                            var prev_next_section = $(this).data('section');
                            var prev_next_question = $(this).data('question');
                            $('.prev_next_section').val(prev_next_section);
                            $('.prev_next_question').val(prev_next_question);
                            $('#question_form').submit();
                        });
                        $('.next').click(function(e){
                            e.preventDefault();
                            var prev_next_section = $(this).data('section');
                            var prev_next_question = $(this).data('question');
                            $('.prev_next_section').val(prev_next_section);
                            $('.prev_next_question').val(prev_next_question);
                            $('#question_form').submit();
                        });
                    </script>
                 </div>
            </div>
            <div style="position: absolute;" class="footer font-size-18 aione-border-top position-absolute p-15 aione-align-center">
             &copy; All rights reserved by OXO solutions
            </div>
        </div>
    @endif

</div>

@endsection