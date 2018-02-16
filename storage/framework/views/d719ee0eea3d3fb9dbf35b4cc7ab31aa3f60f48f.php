

<div class="aione-progress-bar" >
    <div class="aione-progress-bg">
        <div class="aione-progress-inside tooltip" data-position="top" data-delay="50" data-tooltip="80% completed" >
           <div class="aione-progress-bar-content"></div>
        </div>
    </div>
</div>
<?php 
  $link=$_SERVER['REQUEST_URI'];
  $array = explode('/',$link);
  $project_id = end($array);
 ?>



<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal">
    
    <ul class="aione-tabs">
       
    
        <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'details.project')?'nav-item-current':''); ?>">
            <a href="<?php echo e(route('details.project',[$project_id])); ?>">
                <span class="nav-item-text">Info</span>
            </a>
        </li>
         <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'tasks.project')?'nav-item-current':''); ?> ">
            <a href="<?php echo e(route('tasks.project',[$project_id])); ?>">
                <span class="nav-item-text">Task</span>
            </a>
        </li>
         <li class="aione-tab  ">
            <a href="">
                 <span class="nav-item-text">Credentials</span></a>
        </li>
         <li class="aione-tab  ">
            <a href=""> <span class="nav-item-text">Documentation</span></a>
        </li>
         <li class="aione-tab  ">
            <a href=""> <span class="nav-item-text">Attachemnts</span></a>
        </li>
         <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'todo.project')?'nav-item-current':''); ?> ">
            <a href="<?php echo e(route('todo.project',[$project_id])); ?>"> <span class="nav-item-text">To do</span></a>
        </li>
         <li class="aione-tab <?php echo e((Request::route()->action['as'] == 'notes.project')?'nav-item-current':''); ?> ">
            <a href="<?php echo e(route('notes.project',[$project_id])); ?>"> <span class="nav-item-text">Notes</span></a>
        </li>
         <li class="aione-tab  ">
            <a href="#test4"> <span class="nav-item-text">Discussion</span></a>
        </li>
         <li class="aione-tab  ">
            <a href=""> <span class="nav-item-text">Activity</span></a>
        </li>
        <li class="aione-tab  ">
            <a href="#test4"> <span class="nav-item-text">Milestones</span></a>
        </li>
        <li class="aione-tab  ">
            <a href=""> <span class="nav-item-text">Calender</span></a>
        </li>
        <li class="aione-tab  ">
            <a href="#test4"> <span class="nav-item-text">Chat</span></a>
        </li>
    </ul>          
    <div class="clear"></div>
</nav>
