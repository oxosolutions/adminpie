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
                    <i class="fa fa-sitemap blue center-align side-bar-icon-bg white-text" style=""></i>
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
                            <i class="fa fa-th red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            List
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('create.organization')}}">
                        <span class="side-bar-icon">
                            <i class="fa fa-pencil red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            create
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-file green darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Form Builder
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
               <li>
                    <a href="{{Route('create.form')}}">
                    <span class="side-bar-icon">
                        <i class="fa fa-pencil red darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        create
                    </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-cogs green darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Settings
                </span>
{{--                 <span class="arrow">
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
                    <a href="{{Route('create.form')}}">
                    <span class="side-bar-icon">
                        <i class="fa fa-pencil red darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        List
                    </span>
                    </a>
                </li>
            </ul>
        </li>
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
</style>