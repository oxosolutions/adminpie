
@if(isset($settings['form_show_field_label']) || isset($settings['form_show_description']))
	<label for="input_{{$collection->field_slug}}">
		@if(isset($settings['form_show_field_label']) && $settings['form_show_field_label'] == 'yes')
			<h4 class="field-title" id="{{$collection->field_title}}">{!!$collection->field_title!!}</h4>
		@endif
		@if(isset($settings['form_show_field_description']) && $settings['form_show_field_description'] == 'yes')
			<p class="field-description">{!!$collection->field_description!!}</p>
		@endif
	</label>
@endif
