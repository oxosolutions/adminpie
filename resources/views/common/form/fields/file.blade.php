{{-- 
@if(isset($options['type']))
	@if($options['type'] == 'inset') --}}

		@include('common.form.fields.includes.field-wrapper-start')
			@include('common.form.fields.includes.field-label-start')
				@include('common.form.fields.includes.label')
			@include('common.form.fields.includes.field-label-end')
			@include('common.form.fields.includes.field-start')
				{!!Form::file(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug])!!}
				@include('common.form.fields.includes.error')
			@include('common.form.fields.includes.field-end')
		@include('common.form.fields.includes.field-wrapper-end')
	{{-- @else
		<div class="row" style="padding:10px 0px;margin-bottom: 10px">
			<div class="col l3" style="line-height: 30px">
				{{ucfirst($collection->field_title)}}
			</div>
			<div class="col l9">
				{!!Form::file(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px'])!!}
			</div>
			<div class="error-red">	
				@if(@$errors->has())
					{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
				@endif
			</div>

		</div>
	@endif --}}
{{-- @else
	<div class="row" style="padding:10px 0px;margin-bottom: 10px">
		<div class="col l3" style="line-height: 30px">
			{{ucfirst($collection->field_title)}}
		</div>
		<div class="col l9" style="position: relative;">
				@if(isset($model[str_replace(' ','_',strtolower($collection->field_title))]))
					<img src="{{asset($model[str_replace(' ','_',strtolower($collection->field_title))])}}" width="300" class="logo-image"><br/><br/><br/>
					<a href="#" class="submit-logo" data-value="{{str_replace(' ','_',strtolower($collection->field_title))}}_delete" style="cursor: pointer"><i class="fa fa-times-circle-o" style="position: absolute;font-size: 24px;color: white;top: 10px;left: 270px"></i></a>
					<button type='submit' name="{{str_replace(' ','_',strtolower($collection->field_title))}}_delete"  style="display: none" value="submit">submit</button>
				@endif
			{!!Form::file(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px'])!!}
		</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>

	</div>
@endif --}}
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.submit-logo',function(e){
		e.preventDefault();
		$('button[name='+$(this).attr('data-value')+']').click();
	})
})
	
</script>
