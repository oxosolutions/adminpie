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
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.indicater-wrapper').click(function(){
			$(this).toggleClass('active');
		})
	})
</script>
<div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
    @include('organization.survey.survey_draw.messages')
    @if(!empty($survey) && empty($error))
    	@include('organization.survey.survey_draw.sidebar')
    	<div class="aione-float-left aione-border" style="width: calc( 100% - 360px )">
    		@if(!empty($current_data))
    			{!! Form::model($current_data,['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post'])!!}
    		@else
                {!! Form::open(['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post'])!!}
    		@endif
        		<input type="hidden" name="form_id" value="{{$form_id}}" >
    			<input type="hidden" name="ip_address" value="{{Request::ip()}}" >
    			<input type="hidden" name="survey_submitted_from" value="web" >
        		@php
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
        		@endphp
    			@if(Session::has('field'.$form_id))
        			@if(Session::has('wild_field'.$form_id))
                    <script type="text/javascript">
                        $(".codition-{{Session::get('wild_field'.$form_id)['field_id'.$form_id]}}").show(); 
                    </script>
        			<input id="field_id" type="hidden" name="field_id" value="{{Session::get('wild_field'.$form_id)['field_id'.$form_id]}}" >
        			{!! FormGenerator::GenerateField(Session::get('wild_field'.$form_id)['field_slug'.$form_id],[],'','org') !!}
                   
        			@else
        				<input id="field_id" type="hidden" name="field_id" value="{{$get_field_id}}" >
        				{!! FormGenerator::GenerateField($fields[$get_field_id],[],'','org') !!}

                    @endif

                     <div class="font-size-16 line-height-26">
                            <a href="{{route('set.survey',['form_id'=>$form_id ,'id'=>$next_fields_id, 'slug'=>$filter_field[$next_fields_id], 'type'=>'field' ]) }}">Next</a>
                    </div>

                        <script type="text/javascript"> $("#field_682").show();</script>
    			@elseif(Session::has('section'.$form_id))
    				<div class="sec">
    					@if(Session::has('wild_section'.$form_id))
 						<input id="sec_id"  type="hidden" name="section_id" value="{{Session::get('wild_section'.$form_id)['section_id'.$form_id]}}" >
    					   {!! FormGenerator::GenerateSection(Session::get('wild_section'.$form_id)['section_slug'.$form_id], [],'','org') !!}
    					@else
    						{{$section_id}}
    						<input id="sec_id"  type="hidden" name="section_id" value="{{$section_id}}" >
    					   {!! FormGenerator::GenerateSection($section_slug, $current_data,'','org') !!}
    					@endif
    				</div>
    			@else					
    				{!! FormGenerator::GenerateForm($survey_slug,[],'','org') !!}
    				<input type="hidden" name="survey_status" value="completed" >
    			@endif
        		{{-- <input type="hidden" name="form_slug" value="{{$slug}}" > --}}
    			<input type="submit" value="{{@$survey_setting['form_save_button_text']}}">
    		{!! Form::close() !!}
    	</div>
    @endif
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
@endsection