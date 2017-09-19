<div class="container" style="padding: 10px">
	@if($document->DocumentLayout != null)
		@if($document->DocumentLayout['header'] != null)
			{!! $document->DocumentLayout['header'] !!}
		@else
			
		@endif

		@if($document->DocumentTemplate['content'] != null)
			{!! $document->DocumentTemplate['content'] !!}
		@endif


		@if($document->DocumentLayout['footer'] != null)
			{!!  $document->DocumentLayout['footer']  !!}
		@else

		@endif
	@endif
</div>