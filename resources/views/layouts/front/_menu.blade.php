@php
$menu = Menu::wlist(6);
@endphp

<nav id="aione_nav" class="aione-nav horizontal light">
	<div class="aione-nav-background"></div>
    <ul id="aione_menu" class="aione-menu">
        @if(@$menu)
            @foreach($menu as $key => $menu_item)
                <li class="aione-nav-item level0 "> 
                    <a href="{{$menu_item['link']}}">{{$menu_item['label']}}</a>
                </li>
            @endforeach 
        @endif
    </ul>
</nav>