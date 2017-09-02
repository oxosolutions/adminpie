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
				$keys = array_keys($collect->groupBy('key')->toArray());
				$values = array_keys($collect->groupBy('value')->toArray());
				$arrayOptions = array_combine($keys, $values);
			}
		@endphp
		@if($status == false)
			
			@foreach($arrayOptions as $key => $value)
				<div id="field_option_{{$collection->field_slug}}" class="field-option">
					{!!Form::checkbox(str_replace(' ','_',strtolower($collection->field_slug)).'[]',$key,null,['id'=>'option_'.str_replace(' ','_',strtolower($collection->field_slug)).$loop->index,'class'=>$class_name])!!}
			    	<label for="option_{{str_replace(' ','_',strtolower($collection->field_slug)).$loop->index}}" class="field-option-label">{!!$value!!}</label>    
				</div>
			@endforeach
		@else
			@foreach($arrayOptions as $key => $value)
				<div id="field_option_{{$collection->field_slug}}" class="field-option">
					{!!Form::checkbox(str_replace(' ','_',strtolower($collection->field_slug)).'[]',$key,null,['id'=>'option_'.str_replace(' ','_',strtolower($collection->field_slug)).$loop->index,'class'=>$class_name])!!}
			    	<label for="option_{{str_replace(' ','_',strtolower($collection->field_slug)).$loop->index}}" class="field-option-label">{!!$value!!}</label>    
				</div>
			@endforeach
		@endif
		