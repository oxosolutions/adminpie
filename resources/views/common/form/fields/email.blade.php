

		@include('common.form.fields.includes.field-wrapper-start')
			@include('common.form.fields.includes.field-label-start')
				@include('common.form.fields.includes.label')
			@include('common.form.fields.includes.field-label-end')
			@include('common.form.fields.includes.field-start')
				{!!Form::email(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug])!!}
				@include('common.form.fields.includes.error')
			@include('common.form.fields.includes.field-end')
		@include('common.form.fields.includes.field-wrapper-end')
	{{-- @else
		<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				{{ucfirst($collection->field_title)}}
			</div>
			<div class="col l9">
				{!!Form::email(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px'])!!}
			</div>
			<div class="error-red">	
				@if(@$errors->has())
					{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
				@endif
			</div>

		</div>
	@endif --}}
