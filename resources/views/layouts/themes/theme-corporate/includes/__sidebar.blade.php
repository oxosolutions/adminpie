<nav id="aione_nav" class="aione-nav vertical dark">
	<div class="aione-nav-background"></div>
    <ul id="aione_menu" class="aione-menu">
    @php
    $permisson = drawSidebar::checkPermisson();
    @endphp
        @foreach(drawSidebar::drawSidebar() as $key => $sidebar)
       
			@php
			$routes = [];
			@endphp
            @foreach($sidebar->subModule as $ke => $subModule)
              @php
                // preg_match_all("/{(.*?)}/", $subModule->sub_module_route, $matches);
                // $routes[] = preg_replace("/\/{[a-z?]+?\}/", @request()->route()->parameters()[str_replace('?','',@$matches[1][0])], $subModule->sub_module_route);
                $routes[] = str_replace('/{id?}','',$subModule->sub_module_route);
              @endphp
            @endforeach
       
            @if(isset($permisson['module'][$sidebar['id']]['permisson']) && $permisson['module'][$sidebar['id']]['permisson']=='on')
            <li class="aione-nav-item level0 {{(@$sidebar->subModule[0] != null)?'has-children':''}}  {{in_array(Request::path(),$routes)?'nav-item-current':''}}"> 
              @if(@$sidebar->subModule[0] != null)
                <a href="javascript:;">
              @else
                @if($sidebar['route'] != null)
                    <a href="{{@Url($sidebar['route'])}}">
                @else
                    <a href="javascript:void(0)">
                @endif
                @endif
                    {{-- @php
                        $colors =["teal darken-1"=>"teal darken-1","light-blue"=>"light-blue","cyan"=> "cyan","green darken-1"=>"green darken-1","orange darken-1"=>"orange darken-1"];
                        $rand_color = array_rand($colors,1);
						
						
                    @endphp --}}
					
					<span class="nav-item-icon " style="background:{{@$sidebar['color']}}"><i class="fa {{@$sidebar['icon']}}"></i></span>
					<span class="nav-item-text">
						{{@$sidebar['name']}}
					</span>
					
					@if(@$sidebar->subModule[0] != null) 
						<span class="nav-item-arrow"></span>
					@endif
				  
                </a>
                <ul class="side-bar-submenu">

                    @foreach($sidebar->subModule as $ke => $subModule)
                     @if(isset($permisson['submodule'][$subModule['id']]['permisson']) && $permisson['submodule'][$subModule['id']]['permisson']=='on')
                        <li class="aione-nav-item level1 {{Request::is(str_replace('/{id?}','',$subModule->sub_module_route))?'nav-item-current':''}}">
                            <a href="{{ url(str_replace('/{id?}','',$subModule->sub_module_route)) }}">
                                <span class="nav-item-icon">{{@$subModule['name'][0]}}</span>
								<span class="nav-item-text">{{@$subModule['name']}}</span>
                            </a>
                        </li>
                        @endif
                     @endforeach
                </ul>
            </li>
          @endif
        @endforeach 
    </ul>
</nav>


<div class="main-container">
    <div class="left-container">
        <ul>
            <li>list1</li>
            <li>list2</li>
            <li>list3</li>
            <li>list4</li>
            <li>list5</li>
        </ul>
    </div>
</div>