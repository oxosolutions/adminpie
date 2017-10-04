<nav id="aione_nav" class="aione-nav vertical dark">
    <div class="aione-nav-background"></div>
        <ul id="aione_menu" class="aione-menu">
            <li class="aione-nav-item level0 {{in_array(Request::path(),array('/'))?'active-state':''}}">
                <a href="{{route('admin.dashboard')}}">
                    <span class="nav-item-icon side-bar-icon fa fa-tachometer center-align side-bar-icon-bg white-text">
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
                    <span class="nav-item-icon side-bar-icon fa fa-sitemap center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Organizations
                    </span>
                    <span class="nav-item-arrow">
                        
                    </span>
                </a>
                <ul class="side-bar-submenu">
                    <li class="aione-nav-item level1 {{Request::is('organization/list')?'active-state':''}}">
                        <a href="{{route('list.groupOrganizations')}}">
                            <span class="nav-item-icon side-bar-icon fa fa-list darken-1 center-align side-bar-icon-bg">
                            </span>
                            <span class="side-bar-text">
                                Organizations
                            </span>
                        </a>
                    </li>

                    <li class="aione-nav-item level1 {{Request::is('organization/create')?'active-state':''}}">
                        <a href="{{route('create.groupOrganization')}}">
                            <span class="nav-item-icon side-bar-icon fa fa-plus darken-1 center-align side-bar-icon-bg">
                            </span>
                            <span class="side-bar-text">
                                Add Organization
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            
        </ul>
</nav>