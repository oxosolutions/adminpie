<style type="text/css">
	.aione-topbar-item p {
		margin-top: 8px;
	}
	.aione-topbar-logo-item{
		height: 60px;
	    width: 60px;
	    border-radius: 100%;
	}
	.aione-header-logo{
		width: 40%;
    	float: left;
	}
	.aione-header-menu #aione_menu{
		float: right
	}
	.aione-header-logo .grey{
		margin-top: 2px;
	}
</style>
@if(@$design_settings['topbar_left_widgets'] || @$design_settings['topbar_right_widgets'])
	<div id="aione_topbar" class="aione-topbar">
		
		<div class="row-wrapper">
			<div class="ar">
				<div class="ac l50 m50 s100 left-content">
					@if(@$design_settings['topbar_left_widgets'])
						@foreach (@$design_settings['topbar_left_widgets'] as $widget_key => $widget)
							<div id="" class="aione-topbar-item">
								<p>{!! @$widget['widget_content'] !!}</p>
							</div>
						@endforeach
					@endif
				</div>
				<div class="ac l50 m50 s100 right-content">
					@if(@$design_settings['topbar_right_widgets'])
						@foreach (@$design_settings['topbar_right_widgets'] as $widget_key => $widget)
							<div id="" class="aione-topbar-item" >
								{!! @$widget['widget_content'] !!}
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div><!-- .row-wrapper -->
	</div><!-- #aione_header -->
@endif