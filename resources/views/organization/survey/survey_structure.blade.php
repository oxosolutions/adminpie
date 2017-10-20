@extends('layouts.main')
@section('content')
<style type="text/css">
    .aione-row > .left-75{
        width: 70%;
        float: left;
        padding-right: 10px
    }
    .aione-row > .right-25{
        width: 30%;
        float: right;
    }
    .aione-row.theme-1 > .card-4{
        width: 25%;
        float: left;
        padding: 30px 0px;
        text-align: center;
    }
    .aione-row > .card-4 > h3, .aione-row > .card-4 > p{
        padding:0;
        margin: 0;
    }
    .aione-row > .card-4 > p{
        line-height: 28px;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 300;
        color: #676767;
    }
    .aione-row > .card-4:nth-child(odd) > h3{
        color:#DF735E 
    }
    .aione-row > .card-4:nth-child(even) > h3{
        color:#79C3A9 
    }
    .aione-border.theme-1{
        border:1px solid #e8e8e8;
        border-radius: 4px
    }
    .aione-border.theme-1 > .card-4{
        border-right: 1px solid #e8e8e8;
    }

     .aione-row.theme-2 > .card-4{
        width: 24%;
        margin-right: 10px;
        float: left;
        padding: 30px 0px;
        text-align: center;
    }
     .aione-row.theme-2 > .card-4:last-child{
        margin-right: 0px
     }
    .aione-border.theme-2 > .card-4{
        border: 1px solid #e8e8e8;
        border-radius: 4px
    }

     .aione-row.theme-3 > .card-4{
        width: 50%;
        float: left;
        padding: 30px 0px;
        text-align: center;
    }
     
    .aione-border.theme-3 > .card-4{
        border: 1px solid #e8e8e8;
     
    }
</style>

