@if(@$design_settings['header_select_menu'] > 0)
    @php
        $menu = Menu::wlist($design_settings['header_select_menu']);
    @endphp
    <nav id="aione_nav" class="aione-nav horizontal light">
        <div class="aione-nav-background"></div>
        <ul id="aione_menu" class="aione-menu">
            @if(@$menu)
                @foreach($menu as $key => $menu_item)
                    <li class="aione-nav-item level0 "> 
                        <a href="{{$menu_item['link']}}">{{$menu_item['label']}}</a>
                        @if(!empty($menu_item['child']))
                            <ul class="side-bar-submenu">
                                @foreach($menu_item['child'] as $submenu_key => $submenu_item)
                                    <li class="aione-nav-item level1 "> 
                                        <a href="{{$submenu_item['link']}}">{{$submenu_item['label']}}</a>
                                    </li>
                                @endforeach 
                            </ul>
                        @endif
                    </li>
                @endforeach 
            @endif
        </ul>
        <div class="aione-nav-toggle">
            <a href="#" class="nav-toggle "></a>
        </div>
        <div class="clear"></div>
    </nav>
@endif