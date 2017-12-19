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
<div id="aione_footer" class="aione-footer {{@$design_settings['footer_theme']}}">
	
	<div class="wrapper aione-align-left font-weight-100">
		<div class="ar pv-30 pl-5p pr-5p">
			@foreach (@$design_settings['footer_widgets'] as $widget_key => $widget)
				@if(1)
					<div class="ac {{@$column_class}}">
						
						<h5 class="mt-10 white">{!!@$widget['widget_title']!!}</h5>
						
						<nav id="aione_nav" class="aione-nav vertical dark slide-up">
							<ul id="aione_menu" class="aione-menu">
								{!!@$widget['widget_content']!!}
							</ul>
						</nav>
					</div>
				@endif				
			@endforeach
		</div>
	</div><!-- .row-wrapper -->
	
</div>
</div><!-- .aione-footer -->
@endif

