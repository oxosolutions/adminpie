@php
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
	$field_input_class = "input-".$collection->field_slug;
	$field_input_id = "input_".$collection->field_slug;
	$field_validations = null;
	$field_validation = "";
    $placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
    $field_validations = FormGenerator::GetMetaValue($collection->fieldMeta,'field_validations');
	$field_tooltip = FormGenerator::GetMetaValue($collection->fieldMeta,'field_tooltip');
    $requiredStatus = false;
    $fieldTooltipStatus = false;
    if(@$field_validations != '' && $field_validations != null){
        $requiredValidate = json_decode($field_validations, true);
        foreach ($requiredValidate as $key => $validate) {
            if(@$validate['field_validation'] == 'required'){
                $requiredStatus = true;
            }
        }
    }

    if(trim($field_tooltip) != ''){
        $fieldTooltipStatus = true;
    }

	$field_conditions = FormGenerator::GetMetaValue($collection->fieldMeta,'field_conditions');

	$field_meta = array(); 

	$field_meta['field_custom_code_theme'] = FormGenerator::GetMetaValue($collection->fieldMeta,'field_custom_code_theme');
	$field_meta['field_custom_code_language'] = FormGenerator::GetMetaValue($collection->fieldMeta,'field_custom_code_language');
	$has_conditions = 0;
	$field_meta = (object) $field_meta;
	if($field_conditions != ''){
		$conditions = json_decode($field_conditions, true);
		// dump($conditions);
		if(!empty($conditions) && @$conditions[0]['condition_value'] != null){
			$has_conditions = 1;
		}
	}

@endphp
<div id="field_{{$collection->id}}" data-conditions="{{@$has_conditions}}" data-field-type="{{$collection->field_type}}" class="field-wrapper ac field-wrapper-{{$collection->field_slug}} field-wrapper-type-{{$collection->field_type}} {{$class_name}}">
	@if(@$settings['form_field_show_label'] || @$settings['form_field_show_description'])
		@if(!empty(@$collection->field_title) || !empty(@$collection->field_description))
			<div id="field_label_{{$collection->field_slug}}" class="field-label">

				<label for="input_{{$collection->field_slug}}">
					@if(!empty(@$collection->field_title) && @$settings['form_field_show_label'])
						<h4 class="field-title" id="{{$collection->field_title}}">
						{!!$collection->field_title!!}
						@if($requiredStatus)
						  <span class="red">*</span>
						@endif

						@if($fieldTooltipStatus)
						  <span class="aione-tooltip field-tooltip" title="{!! @$field_tooltip !!}"><i class="fa fa-question-circle"></i></span>
						@endif

						</h4>
					@endif
					@if(!empty(@$collection->field_description) && @$settings['form_field_show_description'])
						<p class="field-description">{!!$collection->field_description!!}</p>
					@endif
				</label>

			</div><!-- field label-->
		@endif
	@endif
	

	<div id="field_{{$collection->field_slug}}" class="field field-type-{{$collection->field_type}}">
	
		@if(View::exists('common.form.fields.'.$field))
			@include('common.form.fields.'.$field)

		@else 
			<div class="aione-message error">
				{{ __('messages.form_field_missing') }}
			</div>
		@endif
		@php
			if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
				$name = $collection->field_slug;
			}else{
				$name = str_replace(' ','_',strtolower($collection->field_slug));
			}
			if(@$options['from'] == 'repeater'){
				$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
			}
		@endphp
		@if(@$errors->has($name))
			<span class="aione-field-error">
			{{$errors->first($name)}}
			</span>
		@endif
	</div><!-- field -->
    @php
        $question_repeater = @FormGenerator::GetMetaValue($collection->fieldMeta,'question_repeater');
    @endphp
    @if($question_repeater == 'yes')
        {!! Form::button('Add More',['class'=>'add_more_text']) !!}
    @endif
    
</div><!-- field wrapper -->