
@if(isset($settings['show_title']) || isset($settings['show_description']))
	<label for="input_{{$collection->field_slug}}">
		@if(isset($settings['show_title']) && $settings['show_title'] == 'yes')
			<h4 class="field-title" id="{{$collection->field_title}}">{{ucfirst($collection->field_title)}}</h4>
		@endif
		@if(isset($settings['show_description']) && $settings['show_description'] == 'yes')
			<p class="field-description">{{$collection->field_description}}</p>
		@endif
	</label>
@endif