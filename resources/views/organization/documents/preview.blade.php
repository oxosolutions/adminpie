<style type="text/css">
	.aione-main-container{
		background-color: grey
	}
	.aione-main-container > .container{
		width: 70%;
		background-color: white;
		margin: auto;
	}
</style>
<div class="aione-main-container">
	<div class="container" style="padding: 10px">
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