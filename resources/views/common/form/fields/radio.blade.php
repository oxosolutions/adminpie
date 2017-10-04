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
			
		@endphp
		@if($status == false)
			@foreach($optionValues['key'] as $key => $value)
				<div id="field_option_{{$collection->field_slug}}" class="field-option">
					{!!Form::radio(str_replace(' ','_',strtolower($collection->field_slug)),$optionValues['key'][$loop->index],null,['id'=>'option_'.str_replace(' ','_',strtolower($collection->field_slug)).$loop->index,'class'=>$collection->field_slug.' '.$class_name])!!}
			    	<label for="option_{{str_replace(' ','_',strtolower($collection->field_slug)).$loop->index}}" class="field-option-label">{!!$optionValues['value'][$loop->index]!!}</label>    
				</div>

			@endforeach
		@else
			@if(!empty($arrayOptions))
		
				@foreach($arrayOptions as $key => $value)
					<div id="field_option_{{$collection->field_slug}}" class="field-option">
						{!!Form::radio(str_replace(' ','_',strtolower($collection->field_slug)),$key,null,['id'=>'option_'.str_replace(' ','_',strtolower($collection->field_slug)).$loop->index,'class'=>$class_name])!!}
				    	<label for="option_{{str_replace(' ','_',strtolower($collection->field_slug)).$loop->index}}" class="field-option-label">{!!@$value!!}</label>    
					</div>
				@endforeach

				@else
				
			@endif
		@endif
