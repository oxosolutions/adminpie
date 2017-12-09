<div id="aione_copyright" class="aione-copyright">
	<div class="wrapper aione-align-center line-height-30">
		@if(!empty(@$design_settings['copyright_content']))
			{!!@$design_settings['copyright_content']!!}
		@else
			&copy;{{ date("Y") }} {!!get_organization_meta('title')!!}. All rights reserved.
		@endif
	</div><!-- .aione-row -->
</div><!-- .aione-copyright -->