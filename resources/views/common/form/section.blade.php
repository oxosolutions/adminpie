@php
	if($formFrom == 'admin'){
		$global = true;
	}else{
		$global = false;
	}
	$form_settings = (object) get_form_meta($collection->form_id,null,true,$global);
@endphp


<div id="aione_form_section_{{$collection->id}}" class="aione-form-section non-repeater">
	<div class="aione-row">
	
		@if( (@$form_settings->form_section_show_title && !empty($collection->section_name)) || (@$form_settings->form_show_section_description && !empty($collection->section_description)))
		<div id="aione_form_section_header" class="aione-form-section-header">
			<div class="aione-row">
				@if(@$form_settings->form_section_show_title && !empty($collection->section_name))
					<h3 class="aione-form-section-title aione-align-{{@$form_settings->form_section_title_align}}">{{$collection->section_name}}</h1>
				@endif
				
				@if(@$form_settings->form_section_show_description && !empty($collection->section_description))
					<h4 class="aione-form-section-description aione-align-{{@$form_settings->form_section_description_align}}">{{$collection->section_description}}</h2>
				@endif
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-header -->
		@endif
		<div id="aione_form_section_content" class="aione-form-section-content">
			<div class="aione-row ar">

			@foreach($collection->fields as $secKey => $field)
					@php
						$options['section_id'] = $collection->id;
					@endphp
					{!!FormGenerator::GenerateField($field->field_slug, $options,$model, $formFrom)!!}
			@endforeach

			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

	</div> <!-- .aione-row -->
</div> <!-- .aione-form-section -->