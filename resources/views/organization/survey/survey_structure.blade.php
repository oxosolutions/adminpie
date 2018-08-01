@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Structure <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
); 
if(!empty($survey_data)){
    $repeated_slug=[];
    $sections = $survey_data['section'];
    if(!empty($sections)){
	    $section_slugs = collect($sections)->groupBy('section_slug')->toArray();

		foreach ($section_slugs as $key => $value) {
			if(count($section_slugs[$key])>1){
				 $repeated_slug[$key] = array_column($value, 'section_name','id');

			}
		}
		
	    $setting = $survey_data['forms_meta'];
	   	$settings = array_column($setting,'value','key');
	   	//unset($survey_data['section'][6]);
	  	$sections = $survey_data['section'];
	}
}
$index =1;
$warning = [];
$total_error_count = 0;
$total_warning_count = 0;
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')
@if(!empty($not_valid_id))
 			<div class="aione-message warning">
            	{{ $not_valid_id }}
        	</div>
		
    @elseif(!empty($survey_data))
		@if(empty($sections))
			 <div class="aione-message warning">
            	{{ __('survey.survey_section_miss') }}
        	</div>
   		@else

	   		<div class="ar pb-20">
	            <div class="ac s100 m50 l25">
	                <div class="aione-widget aione-border bg-grey bg-lighten-5">
	                    <div class="aione-title">
	                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Sections</h5>
	                    </div>
	                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2">{{@$data['count']['sections']}}</div>
	                </div>
	            </div>
	            <div class="ac s100 m50 l25">
	                <div class="aione-widget aione-border bg-grey bg-lighten-5">
	                    <div class="aione-title">
	                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Questions</h5>
	                    </div>
	                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2">{{@$data['count']['fields']}}</div>
	                </div>
	            </div>
	            <div class="ac s100 m50 l25">
	                <div class="aione-widget aione-border bg-grey bg-lighten-5">
	                    <div class="aione-title">
	                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Warnings</h5>
	                    </div>
	                        <div class="aione-align-center p-30 font-size-64 font-weight-600 orange darken-2 warning_count">0</div>
	                </div>
	            </div>
	            <div class="ac s100 m50 l25">
	                <div class="aione-widget aione-border bg-grey bg-lighten-5">
	                    <div class="aione-title">
	                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Errors</h5>
	                    </div>
	                    <div class="aione-align-center p-30 font-size-64 font-weight-600 red darken-2 error_count">0</div>
	                </div>
	            </div>
	        </div>

	        <div class="ar pb-20">
	            <div class="ac s100 m100 l100">
	            	<div class="aione-border">
		            	<div class="aione-title aione-border-bottom bg-grey bg-lighten-4">
							<h4 class="aione-align-left font-weight-400 m-0 pv-10 ph-15">Survey Structure</h4>
						</div>
						<div class="aione-accordion p-10">
						
		    				@if(!empty(@$sections))
			    				@foreach (@$sections as $key => $section)
			    					<div class="aione-item">
					                    <div class="aione-item-header font-size-16 font-weight-400 {{@$section['section_slug']}}">
					                        {{@$section['section_name']}}
											<span class="aione-float-right mr-40">{{count(@$section['fields'])}} Questions</span>
					                    </div>
					                    <div class="aione-item-content p-0 aione-table">
											<table class="compact font-size-14">
											    <thead>
											    	<tr>
													    <th>Questions</th> 
													    <th>Slug</th>
													    <th>Type</th>
													    <th style="min-width: 100px">Options</th>
													    <th>Conditions</th>
													    <th>Validations</th>
												    </tr>
												</thead>
									       		
										      	<tbody >
										      	@if(!empty(@$section['fields']))
										      		@foreach(@$section['fields'] as $fieldKey => $fieldVal)
										      		@php
										      			// $field_meta = array_column($fieldVal['field_meta'], 'value','key'));
										      			$field_slug[] = $fieldVal['field_slug'];
										      			$field_title[$fieldVal['field_slug']][]	= 	substr($fieldVal['field_title'], 0, 30);
										      			$field_id[$fieldVal['field_slug']][]	=   $fieldVal['id'];
										      			$sec_ids[$fieldVal['field_slug']][] 	=   $section['id'];
										      			
										      		@endphp
										      		<tr class='{{$fieldVal['field_slug']}}'>
										      			<td>{{@$fieldVal['field_title']}}</td>
										      			<td>{{@$fieldVal['field_slug']}}</td>
											      		<td>{{@$fieldVal['field_type']}}</td> 
											      		
														@php
										            		$collection = collect($fieldVal['field_meta'])->mapWithKeys(function($item){
										                		return [$item['key']=>$item['value']];
										            		});
															$meta = $collection->toArray();
									            		@endphp
									            		<td>
									            		@if(in_array($fieldVal['field_type'], ['radio','select','checkbox']))
									            			 <span class="bg-cyan white p-4 show-details">{{ @count(json_decode($meta['field_options'])) }} Options</span>
									            			 
									            			 <div class="option-details" style="min-width: 150px;max-width: 150px">
									            			 	@foreach($meta as $metaKey=> $metaVal)
									            				@if($metaKey == 'field_options' && in_array($fieldVal['field_type'], ['radio','select','checkbox'])  )
									            				@php
									            					if($metaVal==null || count(json_decode($metaVal,true)) ==0 ) {
									            						$opt_miss_error[] =[$fieldVal['field_type'],$fieldVal['field_slug']]; 
									            						if(empty($error)){
									            							$error = [];
									            						}
									            						if(!array_key_exists($section['section_slug'], $error)){
																			 			$error[$section['section_slug']][] = $section['section_name'];
																			 		}
																			 		$error[$section['section_slug']]['field'][] =['qno'=>$loop->iteration,  'title'=>$fieldVal['field_title'], 'type'=>$fieldVal['field_type'], 'option'=>'Empty options'];
									            					}
									            				@endphp
									                				@foreach(json_decode($metaVal,true) as $optKey => $optVal)
									                			
																		{{$loop->iteration}}
																			@if(!empty($optVal['key']) && !empty($optVal['value']))
																		 		{{$optVal['key']}}-{{$optVal['value']}}<br>
																		 		@else
																		 		@php
																			 		if(!array_key_exists($section['section_slug'], $warning)){
																			 			$warning[$section['section_slug']][] = $section['section_name'];
																			 		}
																			 		$warning[$section['section_slug']]['field'][] =['qno'=>$fieldVal['id'],  'title'=>$fieldVal['field_title'], 'type'=>$fieldVal['field_type'], 'option'=>'Empty option exist.'];

																		 		@endphp 
																					<span class='entry' > not key -  not val </span>
																					
																		 		@endif
									                				@endforeach
									            				@endif
									            			@endforeach 
									            			 </div>
									            		@else
		    				}
			    				
