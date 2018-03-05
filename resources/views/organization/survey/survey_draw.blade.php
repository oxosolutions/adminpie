@extends('layouts.front')
@section('content')
<style type="text/css">
	.indicater-wrapper{
		position: absolute;right: 0;bottom:0;left:0;font-size: 9px;cursor: pointer
	}
	.indicater-wrapper .indicater{
		width: 100%;height: 4px;position: relative;
	}
	.indicater-wrapper .percentage{
		position: absolute;min-height: 4px;left: 0;width: 30%
	}
	.indicater-wrapper .percentage-text{
		display: none;
		position: absolute;
		width: 100%
	}

	.indicater-wrapper.active .percentage-text{
		display: block;
		color: #676767
	}
	.indicater-wrapper.active .indicater{
		height: 15px;margin-top: 10px
	}
	.indicater-wrapper.active .percentage{
		min-height: 15px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.indicater-wrapper').click(function(){
			$(this).toggleClass('active');
		})
	})
</script>
<div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
@include('organization.survey.survey_draw.messages')
@if(!empty($survey) && empty($error))
	@include('organization.survey.survey_draw.sidebar')
	<div class="aione-float-left aione-border" style="width: calc( 100% - 360px )">
		{!! Form::open(['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post'])!!}
			<input type="hidden" name="form_id" value="{{$form_id}}" >
					<input type="hidden" name="ip_address" value="{{Request::ip()}}" >
					<input type="hidden" name="survey_submitted_from" value="web" >
					@php
					 if(Auth::guard('org')->check()){
						echo "<input type='hidden' name='survey_submitted_by' value='".Auth::guard('org')->user()->id."' >";
					 }
					 if(Session::has('section')){
						$section_array = Session::get('section');
						$key = array_keys($section_array);
						if(count($key)==1){
							echo '<input type="hidden" name="survey_status" value="completed" >';
						}else{
							echo '<input type="hidden" name="survey_status" value="incompleted" >';
						}
						$section_id = array_shift($key);
						$section_slug = $section_array[$section_id];
					}
					if(Session::has('field')){
						$fields = Session::get('field');
						$field_keys = array_keys($fields);
						if(count($field_keys)==1){
							echo '<input type="hidden" name="survey_status" value="completed" >';
						}else{
							echo '<input type="hidden" name="survey_status" value="incompleted" >';
						}
 						$get_field_id = array_shift($field_keys);
 					}
					@endphp
							@if(Session::has('field'))
								<input type="hidden" name="field_id" value="{{$get_field_id}}" >
								@if(!empty($current_data))
								{{-- {{dd($current_data)}} --}}
								{!! FormGenerator::GenerateField($fields[$get_field_id],$current_data,'','org') !!}

								@else
								{!! FormGenerator::GenerateField($fields[$get_field_id],[],'','org') !!}

								@endif

							@elseif(Session::has('section'))
								<input type="hidden" name="section_id" value="{{$section_id}}" >
								{!! FormGenerator::GenerateSection($section_slug,[],'','org') !!}
							@else					
								{!! FormGenerator::GenerateForm($survey_slug,[],'','org') !!}
								<input type="hidden" name="survey_status" value="completed" >
							@endif
						
						{{-- <input type="hidden" name="form_slug" value="{{$slug}}" > --}}
						<input type="submit" value="{{@$survey_setting['form_save_button_text']}}">
					{!! Form::close() !!}
				
		

	</div>
@endif
</div>
@endsection