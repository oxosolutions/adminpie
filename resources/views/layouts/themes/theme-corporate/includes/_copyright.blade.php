{{-- <div id="aione_copyright" class="aione-copyright">
	<div class="wrapper aione-align-center line-height-30">
		@if(!empty(@$design_settings['copyright_content']))
			{!!@$design_settings['copyright_content']!!}
		@else
			&copy;{{ date("Y") }} {!!get_organization_meta('title')!!}. All rights reserved.
		@endif
	</div><!-- .aione-row -->
</div><!-- .aione-copyright -->
 --}}
<div id="aione_copyright" class="aione-copyright dark">
	<div class="wrapper aione-align-center font-weight-400 line-height-30">
		@if(!empty(@$design_settings['copyright_content']))
			{!!@$design_settings['copyright_content']!!}
		@else
			&copy;{{ date("Y") }} {!!get_organization_meta('title')!!}. All rights reserved.
		@endif
	</div><!-- .aione-row -->
</div><!-- .aione-copyright -->

{{-- <div id="aione_copyright" class="aione-copyright dark">
	<div class="wrapper aione-align-center font-weight-400 line-height-30">
		©2017 <a href="http://oxoitsolutions.com" target="_blank">OXO IT SOLUTIONS PVT. LTD.</a> All rights reserved. Built with <a href="https://aioneframework.com" target="_blank">Aione Framework</a>.
	</div>
</div> --}}