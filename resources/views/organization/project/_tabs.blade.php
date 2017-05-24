{{-- <div class="col l12" >
    <div class="progress-bar-wrapper">
        <div class="accomplished">
            <span class="percent">18%</span>
            <span class="blue-text">.</span>
        </div>
    </div>
</div> --}}
<div class="aione-progress-bar" style="margin-left: -14px;margin-right: -14px;margin-top: -16px;">
    <div class="aione-progress-bg">
        <div class="aione-progress-inside tooltipped" data-position="top" data-delay="50" data-tooltip="80% completed" >
            <div class="aione-progress-text col l3" style="display: none">completed: 80%</div>
            <div class="aione-progress-text col l3" style="display: none">Dead Line :25-12-2022 </div>
            <div class="aione-progress-text col l3" style="display: none">completed </div>
            <div class="aione-progress-text col l3" style="display: none">completed </div>
        </div>
    </div>
</div>
@php
 
  $link=$_SERVER['REQUEST_URI'];
  
  
@endphp
{{-- <div class="col l12"  >
    <ul class="aione-tabs">
        <li class="tab col {{strpos($link, 'details')?'ione-active':''}}"><a href="{{route('details.project',['12'])}}">Info</a></li>
        <li class="tab col {{strpos($link, 'demo1')?'ione-active':''}}""><a href="{{route('demo1')}}">Tasks</a></li>
        <li class="tab col {{strpos($link, 'credentials')?'ione-active':''}}""><a href="{{route('credentials.project',['12'])}}">Credentials</a></li>
        <li class="tab col {{strpos($link, 'documentation')?'ione-active':''}}""><a href="{{route('documentation.project',['12'])}}">Documentation</a></li>
        <li class="tab col {{strpos($link, 'attachemnts')?'ione-active':''}}""><a href="#test4">Attachemnts</a></li>
        <li class="tab col {{strpos($link, 'todo')?'ione-active':''}}""><a href="{{route('todo.project',['12'])}}">To do</a></li>
        <li class="tab col {{strpos($link, 'notes')?'ione-active':''}}""><a href="{{route('notes.project',['12'])}}">Notes</a></li>
        <li class="tab col {{strpos($link, 'discussion')?'ione-active':''}}""><a href="#test4">Discussion</a></li>
        <li class="tab col {{strpos($link, 'activities')?'ione-active':''}}""><a href="{{route('activities.project',['12'])}}">Activity</a></li>
        <li class="tab col {{strpos($link, 'milestones')?'ione-active':''}}""><a href="#test4">Milestones</a></li>
        <li class="tab col {{strpos($link, 'calender')?'ione-active':''}}""><a href="{{route('calender.project',['12'])}}">calender</a></li>
        <li class="tab col {{strpos($link, 'chat')?'ione-active':''}}""><a href="#test4">chat</a></li>
        <div style="clear: both">
          
        </div>
    </ul>
</div> --}}
{{-- <div class="col l12"  >
    <ul class="ione-tabs">
        <li class="tab col {{strpos($link, 'details')?'ione-active':''}}"><a href="{{route('details.project',['12'])}}">Info</a></li>
        <li class="tab col {{strpos($link, 'demo1')?'ione-active':''}}""><a href="{{route('demo1')}}">Tasks</a></li>
        <li class="tab col {{strpos($link, 'credentials')?'ione-active':''}}""><a href="{{route('credentials.project',['12'])}}">Credentials</a></li>
        <li class="tab col {{strpos($link, 'documentation')?'ione-active':''}}""><a href="{{route('documentation.project',['12'])}}">Documentation</a></li>
        <li class="tab col {{strpos($link, 'attachemnts')?'ione-active':''}}""><a href="#test4">Attachemnts</a></li>
        <li class="tab col {{strpos($link, 'todo')?'ione-active':''}}""><a href="{{route('todo.project',['12'])}}"><span>To do</span></a></li>
        <li class="tab col {{strpos($link, 'notes')?'ione-active':''}}""><a href="{{route('notes.project',['12'])}}">Notes</a></li>
        <li class="tab col {{strpos($link, 'discussion')?'ione-active':''}}""><a href="#test4">Discussion</a></li>
        <li class="tab col {{strpos($link, 'activities')?'ione-active':''}}""><a href="{{route('activities.project',['12'])}}">Activity</a></li>
        <li class="tab col {{strpos($link, 'milestones')?'ione-active':''}}""><a href="#test4">Milestones</a></li>
        <li class="tab col {{strpos($link, 'calender')?'ione-active':''}}""><a href="{{route('calender.project',['12'])}}">calender</a></li>
        <li class="tab col {{strpos($link, 'chat')?'ione-active':''}}""><a href="#test4">chat</a></li>
        <div style="clear: both">
          
        </div>
    </ul>
</div>
 --}}

