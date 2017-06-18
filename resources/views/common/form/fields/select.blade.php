@if(isset($options['type']))
	@if($options['type'] == 'inset')
		@php
			$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
			if($model != false && $model != '' && $model != null){
				$exploded = explode('@',$model);
				$result = new $exploded[0];
				$exploded[1] = str_replace('()', '', $exploded[1]);
			}
		@endphp
		@if($model != false && $model != '' && $model != null)
			<div class="col s12 m2 l12 aione-field-wrapper">
				{!! Form::select($collection->field_title,$result->$exploded[1](),null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')])!!}
			</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>

		@else
			@php
				$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
				$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
			@endphp
			<div class="col s12 m2 l12 aione-field-wrapper">
				{!! Form::select($collection->field_title,$arrayOptions,null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')])!!}
			</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>

		@endif
	@else
		<div class="col l3" style="line-height: 30px">
			{{$collection->field_title}}
		</div>
		<div class="col l9">
			@php
				$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
				$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
			@endphp
			{!! Form::select(str_replace(' ','_',strtolower($collection->field_title)),$arrayOptions,null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')])!!}
		</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>

	@endif
@else

	@php
		$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
		if($model != false && $model != '' && $model != null){
			$exploded = explode('@',$model);
			$result = new $exploded[0];
			$exploded[1] = str_replace('()', '', $exploded[1]);
		}
	@endphp
	@if($model != false && $model != '' && $model != null)
		<div class="col l3" style="line-height: 30px">
			{{$collection->field_title}}
		</div>
		<div class="col l9">
			{!! Form::select($collection->field_title,$result->$exploded[1](),null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')])!!}
		</div>
	@else
		<div class="col l3" style="line-height: 30px">
			{{$collection->field_title}}
		</div>
		<div class="col l9">
			@php
				$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
				$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
			@endphp
			{!! Form::select(str_replace(' ','_',strtolower($collection->field_title)),$arrayOptions,null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')])!!}
		</div>
	@endif
@endif