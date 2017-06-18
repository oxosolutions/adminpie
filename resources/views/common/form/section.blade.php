@foreach($collection->fields as $secKey => $field)
		{!!FormGenerator::GenerateField($field->field_slug, $options)!!}
@endforeach