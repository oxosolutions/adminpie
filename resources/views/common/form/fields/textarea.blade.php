
@if(@$options['type'] == 'inset')
	<div class="col s12 m2 l12 aione-field-wrapper">
			{!!Form::textarea(str_replace(' ','_',strtolower($collection->field_title)),null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'rows'=>'8','style'=>'height: 100px'])!!}
	</div>
	<div class="error-red">	
		@if(@$errors->has())
			{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
		@endif
	</div>

@else
	<div class="col l3" style="line-height: 30px">
		{{ucfirst($collection->field_title)}}
	</div>
	<div class="col l9">
		 {!!Form::textarea(str_replace(' ','_',strtolower($collection->field_title)),null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'materialize-textarea','style'=>'border:1px solid #a8a8a8;margin-bottom: 0px'])!!}
	</div>
	<div class="error-red">	
		@if(@$errors->has())
			{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
		@endif
	</div>

@endif