@php
	$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
	if($model != false && $model != '' && $model != null){
		$exploded = explode('@',$model);
		$result = new $exploded[0];
		$exploded[1] = str_replace('()', '', $exploded[1]);
	}
	
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
@endphp
@if(isset($options['default_value']) && $options['default_value'] != '')
	@php
		$default_value = $options['default_value'];
	@endphp
@else
	@php
		$default_value = [];
	@endphp
@endif

@php
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
					if(!empty($items['value'])){
						return [$items['key']=>$items['value']];
					}
				});
			}
		}
	}else{
		try{
			$arrayOptions = @$result->{$exploded[1]}();
		}catch(\Exception $e){
			$arrayOptions = [];
		}
	}
@endphp

@php
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
	
@endphp

{!! Form::select($name,$arrayOptions,null,['class'=>'input_'.$collection->field_slug.' browser-default ','id'=>'input_'.$collection->field_slug,'placeholder'=>$placeholder])!!}