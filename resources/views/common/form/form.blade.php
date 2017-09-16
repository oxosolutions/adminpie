@php
$form_id =  $collection->id;
$form_title =  $collection->form_title;
$form_description =  $collection->form_description;
if($formFrom == 'admin'){
	$global = true;
}else{
	$global = false;
}
$form_settings = (object) get_form_meta($form_id,null,true,$global);

$aione_form_border = $aione_form_section_border = $aione_form_field_border = "";

if(@$form_settings->form_border){
	$aione_form_border = "aione-form-border";
}
if(@$form_settings->form_secion_show_border){
	$aione_form_section_border = "aione-form-section-border";
}
if(@$form_settings->form_field_show_border){
	$aione_form_field_border = "aione-form-field-border";
}

@endphp

<div id="aione_form_wrapper_{{$form_id}}" class="aione-form-wrapper aione-form-theme-{{@$form_settings->form_theme}} aione-form-label-position-{{@$form_settings->form_label_position}} aione-form-style-{{@$form_settings->form_style}} {{$aione_form_border}} {{$aione_form_field_border}} {{$aione_form_section_border}}">
	<div class="aione-row">
		@if( (@$form_settings->form_show_title && !empty($form_title)) || (@$form_settings->form_show_description && !empty($form_description)))
			<div id="aione_form_header" class="aione-form-header">
				<div class="aione-row">
					@if(@$form_settings->form_show_title && !empty($form_title))
						<h1 class="aione-form-title aione-align-{{@$form_settings->form_title_align}}">{{$form_title}}</h1>
					@endif
					@if(@$form_settings->form_show_description && !empty($form_description))
						<h2 class="aione-form-description aione-align-{{@$form_settings->form_description_align}}">{{$form_description}}</h2>
					@endif
				</div> <!-- .aione-row -->
			</div> <!-- .aione-form-header -->
		@endif
		<div id="aione_form_content" class="aione-form-content">
			<div class="aione-row aione-{{@$form_settings->form_section_style}}">
			@foreach($collection->section as $key => $section)
				<div id="aione_form_section_{{$section->id}}" class="aione-form-section">
					<div class="aione-row">

						@if( (@$form_settings->form_section_show_title && !empty($section->section_name)) || (@$form_settings->form_show_section_description && !empty($section->section_description)))
						<div id="aione_form_section_header" class="aione-form-section-header">
							<div class="aione-row">
								@if(@$form_settings->form_section_show_title && !empty($section->section_name))
									<h3 class="aione-form-section-title aione-align-{{@$form_settings->form_section_title_align}}">{{$section->section_name}}</h1>
								@endif
								@if(@$form_settings->form_section_show_description && !empty($section->section_description))
									<h4 class="aione-form-section-description aione-align-{{@$form_settings->form_section_description_align}}">{{$section->section_description}}</h2>
								@endif
							</div> <!-- .aione-row -->
						</div> <!-- .aione-form-header -->
						@endif
						<div id="aione_form_section_content" class="aione-form-section-content">
							<div class="aione-row">

							@php
							$options['form_id'] = $collection->id; 
							@endphp
							{!!FormGenerator::GenerateSection($section->section_slug, $options,$model, $formFrom)!!}

							</div> <!-- .aione-row -->
						</div> <!-- .aione-form-content -->

					</div> <!-- .aione-row -->
				</div> <!-- .aione-form-section -->
			@endforeach

			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

		@if(@$form_settings->form_show_save_button || @$form_settings->form_show_reset_button )
		<div id="aione_form_footer" class="aione-form-footer">
			<div class="aione-row">
			@php
				$save_button_text = 'Save';
				$cancel_button_text = 'Cancel';
				if(!empty(@$form_settings->form_save_button_text)){
					$save_button_text = $form_settings->form_save_button_text;
				}
				if(!empty(@$form_settings->form_reset_button_text)){
					$cancel_button_text = $form_settings->form_reset_button_text;
				}
			@endphp

			@if(@$form_settings->form_show_save_button)
				<input type="submit" class="aione-button" value="{{$save_button_text}}" />
			@endif
			@if(@$form_settings->form_show_reset_button)
				<input type="submit" class="aione-button" value="{{$cancel_button_text}}" />
			@endif
				
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-footer -->
		@endif


	</div> <!-- .aione-row -->
</div> <!-- .aione-form-wrapper -->

<script type="text/javascript">
	  $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	  });
</script>