<div class="col l12"  >
    <ul class="one-tabs">
        <li class="tab col {{strpos($link, 'details')?'one-active':''}}"><a href="{{route('details.project',['12'])}}">Info</a></li>
        <li class="tab col {{strpos($link, 'demo1')?'one-active':''}}""><a href="{{route('demo1')}}">Tasks</a></li>
        <li class="tab col {{strpos($link, 'credentials')?'one-active':''}}""><a href="{{route('credentials.project',['12'])}}">Credentials</a></li>
        <li class="tab col {{strpos($link, 'documentation')?'one-active':''}}""><a href="{{route('documentation.project',['12'])}}">Documentation</a></li>
        <li class="tab col {{strpos($link, 'attachemnts')?'one-active':''}}""><a href="#test4">Attachemnts</a></li>
        <li class="tab col {{strpos($link, 'todo')?'one-active':''}}""><a href="{{route('todo.project',['12'])}}"><span>To do</span></a></li>
        <li class="tab col {{strpos($link, 'notes')?'one-active':''}}""><a href="{{route('notes.project',['12'])}}">Notes</a></li>
        <li class="tab col {{strpos($link, 'discussion')?'one-active':''}}""><a href="#test4">Discussion</a></li>
        <li class="tab col {{strpos($link, 'activities')?'one-active':''}}""><a href="{{route('activities.project',['12'])}}">Activity</a></li>
        <li class="tab col {{strpos($link, 'milestones')?'one-active':''}}""><a href="#test4">Milestones</a></li>
        <li class="tab col {{strpos($link, 'calender')?'one-active':''}}""><a href="{{route('calender.project',['12'])}}">calender</a></li>
        <li class="tab col {{strpos($link, 'chat')?'one-active':''}}""><a href="#test4">chat</a></li>
        <div style="clear: both">
          
        </div>
    </ul>
</div>
<style type="text/css">

/*********************************************/
/*    .aione-tabs{
         text-transform: uppercase;
   }
   .aione-tabs > .tab{
        padding: 5px 10px;font-size: 10px; border: 2px solid transparent;border-bottom: 2px solid #e8e8e8;background-color: #e8e8e8
   }
   .aione-tabs > .tab > a{
    color: #636363;
   }
    .aione-active{
      border: 2px solid #e8e8e8 !important;
      border-bottom: 2px solid transparent !important;
      background-color: #fff !important;
   }
   .aione-active > a{
      font-weight: 700;
      color: #2196F3 !important;
   }
   .aione-progress-bg {
    background: #f2f2f2;
    min-height: 4px;
  }*/

  /*********************************************/
  /*********************************************/
/*   .ione-tabs{
         text-transform: uppercase;
         width: 100%
   }
   .ione-tabs > .tab{
        padding: 15px 17px;font-size: 10px; border: 2px solid transparent;border-bottom: 2px solid #24425C;background-color: #24425C;
   }
   .ione-tabs > .tab > a{
    color: #62798D;
   }
    .ione-active{
      border: 2px solid #24425C !important;
      border-bottom: 2px solid transparent !important;
      background-color: #24425C !important;
      padding: 15px 17px 3px 15px !important;
   }
   .ione-active:after{
      content: '';
    position: relative;
    display: block;
   top: 5px;
   margin-left: auto;
   margin-right: auto;
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 12px solid #fff;
    
   }
   .ione-active > a{
      font-weight: 900;
      color: #ffffff !important;
   }
   .ione-progress-bg {
    background: #f2f2f2;
    min-height: 4px;
  }
*/
  /*********************************************/


     .one-tabs{
         text-transform: uppercase;
         width: 100%
   }
   .one-tabs > .tab{
        padding: 10px 17px;font-size: 10px; border-bottom: 1px solid #a8a8a8;background-color: white;
   }
   .one-tabs > .tab:hover{
       background-color: #e8e8e8;
   }
   .one-tabs > .tab > a{
    color: #006BBF;
   }
    .one-active{

      border: 1px solid #a8a8a8 !important;

      border-bottom: 1px solid transparent !important;
      background-color: white !important;
     padding: 10px 17px !important;
   }
   /*.one-active:after{
      content: '';
    position: relative;
    display: block;
   top: 5px;
   margin-left: auto;
   margin-right: auto;
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 12px solid #fff;
    
   }*/
   .one-active > a{
      font-weight: 900;
      color: grey !important;
   }
   .one-progress-bg {
    background: #f2f2f2;
    min-height: 4px;
  }
  /* .aione-tabs > .tab:hover{
        border-bottom:1px solid red;
   }*/

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
    $(document).on('click','.one-tabs .tab',function(){
      $(this).addClass('one-active');
      $(this).siblings().removeClass('one-active');

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
