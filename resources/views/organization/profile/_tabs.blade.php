
  
@php
 
  $link=$_SERVER['REQUEST_URI'];
  
  
@endphp

<div class="col l12" style="margin-top: 14px"  >

    <ul class="aione-tabs">
        <li class="tab col {{strpos($link, 'profile')?'aione-active':''}}"><a href="{{Route('account.profile')}}">Profile</a></li>
        <li class="tab col {{strpos($link, 'activities')?'aione-active':''}}""><a href="{{Route('account.activities')}}">Activity</a></li>
        <li class="tab col {{strpos($link, 'attandance')?'aione-active':''}}""><a href="{{Route('account.attandance')}}">Attandance</a></li>
        <li class="tab col {{strpos($link, 'leaves')?'aione-active':''}}""><a href="{{Route('account.leaves')}}">Leaves</a></li>

        <li class="tab col {{strpos($link, 'tasks')?'aione-active':''}}""><a href="{{Route('account.tasks')}}">Tasks</a></li>
        <li class="tab col {{strpos($link, 'todo')?'aione-active':''}}""><a href="{{Route('account.todo')}}">To Do</a></li>
       
        <li class="tab col {{strpos($link, 'notes')?'aione-active':''}}""><a href="{{Route('account.notes')}}">Notes</a></li>
        <li class="tab col {{strpos($link, 'performance')?'aione-active':''}}""><a href="{{Route('account.performance')}}">Performance</a></li>
        <li class="tab col {{strpos($link, 'projects')?'aione-active':''}}""><a href="{{Route('account.projects')}}">Projects</a></li>
        
        <li class="tab col {{strpos($link, 'emails')?'aione-active':''}}""><a href="{{Route('account.emails')}}">Emails</a></li>
        <li class="tab col {{strpos($link, 'salary')?'aione-active':''}}""><a href="{{Route('account.salary')}}">Salary</a></li>
       
        <li class="tab col {{strpos($link, 'chat')?'aione-active':''}}""><a href="{{Route('account.chat')}}">Chat</a></li>
        <li class="tab col {{strpos($link, 'discussion')?'aione-active':''}}""><a href="{{Route('account.discussion')}}">Discussion</a></li>
       
        <div style="clear: both">
          
        </div>
    </ul>
</div>
<style type="text/css">
   .aione-tabs{
      border-bottom: 1px solid #e8e8e8;padding-bottom: 4px;padding: 0px;margin: 0px;
   }
   .aione-tabs > .tab:hover{
		background-color: #e8e8e8;border-bottom: 1px solid #EEE;
   }
   .aione-tabs > .tab > a{
    	padding: 0px 12px  !important; line-height: 40px;display: inline-block; color: #0073aa;
   }
   .aione-active{
      border: 1px solid #e8e8e8;border-bottom: 1px solid #fff;margin-bottom: -1px;
   }
   .aione-active a{
      color: black !important;font-weight: 500
   }
</style>

