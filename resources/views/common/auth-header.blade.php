@php

$check_login_logo = @get_organization_meta('login-form-show-logo');
$check_form_show_title = @get_organization_meta('login-form-show-title');
$check_form_show_tagline = @get_organization_meta('login-form-show-tagline');

$logo = @get_organization_meta('logo');
$title = @get_organization_meta('title');
$tagline = @get_organization_meta('tagline');


@endphp
<style type="text/css">
	
</style>
@if($check_login_logo != null)
	@if($check_login_logo == '1')
		<div class="site-logo">
			<img src="{{asset($logo)}}" >
		</div>
	@endif
@endif
@if($check_form_show_title != null)
	@if($check_form_show_title == '1')
		<div class="site-title">
			{{$title}}
		</div>
	@endif
@endif
@if($check_form_show_tagline != null)
	@if($check_form_show_tagline == '1')
		<div class="site-tagline">
			{{$tagline}}
		</div>
	@endif
@endif
