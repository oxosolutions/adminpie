<div id="aione_footer" class="aione-footer">
	<div class="aione-row">
		@if(@$admin_footer_content)
		{!!@$admin_footer_content!!}
		@else
			&copy;{{ date("Y") }} <a href="http://oxosolutions.com/" target="_blank">OXO Solutions</a>.All rights reserved. 
		@endif
		
	</div><!-- .aione-row -->
</div><!-- #aione_content --> 