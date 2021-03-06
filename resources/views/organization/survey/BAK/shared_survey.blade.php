@extends('layouts.front')
@section('sidebar')
{{-- <ul class="collapsible" data-collapsible="accordion">
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
</ul> --}}
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
{{-- <div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
	<div class="aione-float-left pr-10	" style="width: 360px">
	
		<div>
		
			<div class="pv-15 ph-10 aione-border mb-10 bg-white " style="position:relative;box-shadow: 0 0 3px rgba(0,0,0,.3)">
				<div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">Basic detail section for personal information</div>
				<div class="font-size-13 line-height-20">24 Question</div>
				<div class="indicater-wrapper" >
					
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width:0%">
							
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">30% completed</div>
					</div>
				</div>
				
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;box-shadow: 0 0 3px rgba(0,0,0,.3)">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;box-shadow: 0 0 3px rgba(0,0,0,.3)">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;box-shadow: 0 0 3px rgba(0,0,0,.3)">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;box-shadow: 0 0 3px rgba(0,0,0,.3)">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;box-shadow: 0 0 3px rgba(0,0,0,.3)">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-light-blue bg-darken-2" style="position:relative;box-shadow: 0 0 3px rgba(0,0,0,.3)">
				<div class="font-size-20 white font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20 white">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="aione-float-left " style="width: calc( 100% - 360px )">
		<div class="  bg-white">
			<div id="aione_form_wrapper_1" class="aione-form-wrapper aione-form-theme- aione-form-label-position- aione-form-style- aione-form-border  aione-form-section-border">
	<div class="aione-row">
				<div id="aione_form_content" class="aione-form-content">
			<div class="aione-row aione-">
							
								<div id="aione_form_section_1" class="aione-form-section non-repeater">
	<div class="aione-row">
	
				<div id="aione_form_section_header" class="aione-form-section-header">
			<div class="aione-row">
									<h3 class="aione-form-section-title aione-align-left">Basic Details</h3>
								
							</div> <!-- .aione-row -->
		</div> <!-- .aione-form-header -->
				<div id="aione_form_section_content" class="aione-form-section-content">
			<div class="aione-row ar">

													<div id="field_1" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
						<div id="field_label_name" class="field-label">

				<label for="input_name">
											<h4 class="field-title" id="Name">Name</h4>
														</label>

			</div><!-- field label-->
				

	<div id="field_name" class="field field-type-text">
	
					<input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text"> 


							</div><!-- field -->
            
</div><!-- field wrapper -->
													<div id="field_2" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-email field-wrapper-type-text ">
						<div id="field_label_email" class="field-label">

				<label for="input_email">
											<h4 class="field-title" id="Email">Email</h4>
														</label>

			</div><!-- field label-->
				

	<div id="field_email" class="field field-type-text">
	
					<input class="input-email" id="input_email" placeholder="" data-validation="" name="email" type="text"> 


							</div><!-- field -->
            
</div><!-- field wrapper -->
													<div id="field_3" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-age field-wrapper-type-text ">
						<div id="field_label_age" class="field-label">

				<label for="input_age">
											<h4 class="field-title" id="Age">Age</h4>
														</label>

			</div><!-- field label-->
				

	<div id="field_age" class="field field-type-text">
	
					<input class="input-age" id="input_age" placeholder="" data-validation="" name="age" type="text"> 


							</div><!-- field -->
            
</div><!-- field wrapper -->
			
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

	</div> <!-- .aione-row -->
</div> <!-- .aione-form-section -->

							
								<div id="aione_form_section_2" class="aione-form-section non-repeater">
	<div class="aione-row">
	
				<div id="aione_form_section_header" class="aione-form-section-header">
			<div class="aione-row">
									<h3 class="aione-form-section-title aione-align-left">Enquery questions</h3>
								
							</div> <!-- .aione-row -->
		</div> <!-- .aione-form-header -->
				<div id="aione_form_section_content" class="aione-form-section-content">
			<div class="aione-row ar">

													<div id="field_4" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-rate-us field-wrapper-type-text ">
						<div id="field_label_rate-us" class="field-label">

				<label for="input_rate-us">
											<h4 class="field-title" id="Rate us (0 stands for low satisfaction and 5 stands for high satisfaction)">Rate us (0 stands for low satisfaction and 5 stands for high satisfaction)</h4>
														</label>

			</div><!-- field label-->
				

	<div id="field_rate-us" class="field field-type-text">
	
					<input class="input-rate-us" id="input_rate-us" placeholder="" data-validation=" " name="rate-us" type="text"> 


							</div><!-- field -->
            
</div><!-- field wrapper -->
			
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

	</div> <!-- .aione-row -->
</div> <!-- .aione-form-section -->

			
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

				<div id="aione_form_footer" class="aione-form-footer">
			<div class="aione-row">
			
							<input type="submit" class="aione-button" value="Submit">
										
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-footer -->
		
	<textarea class="form_conditions" id="form_1" style="display: none;">{"4":{"field_slug":"rate-us","field_id":4,"field_title":"Rate us (0 stands for low satisfaction and 5 stands for high satisfaction)","field_conditions":[]}}</textarea>
	</div> <!-- .aione-row -->
</div>
		</div>
	</div>
	<div class="clear">
		
	</div>
</div> --}}
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
				@if(!empty($error['survey_authorization_required']))
{{--login button--}}		<a href="{{route('org.login')}}"> Login </a>
				@endif

