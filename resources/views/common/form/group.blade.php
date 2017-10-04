<div class="repeater-group">
	@if($model != null && !empty($model[strtolower($collection->section_slug)]))
		<div class="repeater-wrapper">
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
					<i class="material-icons dp48 repeater-row-delete">close</i>
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
				</div>
			@endforeach
		</div>
		{{-- @foreach($model as $key => $value)
			@php
				$defaulValues = [];
			@endphp
			<div class="row repeat-row" style="border:1px dashed #e8e8e8; margin-top: 1%;">
				<div class="row">
					<div class="col l1 offset-l11 right-align">
						<i class="fa fa-close close-delete"></i>
					</div>
				</div>
				<div class="row" style="padding:15px 10px; ">
					<div class="col l12">
						@php
							$defaulValues[] = $key;
							$defaulValues[] = $value;
						@endphp
						@foreach($collection->fields as $secKey => $field)
								@php
									//$options['default_value'] = $defaulValues[$secKey];
									$options['from'] = 'repeater';
									$options['section_id'] = $collection->id;
								@endphp
								{!!FormGenerator::GenerateField($field->field_slug, $options,$model, $formFrom)!!}
						@endforeach
					</div>
				</div>
			</div>
		@endforeach --}}
	@else
		<div class="repeater-wrapper">
			<div class="repeater-row ar">
			<i class="material-icons dp48 repeater-row-delete">close</i>
			@foreach($collection->fields as $secKey => $field)
				@php
					$options['from'] = 'repeater';
					$options['section_id'] = $collection->id;
					$options['loop_index'] = 0;
				@endphp
					{!!FormGenerator::GenerateField($field->field_slug, $options,'', $formFrom)!!}	
			@endforeach	
			</div>
		</div>
	@endif
	
		
	<button type="submit" class="aione-float-right aione-button add-new-repeater">Add New</button>
	<div style="clear: both">
		
	</div>
	
</div>