@extends('layouts.main')
@section('content')
<style type="text/css">
	/*#field_authentication_type,#field_role_list,#field_individual_list,
	#field_start_date,#field_expire_date,
	#field_timer_type,#field_survey_duration,
	#field_response_limit,#field_response_limit_type,
	#field_survey_is_disabled,#field_survey_authorization_required,#field_survey_unauthorization_role,#field_survey_un-authorization_user,#field_invalid_survey_id,#field_empty_survey_Id,#field_survey_not_started,#field_survey_expired,#field_survey_responce_limit,#field_survey_success_messages{
		display: none
	}
	.setting-wrapper > div{
		float: left;
		width: 50%
	}*/
</style>
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Survey Settings <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Feedback'
); 
@endphp
@if(Auth::guard('admin')->check() == true)
@php

$route = 'save.form.settings';
@endphp
@else
@php

$route = 'org.save.form.settings';
@endphp
@endif
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('organization.survey._tabs')
	@include('common.page_content_primary_start')
		@if(!empty($error))
			<div class="aione-message warning">
                       	 {{$error }}
               </div>
		@elseif(!@$permission)
			{{dump('You don\'t have permission!')}}
		@else
			<div class="survey-settings-wrapper">
				<div class="ar">
					<div class="ac l50 m50 s100">
						{!! Form::model($model,['route' => ['save.survey.settings',request()->route()->parameters()['id']], 'class'=> 'form-horizontal','method' => 'post'])!!}
							{!! FormGenerator::GenerateForm('Survey_Setting_Form') !!}
						{!! Form::close() !!}		
					</div>
					<div class="ac l50 m50 s100"> 
						{!!Form::model(@$model,['route'=>[$route,request()->route()->parameters()['id']]])!!}
							{!! FormGenerator::GenerateForm('form_setting_form',['type'=>'inset']) !!}
						{!!Form::close()!!}
					</div>
				</div>
			</div> <!-- .survey-settings-wrapper -->
		@endif
		
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		
		{{-- <script type="text/javascript">
			$(document).ready(function(){

				if( $('#field_authentication_required input[type=checkbox]').is(':checked')) {
			       $('#field_authentication_type,#field_role_list,#field_individual_list ').show();
			    } else {
			        $('#field_authentication_type,#field_role_list,#field_individual_list ').hide();
			    }
				$('#field_authentication_required input[type=checkbox]').click(function() {	
					 if( $(this).is(':checked')) {
				       $('#field_authentication_type ').show();
				    } else {
				        $('#field_authentication_type,#field_role_list,#field_individual_list').hide();
				    }
				});

				if($('#field_authentication_type input[type=radio]:checked').val() == 'role_based'){
					$('#field_role_list').show();
					$('#field_individual_list ').hide();
				}
				if($('#field_authentication_type input[type=radio]:checked').val() == 'individual_based'){
					$('#field_individual_list ').show();
					$('#field_role_list').hide();
					
				}
				$('#field_authentication_type input[type=radio]').change(function(){
					if($(this).val() == 'role_based'){
						$('#field_role_list').show();
						$('#field_individual_list ').hide();
					}
					if($(this).val() == 'individual_based'){
						$('#field_role_list').hide();
						$('#field_individual_list ').show();
					}
					
				})

				if( $('#field_survey_scheduling input[type=checkbox]').is(':checked')) {
			       $('#field_start_date,#field_expire_date').show();
			    } else {
			       $('#field_start_date,#field_expire_date').hide();
			    }
				$('#field_survey_scheduling input[type=checkbox]').click(function() {
				   
				     if( $(this).is(':checked')) {
				       $('#field_start_date,#field_expire_date').show();
				    } else {
				       $('#field_start_date,#field_expire_date').hide();
				    }
				}); 

				if( $('#field_survey_timer input[type=checkbox]').is(':checked')) {
			       $('#field_timer_type,#field_survey_duration').show();
			    } else {
			       $('#field_timer_type,#field_survey_duration').hide();
			    }
				$('#field_survey_timer input[type=checkbox]').click(function() {
				    
				    if( $(this).is(':checked')) {
				       $('#field_timer_type,#field_survey_duration').show();
				    } else {
				       $('#field_timer_type,#field_survey_duration').hide();
				    }
				}); 

				if( $('#field_survey_response_limit input[type=checkbox]').is(':checked')) {
			       $('#field_response_limit,#field_response_limit_type').show();
			    } else {
			       $('#field_response_limit,#field_response_limit_type').hide();
			    }
				$('#field_survey_response_limit input[type=checkbox]').click(function() {
				    if( $(this).is(':checked')) {
				       $('#field_response_limit,#field_response_limit_type').show();
				    } else {
				       $('#field_response_limit,#field_response_limit_type').hide();
				    }
				}); 

				if( $('#field_custom_error_messages input[type=checkbox]').is(':checked')) {
			       $('#field_survey_is_disabled,#field_survey_authorization_required,#field_survey_unauthorization_role,#field_survey_un-authorization_user,#field_invalid_survey_id,#field_empty_survey_Id,#field_survey_not_started,#field_survey_expired,#field_survey_responce_limit,#field_survey_success_messages').show();
			    } else {
			       $('#field_survey_is_disabled,#field_survey_authorization_required,#field_survey_unauthorization_role,#field_survey_un-authorization_user,#field_invalid_survey_id,#field_empty_survey_Id,#field_survey_not_started,#field_survey_expired,#field_survey_responce_limit,#field_survey_success_messages').hide();
			    }
				$('#field_custom_error_messages input[type=checkbox]').click(function() {
					if( $(this).is(':checked')) {
				       $('#field_survey_is_disabled,#field_survey_authorization_required,#field_survey_unauthorization_role,#field_survey_un-authorization_user,#field_invalid_survey_id,#field_empty_survey_Id,#field_survey_not_started,#field_survey_expired,#field_survey_responce_limit,#field_survey_success_messages').show();
				    } else {
				       $('#field_survey_is_disabled,#field_survey_authorization_required,#field_survey_unauthorization_role,#field_survey_un-authorization_user,#field_invalid_survey_id,#field_empty_survey_Id,#field_survey_not_started,#field_survey_expired,#field_survey_responce_limit,#field_survey_success_messages').hide();
				    }
				});	
			})
			  
		</script>
		 --}}
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection