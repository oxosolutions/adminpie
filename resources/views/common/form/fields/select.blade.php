@php
	$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
	if($model != false && $model != '' && $model != null){
		$exploded = explode('@',$model);
		$result = new $exploded[0];
		$exploded[1] = str_replace('()', '', $exploded[1]);
	}
	//field_value
	/*$selectedArray = null;
	if(FormGenerator::GetMetaValue($collection->fieldMeta,'field_value') == 'id'){
		if(!empty(request()->route()->parameters)){
			$selectedArray[] = request()->route()->parameters['id'];
		}
	}*/
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
@endphp


@php
	$arrayOptions = [];
	if($model == false || $model == '' || $model == null){
		$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
		if(isset($optionValues['key'])){
			$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
		}else{
			$collect = collect($optionValues);
			$keys = array_keys($collect->groupBy('key')->toArray());
			$values = array_keys($collect->groupBy('value')->toArray());
			$arrayOptions = array_combine($keys, $values);
		}
	}else{
		$arrayOptions = @$result->{$exploded[1]}();
	}
@endphp

@php
	if(isset($settings['show_placeholder']) && $settings['show_placeholder'] != '' && $settings['show_placeholder'] == 'yes'){
		$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
	}else{
		$placeholder = '';
	}
@endphp

{!! Form::select(str_replace(' ','_',strtolower($collection->field_slug)),$arrayOptions,null,['class'=>$collection->field_slug.' browser-default '.$class_name,'id'=>'input_'.$collection->field_slug,'placeholder'=>$placeholder])!!}