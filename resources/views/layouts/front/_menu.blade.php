@if(@$design_settings['header_select_menu'] > 0)
    @php
        $menu = Menu::wlist($design_settings['header_select_menu']);
        $current_page = Request::url();
        dump($current_page);
    @endphp
    <style type="text/css">
        .nav-item-current{
            background: #ededed;
        }
    </style>
    <nav id="aione_nav" class="aione-nav horizontal light">
        <div class="aione-nav-background"></div>
        <ul id="aione_menu" class="aione-menu">
            @if(@$menu)
                @foreach($menu as $key => $menu_item)
                @php
                    if(substr($menu_item['link'], -1) == '/'){
                        $new_menu_item = substr($menu_item['link'] , 0, -1);

                        if($current_page == $new_menu_item){
                            $nav_item_current = 'nav-item-current';
                        }else{  
                            $nav_item_current = '';
                        }
                    }else{
                        if($current_page == $menu_item['link']){
                            $nav_item_current = 'nav-item-current';
                        }else{
                            $nav_item_current = '';
                        }
                    }
                @endphp
                    <li class="aione-nav-item level0 {{ $nav_item_current }}"> 
                        <a href="{{$menu_item['link']}}">{{$menu_item['label']}}</a>
                        @if(!empty($menu_item['child']))
                            <ul class="side-bar-submenu">
                                @foreach($menu_item['child'] as $submenu_key => $submenu_item)
                                {{dump($submenu_item)}}
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