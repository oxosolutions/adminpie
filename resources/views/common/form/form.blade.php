<div>
	{{-- @include('admin.settings._tabs') --}}
	<div>
		<div class="row">
			<div class="col l12">
				<h5>{{@$options['title']}}</h5>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				{{@$options['details']}}
			</div>
		</div>
		<div class="row " >
			@foreach($collection->section as $key => $section)
				<div class="row">
					<div class="row">
						<h5>{{$section->section_name}}</h5> 
					</div>
						@php
							$options['form_id'] = $collection->id;
						@endphp
						{!!FormGenerator::GenerateSection($section->section_slug, $options,$model, $formFrom)!!}
				</div>
			@endforeach
		</div>
		<div class="row right-align ">
			
			@if(isset($settings['settingsec1f6']) && $settings['settingsec1f6'] != '')
				@php
					$buttonText = $settings['settingsec1f6'];
				@endphp
			@else
				@php
					$buttonText = 'Save';
				@endphp
			@endif
			<button type="submit" class="btn">{{$buttonText}}</button>
			@if(isset($settings['show_reset_button']) && $settings['show_reset_button'] != '' &&$settings['show_reset_button'] == 'yes')
				<a class="btn grey darken-2">reset to default</a>
			@endif
		</div>
	</div>
</div>

<script type="text/javascript">
	  $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	  });
</script>