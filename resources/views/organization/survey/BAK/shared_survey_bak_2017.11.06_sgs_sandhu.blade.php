@extends('layouts.front')
@section('sidebar')
<ul class="collapsible" data-collapsible="accordion">
	@foreach($survey['section'] as $surveyVal)
	    <li>
	      <div class="collapsible-header">{{$surveyVal['section_name']}}</div>
	      @if(!empty($surveyVal['fields']))
	      	@foreach($surveyVal['fields'] as $fields)
				@php
					$slug = str_replace('-', '_', $fields['field_slug']);
				@endphp
				@if(!empty($current_data))
					@if(array_key_exists($slug , array_filter($current_data)))
	      				<div class="collapsible-body  fill_{{$slug}}" style="background-color: rgba(0, 128, 0, 0.2);"  ><span>{{$fields['field_slug']}}</span></div>
	      			@else
	      				 <div class="collapsible-body"><span>{{$fields['field_slug']}}</span></div>
	      			@endif
				@else
					 <div class="collapsible-body"><span>{{$fields['field_slug']}}</span></div>	
	      		@endif

	      	@endforeach
	      @endif
	    </li>
	@endforeach
</ul>
@endsection
@section('content')
@php
	$page_title_data = array(
			'show_page_title' => 'yes',
			'show_add_new_button' => 'no',
			'show_navigation' => 'yes',
			'page_title' => 'View Survey',
			'add_new' => '+ Add Feedback'
		);
@endphp
<style>
.aione-progress-bg {
	background: rgba(255,0,0,0.1);
	min-height: 4px;
}
.aione-progress-inside {
	width: 1%;
	height: 5px;
	background: #22adba;
	background: rgba(0,128,0,0.9);;
	background-size: 10% 100%, 100% 100%;
}

</style>
{{-- @include('common.pageheader',$page_title_data)  --}}
	@if(Session::has('sucess'))
		<div class="aione-message success">
			<ul class="aione-messages aione-align-center">
				<li class="aione-align-center">{{Session::get('sucess')}}</li>
			</ul>
		</div>
	@endif

		@if(isset($survey_setting['survey_timer'])  && ($survey_setting['survey_timer']==true))
			@if(isset($survey_setting['timer_type']) && ($survey_setting['timer_type']=="survey_expiry_time"))
				<h3>  {{$survey_setting['survey_time_lefts']}} Survey Expired</h3>
		 	@endif
		@endif
		@if(!empty($error))
				@if(is_array($error))
					<div class="aione-message error">
					    <ul class="aione-messages">
					        <li>{{implode($error)}} </li>
					    </ul>
					</div>
				@else
					<div class="aione-message error">
					    <ul class="aione-messages">
					        <li>{{$error}} </li>
					    </ul>
					</div>
				@endif
		@else
		<div>
			@if(!empty($survey))
			<div class="na" style="display: inline-block; width:300px; float: left; border:1px solid grey;">
			<ul>
				@foreach($survey['section'] as $surveyVal)
					<li>{{$surveyVal['section_name']}}</li>
					@if(!empty($surveyVal['fields']))
					<ul style="margin-left: 20px">
					
						@foreach($surveyVal['fields'] as $fields)
						@php
								$slug = str_replace('-', '_', $fields['field_slug']);

						@endphp
							@if(!empty($current_data))
								@if(array_key_exists($slug , array_filter($current_data)))
									<li style="background-color: rgba(0, 128, 0, 0.2);" class="fill_{{$slug}}">{{$fields['field_title']}} {{$slug}}</li>
									<li style="background-color: rgba(0, 128, 0, 0.2);"  class="ans_{{$slug}}"> 
											Answer: {{$current_data[$slug]}}
									</li>
								@else
									<li  class="fill_{{$fields['field_slug']}}"> {{$fields['field_title']}} {{$fields['field_slug']}}</li>
									<li class="ans_{{$fields['field_slug']}}"> 
											Answer: Not filled yet.
									</li>
								@endif
							@else
								<li  class="fill_{{$fields['field_slug']}}"> {{substr($fields['field_title'], 0,40)}} </li>
									<li class="ans_{{$fields['field_slug']}}"> 
											Answer: Not filled yet.
									</li>

							@endif
						@endforeach
					</ul>
					@endif

				@endforeach
			</ul>
			</div> 
			@endif

		</div>

			<div class="aione-progress-bar">
				<div class="aione-progress-bg">
					<div class="aione-progress-inside" >

					</div>
				</div>
			</div>
			<input id="viewType" type="hidden" name="type" value="survey">
				{!! Form::model($slug,['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post'])!!}
					<input type="hidden" name="form_id" value="{{$form_id}}" >
					<input type="hidden" name="ip_address" value="{{Request::ip()}}" >
					<input type="hidden" name="survey_submitted_from" value="web" >

					@php

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
					@endphp
					<div style="display: inline-block; width: 900px; float: right; border:1px solid grey;">
						<div class="survey-forms">
							@if(Session::has('field'))
								<input type="hidden" name="field_id" value="{{$first_field_key}}" >

								{!! FormGenerator::GenerateField($fields[$first_field_key]['field_slug'],[],'','org') !!}
							
							@elseif(Session::has('section'))
								<input type="hidden" name="section_id" value="{{$section_id}}" >
								{!! FormGenerator::GenerateSection($section_slug,[],'','org') !!}
							@else					
								{!! FormGenerator::GenerateForm($survey_slug,[],'','org') !!}
								<input type="hidden" name="survey_status" value="completed" >

							@endif
						</div>
						<input type="hidden" name="form_slug" value="{{$slug}}" >
						<input type="submit" value="{{@$survey_setting['form_save_button_text']}}">
					{!! Form::close() !!}
				</div>
		@endif
		<div id="append">
			
		</div>
		<script>
