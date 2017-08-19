@foreach($collection->fields as $secKey => $field)
		{{-- {{dump($collection)}} --}}
		@php
			$options['section_id'] = $collection->id;
		@endphp
		{!!FormGenerator::GenerateField($field->field_slug, $options,$model, $formFrom)!!}
@endforeach