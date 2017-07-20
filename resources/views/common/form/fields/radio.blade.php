<div class="col l3" style="line-height: 25px;">
	{{$collection->field_title}}
</div>
<div class="col l9">
	<div class="row" style="margin-bottom: 20px">
		@php
			$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'));
			// dd($optionValues);
		@endphp
		@foreach($optionValues->key as $key => $value)
			<div class="col l3">
				{!!Form::radio(str_replace(' ','_',strtolower($collection->field_title)),$optionValues->key[$loop->index],false,['id'=>str_replace(' ','_',strtolower($collection->field_title)).$loop->index])!!}
		    	<label for="{{str_replace(' ','_',strtolower($collection->field_title)).$loop->index}}">{{$optionValues->value[$loop->index]}}</label>    
			</div>
		@endforeach
	</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>

	
</div>