$(document).ready(function(){
	$('input:checkbox').each(function(){
		name = $(this).attr('name');
		newone =  name.replace('[]', '');
		$(this).addClass(newone);
	});

		// viewType = $("#viewType").val();
		// var nameArray = {};
		// var maxIndex =0;
		// 	$('.survey-form input , select, textarea').each(function(index){
		// 		name = $.trim($(this).attr('class'));
		// 		// console.log(name);
		// 		type = $.trim($(this).attr('type'));
		// 		if(name =='_token'|| name =='survey_started_on'|| name =='survey_id'|| name =='code'|| name=='button')
		// 		{}
		// 		else{
		// 				if(name){
		// 					nameArray[name] = name;
		// 				}
		// 			}
		// 		maxIndex = index;
		// 	});
		// 	// total = nameArray.length;
		// 	// alert(maxIndex);
		// 	console.log(nameArray);
			$('.survey-form').on('change','select',function(){
				slug = $(this).attr('name');
				$(".fill_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
				$(".ans_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
				ansVal = $(this).val();
				$(".ans_"+slug).html('Answer:'+ansVal);

			});
			// $('.survey-form').on('change','select',function(){
			// 	slug = $(this).attr('name');
			// 	$(".fill_"+slug).css({'background':'rgba(0, 128, 0, 0.2)'});
			// 	ansVal = $(this).val();
			// 	$(".ans_"+slug).html('Answer:'+ansVal);

			// });
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

			// $('#survey-form :checkbox').change(function() {
			//     // this will contain a reference to the checkbox   
			//     if (this.checked) {
			//     	alert(1213);
			//     	// val = $(this).val();
			//     	// alert(val);
			//         // the checkbox is now checked 
			//     } else {
			//         // the checkbox is now no longer checked
			//     }
			// });

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



				// $.each(nameArray, function( index, value ) {
				// 	type = $("."+value).attr('type');
				// 	if(type =="radio" )
				// 	{
				// 		val = $("."+value+":checked").val();
				// 	}else if(type =="checkbox"){
				// 		val  = $.trim($("."+value).val());
				// 		alert('checkbox');
				// 		// val = $("."+value+":checked").val();
				// 		// alert(val);
						

				// 	}else{
				// 		val  = $.trim($("."+value).val());
				// 	//console.log(val);
				// 	}
				// 	if(val)
				// 	{
				// 		console.log(value);
				// 		// mark = $("#mark_"+value).html('<b style="color:Green;">Filled</b>');
				// 		mark = $("#mark_"+value).parent().css({'background':'rgba(0, 128, 0, 0.2)'});
				// 		console.log(mark);
				// 			countQues++;	
				// 	}else{
				// 		$("#mark_"+value).parent().css({'background':'rgba(255, 0, 0, 0.2)'});
				// 		// $("#mark_"+value).html('<b style="color:red;">Pending</b>');
				// 	}
				// });
				// 	percentage = countQues/maxIndex*100;

				// $("#sum_filled_ques").html(countQues);
				// $("#progress").val(countQues);
				// $('.aione-progress-inside').css({'width':percentage+'%'});
				// $( window ).bind("resize", function(){
				//     $(".aione-progress-inside").width( 600 );
				// });

			});


	
});

		</script>
		{{-- @endif --}}

	{{-- @include('common.page_content_primary_end') --}}
	{{-- @include('common.page_content_secondry_start') --}}
		{{-- <script type="text/javascript">
			$('.hide-field').parents('.field-wrapper').hide();
			
			$('.show-suboptions').click(function() {
			    if( $(this).is(':checked')) {
			        $(this).parents('.field-wrapper').next().show();
			    } else {
			        $(this).parents('.field-wrapper').next().hide();
			    }

			}); 

			$('.radio-show-hide').change(function(){
				if($(this).val() == 'role_based'){
					$('.role_list').parents('.field-wrapper').show();
					$('.individual_list').parents('.field-wrapper').hide();

				}
				if($(this).val() == 'individual_based'){
					$('.individual_list').parents('.field-wrapper').show();
					$('.role_list').parents('.field-wrapper').hide();
				}
				
			})
		</script> --}}
	{{-- @include('common.page_content_secondry_end') --}}
{{-- @include('common.pagecontentend') --}}
@endsection