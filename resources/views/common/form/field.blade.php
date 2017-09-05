@php
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
@endphp
<div id="field_{{$collection->field_slug}}" class="field-wrapper field-wrapper-{{$collection->field_slug}} field-wrapper-type-{{$collection->field_type}} {{$class_name}}">
	@if(@$settings['form_field_show_label'] || @$settings['form_field_show_description'])
		@if(!empty(@$collection->field_title) || !empty(@$collection->field_description))
			<div id="field_label_{{$collection->field_slug}}" class="field-label">

				<label for="input_{{$collection->field_slug}}">
					@if(!empty(@$collection->field_title) && @$settings['form_field_show_label'])
						<h4 class="field-title" id="{{$collection->field_title}}">{!!$collection->field_title!!}</h4>
					@endif
					@if(!empty(@$collection->field_description) && @$settings['form_field_show_description'])
						<p class="field-description">{!!$collection->field_description!!}</p>
					@endif
				</label>

			</div><!-- field label-->
		@endif
	@endif
	

	<div id="field_{{$collection->field_slug}}" class="field {{$collection->field_type}} field-type-{{$collection->field_type}}">
	
		@if(View::exists('common.form.fields.'.$field))
			@include('common.form.fields.'.$field)
		@else 
			<div class="aione-error">
				{{ __('messages.form_field_missing') }}
			</div>
		@endif

	<span class="error-red">
		@if(@$errors->has(str_replace(' ','_',strtolower($collection->field_title))))
			{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
		@endif
	</span>
	</div><!-- field -->
</div><!-- field wrapper -->