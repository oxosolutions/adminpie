
  
@php
 
  $link=$_SERVER['REQUEST_URI'];
  
  
@endphp

<div class="col l12" style="margin-top: 14px"  >

    <ul class="aione-tabs">
        <li class="tab col aione-active {{strpos($link, 'profile')?'aione-active':''}}"><a href="{{Route('account.profile')}}">Profile</a></li>
        <li class="tab col {{strpos($link, 'activities')?'aione-active':''}}""><a href="{{Route('account.activities')}}">Activity</a></li>
        <li class="tab col {{strpos($link, 'attandance')?'aione-active':''}}""><a href="{{Route('account.attandance')}}">Attandance</a></li>
        <li class="tab col {{strpos($link, 'leaves')?'aione-active':''}}""><a href="{{Route('account.leaves')}}">Leaves</a></li>

        <li class="tab col {{strpos($link, 'tasks')?'aione-active':''}}""><a href="{{Route('account.tasks')}}">Tasks</a></li>
        <li class="tab col {{strpos($link, 'to-do')?'aione-active':''}}""><a href="{{Route('account.todo')}}">To Do</a></li>
       
        <li class="tab col {{strpos($link, 'notes')?'aione-active':''}}""><a href="{{Route('account.notes')}}">Notes</a></li>
        <li class="tab col {{strpos($link, 'performance')?'aione-active':''}}""><a href="{{Route('account.performance')}}">Performance</a></li>
        <li class="tab col {{strpos($link, 'projects')?'aione-active':''}}""><a href="{{Route('account.projects')}}">Projects</a></li>
        
        <li class="tab col {{strpos($link, 'emails')?'aione-active':''}}""><a href="{{Route('account.emails')}}">Emails</a></li>
        <li class="tab col {{strpos($link, 'salary')?'aione-active':''}}""><a href="{{Route('account.salary')}}">Salary</a></li>
       
        <li class="tab col {{strpos($link, 'chat')?'aione-active':''}}""><a href="{{Route('account.chat')}}">Chat</a></li>
        <li class="tab col {{strpos($link, 'discussion')?'aione-active':''}}""><a href="{{Route('account.discussion')}}">Discussion</a></li>
        {{-- <li class="tab col {{strpos($link, 'services')?'aione-active':''}}""><a href="javascript:;">Services</a></li> --}}
         {{-- <li class="tab col {{strpos($link, 'orders')?'aione-active':''}}""><a href="javascript:;">Orders</a></li> --}}
        {{-- <li class="tab col {{strpos($link, 'invoices')?'aione-active':''}}""><a href="javascript:;">Invoices</a></li> --}}
        {{-- <li class="tab col {{strpos($link, 'billing')?'aione-active':''}}""><a href="javascript:;">Billing</a></li> --}}
        {{-- <li class="tab col {{strpos($link, 'contacts')?'aione-active':''}}""><a href="javascript:;">Contacts</a></li> --}}
        <div style="clear: both">
          
        </div>
    </ul>
</div>
<style type="text/css">


 /*    .aione-tabs{
         border-bottom: 2px solid #EEEEEE; 
         width: 100%
         z-index:99;
         margin: 0px
   }
   .aione-tabs > .tab{
        font-size: 14px; border-bottom: 0;background-color: white;margin-right: 5px;z-index: 999
   }
   .aione-tabs > .tab:hover{
       background-color: #EEEEEE;
       border-color: #EEEEEE !important;
   }
   .aione-tabs > .tab > a{
    color: #006BBF;
    padding: 10px 20px;
    line-height: 38px
   }
    .aione-active{

      border: 2px solid #EEEEEE !important;

      border-bottom: 2px solid white !important;
      background-color: white !important;
     
   }
   
   .aione-active > a{
      font-weight: 900;
      color: grey !important;
    

   }*/
   .aione-tabs{
      border-bottom: 1px solid #e8e8e8;
      padding-bottom: 4px;
      padding: 0px;
      margin: 0px;
   }
   .aione-tabs > .tab{
     

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
   .aione-progress-bg {
    background: #f2f2f2;
    min-height: 4px;
  }
    .percent{
        display: none;
    }
   .progress-bar-wrapper{
        width: 80%;background-color: #e8e8e8;margin-top: 10px;overflow: hidden;border-radius:8px ;position: absolute;
   }
   .progress-bar-wrapper > .accomplished{
        background-color: #2196F3;line-height: 5px;font-size:10px;width: 10%;color: white;text-align: right;padding-right: 10px
   }
   
   .progress-bar-wrapper:hover .percent{
        display: flex;
        padding: 8px 0px 2px 0px;
   }
  



.aione-progress-inside {
    width: 80%;
    height: 4px;
    background: #22adba;
    background: linear-gradient( to right, rgba(255, 255, 255, 0),rgba(255, 255, 255, 0.05) 99%,#eee 100% ),linear-gradient(90deg,#2196F3,#2196F3,#2196F3);
    background-size: 10% 100%, 100% 100%;
    cursor: pointer;
}
.aione-progress-text{
    font-size: 10px;
    color: white;
    padding:5px;
}

</style>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.aione-tabs .tab',function(){
      $(this).addClass('aione-active');
      $(this).siblings().removeClass('aione-active');

    });
    $(document).on('click','.aione-tabs .tab',function(){
      $(this).addClass('aione-active');
      $(this).siblings().removeClass('aione-active');

    });
    $(document).on('click','.aione-progress-inside',function(e){
      $('.aione-progress-inside').css({'height':'14px'});
      $('.aione-progress-text').css({'display':'block'});
        e.stopPropagation();
    });   
    $(document).on('click','body',function(){
      $('.aione-progress-inside').css({'height':'4px'});
      $('.aione-progress-text').css({'display':'none'});
        
    }); 

  });
</script>
