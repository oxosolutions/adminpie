<div class="aione-main-container">
	<div class="container">
		@if(@$document->DocumentLayout != null)
			@if(@$document->DocumentLayout['header'] != null)
				{!! $document->DocumentLayout['header'] !!}
			@endif

			@if(@$document->DocumentTemplate['content'] != null)
				{!! $document->DocumentTemplate['content'] !!}
			@endif

			@if(@$document->DocumentLayout['footer'] != null)
				{!!  $document->DocumentLayout['footer']  !!}
			@endif
		@endif
	</div>
</div>