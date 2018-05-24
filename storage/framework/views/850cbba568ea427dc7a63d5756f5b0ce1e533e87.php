<?php 
	$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
	if($model != false && $model != '' && $model != null){
		$exploded = explode('@',$model);
		$result = new $exploded[0];
		$exploded[1] = str_replace('()', '', $exploded[1]);
	}
	
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
 ?>
<?php if(isset($options['default_value']) && $options['default_value'] != ''): ?>
	<?php 
		$default_value = $options['default_value'];
	 ?>
<?php else: ?>
	<?php 
		$default_value = [];
	 ?>
<?php endif; ?>

<?php 
	$arrayOptions = [];
	if($model == false || $model == '' || $model == null){
		$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);

		if(isset($optionValues['key'])){
			$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
		}else{
			$collect = collect($optionValues);
			$arrayOptions =null;
			if(!empty($collect->toArray())){
				$arrayOptions = $collect->mapwithKeys(function($items){
					if($items['value'] != '' && $items['value'] != null){
						return [$items['key']=>$items['value']];
					}
				});
			}
		}
	}else{
		try{
			$arrayOptions = @$result->{$exploded[1]}($collection);
		}catch(\Exception $e){
			$arrayOptions = [];
		}
	}
 ?>
<?php 
	if(isset($settings['form_show_field_placeholder']) && $settings['form_show_field_placeholder'] != '' && $settings['form_show_field_placeholder'] == 'yes'){
		$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
	}else{
		$placeholder = 'Select Value';
	}
	if(empty($arrayOptions)){
		$arrayOptions = $default_value;
	}
	$name = str_replace(' ','_',strtolower($collection->field_slug));
	if(@$options['from'] == 'repeater'){
		$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
	}
	$fieldOptionsArray = [];
    $fieldOptionsArray['class'] = 'input_'.$collection->field_slug.' browser-default ';
    $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
    $fieldOptionsArray['placeholder'] = $placeholder;
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
 ?>
<?php echo Form::select($name,$arrayOptions,null,$fieldOptionsArray); ?>