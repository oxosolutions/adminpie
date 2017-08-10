<!DOCTYPE html>
<html lang="en">
<head>
	@include('components._head')
	
</head>
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-theme-arcane">
		<div class="aione-row">
			
			<div id="aione_main" class="aione-main">
				<div class="aione-row">
					<div id="aione_content" class="aione-content">
						<div class="aione-row">
						
							@yield('content')
							
							@include('components._footer')
							
						</div><!-- .aione-row -->
					</div><!-- #aione_content -->
					<div class="clear"></div><!-- .clear -->
				</div><!-- .aione-row -->
			</div><!-- #aione_main -->
			<div class="clear"></div><!-- .clear -->
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->
	
	@include('components._footerscripts')

</body>
</html>