<div class="col l3" style="line-height: 25px">
	{{$collection->field_title}}
</div>
<div class="col l9">
	<div class="row">
		@php
			$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'));
		@endphp
		@foreach($optionValues as $key => $value)
			<div class="col l3">
				<input name="{{str_replace(' ','_',strtolower($collection->field_title))}}" type="radio" id="test{{$loop->index}}" value="{{$optionValues->key[$loop->index]}}" />
		    	<label for="test{{$loop->index}}">{{$optionValues->value[$loop->index]}}</label>    
			</div>
		@endforeach
	</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>

	
</div>