{{-- 									            		 <span class="bg-cyan white p-4">{{ @count(json_decode($meta['field_options'])) }} Options</span>
 --}}									            		  <span class="bg-blue-grey white p-4">No Options</span>
									            		@endif
								            			</td>
								            			<td>@if(!empty($meta['field_conditions']))
								            					@php
								            					 $meta_field_conditions = json_decode($meta['field_conditions'],true);
								            					if(!empty($meta_field_conditions)){
									            					foreach ($meta_field_conditions[0] as $codkey => $codvalue) {
									            						if(!empty($codvalue)){
									            							echo $codkey.':'.$codvalue.', ';
									            						}
									            					}
								            					}
								            					@endphp
								            				@endif 
								            			</td>	
								            			<td>
								            				@if(!empty($meta['field_validations']))
								            					@php
								            					$meta_validation = json_decode($meta['field_validations'],true);
								            					if(!empty($meta_validation)){
									            					foreach ($meta_validation[0] as $key => $value) {
									            						if(!empty($value)){
									            							echo $key.':'.$value.', ';
									            						}
									            					}
								            					}
								            					@endphp
								            				@endif
								            			</td>
										      		</tr>
										      		@endforeach		
							            		@endif
									      		</tbody>
											</table>
					                    </div>
					                </div>
					    		 @endforeach
					    	@endif
						</div>
					</div>
	            </div>
	        </div>
			{{-- Erorrs --}}
			<style type="text/css">
				.option-details{
					display: none;
				}
			</style>
			<script type="text/javascript">
				$(document).on('click','.show-details',function(e){
					e.preventDefault();
					console.log('hello');
					$(this).parent().find('.option-details').toggle();
				})
			</script>
			@php
				// dump($repet_field, $field_slug);
				$unique = array_unique($field_slug);
				$repeated_ques_slug = array_diff_assoc($field_slug, $unique);

				$long_slug = [];
				foreach (@$field_slug as $field_slug_key => $field_slug_value) {
					if(strlen($field_slug_value) > 62){
						$long_slug[$field_slug_key] = $field_slug_value;
					}
				}
				
				// $ids = array_map(function ($ar) {return $ar['field_slug'];}, $repet_field);
				// dump($ids);
			@endphp
			
			<div class="ar">
				<div class="ac l65">
					
	            	<div class="aione-border border-red mb-15">
		            	<div class="aione-title aione-border-bottom bg-grey bg-lighten-4">
							<h4 class="aione-align-left font-weight-400 m-0 pv-10 ph-15">Survey Structure Errors</h4>
						</div>
			    		
			    		@if(@$count_form_slug>1)
			    				<div class="p-10">
			    					<div class="aione-border bg-red bg-lighten-4 font-size-16 font-weight-400 p-10">
				                        Survey slug already in use.
										@php
											$total_error_count++;
										@endphp
					                 </div>
			    				</div>
			    					
				    		
			    		@endif
			    		@if(count($repeated_slug)> 0)
			    			<div class="aione-accordion p-10">
				    			<div class="aione-item">
			    					<div class="aione-item-header font-size-16 font-weight-400">
					                    Error Sections Slug	
					                </div>
					                <div class="aione-item-content p-0">
					                	<div class="aione-table">
					                		<table class="compact font-size-14">
						                		<thead>
						                			<tr>
						                				<th>ID</th>
						                				<th>Section</th>
						                				<th>Slug</th>
						                				<th>Action</th>
						                			</tr>
						                		</thead>
						                		<tbody>
						                			@foreach (@$repeated_slug as $seckey => $secvalue)
						                			<tr>
						                				<td>{{implode(', ', array_keys($repeated_slug[$seckey]))}}</td>
						                				<td class="truncate">
						                				@foreach($secvalue as $keyz => $valz)
																<a href="{{route('survey.sections.list',$id)}}?sections={{$keyz}}"><span class="nav-item-text"> {{$valz}} Edit</span></a> , 
						                				@endforeach
						                				</td>
						                				<td class="bg-red bg-lighten-4">{{$seckey}}</td>
						                				<td><a href="" class="goToSection" id="{{$seckey}}">Go to section</a></td>
						                			</tr>
						                			@php
														$total_error_count++;
													@endphp
						                			@endforeach
						                		</tbody>
						                	</table>	
					                	</div>
					                	
					                </div>
					                
				    			</div>
			    			</div>
			    		@endif
			    		{{-- ****** If question slug is too long ******* --}}
			    		@if(count($long_slug)> 0)
			    			<div class="aione-accordion p-10">
				    			<div class="aione-item">
			    					<div class="aione-item-header font-size-16 font-weight-400">
					                    Error Question Slug	Too Long
					                </div>
					                <div class="aione-item-content p-0">
					                	<div class="aione-table">
					                		<table class="compact font-size-14">
						                		<thead>
						                			<tr>
						                				<th>ID</th>
						                				<th>Question</th>
						                				<th>Slug</th>
						                				<th>Action</th>
						                			</tr>
						                		</thead>
						                		<tbody>
						                			@foreach (@$long_slug as $long_slug_key => $long_slug_value)
						                			<tr>
						                				<td>{{implode(', ', $field_id[$long_slug_value])}}</td>
						                				<td>
							                				@foreach($field_id[$long_slug_value] as $fieldKeys => $fieldValues)
							                					{{$field_title[$long_slug_value][$fieldKeys]}}
							                					<a href="{{route('survey.sections.list',$id)}}?sections={{$sec_ids[$long_slug_value][$fieldKeys]}}&field={{$fieldValues}}"><span class="nav-item-text">  Edit</span></a>
							                				@endforeach
							                			</td>
						                				
						                				<td class="bg-red bg-lighten-4"> {{$long_slug_value}}</td>
						                				<td><a href="" class="goToQues" id="{{$long_slug_value}}" > Go to question</a></td>
						                			</tr>
						                			@php
														$total_error_count++;
													@endphp


						                			@endforeach
						                		</tbody>
						                	</table>	
					                	</div>
					                	
					                </div>
					                
				    			</div>
			    			</div>
			    		@endif
			    		{{-- ******************** --}}
						<div class="aione-accordion p-10">

							@if(!empty(@$repeated_ques_slug))
			    				<div class="aione-item">
			    					<div class="aione-item-header font-size-16 font-weight-400">
					                    Error Questions Slug
										<span class="aione-float-right mr-40"> </span>
					                </div>
					                <div class="aione-item-content p-0">
					                	<div class="aione-table">
					                		<table class="compact font-size-14">
						                		<thead>
						                			<tr>
						                				<th>ID</th>
						                				<th>Question</th>
						                				<th>Slug</th>
						                				<th>Action</th>
						                			</tr>
						                		</thead>
						                		<tbody>
						                	
						                			@foreach (@$repeated_ques_slug as $quekey => $quevalue)
						                			<tr>
						                				<td>{{implode(', ', $field_id[$quevalue])}}</td>
						                				<td>
							                				@foreach($field_id[$quevalue] as $fieldKeys => $fieldValues)
							                				
							                					<a href="{{route('survey.sections.list',$id)}}?sections={{$sec_ids[$quevalue][$fieldKeys]}}&field={{$fieldValues}}"><span class="nav-item-text"> {{$field_title[$quevalue][$fieldKeys]}} Edit</span></a> , 
							                				@endforeach
							                			</td>
						                				
						                				<td class="bg-red bg-lighten-4"> {{$quevalue}}</td>
						                				<td><a href="" class="goToQues" id="{{$quevalue}}" > Go to question</a></td>
						                			</tr>
						                			@php
														$total_error_count++;
													@endphp


						                			@endforeach
						                		</tbody>
						                	</table>	
					                	</div>
					                	
					                </div>
				    				{{-- @foreach (@$repeated_ques_slug as $quekey => $quevalue)
									   <div class="aione-item-content p-0 aione-table">
											 {{$quevalue}} 
											 @php
												$total_error_count++;
											@endphp

										</div>
				    				@endforeach --}}
								</div>
				    		@endif
			    		

		    				@if(!empty(@$error))
			    				@foreach (@$error as $key => $value)
			    					<div class="aione-item">
					                    <div style="background-color: #F44336;" class="aione-item-header font-size-16 font-weight-400">
					                        {{@$error[$key][0]}}
											<span class="aione-float-right mr-40"> </span>
					                    </div>
					                    <div class="aione-item-content p-0 aione-table">
											<table class="compact">
											    <thead>
											    	<tr>
											    		<th>Question No</th>
													    <th>Questions</th> 
													    <th>Type</th>
													    <th>Options</th>
												    </tr>
												</thead>
										      	<tbody style="background-color: #F44336;" >
										      	@foreach(@$value['field'] as $fieldKey => $fieldVal)
										      	<tr style="background-color: #F44336;" >
										      		<td>{{$fieldVal['qno']}}</td>
										      		<td>{{$fieldVal['title']}}</td>
										      		<td>{{$fieldVal['type']}}</td>
										      		<td>{{$fieldVal['option']}}</td>
										      	</tr>
										      	@php
													$total_error_count++;
												@endphp

										      	@endforeach
										      	</tbody>
										    </table>
										</div>
									</div>
								@endforeach
							@else
								{{-- <div class="aione-message error">
            						{{ __('survey.survey_no_error') }}
        						</div> --}}
							@endif
						</div>
					</div>
						
			        <script type="text/javascript">
			        	$(".error_count").html({{$total_error_count}});
			        </script>
				 	<div class="">
		            	<div class="aione-border">
			            	<div class="aione-title aione-border-bottom bg-grey bg-lighten-4">
								<h4 class="aione-align-left font-weight-400 m-0 pv-10 ph-15">Survey Structure Warning</h4>
							</div>
							<div class="aione-accordion p-10">
							
			    				@if(!empty(@$warning))
				    				@foreach (@$warning as $key => $value)
				    					<div class="aione-item">
						                    <div class="aione-item-header font-size-16 font-weight-400">
						                        {{@$warning[$key][0]}}
												<span class="aione-float-right mr-40"> </span>
						                    </div>
						                     <div class="aione-item-content p-0 aione-table">
												<table class="compact">
												    <thead>
												    	<tr>
												    		<th>Question No</th>
														    <th>Questions</th> 
														    <th>Type</th>
														    <th>Options</th>
													    </tr>
													</thead>
											      	<tbody  >
											      	@foreach(@$value['field'] as $fieldKey => $fieldVal)
											      	<tr >
											      		<td>{{$fieldVal['qno']}}</td>
											      		<td>{{$fieldVal['title']}}</td>
											      		<td>{{$fieldVal['type']}}</td>
											      		<td>{{$fieldVal['option']}}</td>
											      	</tr>
											      	@php
											      	$total_warning_count++;
											      	@endphp

											      	@endforeach
											      	</tbody>
											     </table>
											</div>
										</div>
									@endforeach
								@else
									<div class="aione-message warning">
	            						{{ __('survey.survey_no_warning') }}
	        						</div>
								@endif
								</div>
							</div>
						
					</div>
					<script>
						$(".warning_count").html({{@$total_warning_count}});
					</script>
				</div>
				<div class="ac l35">
			    		
			    			<div class="aione-border">
				    			<div class="aione-title">
			                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 bg-grey bg-lighten-4">Survey Settings</h5>
			                    </div>
				    			<div class="aione-table p-10">
				    				@if($setting_questions != null)
					    				<table class="compact">
					    					<tbody>
					    						@foreach($setting_questions as $settingKey => $settingVal)
					                                @if($settingKey=='_token')
					                                    @continue;
					                                @endif
					                                @if(!empty($settings[$settingKey]))
					                                    <tr>
					                                        <td>{{$index++}}. {{$settingVal['field_title']}}</td>
					                                        @if($settingKey =='individual_list')
																<td>
					                                        		@foreach(json_decode($settings[$settingKey],true) as $ukey => $uval) 
					                                        			@if(!empty($user = get_user(false ,true, $uval)))
																				{{$user['name']}}, 
																			@else
																				User not exist.
					                                        			@endif
					                                        		@endforeach
					                                        	</td>
					                                        	{{-- <td>{{dump(json_decode($settings[$settingKey],true))}}</td> --}}
															@elseif($settingKey =='role_list')
															<td>
																@foreach($roles = json_decode($settings[$settingKey],true) as $rkey => $rval)
																		@if(!empty($role_name = get_role($rval)))
																			{{$role_name}}
																		@else
																			Role not exist.
																		@endif
																@endforeach
															</td>
															@else
					                                        	@if($settingVal['field_type']=='switch')
																	@if($settings[$settingKey]==1)
																		<td>Yes </td>				
																	@else
																		<td>No  </td>
																	@endif
					                                        	@else
					                                        		<td>{{$settings[$settingKey]}}</td>
					                                        	@endif
					                                        @endif
					                                    </tr>
					                                @endif
					                            @endforeach
					                            
					    					</tbody>
					    				</table>
					    			@endif
				    			</div>	
			    			</div>	
			    	
			    		
				</div>
			</div>

			
	       
			        
  
    	@endif
	  @else
	     <div class="aione-message warning">
            {{ __('survey.survey_not_exit') }}
        </div>
 @endif
	
<script>
	$(document).on('click','.goToSection', function(e){
		e.preventDefault();
		id = $(this).attr('id');
		$('html, body').animate({
		    scrollTop: ($('.'+id).offset().top)
		},500);
		$("."+id).css('background-color','yellow');
		
			setTimeout(function(){
				$("."+id).css('background-color','white');
			},6000);
	});

	$(document).on('click','.goToQues', function(e){
		e.preventDefault();
		id = $(this).attr('id');
		className = $("."+id).closest('div.aione-table').closest('div.aione-item').addClass('active');
		$("."+id).css('background-color','yellow');

		$('html, body').animate({
		    scrollTop: ($('.'+id).offset().top)
		},1500);

		setTimeout(function(){
				$("."+id).css('background-color','white');
				className = $("."+id).closest('div.aione-table').closest('div.aione-item').removeClass('active');
			},10000);

	});



	
</script>



@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection

