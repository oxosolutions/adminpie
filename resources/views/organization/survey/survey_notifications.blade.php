@extends('layouts.main')
@section('content')
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
	<style type="text/css">
	
.btn-reset{
	position: relative;
    left: 118px;
    bottom: 95px;
}
	</style>
		@if(!@$permission)
		<div class="aione-message warning">
            	{{ __('survey.survey_with_no_permisson') }}
        </div>
		@else
			<div class="survey-settings-wrapper">
				<div class="ar">
					<div class="ac l100 m100 s100">
						{!! Form::model(@$model,['route' => ['save.survey.notifications',request()->route()->parameters()['id']], 'class'=> 'form-horizontal','method' => 'post'])!!}
							{!! FormGenerator::GenerateForm('survey_notification_form',[],$model) !!}
							<input type="submit" class='btn-reset' name="reset" value="Reset" >
						{!! Form::close() !!}
					</div>
				</div>
			</div> <!-- .survey-settings-wrapper -->
		@endif
		
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
    $(function(){
        $('.field-wrapper-send_notification_to_text, .field-wrapper-send_to_role').hide();
        setTimeout(function(){
            $('.send_notification_to:checked').each(function(){
               $(this).trigger('click') ;
            });
        }, 300);
        
        $('body').on('click','.send_notification_to', function(){
            if($(this).is(':checked')){
                if($(this).val() == 'email'){
                    $(this).parents('.repeater-row').find('.field-wrapper-send_notification_to_text').show();
                    $(this).parents('.repeater-row').find('.field-wrapper-send_to_role').hide();
                }else{
                    $(this).parents('.repeater-row').find('.field-wrapper-send_notification_to_text').hide();
                    $(this).parents('.repeater-row').find('.field-wrapper-send_to_role').show();
                }
            }
        });
    });
</script>
@endsection