{{--1--}}@else 
		<div>
			@if(!empty($survey))
			<div class="na" style="display: inline-block; width:300px; float: left; border:1px solid grey;">
			<ul>

				@foreach($survey['section'] as $surveyVal)

				@if(Session::has('section'))
					<li>  <a href="{{route('set.survey',['id'=>$surveyVal['id'], 'slug'=>$surveyVal['section_slug'], 'type'=>'section' ]) }}">  {{$surveyVal['section_name']}} </a></li>
				@else
					<li>    {{$surveyVal['section_name']}} </li>
				@endif
					@if(!empty($surveyVal['fields']))
					<ul style="margin-left: 20px">
					
						@foreach($surveyVal['fields'] as $fields)
						@php
								$slug = str_replace('-', '_', $fields['field_slug']);
						@endphp
							@if(!empty($current_data))
								@if(array_key_exists($slug , array_filter($current_data)))
									<li style="background-color: rgba(0, 128, 0, 0.2);" class="fill_{{$slug}}">
								<a href="{{route('set.survey',['id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ]) }}">
									{{$fields['field_title']}} 
								</a>
								</li>
									<li style="background-color: rgba(0, 128, 0, 0.2);"  class="ans_{{$slug}}"> 
											Answer: {{$current_data[$slug]}}
									</li>
								@else
									<li  class="fill_{{$fields['field_slug']}}"> 
										<a href="{{route('set.survey',['id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ]) }}">
											{{$fields['field_title']}} 
										</a>

									</li>
									<li class="ans_{{$fields['field_slug']}}"> 
											Answer: Not filled yet.
									</li>
								@endif
							@else
								<li  class="fill_{{$fields['field_slug']}}">
									<a href="{{route('set.survey',['id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ]) }}"> {{substr($fields['field_title'], 0,40)}} 
									</a> 
								</li>
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
			{{dump($slug)}}
				{!! Form::model($slug,['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post'])!!}
					<input type="hidden" name="form_id" value="{{$form_id}}" >
					<input type="hidden" name="ip_address" value="{{Request::ip()}}" >
					<input type="hidden" name="survey_submitted_from" value="web" >
					@php
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

					@endphp
					<div style="display: inline-block; width: 900px; float: right; border:1px solid grey;">
						<div class="survey-forms">
							@if(Session::has('field'))
								<input type="hidden" name="field_id" value="{{$get_field_id}}" >
								@if(!empty($current_data))
								{{-- {{dd($current_data)}} --}}
								{!! FormGenerator::GenerateField($fields[$get_field_id],$current_data,'','org') !!}

								@else
								{!! FormGenerator::GenerateField($fields[$get_field_id],[],'','org') !!}

								@endif

							@elseif(Session::has('section'))
								<input type="hidden" name="section_id" value="{{$section_id}}" >
								{!! FormGenerator::GenerateSection($section_slug,[],'','org') !!}
							@else					
								{!! FormGenerator::GenerateForm($survey_slug,[],'','org') !!}
								<input type="hidden" name="survey_status" value="completed" >
							@endif
						</div>
						{{dump($slug)}}
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
@endsection