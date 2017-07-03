@if(isset($options['type']))
	@if($options['type'] == 'inset')
		<div class="col s12 m2 l12 aione-field-wrapper">
			 {!!Form::password(str_replace(' ','_',strtolower($collection->field_title)),['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')])!!}
		</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>
	@else
		<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				{{ucfirst($collection->field_title)}}
			</div>
			<div class="col l9">
				{!!Form::password(str_replace(' ','_',strtolower($collection->field_title)),['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px'])!!}
			</div>
			<div class="error-red">	
				@if(@$errors->has())
					{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
				@endif
			</div>

		</div>
	@endif
@else
	<div class="row" style="padding:10px 0px">
		<div class="col l3" style="line-height: 30px">
			{{ucfirst($collection->field_title)}}
		</div>
		<div class="col l9">
			{!!Form::password(str_replace(' ','_',strtolower($collection->field_title)),['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px'])!!}
		</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>

	</div>
@endif