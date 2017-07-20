<nav id="aione_nav" class="aione-nav aione-nav-vertical">
    <div class="aione-nav-background"></div>
        <ul id="aione_menu" class="aione-menu">
            <li class="aione-nav-item level0 {{in_array(Request::path(),array('/'))?'active-state':''}}">
                <a href="{{route('admin.dashboard')}}">
                    <span class="nav-item-icon side-bar-icon fa fa-tachometer blue center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Dashboard
                    </span>
                   {{--  <span class="arrow">
                        <i class="fa fa-chevron-right" ></i>
                    </span> --}}
                </a>
            </li>
            <li class="aione-nav-item level0 has-children {{in_array(Request::path(),array('organization/list','organization/create'))?'nav-item-current':''}}">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-sitemap orange center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Organizations
                    </span>
                    <span class="nav-item-arrow">
                        <i class="fa fa-angle-right" ></i>
                    </span>
                </a>
                <ul class="side-bar-submenu">
                    <li class="aione-nav-item level1 {{Request::is('organization/list')?'active-state':''}}">
                        <a href="{{route('list.organizations')}}">
                            <span class="nav-item-icon side-bar-icon fa fa-list grey darken-1 center-align side-bar-icon-bg">
                            </span>
                            <span class="side-bar-text">
                                Organizations
                            </span>
                        </a>
                    </li>

                    <li class="aione-nav-item level1 {{Request::is('organization/create')?'active-state':''}}">
                        <a href="{{route('create.organization')}}">
                            <span class="nav-item-icon side-bar-icon fa fa-plus cyan darken-1 center-align side-bar-icon-bg">
                            </span>
                            <span class="side-bar-text">
                                Add Organization
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children {{in_array(Request::path(),array('forms','form/create'))?'nav-item-current':''}}">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-file-text red darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Forms
                    </span>
                    <span class="nav-item-arrow">
                            <i class="fa fa-angle-right" ></i>
                        </span>
                </a>
                <ul class="side-bar-submenu " >
                   <li class="aione-nav-item level1 {{Request::is('forms')?'active-state':''}}">
                        <a href="{{Route('list.forms')}}">
                        <span class="nav-item-icon side-bar-icon fa fa-list blue darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Forms
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 {{Request::is('form/create')?'active-state':''}}">
                        <a href="{{Route('create.form')}}">
                        <span class="nav-item-icon side-bar-icon fa fa-plus green darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add Form
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children {{in_array(Request::path(),array('modules','module/create'))?'active-state':''}}">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-square-o red darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Modules
                    </span>
                    <span class="nav-item-arrow">
                            <i class="fa fa-angle-right" ></i>
                        </span>
                </a>
                <ul class="side-bar-submenu " >
                   <li class="aione-nav-item level1 {{Request::is('modules')?'active-state':''}}">
                        <a href="{{Route('list.module')}}">
                        <span class="nav-item-icon side-bar-icon fa fa-list blue darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Modules
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 {{Request::is('module/create')?'active-state':''}}">
                        <a href="{{Route('create.module')}}">
                        <span class="nav-item-icon side-bar-icon fa fa-plus green darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add Module
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children {{in_array(Request::path(),array('widgets','widget/create'))?'active-state':''}}">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-square-o cyan darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Widgets
                    </span>
                    <span class="nav-item-arrow">
                            <i class="fa fa-angle-right" ></i>
                        </span>
                </a>
                <ul class="side-bar-submenu " >
                   <li class="aione-nav-item level1 {{Request::is('widgets')?'active-state':''}}">
                        <a href="{{Route('index.widget')}}">
                        <span class="nav-item-icon side-bar-icon fa fa-list blue darken-1 center-align side-bar-icon-bg" >
                        </span>
                        <span class="side-bar-text">
                            Widgets
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 {{Request::is('widget/create')?'active-state':''}}">
                        <a href="{{Route('create.widget')}}">
                        <span class="nav-item-icon side-bar-icon fa fa-plus green darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add Widget
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children {{in_array(Request::path(),array('settings'))?'active-state':''}}">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-cogs teal darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Settings
                    </span>
                    <span class="nav-item-arrow">
                            <i class="fa fa-angle-right" ></i>
                        </span>
                 
                </a>
                <ul class="side-bar-submenu" >
                   <li class="aione-nav-item level1 {{Request::is('settings')?'active-state':''}}">
                        {{-- <a href="{{Route('list.settings')}}"> --}}
                        <a href="{{Route('organization.settings')}}">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil red darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Organization
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children {{in_array(Request::path(),array('users'))?'active-state':''}}">
                <a href="#">
                    <span class="nav-item-icon side-bar-icon fa fa-users green darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Users
                    </span>
                    <span class="nav-item-arrow">
                            <i class="fa fa-angle-right" ></i>
                        </span>
                </a>
                <ul class="side-bar-submenu" >
                    <li class="aione-nav-item level1 {{Request::is('users')?'active-state':''}}">
                        <a href="{{ route('admin_users') }}">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil red darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Users
                        </span>
                        </a>
                    </li>
                </ul>
            </li> 
            <li class="aione-nav-item level0 has-children {{in_array(Request::path(),array('users'))?'active-state':''}}">
                <a href="#">
                    <span class="nav-item-icon side-bar-icon fa fa-users green darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Maps
                    </span>
                    <span class="nav-item-arrow">
                        <i class="fa fa-angle-right" ></i>
                    </span>
                </a>
                <ul class="side-bar-submenu" >
                    <li class="aione-nav-item level1 {{Request::is('custom-maps')?'active-state':''}}">
                        <a href="{{ route('custom.maps') }}">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil red darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Custom Maps
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
</nav>