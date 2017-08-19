@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Modules',
  'add_new' => '+ Apply leave'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    <div class="module-wrapper">
        {{-- <div class="list-container">
            <ul class="list-modules" id="sortable">
                <li >
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        First Module
                        <i class="material-icons dp48 del">clear</i>    
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        second Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        third Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li >
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        First Module
                        <i class="material-icons dp48 del">clear</i>    
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        second Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        third Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li >
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        First Module
                        <i class="material-icons dp48 del">clear</i>    
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        second Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        third Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li >
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        First Module
                        <i class="material-icons dp48 del">clear</i>    
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        second Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        third Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li >
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        First Module
                        <i class="material-icons dp48 del">clear</i>    
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        second Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        third Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li >
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        First Module
                        <i class="material-icons dp48 del">clear</i>    
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        second Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
                <li>
                    <div>
                        <i class="material-icons dp48 arrow">arrow_drop_down</i>
                        third Module
                        <i class="material-icons dp48 del">clear</i>
                    </div>
                    <ul class="list-sub-modules">
                        <li>
                            abc
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                        <li>
                            def
                            <i class="material-icons dp48 del">clear</i> 
                        </li>
                    </ul>
                </li>
            </ul>  
        </div> --}}
        <div class="list-container">
            <nav id="aione_nav" class="aione-nav aione-nav-vertical">
                <div class="aione-nav-background"></div>
                <ul id="sortable" class="aione-menu">
                    <li class="aione-nav-item level0   ">
                        <a href="#">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-dashboard">
                                </i></span>
                            <span class="nav-item-text">
                                Dashboard
                            </span>                      
                        </a>
                        <ul class="side-bar-submenu">

                        </ul>
                        <i class="material-icons dp48 del">clear</i>    
                    </li>

                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-amazon">
                                </i></span>
                            <span class="nav-item-text">
                                Account
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul id="sortable_submenu" class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/profile">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Profile</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/activities">
                                    <span class="nav-item-icon">A</span>
                                    <span class="nav-item-text">Activities</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/attendance">
                                    <span class="nav-item-icon">A</span>
                                    <span class="nav-item-text">Attendence</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/performance">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Performance</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/emails">
                                    <span class="nav-item-icon">E</span>
                                    <span class="nav-item-text">Emails</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/salary">
                                    <span class="nav-item-icon">S</span>
                                    <span class="nav-item-text">Salary</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/chat">
                                    <span class="nav-item-icon">C</span>
                                    <span class="nav-item-text">Chat</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/discussion">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Discussion</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/leaves">
                                    <span class="nav-item-icon">L</span>
                                    <span class="nav-item-text">Leaves</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/holiday/list">
                                    <span class="nav-item-icon">H</span>
                                    <span class="nav-item-text">Holidays</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/todo">
                                    <span class="nav-item-icon">T</span>
                                    <span class="nav-item-text">To Do</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/tasks">
                                    <span class="nav-item-icon">T</span>
                                    <span class="nav-item-text">Tasks</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/notes">
                                    <span class="nav-item-icon">N</span>
                                    <span class="nav-item-text">Notes</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/account/projects">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Projects</span>
                                </a>
                            </li>
                        </ul>
                        <i class="material-icons dp48 del">clear</i>    
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-asterisk">
                                </i></span>
                            <span class="nav-item-text">
                                CRM
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/crm/clients">
                                    <span class="nav-item-icon">C</span>
                                    <span class="nav-item-text">Customers</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/crm/products">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Products</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/crm/services">
                                    <span class="nav-item-icon">S</span>
                                    <span class="nav-item-text">Services</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/crm/invoices">
                                    <span class="nav-item-icon">I</span>
                                    <span class="nav-item-text">Invoices</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/crm/payment-methods">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Payment-Method</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/crm/product/category">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Product Categories</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/crm/service/category">
                                    <span class="nav-item-icon">S</span>
                                    <span class="nav-item-text">Service Categories</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/crm/contacts">
                                    <span class="nav-item-icon">C</span>
                                    <span class="nav-item-text">Contacts</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0.007)"><i class="fa fa-user-circle-o">
                                </i></span>
                            <span class="nav-item-text">
                                HRM
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/employees">
                                    <span class="nav-item-icon">E</span>
                                    <span class="nav-item-text">Employees</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/attendance">
                                    <span class="nav-item-icon">A</span>
                                    <span class="nav-item-text">Attendance</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/designations">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Designations</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/departments">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Departments</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/leaves">
                                    <span class="nav-item-icon">L</span>
                                    <span class="nav-item-text">Leaves</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/leave-categories">
                                    <span class="nav-item-icon">L</span>
                                    <span class="nav-item-text">Leave Categories</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/shifts">
                                    <span class="nav-item-icon">S</span>
                                    <span class="nav-item-text">Shifts</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/holidays">
                                    <span class="nav-item-icon">H</span>
                                    <span class="nav-item-text">Holidays</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/openings">
                                    <span class="nav-item-icon">J</span>
                                    <span class="nav-item-text">Job Openings</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/applicants">
                                    <span class="nav-item-icon">A</span>
                                    <span class="nav-item-text">Applicants</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/payscale">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Pay Scale</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/applications">
                                    <span class="nav-item-icon">A</span>
                                    <span class="nav-item-text">Applications</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-product-hunt">
                                </i></span>
                            <span class="nav-item-text">
                                Projects
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/projects">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Projects</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/project/tasks">
                                    <span class="nav-item-icon">T</span>
                                    <span class="nav-item-text">Tasks</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/teams">
                                    <span class="nav-item-icon">T</span>
                                    <span class="nav-item-text">Teams</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/project/categories">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Project Categories</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-handshake-o">
                                </i></span>
                            <span class="nav-item-text">
                                CMS
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/cms/pages">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Pages</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/cms/media">
                                    <span class="nav-item-icon">M</span>
                                    <span class="nav-item-text">Media</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/cms/categories">
                                    <span class="nav-item-icon">C</span>
                                    <span class="nav-item-text">Categories</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/cms/posts">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text">Posts</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-files-o">
                                </i></span>
                            <span class="nav-item-text">
                                Datasets
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/datasets">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Datasets</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/dataset/import">
                                    <span class="nav-item-icon">I</span>
                                    <span class="nav-item-text">Import Dataset</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(72, 29, 29, 0)"><i class="fa fa-area-chart">
                                </i></span>
                            <span class="nav-item-text">
                                Visualizations
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/create/visualization">
                                    <span class="nav-item-icon">V</span>
                                    <span class="nav-item-text">Visualization</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-users">
                                </i></span>
                            <span class="nav-item-text">
                                Users
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/users">
                                    <span class="nav-item-icon">U</span>
                                    <span class="nav-item-text">Users</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/hrm/roles">
                                    <span class="nav-item-icon">R</span>
                                    <span class="nav-item-text">Roles</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-cogs">
                                </i></span>
                            <span class="nav-item-text">
                                Settings
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/settings/organization">
                                    <span class="nav-item-icon">O</span>
                                    <span class="nav-item-text">Organization</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/settings/department">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Department</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/deleted/employees">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Deleted Employees</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-envelope-o">
                                </i></span>
                            <span class="nav-item-text">
                                Emails
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/email">
                                    <span class="nav-item-icon">E</span>
                                    <span class="nav-item-text">Emails</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/email/templates">
                                    <span class="nav-item-icon">E</span>
                                    <span class="nav-item-text">Email Templates</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/email/layouts">
                                    <span class="nav-item-icon">E</span>
                                    <span class="nav-item-text">Email Layouts</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:"><i class="fa fa-archive">
                                </i></span>
                            <span class="nav-item-text">
                                Documents
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/documents">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Documents</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/document/templates">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Document Templates</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/document/layouts">
                                    <span class="nav-item-icon">D</span>
                                    <span class="nav-item-text">Document Layouts</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-wpforms">
                                </i></span>
                            <span class="nav-item-text">
                                Forms
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/forms/list">
                                    <span class="nav-item-icon">F</span>
                                    <span class="nav-item-text">Forms</span>
                                </a>
                            </li>
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/forms/create">
                                    <span class="nav-item-icon">A</span>
                                    <span class="nav-item-text">Add Form</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-globe">
                                </i></span>
                            <span class="nav-item-text">
                                Maps
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/custom-maps/{type?}">
                                    <span class="nav-item-icon">C</span>
                                    <span class="nav-item-text">Custom Maps</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aione-nav-item level0 has-children  ">
                        <a href="javascript:;">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-gears">
                                </i></span>
                            <span class="nav-item-text">
                                Tools
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul class="side-bar-submenu">
                            <li class="aione-nav-item level1 ">
                                <a href="http://master.adminpie.com/tools">
                                    <span class="nav-item-icon">T</span>
                                    <span class="nav-item-text">Tools</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="Detail-container">
            <div class="row">
                <div class="col l6">
                    <h6><strong>Edit Module</strong></h6>
                    <div class="col s12 m2 l12 aione-field-wrapper">
                        <label>Name</label>
                        <input type="text" name="name" value="" class="no-margin-bottom aione-field" >
                    </div>
                    <div class="col s12 m2 l12 aione-field-wrapper">
                        <label>Route</label>
                        {!!Form::select('route',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control sel browser-default','placeholder'=>'url ']) !!}
                    </div>
                </div>
                <div class="col l6">
                    <div class="col l6">
                        <h6>Pick a color</h6>

                        <input type="text" id="custom">
                         
                    </div>
                    
                    <div class="col l6">
                        <h6>Pick an icon</h6>
                        <input type="text" class="input1 input font-awesome" placeholder="Pick an icon" /> 
                    </div>
                </div>
                <div class="col l12">
                    <div class="col l6">
                        <label>
                        Write Javascript code here
                        </label>
                        <div id="editor-js" class="editor">
                        </div>
                    </div>
                    <div class="col l6">
                        <label>
                            Write css code here
                        </label>
                        <div id="editor-css" class="editor" >
                            
                        </div>
                    </div>
                </div>
                <div class="col l12">
                    <button class="btn blue">Save Settings</button>
                </div>
            </div>

        </div>
        <div style="clear: both;padding:20px">
            
        </div>
        
        
    </div>
    <style type="text/css">
        .module-wrapper > .list-container{
            float: left;
            width: 25%;
            border: 1px solid #e8e8e8;
            height: 100%;
            padding: 10px;
        }
        .module-wrapper > .Detail-container{
            float: right;
            width: 74%;
            border: 1px solid #e8e8e8;
            padding: 10px;
           
        }
        .list-modules > li > div,.list-sub-modules > li{
            border: 1px solid #e8e8e8;
            padding:10px 5px;
            margin-bottom: 5px;
            box-shadow: 1px 1px 1px 1px #F2F1F1;
            background-color: white;
        }
        .list-modules > li > div > .del,.list-sub-modules > li > .del{
            float: right;
            color: #757575;
            font-size: 18px;
            cursor: pointer;
        }
        .list-modules > li > div > .arrow{
            float: left;
            color: #757575;
            font-size: 18px;
            transform: rotate(270deg);
            cursor: pointer;
        }
        .list-sub-modules > li{
            margin-left: 10px;
             transition: opacity 1s ease-out;
        }
        .list-active .list-sub-modules{
            display: block;
            
        }
        .list-sub-modules{
            display: none;
        }
       .module-wrapper .editor{
            height: 200px;margin: 5px 10px
        }
        .module-wrapper .sp-preview{
            height: 40px;
            width: 40px;
        }
        .module-wrapper .sp-dd{
            padding: 2px 6px;
            height: 40px;
            line-height: 40px;
        }
        .module-wrapper .btn.blue{
            float: right;
           
            margin: 10px;
        }
        .aione-nav-item .material-icons{
            position: absolute;
            top: -10px;
            right: -10px;
            border: 3px solid white;
            line-height: 14px;
            height: 20px;
            background-color: red;
            font-size: 14px;
            border-radius: 50%;
            cursor: pointer;
            display: none;
        }
        .aione-nav-item:hover .material-icons{
            display: block
        }

    </style>
    <script type="text/javascript">
        $("#custom").spectrum({
            color: '#000',
            showAlpha: true,    
        });
        $(document).ready(function(){
            $(document).on('click','.list-modules .arrow',function(){ 
                if($(this).parents('li').hasClass('list-active')){
                    $(this).parents('li').removeClass('list-active');
                }else{
                    $(this).parents('li').addClass('list-active');
                    $(this).parents('li').siblings().removeClass('list-active');    
                }
                
            });

            $('.input1').iconpicker(".input1");

            $('#custom').change(function(){
                $('.color_picker').val($("#custom").spectrum('get').toRgbString());             
            });
            $('.font-awesome').change(function(){
                $('.font-awesome-text').val($(this).val());
            });
            if($('input[name=icon]').val() != ""){
                $('.geticonval > i').each(function(){
                    if($(this).attr('class') == 'fa '+$('input[name=icon]').val()){
                        $(this).parent().addClass('geticonval selectedicon');
                        $('.font-awesome').val($('input[name=icon]').val());
                    }else{
                        console.log("not in class");
                    }
                });
            }
            if($('input[name=color]').val() != ""){
                $('.sp-preview-inner').css({'background-color': $('input[name=color]').val()});
            }
        });
        var editorJs = ace.edit("editor-js");
        editorJs.setTheme("ace/theme/monokai");
        editorJs.getSession().setMode("ace/mode/javascript");
        var editorCss = ace.edit("editor-css");
        editorCss.setTheme("ace/theme/monokai");
        editorCss.getSession().setMode("ace/mode/css");
        $("#custom").spectrum({
            color: '#000',
            showAlpha: true,
        });


        $( function() {
                $( "#sortable" ).sortable({
                    axis: "y"
                });
                $( "#sortable" ).disableSelection();
              } );
        $( function() {
                $( "#sortable_submenu" ).sortable({
                    axis: "y"
                });
                $( "#sortable_submenu" ).disableSelection();
              } );


        
    </script>
@endsection