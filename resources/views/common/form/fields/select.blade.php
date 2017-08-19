@php
	$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
	if($model != false && $model != '' && $model != null){
		$exploded = explode('@',$model);
		$result = new $exploded[0];
		$exploded[1] = str_replace('()', '', $exploded[1]);
	}
	//field_value
	$selectedArray = null;
	if(FormGenerator::GetMetaValue($collection->fieldMeta,'field_value') == 'id'){
		if(!empty(request()->route()->parameters)){
			$selectedArray[] = request()->route()->parameters['id'];
		}
	}
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
@endphp


@php
	if($model == false || $model == '' || $model == null){
		$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
		$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
	}
@endphp
@include('common.form.fields.includes.field-wrapper-start')
	@include('common.form.fields.includes.field-label-start')
		@include('common.form.fields.includes.label')
	@include('common.form.fields.includes.field-label-end')
	@include('common.form.fields.includes.field-start')
		@php
			if(isset($settings['show_placeholder']) && $settings['show_placeholder'] != '' && $settings['show_placeholder'] == 'yes'){
				$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
			}else{
				$placeholder = '';
			}
		@endphp
		@if($model != false && $model != '' && $model != null)
			{!! Form::select(str_replace(' ','_',strtolower($collection->field_slug)),$result->$exploded[1](),$selectedArray,["class"=>"no-margin-bottom aione-field browser-default ".$class_name.' ' , 'placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')])!!}
		@else
			{!! Form::select(str_replace(' ','_',strtolower($collection->field_slug)),$arrayOptions,null,['class'=>$collection->field_slug.' browser-default '.$class_name,'id'=>'input_'.$collection->field_slug,'placeholder'=>$placeholder])!!}
		@endif
		@include('common.form.fields.includes.error')
	@include('common.form.fields.includes.field-end')
@include('common.form.fields.includes.field-wrapper-end')