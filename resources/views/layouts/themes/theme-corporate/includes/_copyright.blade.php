<div id="aione_copyright" class="aione-copyright">
	<div class="aione-row">
		@if(!empty(@$design_settings['copyright_content']))
			{!!@$design_settings['copyright_content']!!}
		@else
			&copy;{{ date("Y") }} {!!get_organization_meta('title')!!}. All rights reserved.
		@endif
	</div><!-- .aione-row -->
</div>