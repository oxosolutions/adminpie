<div class="row">
    <ul id="slide-out" class="side-nav fixed hrm">
        <li class="root">
            <a href="{{route('admin.dashboard')}}">
                <span class="side-bar-icon">
                    <i class="fa fa-tachometer blue center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Dashboard
                </span>
               {{--  <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span> --}}
            </a>
        </li>
        <li class="root">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-sitemap orange center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Organizations
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu">
                <li>
                    <a href="{{route('list.organization')}}">
                        <span class="side-bar-icon">
                            <i class="fa fa-list grey darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            All Organizations
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('create.organization')}}">
                        <span class="side-bar-icon">
                            <i class="fa fa-plus cyan darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Add New Organization
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-file-text red darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Forms
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
               <li>
                    <a href="{{Route('list.form')}}">
                    <span class="side-bar-icon">
                        <i class="fa fa-list blue darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        All Forms
                    </span>
                    </a>
                </li>
                <li>
                    <a href="{{Route('create.form')}}">
                    <span class="side-bar-icon">
                        <i class="fa fa-plus green darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Add New Form
                    </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root">
            <a href="{{Route('list.module')}}">
                <span class="side-bar-icon">
                    <i class="fa fa-cogs teal darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Settings
                </span>
{{--<span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
 --}}            
            </a>
        </li>
        <li class="root">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-users green darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Users
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu" >
               <li>
                    <a href="#">
                    <span class="side-bar-icon">
                        <i class="fa fa-pencil red darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        All Users
                    </span>
                    </a>
                </li>
            </ul>
        </li>
        <li><p class="footer">&copy; {{ date("Y") }} <a href="oxosolutions.com" target="_blank">OXO Solutions</a> <br>All rights reserved.</p></li>
    </ul>
</div>
<style type="text/css">
    #slide-out ul {
        margin: 0px 0px 0px 20px;
        list-style: none;
        line-height: 2em;
        font-family: Arial;
    }
    #slide-out ul li {
        font-size: 16px;
        position: relative;
    }
    #slide-out ul li:before {
        position: absolute;
        left: -7px;
        top: -1px;
        content: '';
        display: block;
        border-left: 1px solid #ddd;
        height: 26px;
        border-bottom: 1px solid #ddd;
        width: 10px;
    }
    #slide-out ul li:after {
        position: absolute;
        left: -7px;
        bottom: -3px;
        content: '';
        display: block;
        border-left: 1px solid #ddd;
        height: 100%;
    }
    #slide-out ul li.root {
        margin: 0px 0px 0px 0px;
    }
    #slide-out ul li.root:before {
        display: none;
    }
    #slide-out ul li.root:after {
        display: none;
    }
    #slide-out ul li:last-child:after {
        display: none;
    }
    .footer{
        z-index: 9999;
        background: #2D323E;
        text-align: center;
        color: white;
        font-size: 14px;
        width: 230px;
        bottom: 0px;
        position: absolute;
    }
</style>