{{-- <div class="col l12" >
    <div class="progress-bar-wrapper">
        <div class="accomplished">
            <span class="percent">18%</span>
            <span class="blue-text">.</span>
        </div>
    </div>
</div> --}}
<div class="aione-progress-bar">
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
<div class="col l12" style="margin:15px 0px;" >
    <ul class="aione-tabs">
        <li class="tab col {{strpos($link, 'details')?'aione-active':''}}"><a href="{{route('details.project',['12'])}}">Info</a></li>
        <li class="tab col {{strpos($link, 'demo1')?'aione-active':''}}""><a href="{{route('demo1')}}">Tasks</a></li>
        <li class="tab col {{strpos($link, 'credentials')?'aione-active':''}}""><a href="{{route('credentials.project',['12'])}}">Credentials</a></li>
        <li class="tab col {{strpos($link, 'documentation')?'aione-active':''}}""><a href="{{route('documentation.project',['12'])}}">Documentation</a></li>
        <li class="tab col {{strpos($link, 'attachemnts')?'aione-active':''}}""><a href="#test4">Attachemnts</a></li>
        <li class="tab col {{strpos($link, 'todo')?'aione-active':''}}""><a href="{{route('todo.project',['12'])}}">To do</a></li>
        <li class="tab col {{strpos($link, 'notes')?'aione-active':''}}""><a href="{{route('notes.project',['12'])}}">Notes</a></li>
        <li class="tab col {{strpos($link, 'discussion')?'aione-active':''}}""><a href="#test4">Discussion</a></li>
        <li class="tab col {{strpos($link, 'activities')?'aione-active':''}}""><a href="{{route('activities.project',['12'])}}">Activity</a></li>
        <li class="tab col {{strpos($link, 'milestones')?'aione-active':''}}""><a href="#test4">Milestones</a></li>
        <li class="tab col {{strpos($link, 'calender')?'aione-active':''}}""><a href="{{route('calender.project',['12'])}}">calender</a></li>
        <li class="tab col {{strpos($link, 'chat')?'aione-active':''}}""><a href="#test4">chat</a></li>
        <div style="clear: both">
          
        </div>
    </ul>
</div>
<style type="text/css">
    .aione-tabs{
         text-transform: uppercase;
   }
   .aione-tabs > .tab{
        padding: 5px 10px;font-size: 10px; border: 2px solid transparent;border-bottom: 2px solid #e8e8e8;background-color: #e8e8e8
   }
   .aione-tabs > .tab > a{
    color: #636363;
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
    $(document).on('click','.tab',function(){
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
