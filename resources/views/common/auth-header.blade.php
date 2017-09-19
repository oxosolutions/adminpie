@if($settings != null)
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
				<div style="text-align: center;margin: 20px;color: #888">
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
	
@endif