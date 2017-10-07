<!DOCTYPE html>
<html lang="en">
@php
	$site_logo = App\Model\Organization\OrganizationSetting::getSettings('logo');
	$site_title = App\Model\Organization\OrganizationSetting::getSettings('title');

@endphp
	@php
		$slug = request()->route()->parameters();
		$meta = [];
	@endphp
	@if(@$slug['slug'])
		@php
			$data = App\Model\Organization\Page::where('slug',$slug)->with('pageMeta')->first();
		@endphp
		@foreach(@$data->pageMeta->toArray() as $k => $v)
			@php
				$meta[$v['key']] = $v['value'];
			@endphp
		@endforeach
	@endif

	@if(@$meta['select_menu'])
		@php
			$menu = App\Model\Organization\Cms\Menu\Menu::where('id',$meta['select_menu'])->with('menuItem')->get();
		@endphp
	@endif
@include('layouts.front._head')
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-theme-arcane">
		<div class="aione-row">
			@if(@$meta['show_topbar'] == 1)
				@include('layouts.front._topbar')
			@endif
			@if(@$meta['show_header'] == 1)
				@include('layouts.front._header')
			@endif
			{{-- @if(@$meta['show_page_title'] == 1)  --}}
				@include('layouts.front._pagetitle')
			{{-- @endif --}}
			@if(@$meta['show_slider'] == 1)
				@include('layouts.front._slider')
			@endif
			<div id="aione_main" class="aione-main ">
				<div class="aione-row">
					<div id="aione_sidebar" class="aione-sidebar">
						<div class="aione-row">
							@if(@$meta['show_sidenav'] == 1)
								@include('layouts.front._sidebar')
							@endif
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
				</div><!-- .aione-row -->
			</div><!-- #aione_main -->
			@if(@$meta['show_footer'] == 1)
				@include('layouts.front._footer')
			@endif
			@if(@$meta['show_copyright'] == 1)
				@include('layouts.front._copyright')
			@endif
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->
	
	@include('components._footerscripts')

</body>
<style type="text/css">
	.aione-theme-arcane .aione-topbar{
		background-color: #1C201A;
		color: white
	}
	.aione-theme-arcane .aione-topbar .right-content{
		text-align: right
	}
	.aione-theme-arcane .aione-topbar .aione-topbar-item{
		display: inline-block;
		padding: 0 10px
	}
	.aione-theme-arcane .aione-topbar{
		padding: 10px 0;
	}
	.aione-theme-arcane .aione-header{
		position: inherit;
		height: auto;
		background-color: white;
		padding: 20px 0;
	}
	.aione-theme-arcane .aione-header #aione_header_logo img{
	    height: 60px;
	}
	.aione-theme-arcane .aione-header  .aione-header-item{
		display: inline-block;
		padding: 0 10px
	}
	.aione-theme-arcane .aione-header #aione_header_title h4{
		margin:0;
		font-weight: 800;
		color: #168DC5;;
	}
	.aione-theme-arcane .aione-header #aione_header_title p{
		font-style: italic;
    	font-size: 16px;
        color: #676767;
	}
	.aione-theme-arcane .aione-header .right-content{
		
    	margin: 0;
	}
	.aione-theme-arcane .aione-header .right-content i{
	    vertical-align: top;
	    margin: 0 5px;
	    font-size: 20px;
	    color: #757575;
        line-height: 1.7;
	}
	.aione-theme-arcane .aione-header  .aione-header-item h6{
		margin: 0;
	    font-size: 16px;
	    font-weight: 500;
	    color: #676767;
	    line-height: 2;
	}
	.aione-theme-arcane .aione-header  .aione-header-item p{
	    font-size: 12px;
	    color: #757575;
    	font-weight: 300;
	}
	.aione-theme-arcane .aione-header .aione-header-item .aione-header-button{

	}
	.aione-theme-arcane .aione-header .aione-header-feature{
		display: inline-block;
	}
	.aione-theme-arcane .aione-footer{
		text-align: left;
		padding: 50px 30px;
	    background-color: #1F1F1F;
	    margin-bottom: 0
	}
	.aione-theme-arcane .aione-footer #aione_footer_title > div{
		display: inline-block;
	}
	.aione-theme-arcane .aione-footer #aione_footer_title img{
		height: 42px;
	}
	.aione-theme-arcane .aione-footer #aione_footer_title .title{
		vertical-align: top;
	}
	.aione-theme-arcane .aione-footer #aione_footer_title .title h5,
	.aione-theme-arcane .aione-footer #aione_footer_title h5{
		margin: 0;
	    line-height: 42px;
	    color: #e8e8e8;
	}
	.aione-theme-arcane .aione-footer #aione_footer_address{
		color: #999;
		line-height: 3;
	}
	.aione-theme-arcane .aione-footer #aione_footer_address i{
		color: #e8e8e8;
	}
	.aione-theme-arcane .aione-pagetitle{
		
		background-image: url('https://s3.envato.com/files/232812641/consulting_theme/images/background/page-title-3.jpg');
	}

	.aione-theme-arcane .aione-pagetitle > .row-wrapper{
		padding: 28px 0;
    	background-color: rgba(17, 17, 17, 0.69);
	}
	.aione-theme-arcane .aione-pagetitle h4.page-title{
		text-align: center;
	    font-weight: 300;
	    color: white;
	    margin: 0;
	    margin-bottom: 10px;
	}
	.aione-theme-arcane .aione-pagetitle p.page-subtitle{
		text-align: center;
	    font-size: 18px;
	    font-weight: 400;
	    color: #e8e8e8;
	}
	.aione-theme-arcane .aione-copyright{
		padding: 25px;
	    background-color: #282828;
	    color: #838383;
	 }
</style>

@php
	$slug = request()->route()->parameters();
@endphp
@if(@$slug['slug'])
	@php
		$data = App\Model\Organization\Page::where('slug',$slug)->with('pageMeta')->first();
	@endphp
	@foreach(@$data->pageMeta->toArray() as $k => $v)
		@if($v['key'] == 'js_code')
			@if($v['value'] != null)
				<script type="text/javascript">
					$(document).ready(function(){
						{!! $v['value'] !!}
					});
				</script>
			@endif
		@endif
	@endforeach
@endif
</html>