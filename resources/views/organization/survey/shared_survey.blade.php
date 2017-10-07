@extends('layouts.survey')
@section('content')
@php
	$page_title_data = array(
			'show_page_title' => 'yes',
			'show_add_new_button' => 'no',
			'show_navigation' => 'yes',
			'page_title' => 'View Survey',
			'add_new' => '+ Add Feedback'
		);
@endphp
<style>
.aione-progress-bg {
	background: rgba(255,0,0,0.1);
	min-height: 4px;
}


.aione-progress-inside {
	width: 1%;
	height: 5px;
	background: #22adba;
	background: rgba(0,128,0,0.9);;
	background-size: 10% 100%, 100% 100%;
}

</style>



{{-- @include('common.pageheader',$page_title_data)  --}}
	@if(Session::has('sucess'))
		<div class='aione-message aione-message-success'> {{Session::get('sucess')}}</div>
	@endif
{{-- @include('common.pagecontentstart') --}}
	{{-- @include('common.page_content_primary_start') --}}
		{{-- @include('organization.survey._tabs') --}}
		{{-- @if(!@$permission)
			<div class='aione-message aione-message-error'>Access Denied</div>
		@else --}}
		@if(!empty($survey_setting['survey_timer'])  && ($survey_setting['survey_timer']==true))
			@if(!empty($survey_setting['timer_type']) && ($survey_setting['timer_type']=="survey_expiry_time"))
				<h3>  {{$survey_setting['survey_time_lefts']}} Survey Expired</h3>
		 	@endif

		@endif
		@if(!empty($error))
				@if(is_array($error))
					<h3 style="color:red;">{{implode($error)}} </h3>
					@else
						<h3 style="color:red;">{{$error}} </h3>
				@endif
		@else

			<div class="aione-progress-bar">
				<div class="aione-progress-bg">
					<div class="aione-progress-inside" >

					</div>
				</div>
			</div>
			<input id="viewType" type="hidden" name="type" value="survey">
				{!! Form::model($slug,['route' => 'filled.survey', 'class'=> 'survey-form form-horizontal','method' => 'post'])!!}
					<input type="hidden" name="form_id" value="{{$form_id}}" >
					<input type="hidden" name="ip_address" value="{{Request::ip()}}" >
					@php 
						// dump($section_array = Session::get('section'));
						//  dump($key = array_keys($section_array));
						
						//  dump($section_id = array_shift($key));
						//  echo $section_slug = $section_array[$section_id];

					@endphp
					{{-- <input type="text" name="section_slug" value="{{$section_slug}}" >
					<input type="text" name="section_id" value="{{$section_id}}" > --}}


					
					{{-- {!! FormGenerator::GenerateSection($section_slug,[],'','org') !!} --}}
					{!! FormGenerator::GenerateForm($slug,[],'','org') !!}
					<input type="hidden" name="form_slug" value="{{$slug}}" >
					<input type="submit" value="{{@$survey_setting['form_save_button_text']}}">
				{!! Form::close() !!}
		@endif
		<script>
			
$(document).ready(function(){

	viewType = $("#viewType").val();
	if(viewType=="survey")
	{
		var nameArray = {};
		var maxIndex =0;
			$('.survey-form input , select, textarea').each(function(index){
				name = $.trim($(this).attr('class'));
				type = $.trim($(this).attr('type'));
				if(name =='_token'|| name =='survey_started_on'|| name =='survey_id'|| name =='code'|| name=='button')
				{}
				else{
						if(name)
						{
							nameArray[name] = name;
						}
					}
				maxIndex = index;
			});
			// total = nameArray.length;
			// alert(maxIndex);
			console.log(nameArray);
		$('.survey-form ').on('blur','input, select, textarea',function(){
				countQues =0;

				$.each(nameArray, function( index, value ) {  


					type = $("."+value).attr('type');
					//console.log('type---'+type);

					if(type =="radio" )
					{
						val = $("."+value+":checked").val();

					}else{
					val  = $.trim($("."+value).val());
					//console.log(val);
					}

					if(val)
					{
						console.log(value);
						// mark = $("#mark_"+value).html('<b style="color:Green;">Filled</b>');
						mark = $("#mark_"+value).parent().css({'background':'rgba(0, 128, 0, 0.2)'});
						console.log(mark);
							countQues++;	
					}else{
						$("#mark_"+value).parent().css({'background':'rgba(255, 0, 0, 0.2)'});
						// $("#mark_"+value).html('<b style="color:red;">Pending</b>');
					}
				});
					percentage = countQues/maxIndex*100;

				$("#sum_filled_ques").html(countQues);
				$("#progress").val(countQues);
				$('.aione-progress-inside').css({'width':percentage+'%'});

				// $( window ).bind("resize", function(){
				//     $(".aione-progress-inside").width( 600 );
				// });

			});


	}
});

		</script>
		{{-- @endif --}}

	{{-- @include('common.page_content_primary_end') --}}
	{{-- @include('common.page_content_secondry_start') --}}
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
	{{-- @include('common.page_content_secondry_end') --}}
{{-- @include('common.pagecontentend') --}}
@endsection