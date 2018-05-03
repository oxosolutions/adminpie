{{--  --}}
{{-- 
@if(@$settings != null)
	@php
		$check_login_logo = $settings->where('key' , 'login-form-show-logo')->first();
		$check_form_show_title = $settings->where('key' , 'login-form-show-title')->first();
		$check_form_show_tagline = $settings->where('key' , 'login-form-show-tagline')->first();


	@endphp
	@if($check_login_logo != null)
		@if($check_login_logo->value == '1')
			@php
				$logo = $settings->where('key' , 'logo')->first();
			@endphp
				<div style="margin: 0 auto;border-radius: 50%;overflow: hidden;height: 120px;width: 120px;position: relative;">
					<img src="{{asset($logo->value)}}" style="height: 120px;width: auto;position: absolute;left: 50%;top: 50%;    -webkit-transform: translateY(-50%) translateX(-50%);">
				</div>
		@endif
	@endif

	@if($check_form_show_title != null)
		@if($check_form_show_title->value == '1')
			@php
				$title = $settings->where('key' , 'title')->first();
			@endphp
				<div style="text-align: center;margin: 20px;color: #168dc5;font-size: 25px; line-height: 1.4;">
					{{$title->value}}
				</div>
		@endif
	@endif

	@if($check_form_show_tagline != null)
		@if($check_form_show_tagline->value == '1')
			@php
				$tagline = $settings->where('key' , 'tagline')->first();
			@endphp
				<div style="text-align: center;margin: 20px;color: #888">
					{{$tagline->value}}
				</div>
		@endif
	@endif
	
@endif --}}


 @if(@$settings != null)
	@php
		$check_login_logo = get_organization_meta('login-form-show-logo');
		$check_form_show_title = get_organization_meta('login-form-show-title');
		$check_form_show_tagline = get_organization_meta('login-form-show-tagline');


	@endphp
	@if($check_login_logo != null)
		@if($check_login_logo == '1')
			@php
				$logo = get_organization_meta('logo');

			@endphp
				<div style="margin: 0 auto;border-radius: 50%;overflow: hidden;height: 120px;width: 120px;position: relative;">
					<img src="{{asset($logo)}}" style="height: 120px;width: auto;position: absolute;left: 50%;top: 50%;    -webkit-transform: translateY(-50%) translateX(-50%);">
				</div>
		@endif
	@endif

	@if($check_form_show_title != null)
		@if($check_form_show_title == '1')
			@php
				$title = get_organization_meta('title');
			@endphp
				<div style="text-align: center;margin: 20px;color: #168dc5;font-size: 25px; line-height: 1.4;">
					{{$title}}
				</div>
		@endif
	@endif

	@if($check_form_show_tagline != null)
		@if($check_form_show_tagline == '1')
			@php
				$tagline = get_organization_meta('tagline');
			@endphp
				<div style="text-align: center;margin: 20px;color: #888">
					{{$tagline}}
				</div>
		@endif
	@endif
	
@endif