@php
	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Structure :<span>'.$survey_data[0]['form_title'].'</span>',
	    'add_new' => '+ Add Media'
	); 
	$id = "";
	if(!empty($survey_data)){
	    $repeated_slug=[];
	    $sections = $survey_data[0]['section'];
	    $section_slugs = collect($sections)->groupBy('section_slug')->toArray();
		foreach ($section_slugs as $key => $value) {
			if(count($section_slugs[$key])>1){
				 $repeated_slug[] = $key;
			}
		}
	    $setting = $survey_data[0]['forms_meta'];
	   	$settings = array_column($setting,'value','key');
	   	unset($survey_data[0]['section'][6]);
	   	$sections = $survey_data[0]['section'];
	}
	$index =1;
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')
    @if(!empty($survey_data))
   
    	<div class="aione-form-section-border">
    		<div class="ar">
	    		<div class="ac s100 m100 l75 aione-border">
	    			<div class="aione-title aione-border-bottom m-b-10">
						<h4 class="aione-align-left">Survey Structure</h4>
					</div>
	    			<div class="" >
	    				<div class="aione-row" style="">
		    				<div class="aione-row aione-collapsible">
			    				@foreach ($sections as $key => $section)
			    				{{-- {{dump($section)}} --}}
				    				<div class="aione-form-section"  >
					    				<div class="aione-row">
					    					<div class="aione-form-section-header" id="{{$section['section_slug']}}">
												<div class="aione-row">
													<h3 class="aione-form-section-title aione-align-left">
														{{$section['section_name']}}
														
														<span style="float: right;margin-right: 40px">{{count($section['fields'])}} Questions</span>
														
													</h3>
												</div>
					    					</div>
					    					<div class="aione-form-section-content aione-table">
												<table class="compact">
												    <thead>
												    	<tr>
														    <th >Questions </th> 
														    <th >Type</th>
														 
														    <th >Answer Option</th>
													    </tr>
													</thead>
										       		
											      	<tbody >
											      		@foreach($section['fields'] as $fieldKey => $fieldVal)
											      		@php
											      			$field_slug[] = $fieldVal['field_slug'];
											      		@endphp
											      		<tr>
											      			<td class="{{$fieldVal['field_slug']}}" >{{$fieldVal['field_title']}}</td>
												      		<td class="{{$fieldVal['field_slug']}}"  >{{$fieldVal['field_type']}}</td> 
												      		
															@php
											            		$collection = collect($fieldVal['field_meta'])->mapWithKeys(function($item){
											                		return [$item['key']=>$item['value']];
											            		});
																$meta = $collection->toArray();
										            		@endphp
										            		<td >
											            		@foreach($meta as $metaKey=> $metaVal)
										            				@if($metaKey == 'field_options' && in_array($fieldVal['field_type'], ['radio','select','checkbox'])  )
										            				@php
										            					if($metaVal==null || count(json_decode($metaVal,true)) ==0 ) {
										            						$opt_miss_error[] =[$fieldVal['field_type'],$fieldVal['field_slug']]; 
										            					}
										            				@endphp
										                				@foreach(json_decode($metaVal,true) as $optKey => $optVal)
																			{{$loop->iteration}}
																				@if(!empty($optVal['key']) && !empty($optVal['value']))
																			 		{{$optVal['key']}}-{{$optVal['value']}}<br>
																			 		@else
																						<span class='entry' style="background-color:#F9E5E6;border: 1px solid #F4B7B9;"> not key -  not val </span>
																						<script>
																							$("#{{$section['section_slug']}}").css({'background-color':'#F9E5E6', 'border':'1px solid #F4B7B9'});
																							$(".{{$fieldVal['field_slug']}}").css({'background-color':'#F9E5E6', 'border':'1px solid #F4B7B9'});
																						</script>
																			 		@endif
										                				@endforeach
										            				@endif
										            			@endforeach 
									            			</td>	
											      		</tr>
											      		@endforeach		
								            			

										      		</tbody>
													
												</table>
					    					</div>
					    				</div>
					    			</div>	
					    		 @endforeach
			    			</div>	
			    		
	    				</div>
		    			@php
		    				$unique = array_unique($field_slug);
		    				$repeated_ques_slug = array_diff_assoc($field_slug, $unique);

		    			@endphp
	    				 <div class="aione-row aione-border theme-2" style="margin-bottom: 10px">
		                    <div class="card-4">
		                        <h3>{{@$count_form_slug -1}} {{-- {{$survey_data[0]['form_slug']}} --}}</h3>
		                        <p>Repeated Form Slug </p>
		                    </div>
		                    <div class="card-4">
		                        <h3>{{(count($repeated_slug)>0)?implode(', ', $repeated_slug):0}}</h3>
		                        <p>Repeated Section Slug</p>
		                    </div>
		                     <div class="card-4">
		                        <h3> {{count($repeated_ques_slug)}}</h3>
		                        <p> {{implode(', ', $repeated_ques_slug)}}</p>
		                        <p>Repeated Question Slug</p>
		                    </div>
		                    <div class="card-4">
		                        <h3> </h3>
		                        <p>Miss option value</p>
			                    @if(!empty($opt_miss_error))
				                    @foreach($opt_miss_error as $key => $val)
				                    	<p>Field {{$val['type']}} ,  Slug {{$val['slug']}}</p>
				                    @endforeach
					    			
					    		@endif
		                    </div>
		                    
		                </div>
	    			</div>
	    			

		    			
	    			

	    			
	    		</div>


	    		<div class="ac s100 m100 l25 aione-border">
	    			<div class="">
	    				<div class="aione-row" style="">
		    	
			    			<h4 class="" style="margin-top: 0;font-weight: 300;margin: 15px">Survey Settings</h4>
			    			
			    				
			    			<div class="aione-table">

			    			{{-- {{dump($setting_questions)}} --}}
			    				@if($setting_questions != null)
				    				<table class="compact">
				    					<tbody>
				    						@foreach($setting_questions as $settingKey => $settingVal)
				                                @if($settingKey=='_token')
				                                    @continue;
				                                @endif
				                                @if(!empty($settings[$settingKey]))

				                                    <tr>
				                                        <td>{{$index++}}.{{$settingVal}}</td>
				                                        <td>{{$settings[$settingKey]}}</td>
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
	    	</div>	
    	</div>


    	
  {{--   <style>
		.chead {
			width:240px;
			display: inline-block;
		}

		.font-style{		
			font-size: 16px;
			font-weight: 300;
		}
		.desc{
			width:140px;
			display: inline-block;
		}

		.field-font-style{
			font-size: 14px;
			font-weight: 300;
		}
		.collapsible{
			box-shadow: none
		}
		.collapsible-header > i{
			 float: right;color: #aaa;
		    position: absolute;
		    right: 0;
		}
		.collapsible-header.active > i{
			transform: rotate(90deg);
			transition: 0.6s ease-in;
		}
    </style> --}}
	    {{-- <ul class="collapsible" data-collapsible="accordion">
		    @foreach ($sections as $key => $value) 
			    <li>
			      <div class="collapsible-header" style="position: relative;"><span>{{$value['section_name']}}</span><i class="fa fa-chevron-circle-right" style="   "></i></div>
			      <div class="collapsible-body aione-table">
			      	<table class="wide">
					    <thead>
					    	<tr>
							    <th >Questions </th> 
							    <th >Type</th>
							    <th >Description </th> 
							    <th >Answer Option</th>
						    </tr>
						</thead>
			       		
				      	<tbody >
				      		@foreach($value['fields'] as $fieldKey => $fieldVal)
				      		<tr>
				      			<td >{{$fieldVal['field_title']}}</td>
					      		<td  >{{$fieldVal['field_type']}}</td> 
					      		<td >{{substr($fieldVal['field_description'], 90)}}</td>
								@php
				            		$collection = collect($fieldVal['field_meta'])->mapWithKeys(function($item){
				                		return [$item['key']=>$item['value']];
				            		});
									$meta = $collection->toArray();
			            		@endphp
			            		<td >
				            		@foreach($meta as $metaKey=> $metaVal)
			            				@if($metaKey == 'field_options' && in_array($fieldVal['field_type'], ['radio','select','checkbox'])  )
			            					
			                				@foreach(json_decode($metaVal,true) as $optKey => $optVal)
												{{$loop->iteration}}
													@if(!empty($optVal['key']) && !empty($optVal['value']))
												 		{{$optVal['key']}}-{{$optVal['value']}}<br>
												 		@else
															<h3 class='entry' style="background-color: red;"> not key -  not val </span>
															<script>
																
																
															</script>
												 		@endif
			                				@endforeach
			            				@endif
			            			@endforeach 
		            			</td>	
				      		</tr>
				      		@endforeach		
	            			

			      		</tbody>
						
					</table>
				  </div>
			    </li>
		    @endforeach
	  	</ul> --}}
	  @else
	     <div class="aione-message warning">
            {{ __('survey.survey_not_exit') }}
        </div>

 @endif
	
