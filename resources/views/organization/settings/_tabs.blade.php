
  
@php
 
  $link=$_SERVER['REQUEST_URI'];
  
  
@endphp

<div class="col l12" style="margin-top: 14px"  >

    <ul class="aione-tabs">
        <li class="tab col aione-active {{strpos($link, 'org')?'aione-active':''}}"><a href="{{Route('setting.org')}}">Basic Settings</a></li>
        <li class="tab col {{strpos($link, 'activities')?'aione-active':''}}""><a href="{{Route('setting.employee')}}">Employee Setting</a></li>
        <li class="tab col {{strpos($link, 'attandance')?'aione-active':''}}""><a href="{{Route('setting.attendance')}}">Attendance Setting</a></li>
        <li class="tab col {{strpos($link, 'attandance')?'aione-active':''}}""><a href="{{Route('setting.role')}}">Roles Setting</a></li>
        <li class="tab col {{strpos($link, 'attandance')?'aione-active':''}}""><a href="{{Route('setting.leaves')}}">Leave Setting</a></li>
        <div style="clear: both">
          
        </div>
    </ul>
</div>
<style type="text/css">



   .aione-tabs{
      border-bottom: 1px solid #e8e8e8;
      padding-bottom: 4px;
      padding: 0px;
      margin: 0px;
   }
   .aione-tabs > .tab{
     
    display: inline-block;
   }
   .aione-tabs > .tab:hover{
      background-color: #e8e8e8;
          border-bottom: 1px solid #EEE;
   }
   .aione-tabs > .tab > a{
    padding: 0px 12px  !important; 
    line-height: 40px;
    display: inline-block; 
    color: #0073aa;
   }
   .aione-active{
      border: 1px solid #e8e8e8;
      border-bottom: 1px solid #fff;
      margin-bottom: -1px;
   }
   .aione-active a{
      color: black !important;
      font-weight: 500
   }

</style>
