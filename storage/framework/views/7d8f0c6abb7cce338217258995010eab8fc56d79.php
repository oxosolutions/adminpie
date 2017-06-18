<div class="row">
    <ul id="slide-out" class="side-nav fixed hrm">
        <li class="root <?php echo e(in_array(Request::path(),array('/'))?'active-state':''); ?>">
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <span class="side-bar-icon">
                    <i class="fa fa-tachometer blue center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Dashboard
                </span>
               
            </a>
        </li>
        <li class="root <?php echo e(in_array(Request::path(),array('organization/list','organization/create'))?'active-state':''); ?>">
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
                <li class="<?php echo e(Request::is('organization/list')?'active-state':''); ?>">
                    <a href="<?php echo e(route('list.organizations')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-list grey darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            All Organizations
                        </span>
                    </a>
                </li>

                <li class="<?php echo e(Request::is('organization/create')?'active-state':''); ?>">
                    <a href="<?php echo e(route('create.organization')); ?>">
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
        <li class="root <?php echo e(in_array(Request::path(),array('forms','form/create'))?'active-state':''); ?>">
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
               <li class="<?php echo e(Request::is('forms')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('list.forms')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-list blue darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        All Forms
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('form/create')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('create.form')); ?>">
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
        <li class="root <?php echo e(in_array(Request::path(),array('modules','module/create'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-square-o red darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Modules
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
               <li class="<?php echo e(Request::is('modules')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('list.module')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-list blue darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        All Modules
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('module/create')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('create.module')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-plus green darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Add New Module
                    </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root <?php echo e(in_array(Request::path(),array('widgets','widget/create'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-square-o cyan darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Widgets
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
               <li class="<?php echo e(Request::is('widgets')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('index.widget')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-list blue darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        All Widgets
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('widget/create')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('create.widget')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-plus green darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Add New Widget
                    </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root <?php echo e(in_array(Request::path(),array('settings'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-cogs teal darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Settings
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
             
            </a>
            <ul class="side-bar-submenu" >
               <li class="<?php echo e(Request::is('settings')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('list.settings')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-pencil red darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        General
                    </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root <?php echo e(in_array(Request::path(),array('users'))?'active-state':''); ?>">
            <a href="#">
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
               <li class="<?php echo e(Request::is('users')?'active-state':''); ?>">
                    <a href="<?php echo e(route('admin_users')); ?>">
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
    </ul>
</div>

<style type="text/css">
    #slide-out ul {
        margin: 0px 0px 0px 20px;
        list-style: none;
        line-height: : 2em;
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