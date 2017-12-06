@if( !empty( @$post->title ) || !empty( @$post->description ) )
<div id="aione_pagetitle" class="aione-pagetitle">
	<div class="row-wrapper">
		<div class="ar">
			@if(@$design_settings['pagetitle_show_title'] == 1)
				@if( !empty( @$post->title ) )
					<h4 class="aione-page-title pb-20 m-0 aione-align-center">{{@$post->title}}</h4>
				@endif
			@endif
			@if(@$design_settings['pagetitle_show_description'] == 1)
				@if( !empty( @$post->description ) )
					<p class="aione-page-description font-size-16 aione-align-center">{{@$post->description}}</p>
				@endif
			@endif
		</div>
	</div><!-- .row-wrapper -->
</div><!-- #aione_header -->
@endif

