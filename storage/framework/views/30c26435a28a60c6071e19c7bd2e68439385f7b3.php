<div class="row">
    <ul id="slide-out" class="side-nav fixed hrm">
        <li class="root <?php echo e(Request::is('/')?'active-state':''); ?>" >
            <a href="<?php echo e(Route('organization.dashboard')); ?>">
                <span class="side-bar-icon">
                    <i class="fa fa-tachometer blue center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Dashboard
                </span>
            </a>
            
        </li>
        <li class="root <?php echo e(in_array(Request::path(),array('account/emails','account/profile','account/activities','account/attandance','account/leaves','account/tasks','account/ToDo','account/notes','account/performance','account/projects','account/salary','account/chat','account/discussion'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-user orange center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Account
                </span>
               <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu">
                <li class="<?php echo e(Request::is('account/profile')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.profile')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-user red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Profile
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/activities')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.activities')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-user red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Activity
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/attandance')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.attandance')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-user red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Attendance
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/employeeleave')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('list.employeeleave')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-minus red darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                         Leaves
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/tasks')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.tasks')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-tasks red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Tasks
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/todo')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.todo')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-th-list red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            To Do
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/notes')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.notes')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-sticky-note red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Notes
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/performance')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.performance')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-user red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Performance
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/projects')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.projects')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-file red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Projects 
                        </span>
                    </a>
                </li>
                <li  class="<?php echo e(Request::is('account/emails')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.emails')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-envelope red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Email 
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/salary')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.salary')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-usd red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Salary 
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/chat')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.chat')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-comments red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Chat 
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('account/discussion')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('account.discussion')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-bullhorn red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Discussion 
                        </span>
                    </a>
                </li>
            
            </ul>
        </li>
        <li class="root <?php echo e(in_array(Request::path(),array('crm/client/list'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-handshake-o blue center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    CRM
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu">
                <li class="<?php echo e(Request::is('crm/client/list')?'active-state':''); ?>">
                    <a href="<?php echo e(route('list.client')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-handshake-o red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Customers
                        </span>
                    </a>
                </li>
               
               
               
                
              
                
               
                
               
            </ul>
        </li>
        <li class="root <?php echo e(in_array(Request::path(),array('hrm/employees','hrm/attendance','hrm/attendance/hr','hrm/designations','hrm/departments','hrm/leaves','hrm/leave-categories','hrm/shifts','hrm/holidays'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-tachometer green darken-1 center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    HRM
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
                <li class="<?php echo e(Request::is('hrm/employees')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('list.employee')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-address-card orange darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Employee
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/attendance')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('list.attendance')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-random red darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Attendence  
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/attendance/hr')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('hr.attendance')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-random red darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Attendence by
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/designations')?'active-state':''); ?>">
                    <a href="<?php echo e(route('designations')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-briefcase blue darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Designations
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/departments')?'active-state':''); ?>">
                    <a href="<?php echo e(route('departments')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-building green darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Departments
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/leaves')?'active-state':''); ?>">
                    <a href="<?php echo e(route('leaves')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-user-times teal darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Leaves
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/leave-categories')?'active-state':''); ?>">
                    <a href="<?php echo e(route('leave.categories')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-tachometer grey darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Leave Categories
                    </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/shifts')?'active-state':''); ?>">
                    <a href="<?php echo e(route('shifts')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-clock-o red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Shifts
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/holidays')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('list.holidays')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-bed teal darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Holidays
                    </span>
                    </a>
                </li>
                                
            </ul>
        </li>
        <li class="root <?php echo e(in_array(Request::path(),array('projects','projects/categories'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-files-o blue center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text">
                    Projects
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu">
                <li class="<?php echo e(Request::is('projects')?'active-state':''); ?>">
                    <a href="<?php echo e(route('list.project')); ?>" class="side-bar-submenu-li">
                        <span class="side-bar-icon">
                            <i class="fa fa-database red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            All Projects
                        </span>
                    </a>
                   
                </li>
                <li>
                    <a href="javascript:;">
                        <span class="side-bar-icon">
                            <i class="fa fa-tasks red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Tasks
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('projects/categories')?'active-state':''); ?>">
                    <a href="<?php echo e(route('categories.project')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-tachometer red darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Project Categories
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root  <?php echo e(in_array(Request::path(),array('pages'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-tachometer red center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text ">
                    CMS
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
               <li class="<?php echo e(Request::is('pages')?'active-state':''); ?>">
                    <a href="<?php echo e(Route('list.pages')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-leanpub orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Pages
                        </span>
                    </a>
                </li>
                <li >
                    <span class="side-bar-icon">
                        <i class="fa fa-thumb-tack red darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Posts
                    </span>
                </li>
                <li >
                    <span class="side-bar-icon">
                        <i class="fa fa-object-group teal darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Categories
                    </span>
                </li>
                <li >
                    <span class="side-bar-icon">
                        <i class="fa fa-camera green darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Media
                    </span>
                </li>
            </ul>
        </li>
        <li class="root  ">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-check red center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text ">
                    Survey
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
               <li>
                    <a href="javascript:;">
                        <span class="side-bar-icon">
                            <i class="fa fa-leanpub orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            list
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="root  <?php echo e(in_array(Request::path(),array('dataset/list','dataset/import'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-table red center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text ">
                  Dataset
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu">
               <li class="<?php echo e(Request::is('dataset/list')?'active-state':''); ?>">
                    <a href="<?php echo e(route('list.dataset')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-tachometer orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            All Datasets
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('dataset/import')?'active-state':''); ?>">
                    <a href="<?php echo e(route('import.dataset')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-tachometer orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Import
                        </span>
                    </a>
                </li>
            </ul>
        </li>
       
        <li class="root <?php echo e(in_array(Request::path(),array('list/visual'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-area-chart red center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text ">
                    Visualizations
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
                <li class="<?php echo e(Request::is('list/visual')?'active-state':''); ?>">
                    <a href="<?php echo e(route('list.visual')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-files-o orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            list
                        </span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="root <?php echo e(in_array(Request::path(),array('users','hrm/roles'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-users red center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text ">
                    Users
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
               <li class="<?php echo e(Request::is('users')?'active-state':''); ?> ">
                    <a href="<?php echo e(route('list.user')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-user-plus orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Users
                        </span>
                    </a>
                </li>
                <li class="<?php echo e(Request::is('hrm/roles')?'active-state':''); ?> ">
                    <a href="<?php echo e(Route('list.role')); ?>">
                    <span class="side-bar-icon">
                        <i class="fa fa-bars teal darken-1 center-align side-bar-icon-bg" style=""></i>
                    </span>
                    <span class="side-bar-text">
                        Roles
                    </span>
                    </a>
                </li>  
            </ul>
        </li>
        <li class="root  ">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-cogs red center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text ">
                    Settings
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu " >
               <li>
                    <a href="javascript:;">
                        <span class="side-bar-icon">
                            <i class="fa fa-tachometer orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Projects
                        </span>
                    </a>
                </li>
               <li>
                    <a href="javascript:;">
                        <span class="side-bar-icon">
                            <i class="fa fa-tachometer blue darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            CRM
                        </span>
                    </a>
                </li>
               <li>
                    <a href="javascript:;">
                        <span class="side-bar-icon">
                            <i class="fa fa-tachometer green darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            HRM
                        </span>
                    </a>
                </li>
               <li>
                    <a href="javascript:;">
                        <span class="side-bar-icon">
                            <i class="fa fa-tachometer grey darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Support
                        </span>
                    </a>
                </li>
               <li>
                    <a href="">
                        <span class="side-bar-icon">
                            <i class="fa fa-tachometer deep-orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Users
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="root  <?php echo e(in_array(Request::path(),array('hrm/log'))?'active-state':''); ?>">
            <a href="javascript:;">
                <span class="side-bar-icon">
                    <i class="fa fa-users red center-align side-bar-icon-bg white-text" style=""></i>
                </span>
                <span class="side-bar-text ">
                    Manage
                </span>
                <span class="arrow">
                    <i class="fa fa-chevron-right" ></i>
                </span>
            </a>
            <ul class="side-bar-submenu">
               <li class="<?php echo e(Request::is('hrm/log')?'active-state':''); ?>">
                    <a href="<?php echo e(route('list.log')); ?>">
                        <span class="side-bar-icon">
                            <i class="fa fa-user-plus orange darken-1 center-align side-bar-icon-bg" style=""></i>
                        </span>
                        <span class="side-bar-text">
                            Log
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
.side-bar-submenu{
    width: 225px !important;
    margin-left: -8px !important;
    padding-left: 28px !important;
}
.display-block{
    display: block;
}
</style>