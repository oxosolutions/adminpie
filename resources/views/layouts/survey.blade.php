<!DOCTYPE html>
<html lang="en">
@php
	$site_logo = App\Model\Organization\OrganizationSetting::getSettings('logo');
	$site_title = App\Model\Organization\OrganizationSetting::getSettings('title');

@endphp 
	

@include('layouts.front._head')
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-theme-arcane">
		<div class="aione-row">
			<div id="aione_topbar" class="aione-topbar">
				<div class="aione-row">
					{{-- @include('components.topHeader')  --}}
					<div class="left">
						ashish9436@gmail.com
					</div>
					<div class="right">
						Buttons
					</div>
				</div><!-- .aione-row -->
			</div><!-- #aione_header -->
			@include('layouts.front._header')
			<div id="aione_main" class="aione-main ">
				<div class="aione-row">
					<div id="aione_sidebar" class="aione-sidebar">
						<div class="aione-row">
							
						
						</div><!-- .aione-row -->
					</div><!-- #aione_sidebar -->
					<div id="aione_content" class="aione-content" >
						<div class="aione-row">
					        @yield('content')
							{{-- @yield('pagetitle') --}}
              				<div class="clear"></div><!-- .clear -->							
							{{-- @include('components._footer') --}}
							
						</div><!-- .aione-row -->
					</div><!-- #aione_content -->
					<div class="clear"></div><!-- .clear -->
					<div class="clear"></div><!-- .clear -->
				</div><!-- .aione-row -->
			</div><!-- #aione_main -->
			<div class="clear"></div><!-- .clear -->
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->
	
	@include('components._footerscripts')

</body>
</html>