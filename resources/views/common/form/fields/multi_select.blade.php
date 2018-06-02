@php
	$modelRelated = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
	if($modelRelated != false && $modelRelated != '' && $modelRelated != null){
		$exploded = explode('@',$modelRelated);
		$result = new $exploded[0];
		$exploded[1] = str_replace('()', '', $exploded[1]);
	}
	if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
		$name = $collection->field_slug;
	}else{
		$name = str_replace(' ','_',strtolower($collection->field_slug));
	}
	if(@$options['from'] == 'repeater'){
		$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
	}
    $placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
@endphp

	<input type="hidden" name="{{ $name }}">

@if($modelRelated != false && $modelRelated != '' && $modelRelated != null)
				@php
					try{
						$arrayOptions = $result->{$exploded[1]}($collection);
					}catch(\Exception $e){
						$arrayOptions = [];
					}
					$fieldOptionsArray = [];
                    $fieldOptionsArray['class'] = $collection->field_slug.' browser-default no-margin-bottom aione-field';
                    $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
                    $fieldOptionsArray['placeholder'] = $placeholder;
                    $fieldOptionsArray['multiple'] = true;
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
				@endphp
			{!! Form::select($name.'[]',$arrayOptions,null,$fieldOptionsArray)!!}
		

@else
	@php
		$arrayOptions = [];
		$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
		if(isset($optionValues['key'])){

			$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
		}else{
			$collect = collect($optionValues);
			$keys = array_keys($collect->groupBy('key')->toArray());
			$values = array_keys($collect->groupBy('value')->toArray());
			$arrayOptions = array_combine($keys, $values);
		}
        $fieldOptionsArray = [];
        $fieldOptionsArray['class'] = $collection->field_slug.' browser-default';
        $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
        $fieldOptionsArray['placeholder'] = $placeholder;
        $fieldOptionsArray['multiple'] = true;
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
		
	@endphp
            
			{!! Form::select($name.'[]',$arrayOptions,null,$fieldOptionsArray)!!}

@endif
<div class="field-actions">
	<a class="aione-form-multiselect-all aione-action-link">Select All</a> / 
	<a class="aione-form-multiselect-none aione-action-link">Select None</a> 
</div>