{{-- <table>
	<tr>
		<th>Section</th>
		<th>Question</th>
		<th>Type</th>
		<th>Description</th>
		<th>Required</th>
		<th>Answer Option</th>
		<th>Created at</th>
	</tr>
	<tbody>
		
	

@if(!empty($survey_data))
    @foreach ($sections as $key => $value) 
        @foreach($value['fields'] as $fieldKey => $fieldVal)
        <tr>
      		<td>{{$value['section_name']}}</td>
			<td>{{$fieldVal['field_title']}}</td>
			<td>{{$fieldVal['field_type']}}</td>
			<td>{{$fieldVal['field_description']}}</td>
			@php 

	            $collection = collect($fieldVal['field_meta'])->mapWithKeys(function($item){
	                return [$item['key']=>$item['value']];
	            });
				$meta = $collection->toArray();
            @endphp
            <td>{{@$meta['required']  }}</td>
			
			<td>
            @foreach($meta as $metaKey=> $metaVal)
            @if($metaKey == 'field_options' && in_array($fieldVal['field_type'], ['radio','select','checkbox'])  )
                @foreach(json_decode($metaVal,true) as $optKey => $optVal)
						{{$loop->iteration}} {{$optVal['key']}}-{{$optVal['value']}}<br>
                @endforeach
            @endif
            @endforeach
           </td>
            <td>{{$fieldVal['created_at']}}</td>
		</tr>
        @endforeach

    @endforeach
    @else
    <h3> No Question Available </h3>
@endif

</tbody>
</table> --}}

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection

