@php
	$link=$_SERVER['REQUEST_URI'];
@endphp

<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal">
	@php
	$index = 0;
	$permisson = drawSidebar::checkPermisson();
	@endphp
	
	@foreach(drawSidebar::drawSidebar() as $key => $sidebar)
		@if($sidebar->name == 'Account')
			@php
				$routes = [];
			@endphp
			@foreach($sidebar->subModule as $ke => $subModule)
				@php
					$routes[] = str_replace('/{id?}','',$subModule->sub_module_route);
				@endphp
			@endforeach
			@if(isset($permisson['module'][$sidebar['id']]['permisson']) && $permisson['module'][$sidebar['id']]['permisson']=='on')
				<ul class="aione-tabs">
					@foreach($sidebar->subModule as $ke => $subModule)
						@if(isset($permisson['submodule'][$subModule['id']]['permisson']) && $permisson['submodule'][$subModule['id']]['permisson']=='on')
							<li class="aione-tab {{-- {{strpos($link, 'details')?'one-active':''}} --}} {{Request::is(str_replace('/{id?}','',$subModule->sub_module_route))?'nav-item-current':''}}">
								<a href="{{ url(str_replace('/{id?}','',$subModule->sub_module_route)) }}">
									<span class="nav-item-text">{{@$subModule['name']}}</span>
								</a>
							</li>
						@endif
					@endforeach
				</ul>
				@php
					$index++;
				@endphp
			@endif
		@endif
	@endforeach 
	<div class="clear"></div>
</nav>