<span class="error-red">
	@if(@$errors->has(str_replace(' ','_',strtolower($collection->field_title))))
		{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
	@endif
</span>