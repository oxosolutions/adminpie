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
<div id="aione_footer" class="aione-footer dark">
	{{-- <div class="wrapper">
		<div class="ar">
			@foreach (@$design_settings['footer_widgets'] as $widget_key => $widget)
				@if(1)
					<div class="ac {{@$column_class}}">
						<div class="footer-widget-title">
							<h5>{!!@$widget['widget_title']!!}</h5>
						</div>
						<div class="footer-widget-content">
							{!!@$widget['widget_content']!!}
						</div>
					</div>
				@endif				
			@endforeach
		</div>
	</div><!-- .row-wrapper --> --}}
	<div class="wrapper aione-align-left font-weight-100">
	<div class="ar pv-30 pl-5p pr-5p">
		<div class="ac l25 m50 s100">
			<h4 class="mt-10  white">About</h4>
			<nav id="aione_nav" class="aione-nav vertical dark slide-up">
				<ul id="aione_menu" class="aione-menu">
					<li class="aione-nav-item level0">
						<a href="index.html">
						<span class="nav-item-text" data-hover="Home">Home
						</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="about.html">
						<span class="nav-item-text" data-hover="About">About
						</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://aioneframework.com/docs">
						<span class="nav-item-text" data-hover="Docs">Docs</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://aioneframework.com/play">
						<span class="nav-item-text" data-hover="Play">Play</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://aioneframework.com/builder">
						<span class="nav-item-text" data-hover="Builder">Builder
						</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="ac l25 m50 s100">
			<h4 class=" mt-10  white">Ventures</h4>
			<nav id="aione_nav" class="aione-nav vertical dark slide-up">
				<ul class="aione-menu ">
					<li class="aione-nav-item level0">
						<a href="http://oxosolutions.com/" target="_blank">
						<span class="nav-item-text" data-hover="OXO Solutions">OXO Solutions</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://makemyfolio.com/" target="_blank">
						<span class="nav-item-text" data-hover="MakeMyFolio">MakeMyFolio
						</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://darlic.com/" target="_blank">
						<span class="nav-item-text" data-hover="Darlic">Darlic</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://adminpie.com/" target="_blank">
						<span class="nav-item-text" data-hover="AdminPie">AdminPie
						</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://populaa.com/" target="_blank">
						<span class="nav-item-text" data-hover="Populaa">Populaa
						</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="ac l25 m50 s100">
			<h4 class="mt-10  white">Initiatives</h4>
			<nav id="aione_nav" class="aione-nav vertical dark slide-up">
				<ul class="aione-menu ">
					<li class="aione-nav-item level0">
						<a href="http://dkranti.com/" target="_blank">
						<span class="nav-item-text" data-hover="Dkranti">Dkranti</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://darlic.org/" target="_blank">
						<span class="nav-item-text" data-hover="Darlic.org">Darlic.org
						</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://punjabimaaboli.com/" target="_blank">
						<span class="nav-item-text" data-hover="Punjabi Maa Boli">Punjabi Maa Boli</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="http://sikhvichardhara.com/" target="_blank">
						<span class="nav-item-text" data-hover="Sikh Vichardhara">Sikh Vichardhara
						</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="ac l25 m50 s100">
			<h4 class=" mt-10  white">Tools</h4>
			<nav id="aione_nav" class="aione-nav vertical dark slide-up">
				<ul class="aione-menu ">
					<li class="aione-nav-item level0">
						<a href="http://aioneframework.com/resources" target="_blank">
						<span class="nav-item-text" data-hover="Resources">Resources</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="" target="_blank">
						<span class="nav-item-text" data-hover="">
						</span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="" target="_blank">
						<span class="nav-item-text" data-hover=""></span>
						</a>
					</li>
					<li class="aione-nav-item level0">
						<a href="" target="_blank">
						<span class="nav-item-text" data-hover="">
						</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>
</div><!-- .aione-footer -->
@endif

