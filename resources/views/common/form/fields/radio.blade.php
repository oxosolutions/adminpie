@php
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
@endphp

		@php

			$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'),true);
			if(isset($optionValues['key'])){
				$status = false;
				$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
			}else{
				$status = true;
				$collect = collect($optionValues);
				$arrayOptions =null;
				if(!empty($collect->toArray())){
					
					$arrayOptions = $collect->mapwithKeys(function($items){
						if(!empty(@$items['value'])){
							return [@$items['key']=>$items['value']];
						}
					});
				}
				  
			}
            if(!function_exists('javascriptValidations')){
                function javascriptValidations($loop, $collection, $field_validations, $class_name){
                    $fieldOptionsArray = [];
                    $fieldOptionsArray['class'] = $collection->field_slug.' '.$class_name;
                    $fieldOptionsArray['id'] = 'option_'.str_replace(' ','_',strtolower($collection->field_slug)).$loop->index;
                    $fieldOptionsArray['data-validation'] = '';
                    $validationString = '';
                    if($field_validations != null){
                        $javaScriptValidations = json_decode(@$field_validations);
                        if(!empty($javaScriptValidations)){
                            foreach($javaScriptValidations as $key => $validation){
                                if(@$validation->field_validation == 'length'){
                                    $fieldOptionsArray['data-validation-length'] = @$validation->validation_argument;
                                }
                                $validationString.= @$validation->field_validation.' ';
                            }
                            $fieldOptionsArray['data-validation'] = $validationString;
                        }
                    }
                    return $fieldOptionsArray;
                }
            }
            if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
                $name = $collection->field_slug;
            }else{
                $name = str_replace(' ','_',strtolower($collection->field_slug));
            }
            if(@$options['from'] == 'repeater'){
                $name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
            }else{
                $name = str_replace(' ','_',strtolower($collection->field_slug));
            }
		@endphp
		@if($status == false)
			@foreach($optionValues['key'] as $key => $value)
				<div id="field_option_{{$collection->field_slug}}" class="field-option">
					{!!Form::radio($name,$optionValues['key'][$loop->index],null,javaScriptValidations($loop,$collection,$field_validations,$class_name))!!}
			    	<label for="option_{{$name.$loop->index}}" class="field-option-label">{!!$optionValues['value'][$loop->index]!!}</label>    
				</div>

			@endforeach
		@else
			@if(!empty($arrayOptions))
		
				@foreach($arrayOptions as $key => $value)
					<div id="field_option_{{$collection->field_slug}}" class="field-option">
						{!!Form::radio($name,$key,null,javaScriptValidations($loop,$collection,$field_validations,$class_name))!!}
				    	<label for="option_{{$name.$loop->index}}" class="field-option-label">{!!@$value!!}</label>    
					</div>
				@endforeach

				@else
				
			@endif
		@endif
