@if(@$design_settings['topbar_left_widgets'] || @$design_settings['topbar_right_widgets'])
	<div id="aione_topbar" class="aione-topbar">
		<div class="row-wrapper">
			<div class="ar p-10">
				<div class="ac l50 m50 s100 left-content">
					@if(@$design_settings['topbar_left_widgets'])
						@foreach (@$design_settings['topbar_left_widgets'] as $widget_key => $widget)
							<div id="" class="aione-topbar-item">
								{!! @$widget['widget_content'] !!}
							</div><!-- .aione-topbar-item -->
						@endforeach
					@endif
				</div>
				<div class="ac l50 m50 s100 right-content">
					@if(@$design_settings['topbar_right_widgets'])
						@foreach (@$design_settings['topbar_right_widgets'] as $widget_key => $widget)
							<div id="" class="aione-topbar-item">
								{!! @$widget['widget_content'] !!}
							</div><!-- .aione-topbar-item -->
						@endforeach
					@endif
				</div>
			</div>
		</div><!-- .row-wrapper -->
	</div><!-- #aione_header -->
@endif