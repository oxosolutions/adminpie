	@php
		$orgData = App\Model\Admin\GlobalGroup::where('id',Auth::guard('group')->user()->group_id)->first();
	@endphp
<div id="aione_footer" class="aione-footer">
	<div class="aione-row">
		@if(@$admin_footer_content)
		{!!@$admin_footer_content!!}
		@else
			&copy;{{ date("Y") }} <a href="#">{{ $orgData->name }}</a>.All rights reserved. 
		@endif
		
	</div><!-- .aione-row -->
</div><!-- #aione_content --> 