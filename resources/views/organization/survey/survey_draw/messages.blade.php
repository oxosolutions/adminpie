@if(Session::has('sucess'))
	<div class="aione-message success">
		<ul class="aione-messages aione-align-center">
			<li class="aione-align-center">{{Session::get('sucess')}}</li>
		</ul>
	</div>
@endif 
 
@if(isset($survey_setting['survey_timer'])  && ($survey_setting['survey_timer']==true))
	@if(isset($survey_setting['timer_type']) && ($survey_setting['timer_type']=="survey_expiry_time"))
		<h3>  {{$survey_setting['survey_time_lefts']}} Survey Expired</h3>
 	@endif
@endif
@if(!empty($error))
	@if(is_array($error))
		<div class="aione-message error">
		    <ul class="aione-messages">
		        <li>{{implode($error)}} </li>
		    </ul>
		</div>
	@else
		<div class="aione-message error">
		    <ul class="aione-messages">
		        <li>{{$error}} </li>
		    </ul>
		</div>
	@endif
	@if(!empty($error['survey_authorization_required']))
		<a href="{{route('org.login')}}"> Login </a>
	@endif
@endif