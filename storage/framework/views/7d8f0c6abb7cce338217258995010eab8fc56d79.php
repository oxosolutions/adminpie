<nav id="aione_nav" class="aione-nav aione-nav-vertical">
    <div class="aione-nav-background"></div>
        <ul id="aione_menu" class="aione-menu">
            <li class="aione-nav-item level0 <?php echo e(in_array(Request::path(),array('/'))?'active-state':''); ?>">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <span class="nav-item-icon side-bar-icon fa fa-tachometer blue center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Dashboard
                    </span>
                   
                </a>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('organization/list','organization/create'))?'nav-item-current':''); ?>">
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
                    <li class="aione-nav-item level1 <?php echo e(Request::is('organization/list')?'active-state':''); ?>">
                        <a href="<?php echo e(route('list.organizations')); ?>">
                            <span class="nav-item-icon side-bar-icon fa fa-list grey darken-1 center-align side-bar-icon-bg">
                            </span>
                            <span class="side-bar-text">
                                All Organizations
                            </span>
                        </a>
                    </li>

                    <li class="aione-nav-item level1 <?php echo e(Request::is('organization/create')?'active-state':''); ?>">
                        <a href="<?php echo e(route('create.organization')); ?>">
                            <span class="nav-item-icon side-bar-icon fa fa-plus cyan darken-1 center-align side-bar-icon-bg">
                            </span>
                            <span class="side-bar-text">
                                Add New Organization
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('forms','form/create'))?'nav-item-current':''); ?>">
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
                   <li class="aione-nav-item level1 <?php echo e(Request::is('forms')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('list.forms')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-list blue darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            All Forms
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('form/create')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('create.form')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-plus green darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add New Form
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('modules','module/create'))?'active-state':''); ?>">
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
                   <li class="aione-nav-item level1 <?php echo e(Request::is('modules')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('list.module')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-list blue darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            All Modules
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('module/create')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('create.module')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-plus green darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add New Module
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('widgets','widget/create'))?'active-state':''); ?>">
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
                   <li class="aione-nav-item level1 <?php echo e(Request::is('widgets')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('index.widget')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-list blue darken-1 center-align side-bar-icon-bg" >
                        </span>
                        <span class="side-bar-text">
                            All Widgets
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('widget/create')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('create.widget')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-plus green darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add New Widget
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('settings'))?'active-state':''); ?>">
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
                   <li class="aione-nav-item level1 <?php echo e(Request::is('settings')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('organization.settings')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil red darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Organization
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('users'))?'active-state':''); ?>">
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
                   <li class="aione-nav-item level1 <?php echo e(Request::is('users')?'active-state':''); ?>">
                        <a href="<?php echo e(route('admin_users')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil red darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            All Users
                        </span>
                        </a>
                    </li>
                </ul>
            </li> 
        </ul>
</nav>