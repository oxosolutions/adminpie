@php
	$modelRelated = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
	if($modelRelated != false && $modelRelated != '' && $modelRelated != null){
		$exploded = explode('@',$modelRelated);
		$result = new $exploded[0];
		$exploded[1] = str_replace('()', '', $exploded[1]);
	}
@endphp
@if($modelRelated != false && $modelRelated != '' && $modelRelated != null)
				
			{!! Form::select(str_replace(' ','_',strtolower($collection->field_slug)).'[]',$result->$exploded[1](),null,["class"=>"browser-default no-margin-bottom aione-field" , 'placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'multiple'=>true])!!}
		

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
			{!! Form::select(str_replace(' ','_',strtolower($collection->field_slug)).'[]',$arrayOptions,null,['class'=>$collection->field_slug.' browser-default ','id'=>'input_'.$collection->field_slug,'multiple'])!!}

@endif