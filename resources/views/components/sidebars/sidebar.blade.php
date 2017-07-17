<nav id="aione_nav" class="aione-nav aione-nav-vertical">
	<div class="aione-nav-background"></div>
    <ul id="aione_menu" class="aione-menu">
    @php
    $index = 0;
     $permisson = drawSidebar::checkPermisson();
    @endphp
        @foreach(drawSidebar::drawSidebar() as $key => $sidebar)
        {{-- {{dump($sidebar->subModule)}} --}}
			@php
			$routes = [];
			@endphp
            @foreach($sidebar->subModule as $ke => $subModule)
              @php
                // preg_match_all("/{(.*?)}/", $subModule->sub_module_route, $matches);
                // $routes[] = preg_replace("/\/{[a-z?]+?\}/", @request()->route()->parameters()[str_replace('?','',@$matches[1][0])], $subModule->sub_module_route);
                $routes[] = str_replace('/{id?}','',$subModule->sub_module_route);
                // dump($routes);
              @endphp
            @endforeach
{{--             {{dump(Request::path())}}
            {{dump($routes)}}
 --}}          
            @if(isset($permisson['module'][$sidebar['id']]['permisson']) && $permisson['module'][$sidebar['id']]['permisson']=='on')
            <li class="aione-nav-item level0 {{(@$sidebar->subModule[0] != null)?'has-children':''}}  {{in_array(Request::path(),$routes)?'nav-item-current':''}}"> 
              @if(@$sidebar->subModule[0] != null)
                <a href="javascript:;">
              @else
                <a href="{{Url($sidebar['route'])}}">
                @endif
                    @php
                        $colors =["teal darken-1"=>"teal darken-1","light-blue"=>"light-blue","cyan"=> "cyan","green darken-1"=>"green darken-1","orange darken-1"=>"orange darken-1"];
                        $rand_color = array_rand($colors,1);
						
						
                    @endphp
					
					<span class="nav-item-icon {{$rand_color}}">{{@$sidebar['name'][0]}}</span>
					<span class="nav-item-text">
						{{@$sidebar['name']}}
					</span>
					
					@if(@$sidebar->subModule[0] != null) 
						<span class="nav-item-arrow">
							<i class="fa fa-angle-right" ></i>
						</span>
					@endif
				  
                </a>
                <ul class="side-bar-submenu">

                    @foreach($sidebar->subModule as $ke => $subModule)
                     @if(isset($permisson['submodule'][$subModule['id']]['permisson']) && $permisson['submodule'][$subModule['id']]['permisson']=='on')
                        <li class="aione-nav-item level1 {{Request::is(str_replace('/{id?}','',$subModule->sub_module_route))?'nav-item-current':''}}">
                            <a href="{{ url(str_replace('/{id?}','',$subModule->sub_module_route)) }}">
                                <span class="nav-item-icon">{{@$subModule['name'][0]}}</span>
								<span class="nav-item-text">{{$subModule['name']}}</span>
                            </a>
                        </li>
                        @endif
                     @endforeach
                </ul>
            </li>
          @endif
          @php
            $index++;
          @endphp
        @endforeach 
        <li class="aione-nav-item level0 root has-children {{-- {{in_array(Request::path(),array('crm/client/list'))?'active-state':''}}" --}}">
            <a href="javascript:;">
                <span class="side-bar-icon fa fa-cogs red center-align side-bar-icon-bg white-text">
                </span>
                <span class="side-bar-text ">
                    Settings
                </span>
                <span class="nav-item-arrow">
                        <i class="fa fa-angle-right" ></i>
                    </span>
            </a>
            <ul class="side-bar-submenu " >
               <li class="aione-nav-item level1 ">
                    <a href="javascript:;">
                        <span class="side-bar-icon fa fa-tachometer orange darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Projects
                        </span>
                    </a>
                </li>
               <li class="aione-nav-item level1 ">
                    <a href="javascript:;">
                        <span class="side-bar-icon fa fa-tachometer blue darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            CRM
                        </span>
                    </a>
                </li>
               <li class="aione-nav-item level1 ">
                    <a href="javascript:;">
                        <span class="side-bar-icon fa fa-tachometer green darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            HRM
                        </span>
                    </a>
                </li>
               <li class="aione-nav-item level1 ">
                    <a href="javascript:;">
                        <span class="side-bar-icon fa fa-tachometer grey darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Support
                        </span>
                    </a>
                </li>
               <li class="aione-nav-item level1 ">
                    <a href="">
                        <span class="side-bar-icon fa fa-tachometer deep-orange darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Users
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="aione-nav-item level0 root has-children {{-- {{in_array(Request::path(),array('crm/client/list'))?'active-state':''}}" --}}">
            <a href="javascript:;">
                <span class="side-bar-icon fa fa-check red center-align side-bar-icon-bg white-text">
                </span>
                <span class="side-bar-text ">
                    Survey
                </span>
                <span class="nav-item-arrow">
                            <i class="fa fa-angle-right" ></i>
                        </span>
            </a>
            <ul class="side-bar-submenu " >
               <li class="aione-nav-item level1 ">
                    <a href="javascript:;">
                        <span class="side-bar-icon fa fa-leanpub orange darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            list
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="aione-nav-item level0 root has-children {{in_array(Request::path(),array('dataset/list','dataset/import'))?'active-state':''}}">
            <a href="javascript:;">
                <span class="side-bar-icon fa fa-table red center-align side-bar-icon-bg white-text">
                </span>
                <span class="side-bar-text ">
                  Dataset
                </span>
                <span class="nav-item-arrow">
                    <i class="fa fa-angle-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu">
               <li class="aione-nav-item level1 {{Request::is('dataset/list')?'active-state':''}}">
                    <a href="{{route('list.dataset')}}">
                        <span class="side-bar-icon fa fa-tachometer orange darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            All Datasets
                        </span>
                    </a>
                </li>
                <li class="aione-nav-item level1 {{Request::is('dataset/import')?'active-state':''}}">
                    <a href="{{route('import.dataset')}}">
                        <span class="side-bar-icon fa fa-tachometer orange darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Import
                        </span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>