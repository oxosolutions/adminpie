
<?php $__env->startSection('content'); ?>
<?php 
  $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Attendance',
    'add_new' => '+ Add Task'
  );

  $now = Carbon\Carbon::now();
  $year= $now->year;
  $now->subMonth();
  $month = $now->month;
  if(strlen($month)==1)
  {
    $month = '0'.$month;
  }
  //$dt = Carbon\Carbon::create($now->year, $now->month, 1);
  //$beforeDay = $dt->dayOfWeek;
  
 ?>
<style type="text/css">
    .box{
        height: 28px;
        width: 28px
    }
    .holiday:after{
        content: 'H';
    }
    .attendance-row > div{
        vertical-align: top;
    }
    .attendance-status-present{ 
    background-color: #9dcb64;
    color: white
    }
    .attendance-status-absent{ 
        background-color: #e85d52;
        color: white
    }
    .attendance-status-leave{ 
        background-color: #29c8f8;
        color: white
    }
    .attendance-status-leave{ 
        background-color: #f88662;
    }
    .attendance-status-tardy:after{ 
        background-color: #e85d52;
    }
    .attendance-status-holiday{
        background-color:#81c3d8;
        color: white
    }
    .attendance-status-holiday.attendance-status-present,
    .attendance-status-off.attendance-status-present{
        background-color:#80a750;
    }
</style>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<nav id="aione_account_tabs" class="aione-account-tabs aione-nav aione-nav-horizontal">
  <ul id="sortable_tabs" class="aione-tabs">
      <li class="aione-tab ">
        <a href="http://master.scolm.com/hrm/attendance/list"><span class="nav-item-text">Attendance</span></a>
      </li>
      <li class="aione-tab nav-item-current">
        <a href="http://master.scolm.com/hrm/attendance"><span class="nav-item-text">View Attendance</span></a>
      </li>
      <li class="aione-tab ">
        <a href="http://master.scolm.com/hrm/attendance/edit"><span class="nav-item-text">Mark Attendance</span></a>
      </li>
      <div class="clear"></div>
  </ul>
</nav>
<div style="overflow-x: auto;">
    <div id="" class="row year-view mt-30"  style="min-width: 1130px;">
        
        <div class="font-size-0 attendance-row" style="font-size: 0">
            <div class="font-size-14 display-inline-block line-height-28 aione-align-center" style="width: 80px">ID</div>

            <div class="font-size-14 display-inline-block line-height-28 aione-align-center" style="width: 120px">
                Employees
            </div>

            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >1
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >2
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >3
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >4
            </div>
             <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >5
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >6
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >7
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >8
            </div>
             <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >9
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >10
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >11
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >12
            </div>
             <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >13
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >14
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >15
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >16
            </div>
             <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >17
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >18
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >19
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >20
            </div>
             <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >21
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >22
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >23
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >24
            </div>
             <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >25
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >26
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >27
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >28
            </div>
             <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >29
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >30
            </div>
            <div class=" display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >31
            </div>
           
           
        </div>
        <div class="font-size-0 attendance-row" style="font-size: 0">
            <div class="font-size-14 display-inline-block line-height-28 aione-align-center" style="width: 80px">119412</div>

            <div class="font-size-14 display-inline-block line-height-28 aione-align-center" style="width: 120px">
                ashish Kumar
            </div>

            <div class="attendance-status-present display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="attendance-status-present display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="attendance-status-absent display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="attendance-status-absent display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
             <div class="attendance-status-leave display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >L
            </div>
            <div class="attendance-status-leave display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >L
            </div>
            <div class="attendance-status-holiday display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="attendance-status-holiday display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
             <div class="attendance-status-holiday attendance-status-present display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
           
           
        </div>
        <div class="font-size-0 attendance-row" style="font-size: 0">
            <div class="font-size-14 display-inline-block line-height-28 aione-align-center" style="width: 80px">119412</div>

            <div class="font-size-14 display-inline-block line-height-28 aione-align-center" style="width: 120px">
                ashish Kumar
            </div>

            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >O
            </div>
             <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >H
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >A
            </div>
            <div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2 font-size-14 aione-align-center line-height-28" >P
            </div>
           
           
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>