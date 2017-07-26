
  
@php
 
  $link=$_SERVER['REQUEST_URI'];
  
  
@endphp

<div class="col l12" style="margin-top: 14px"  >

    <ul class="aione-tabs">
        <li class="tab col {{strpos($link, 'edit')?'aione-active':''}}"><a href="{{Route('edit.visual',['id'=>request()->route()->parameters()['id']])}}">Charts</a></li>
        <li class="tab col {{strpos($link, 'setting')?'aione-active':''}}""><a href="{{Route('setting.visualization',['id'=>request()->route()->parameters()['id']])}}">Settings</a></li>
        <li class="tab col {{strpos($link, 'users')?'aione-active':''}}""><a href="{{Route('user.visualization',['id'=>request()->route()->parameters()['id']])}}">Users</a></li>
        <li class="tab col {{strpos($link, 'leaves')?'aione-active':''}}""><a href="{{Route('account.leaves')}}">Reports</a></li>   
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
    .aione-tabs > .tab{
      display: inline-block;
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

