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
@endphp

@if($modelRelated != false && $modelRelated != '' && $modelRelated != null)
				
			{!! Form::select($name.'[]',$result->$exploded[1](),null,["class"=>"browser-default no-margin-bottom aione-field" , 'placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'multiple'=>true])!!}
		

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
		
	@endphp

			{!! Form::select($name.'[]',$arrayOptions,null,['class'=>$collection->field_slug.' browser-default ','id'=>'input_'.$collection->field_slug,'multiple'])!!}

@endif