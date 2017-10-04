<div id="aione_footer" class="aione-footer">
	<div class="aione-row">
		<div class="footer-links">
			<a href="">Home</a>
			<a href="">About</a>
			<a href="">Client</a>
		</div>
	</div>
</div>
@php
	$slug = request()->route()->parameters();
@endphp
@if(@$slug['slug'])
	@php
		$data = App\Model\Organization\Page::where('slug',$slug)->with('pageMeta')->first();
	@endphp
	@foreach(@$data->pageMeta->toArray() as $k => $v)
		@if($v['key'] == 'js_code')
			@if($v['value'] != null)
				<script type="text/javascript">
					$(document).ready(function(){
						{!! $v['value'] !!}
					});
				</script>
			@endif
		@endif
	@endforeach
@endif
<div id="aione_copyright" class="aione-copyright">
	<div class="aione-row">
		&copy;{{ date("Y") }} <a href="http://oxosolutions.com/" target="_blank">{{ $pageData->title }}</a>. All rights reserved.
	</div><!-- .aione-row -->
</div>