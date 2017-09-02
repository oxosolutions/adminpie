{{--
Form Title
<h5>{{@$options['title']}}</h5>
Form Description
<h5>{{@$options['title']}}</h5>
{{dd($collection)}}
--}}

@php
$form_id =  $collection->id;
$form_title =  $collection->form_title;
$form_description =  $collection->form_description;


//$form_settings = $collection->forms_meta;
//dd($collection);

$form_settings = (object) get_form_meta($form_id);
//dd($form_settings);

$aione_form_border = "";
if(@$form_settings->form_show_field_border){
	$aione_form_border = "aione-form-border";
}

@endphp
<input type="hidden" name="form_id" value="{{$collection->id}}" />
<input type="hidden" name="form_slug" value="{{$collection->form_slug}}" />
<input type="hidden" name="form_title" value="{{$collection->form_title}}" />

<div id="aione_form_wrapper_{{$form_id}}" class="aione-form-wrapper aione-form-theme-{{@$form_settings->form_theme}} aione-form-label-position-{{@$form_settings->form_label_position}} aione-form-style-{{@$form_settings->form_style}} {{$aione_form_border}}">
	<div class="aione-row">
		@if( (@$form_settings->form_show_form_title == 'yes' && !empty($form_title)) || (@$form_settings->form_show_form_description == 'yes' && !empty($form_description)))
			<div id="aione_form_header" class="aione-form-header">
				<div class="aione-row">
					@if(@$form_settings->form_show_form_title == 'yes' && !empty($form_title))
						<h1 class="aione-form-title aione-align-{{@$form_settings->form_title_align}}">{{$form_title}}</h1>
					@endif
					@if(@$form_settings->form_show_form_description == 'yes' && !empty($form_description))
						<h2 class="aione-form-description aione-align-{{@$form_settings->form_description_align}}">{{$form_description}}</h2>
					@endif
				</div> <!-- .aione-row -->
			</div> <!-- .aione-form-header -->
		@endif
		<div id="aione_form_content" class="aione-form-content">
			<div class="aione-row">
			@foreach($collection->section as $key => $section)
				<div id="aione_form_section_{{$section->id}}" class="aione-form-section">
					<div class="aione-row">

						@if( (@$form_settings->form_show_section_title == 'yes' && !empty($section->section_name)) || (@$form_settings->form_show_section_description == 'yes' && !empty($section->section_description)))
						<div id="aione_form_section_header" class="aione-form-section-header">
							<div class="aione-row">
								@if(@$form_settings->form_show_section_title == 'yes' && !empty($section->section_name))
									<h3 class="aione-form-section-title aione-align-{{@$form_settings->form_section_title_align}}">{{$section->section_name}}</h1>
								@endif
								@if(@$form_settings->form_show_section_description == 'yes' && !empty($section->section_description))
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

		@if(@$form_settings->form_show_save_button == 'yes' || @$form_settings->form_show_reset_button == 'yes' )
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

			@if(@$form_settings->form_show_save_button == 'yes')
				<input type="submit" class="aione-button" value="{{$save_button_text}}" />
			@endif
			@if(@$form_settings->form_show_reset_button == 'yes')
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