<nav id="aione_nav" class="aione-nav vertical dark">
    <div class="aione-nav-background"></div>
        <ul id="aione_menu" class="aione-menu">
            <li class="aione-nav-item level0 <?php echo e(in_array(Request::path(),array('/'))?'active-state':''); ?>">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <span class="nav-item-icon side-bar-icon fa fa-tachometer center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Dashboard
                    </span>
                   
                </a>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('group'))?'active-state':''); ?>">
                <a href="#">
                    <span class="nav-item-icon side-bar-icon fa fa-sitemap darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Groups
                    </span>
                    <span class="nav-item-arrow">
                        
                    </span>
                </a>
                <ul class="side-bar-submenu" >
                    <li class="aione-nav-item level1 <?php echo e(Request::is('list.group')?'active-state':''); ?>">
                        <a href="<?php echo e(route('list.group')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Groups
                        </span>
                        </a>
                    </li>
                     <li class="aione-nav-item level1 <?php echo e(Request::is('create.group')?'active-state':''); ?>">
                        <a href="<?php echo e(route('create.group')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add Group
                        </span>
                        </a>
                    </li>
                </ul>
                
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('organization/list','organization/create'))?'nav-item-current':''); ?>">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-circle center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Organizations
                    </span>
                    <span class="nav-item-arrow">
                        
                    </span>
                </a>
                <ul class="side-bar-submenu">
                    <li class="aione-nav-item level1 <?php echo e(Request::is('organization/list')?'active-state':''); ?>">
                        <a href="<?php echo e(route('list.organizations')); ?>">
                            <span class="nav-item-icon side-bar-icon fa fa-list darken-1 center-align side-bar-icon-bg">
                            </span>
                            <span class="side-bar-text">
                                Organizations
                            </span>
                        </a>
                    </li>

                    <li class="aione-nav-item level1 <?php echo e(Request::is('organization/create')?'active-state':''); ?>">
                        <a href="<?php echo e(route('create.organization')); ?>">
                            <span class="nav-item-icon side-bar-icon fa fa-plus darken-1 center-align side-bar-icon-bg">
                            </span>
                            <span class="side-bar-text">
                                Add Organization
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('modules','module/create'))?'active-state':''); ?>">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-stop-circle darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Modules
                    </span>
                    <span class="nav-item-arrow">
                            
                    </span>
                </a>
                <ul class="side-bar-submenu " >
                   <li class="aione-nav-item level1 <?php echo e(Request::is('modules')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('list.module')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-list darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Modules
                        </span>
                        </a>
                    </li>
                   
                </ul>
            </li>
            
            <li class="aione-nav-item level0  has-children  <?php echo e(in_array(Request::path(),array('products','product/create'))?'active-state':''); ?>">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-tachometer center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Products
                    </span>
                </a>
                <ul class="side-bar-submenu " >
                   <li class="aione-nav-item level1 <?php echo e(Request::is('products')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('products.list')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-list darken-1 center-align side-bar-icon-bg" >
                        </span>
                        <span class="side-bar-text">
                            Products
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('product/create')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('create.admin.product')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-plus darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add Product
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0  has-children  <?php echo e(in_array(Request::path(),array('orders','product/create'))?'active-state':''); ?>">
                <a href="<?php echo e(route('list.admin.orders')); ?>">
                    <span class="nav-item-icon side-bar-icon fa fa-shopping-cart center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Orders
                    </span>
                </a>
            </li>

            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('widgets','widget/create'))?'active-state':''); ?>">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-th-large darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Widgets
                    </span>
                    <span class="nav-item-arrow">
                            
                        </span>
                </a>
                <ul class="side-bar-submenu " >
                   <li class="aione-nav-item level1 <?php echo e(Request::is('widgets')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('index.widget')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-list darken-1 center-align side-bar-icon-bg" >
                        </span>
                        <span class="side-bar-text">
                            Widgets
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('widget/create')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('create.widget')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-plus darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add Widget
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('forms','form/create'))?'nav-item-current':''); ?>">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-file-text darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Forms
                    </span>
                    <span class="nav-item-arrow">
                            
                        </span>
                </a>
                <ul class="side-bar-submenu " >
                   <li class="aione-nav-item level1 <?php echo e(Request::is('forms')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('list.forms')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-list darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Forms
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('form/create')?'active-state':''); ?>">
                        <a href="<?php echo e(Route('create.form')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-plus darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add Form
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('users'))?'active-state':''); ?>">
                <a href="#">
                    <span class="nav-item-icon side-bar-icon fa fa-map darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Maps
                    </span>
                    <span class="nav-item-arrow">
                        
                    </span>
                </a>
                <ul class="side-bar-submenu" >
                    <li class="aione-nav-item level1 <?php echo e(Request::is('custom-maps')?'active-state':''); ?>">
                        <a href="<?php echo e(route('custom.maps')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Maps
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('add-map')?'active-state':''); ?>">
                        <a href="<?php echo e(route('add.map')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add Map
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('settings'))?'active-state':''); ?>">
                <a href="javascript:;">

                    <span class="nav-item-icon side-bar-icon fa fa-handshake-o darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        CMS
                    </span>
                    <span class="nav-item-arrow"></span>
                 
                </a>
                <ul class="side-bar-submenu" >
                   <li class="aione-nav-item level1 <?php echo e(Request::is('cms')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('admin.list.pages')); ?>">
                        <span class="nav-item-icon fa fa-handshake-o fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Pages
                        </span>
                        </a>
                    </li>
                   <li class="aione-nav-item level1 <?php echo e(Request::is('cms')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('admin.media')); ?>">
                        <span class="nav-item-icon fa fa-handshake-o fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Media
                        </span>
                        </a>
                    </li>
                   <li class="aione-nav-item level1 <?php echo e(Request::is('cms')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('admin.categories')); ?>">
                        <span class="nav-item-icon fa fa-handshake-o fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Categories
                        </span>
                        </a>
                    </li>
                   <li class="aione-nav-item level1 <?php echo e(Request::is('cms')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('admin.list.posts')); ?>">
                        <span class="nav-item-icon fa fa-handshake-o fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Posts
                        </span>
                        </a>
                    </li>
                   <li class="aione-nav-item level1 <?php echo e(Request::is('cms')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('admin.list.menus')); ?>">
                        <span class="nav-item-icon fa fa-handshake-o fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Menus
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('users'))?'active-state':''); ?>">
                <a href="#">
                    <span class="nav-item-icon side-bar-icon fa fa-user darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Users
                    </span>
                    <span class="nav-item-arrow">
                            
                        </span>
                </a>
                <ul class="side-bar-submenu" >
                    <li class="aione-nav-item level1 <?php echo e(Request::is('users')?'active-state':''); ?>">
                        <a href="<?php echo e(route('admin.list.users')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Users
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('add.user')?'active-state':''); ?>">
                        <a href="<?php echo e(route('admin.add.user')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Add User
                        </span>
                        </a>
                    </li>
                </ul>
            </li> 
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('settings'))?'active-state':''); ?>">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-cogs darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Settings
                    </span>
                    <span class="nav-item-arrow">
                            
                        </span>
                 
                </a>
                <ul class="side-bar-submenu" >
                   <li class="aione-nav-item level1 <?php echo e(Request::is('settings')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('organization.settings')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Organization
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="aione-nav-item level0 has-children <?php echo e(in_array(Request::path(),array('control'))?'active-state':''); ?>">
                <a href="javascript:;">
                    <span class="nav-item-icon side-bar-icon fa fa-cogs darken-1 center-align side-bar-icon-bg white-text">
                    </span>
                    <span class="side-bar-text">
                        Control Panel
                    </span>
                    <span class="nav-item-arrow">
                            
                        </span>
                 
                </a>
                <ul class="side-bar-submenu" >
                    <li class="aione-nav-item level1 <?php echo e(Request::is('control')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('testing.control')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Testing
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('control')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('consistency.control')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Consistency
                        </span>
                        </a>
                    </li>
                    <li class="aione-nav-item level1 <?php echo e(Request::is('control')?'active-state':''); ?>">
                        
                        <a href="<?php echo e(Route('version.control')); ?>">
                        <span class="nav-item-icon side-bar-icon fa fa-pencil darken-1 center-align side-bar-icon-bg">
                        </span>
                        <span class="side-bar-text">
                            Version
                        </span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
            
        </ul>
</nav>