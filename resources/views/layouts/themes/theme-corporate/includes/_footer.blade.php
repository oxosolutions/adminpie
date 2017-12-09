@php
	$footer_widgets = $design_settings['footer_widgets'];
	$count = 0;
	foreach ($footer_widgets as $key => $widget) {
		if(1){
			$count++;
		}
	}
	$column_class = "s100 m".round(100/$count)." l".round(100/$count);
	// dump($column_class);
@endphp
@if($count > 0)
<div id="aione_footer" class="aione-footer">
	<div class="wrapper">
		<div class="ar">
			@foreach (@$design_settings['footer_widgets'] as $widget_key => $widget)
				@if(1)
					<div class="ac {{@$column_class}}">
						<div class="footer-widget-title">
							<h5>{!!@$widget['widget_title']!!}</h5>
						</div>
						<div class="footer-widget-content">
							{!!@$widget['widget_content']!!}
						</div>
					</div>
				@endif				
			@endforeach
		</div>
	</div><!-- .row-wrapper -->
</div><!-- .aione-footer -->
@endif

