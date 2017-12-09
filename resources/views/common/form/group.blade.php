@php
	if($formFrom == 'admin'){
		$global = true;
	}else{
		$global = false;
	}
	$form_settings = (object) get_form_meta($collection->form_id,null,true,$global);
@endphp
<style type="text/css">
	.repeater-wrapper .repeater-row > i{
		z-index: 999999
	}
</style>
<div class="repeater-group" >
	@if($model != null && !empty($model[strtolower($collection->section_slug)]))
		<div class="repeater-wrapper" id="sortable-options">
			@if(@$model[strtolower($collection->section_slug)] != '')
				@php
					$fieldOptions = $model[strtolower($collection->section_slug)];
					
					if(!is_array($fieldOptions)){
						$fieldOptions = json_decode($fieldOptions,true);
					}
				@endphp
			@endif
			@foreach($fieldOptions as $key => $value)
				<div class="repeater-row ar">
					<i class="material-icons dp48 repeater-row-delete" style="z-index: 999999;">close</i>
					<div id="aione_form_section_{{$collection->id}}" class="aione-form-section">
						<div class="aione-row">
								
							@if( (@$form_settings->form_section_show_title && !empty($collection->section_name)) || (@$form_settings->form_show_section_description && !empty($collection->section_description)))
								<div id="aione_form_section_header" class="aione-form-section-header">
									<div class="aione-row">
										@if(@$form_settings->form_section_show_title && !empty($collection->section_name))
											<h3 class="aione-form-section-title aione-align-{{@$form_settings->form_section_title_align}}">{{$collection->section_name}}</h3>
										@endif
										@if(@$form_settings->form_section_show_description && !empty($section->section_description))
											<h4 class="aione-form-section-description aione-align-{{@$form_settings->form_section_description_align}}">{{$collection->section_description}}</h4>
										@endif
									</div> <!-- .aione-row -->
								</div> <!-- .aione-form-header -->
							@endif
							<div id="aione_form_section_content" class="aione-form-section-content">
								<div class="aione-row ar">
									@php
										$options = [];
										$options['loop_index'] = $loop->index;
									@endphp
									@foreach($collection->fields as $secKey => $field)
										@php
											$default_value = '';
											$options['from'] = 'repeater';
											$options['section_id'] = $collection->id;
											$default_value = @$value[$field->field_slug];
										@endphp
											{!!FormGenerator::GenerateField($field->field_slug, $options,$default_value, $formFrom)!!}	
									@endforeach
							</div> <!-- .aione-row -->
							</div> <!-- .aione-form-content -->

							</div> <!-- .aione-row -->
						</div> <!-- .aione-form-section -->
				</div>
			@endforeach
		</div>
	@else
		<div class="repeater-wrapper">
				<div class="repeater-row ar">
				<i class="material-icons dp48 repeater-row-delete">close</i>
				<div id="aione_form_section_{{$collection->id}}" class="aione-form-section">
					<div class="aione-row">
							
						@if( (@$form_settings->form_section_show_title && !empty($collection->section_name)) || (@$form_settings->form_show_section_description && !empty($collection->section_description)))
							<div id="aione_form_section_header" class="aione-form-section-header">
								<div class="aione-row">
									@if(@$form_settings->form_section_show_title && !empty($collection->section_name))
										<h3 class="aione-form-section-title aione-align-{{@$form_settings->form_section_title_align}}">{{$collection->section_name}}</h3>
									@endif
									@if(@$form_settings->form_section_show_description && !empty($section->section_description))
										<h4 class="aione-form-section-description aione-align-{{@$form_settings->form_section_description_align}}">{{$collection->section_description}}</h4>
									@endif
								</div> <!-- .aione-row -->
							</div> <!-- .aione-form-header -->
						@endif
						<div id="aione_form_section_content" class="aione-form-section-content">
							<div class="aione-row ar">

								
								@foreach($collection->fields as $secKey => $field)
									@php
										$options['from'] = 'repeater';
										$options['section_id'] = $collection->id;
										$options['loop_index'] = 0;
									@endphp
										{!!FormGenerator::GenerateField($field->field_slug, $options,'', $formFrom)!!}	
								@endforeach	
									
						</div> <!-- .aione-row -->
					</div> <!-- .aione-form-content -->

					</div> <!-- .aione-row -->
				</div> <!-- .aione-form-section -->
			</div>
		</div>
	@endif
	
		
	<button type="submit" class="aione-float-right aione-button add-new-repeater">Add New</button>
	<div style="clear: both">
		
	</div>
	
</div>