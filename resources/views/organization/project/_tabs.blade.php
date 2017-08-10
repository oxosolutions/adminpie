

<div class="aione-progress-bar" >
    <div class="aione-progress-bg">
        <div class="aione-progress-inside tooltip" data-position="top" data-delay="50" data-tooltip="80% completed" >
           {{--  <span id="tooltip-span">
                Tooltip data
            </span> --}}
           <div class="aione-progress-bar-content"></div>
        </div>
    </div>
</div>
@php
 
  $link=$_SERVER['REQUEST_URI'];
  $array = explode('/',$link);
  $project_id = end($array);
@endphp

{{-- <div class="col l12">
    <ul class="one-tabs" style="margin-top: 14px">
        <li class="tab col {{strpos($link, 'details')?'one-active':''}}"><a href="{{route('details.project',[$project_id])}}">Info</a></li>
        <li class="tab col {{strpos($link, 'demo1')?'one-active':''}}""><a href="{{route('tasks.project',[$project_id])}}">Tasks</a></li>
        <li class="tab col {{strpos($link, 'credentials')?'one-active':''}}""><a href="{{route('credentials.project',[$project_id])}}">Credentials</a></li>
        <li class="tab col {{strpos($link, 'documentation')?'one-active':''}}""><a href="{{route('documentation.project',[$project_id])}}">Documentation</a></li>
        <li class="tab col {{strpos($link, 'attachemnts')?'one-active':''}}""><a href="{{route('attachment.project',[$project_id])}}">Attachemnts</a></li>
        <li class="tab col {{strpos($link, 'todo')?'one-active':''}}""><a href="{{route('todo.project',[$project_id])}}"><span>To do</span></a></li>
        <li class="tab col {{strpos($link, 'notes')?'one-active':''}}""><a href="{{route('notes.project',[$project_id])}}">Notes</a></li>
        <li class="tab col {{strpos($link, 'discussion')?'one-active':''}}""><a href="#test4">Discussion</a></li>
        <li class="tab col {{strpos($link, 'activities')?'one-active':''}}""><a href="{{route('activities.project',[$project_id])}}">Activity</a></li>
        <li class="tab col {{strpos($link, 'milestones')?'one-active':''}}""><a href="#test4">Milestones</a></li>
        <li class="tab col {{strpos($link, 'calender')?'one-active':''}}""><a href="{{route('calender.project',[$project_id])}}">calender</a></li>
        <li class="tab col {{strpos($link, 'chat')?'one-active':''}}""><a href="#test4">chat</a></li>
        <div style="clear: both">
          
        </div>
    </ul>
</div> --}}

<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal">
    
    <ul class="aione-tabs">
       
        {{-- <li class="aione-tab  ">
            <a href="">
                <span class="nav-item-text">ahshashd</span>
            </a>
        </li> --}}
        <li class="aione-tab nav-item-current ">
            <a href="{{route('details.project',[$project_id])}}">
                <span class="nav-item-text">Info</span>
            </a>
        </li>
         <li class="aione-tab  ">
            <a href="{{route('tasks.project',[$project_id])}}">
                <span class="nav-item-text">Task</span>
            </a>
        </li>
         <li class="aione-tab  ">
            <a href="{{route('credentials.project',[$project_id])}}">
                 <span class="nav-item-text">Credentials</span></a>
        </li>
         <li class="aione-tab  ">
            <a href="{{route('documentation.project',[$project_id])}}"> <span class="nav-item-text">Documentation</span></a>
        </li>
         <li class="aione-tab  ">
            <a href="{{route('attachment.project',[$project_id])}}"> <span class="nav-item-text">Attachemnts</span></a>
        </li>
         <li class="aione-tab  ">
            <a href="{{route('todo.project',[$project_id])}}"> <span class="nav-item-text">To do</span></a>
        </li>
         <li class="aione-tab  ">
            <a href="{{route('notes.project',[$project_id])}}"> <span class="nav-item-text">Notes</span></a>
        </li>
         <li class="aione-tab  ">
            <a href="#test4"> <span class="nav-item-text">Discussion</span></a>
        </li>
         <li class="aione-tab  ">
            <a href="{{route('activities.project',[$project_id])}}"> <span class="nav-item-text">Activity</span></a>
        </li>
        <li class="aione-tab  ">
            <a href="#test4"> <span class="nav-item-text">Milestones</span></a>
        </li>
        <li class="aione-tab  ">
            <a href="{{route('calender.project',[$project_id])}}"> <span class="nav-item-text">Calender</span></a>
        </li>
        <li class="aione-tab  ">
            <a href="#test4"> <span class="nav-item-text">Chat</span></a>
        </li>
        
    </ul>
               
    <div class="clear"></div>
</nav>
{{-- <style type="text/css">
    .tooltip {
    text-decoration:none;
    position:relative;
}
.tooltip span {
    display:none;
}
.tooltip:hover span {
    display:block;
    position:fixed;
    overflow:hidden;
}
</style>
<script type="text/javascript"></script> --}}
