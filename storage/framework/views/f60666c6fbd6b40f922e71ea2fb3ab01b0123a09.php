

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
<?php 
 
  $link=$_SERVER['REQUEST_URI'];
  
  
 ?>

<div class="col l12"  >
    <ul class="one-tabs">
        <li class="tab col <?php echo e(strpos($link, 'details')?'one-active':''); ?>"><a href="<?php echo e(route('details.project',['12'])); ?>">Info</a></li>
        <li class="tab col <?php echo e(strpos($link, 'demo1')?'one-active':''); ?>""><a href="<?php echo e(route('demo1')); ?>">Tasks</a></li>
        <li class="tab col <?php echo e(strpos($link, 'credentials')?'one-active':''); ?>""><a href="<?php echo e(route('credentials.project',['12'])); ?>">Credentials</a></li>
        <li class="tab col <?php echo e(strpos($link, 'documentation')?'one-active':''); ?>""><a href="<?php echo e(route('documentation.project',['12'])); ?>">Documentation</a></li>
        <li class="tab col <?php echo e(strpos($link, 'attachemnts')?'one-active':''); ?>""><a href="#test4">Attachemnts</a></li>
        <li class="tab col <?php echo e(strpos($link, 'todo')?'one-active':''); ?>""><a href="<?php echo e(route('todo.project',['12'])); ?>"><span>To do</span></a></li>
        <li class="tab col <?php echo e(strpos($link, 'notes')?'one-active':''); ?>""><a href="<?php echo e(route('notes.project',['12'])); ?>">Notes</a></li>
        <li class="tab col <?php echo e(strpos($link, 'discussion')?'one-active':''); ?>""><a href="#test4">Discussion</a></li>
        <li class="tab col <?php echo e(strpos($link, 'activities')?'one-active':''); ?>""><a href="<?php echo e(route('activities.project',['12'])); ?>">Activity</a></li>
        <li class="tab col <?php echo e(strpos($link, 'milestones')?'one-active':''); ?>""><a href="#test4">Milestones</a></li>
        <li class="tab col <?php echo e(strpos($link, 'calender')?'one-active':''); ?>""><a href="<?php echo e(route('calender.project',['12'])); ?>">calender</a></li>
        <li class="tab col <?php echo e(strpos($link, 'chat')?'one-active':''); ?>""><a href="#test4">chat</a></li>
        <div style="clear: both">
          
        </div>
    </ul>
</div>
<style type="text/css">


     .one-tabs{
         text-transform: uppercase;
         width: 100%
   }
   .one-tabs > .tab{
        font-size: 10px; border-bottom: 1px solid #a8a8a8;background-color: white;
   }
   .one-tabs > .tab:hover{
       background-color: #e8e8e8;
   }
   .one-tabs > .tab > a{
    color: #006BBF;
    padding: 10px 17px;
    line-height: 40px
   }
    .one-active{

      border: 1px solid #a8a8a8 !important;

      border-bottom: 1px solid transparent !important;
      background-color: white !important;
     
   }
   
   .one-active > a{
      font-weight: 900;
      color: grey !important;
      padding: 15px 17px !important;

   }
   .one-progress-bg {
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
