@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
			'show_page_title' => 'yes',
			'show_add_new_button' => 'no',
			'show_navigation' => 'yes',
			'add_new' => '+ Add Feedback',
			'page_title' => 'View Survey  <span>'.get_survey_title(request()->route()->parameters()['form_id']).'</span>',
		); 
@endphp
@include('common.pageheader',$page_title_data) 
	@if(Session::has('sucess'))
		<div class='aione-message aione-message-success'> {{Session::get('sucess')}}</div>
	@endif
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('organization.survey._tabs')
		@if(!empty($error))
		<div class="aione-message warning">
            {{$error}}
        </div>

		@elseif(!@$permission)
			<div class='aione-message aione-message-error'>Access Denied</div>
		@else
			{!! Form::model($slug,['route' => 'view.filled.survey', 'class'=> 'form-horizontal','method' => 'post'])!!}
				{!! FormGenerator::GenerateForm($slug,[],'','org') !!}
				<input type="hidden" name="form_id" value="{{$form_id}}" >
				<input type="hidden" name="form_slug" value="{{$slug}}" >
			{!! Form::close() !!}
		@endif

	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		{{-- <script type="text/javascript">
			$('.hide-field').parents('.field-wrapper').hide();
			
			$('.show-suboptions').click(function() {
			    if( $(this).is(':checked')) {
			        $(this).parents('.field-wrapper').next().show();
			    } else {
			        $(this).parents('.field-wrapper').next().hide();
			    }

			}); 

			$('.radio-show-hide').change(function(){
				if($(this).val() == 'role_based'){
					$('.role_list').parents('.field-wrapper').show();
					$('.individual_list').parents('.field-wrapper').hide();

				}
				if($(this).val() == 'individual_based'){
					$('.individual_list').parents('.field-wrapper').show();
					$('.role_list').parents('.field-wrapper').hide();
				}
				
			})
		</script> --}}
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection