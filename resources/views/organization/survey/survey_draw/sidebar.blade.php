@php

use App\Http\Controllers\Organization\survey\SurveyController;
	$all = Session::get('all'.$form_id);
	// dd($all);
@endphp

<div class="aione-float-left pr-15	" style="width: 360px">
	<div>
		@foreach($survey['section'] as $surveyVal)
		@php
			$index = 0;
		@endphp
			
			<div class="pv-15 ph-10 aione-border mb-10 bg-white " style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">
				@if(Session::has('field'.$form_id))
				{{$surveyVal['section_name']}}
				@else
					<a href="{{route('set.survey',['form_id'=>$form_id ,  'id'=>$surveyVal['id'], 'slug'=>$surveyVal['section_slug'], 'type'=>'section' ]) }}">{{$surveyVal['section_name']}} </a>
				@endif

				</div>
				
				@if(Session::has('field'.$form_id) && !empty($surveyVal['fields']))
					@foreach($surveyVal['fields'] as $fields)
						@php 
						//dump($fields);
							$result = SurveyController::check_field_conditions($fields['id']);
							$slug 	= str_replace('-', '_', $fields['field_slug']);
						@endphp
					@if(empty($result))	
					@php
						$index++;
					@endphp
						<div class="aione-border">
							<div class="aione-border-bottom p-10">
								<div class="font-size-16 line-height-26">
									<a href="{{route('set.survey',['form_id'=>$form_id ,'id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ]) }}">{{$fields['field_title']}}</a>
								</div>
								<div class="grey font-size-13">
									{{$fields['field_description']}}
								</div>
							</div>
						</div>
					@else
					{{-- {{dd($result)}} --}}
						<div class="aione-border codition-{{$fields['id']}} display-none">
							<div class="aione-border-bottom p-10">
								<div class="font-size-16 line-height-26">
									<a href="{{route('set.survey',['form_id'=>$form_id ,'id'=>$fields['id'], 'slug'=>$fields['field_slug'], 'type'=>'field' ]) }}">{{$fields['field_title']}}</a>
								</div>
								<div class="grey font-size-13">
									{{$fields['field_description']}}
								</div>
							</div>
						</div>
					@endif
					@endforeach
				@endif
				@php
				// $total_field = count($surveyVal['fields'])
					if(!empty($all)){
						//dump($all[$surveyVal['id']]);
						$filled_count = count(array_filter($all[$surveyVal['id']]));
					}else{
						$filled_count = 0;
					}
					$percentage =0;
					if($index>0){
				 		$percentage = $filled_count/$index*100;
 					}
				
			@endphp
				<div class="font-size-13 line-height-20"><span id="{{$surveyVal['id']}}" >{{$filled_count}}</span>/ <span id="sec_que_count_{{$surveyVal['id']}}">  {{$index}} </span> Question</div>
				<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="progress_bar_{{$surveyVal['id']}} bg-light-blue bg-darken-2 percentage" style="width:{{$percentage}}%">
							
							
						</div>
						<div class="progress_val_{{$surveyVal['id']}} grey aione-align-center line-height-15 percentage-text">0% completed {{$percentage}}</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	</div>