
  
<?php 
 
  $link=$_SERVER['REQUEST_URI'];
  
  
 ?>

<div class="col l12" style="margin-top: 14px"  >

    <ul class="aione-tabs">
        <li class="tab col <?php echo e(strpos($link, 'profile')?'aione-active':''); ?>"><a href="<?php echo e(Route('account.profile')); ?>">Profile</a></li>
        <li class="tab col <?php echo e(strpos($link, 'activities')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.activities')); ?>">Activity</a></li>
        <li class="tab col <?php echo e(strpos($link, 'attandance')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.attandance')); ?>">Attandance</a></li>
        <li class="tab col <?php echo e(strpos($link, 'leaves')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.leaves')); ?>">Leaves</a></li>

        <li class="tab col <?php echo e(strpos($link, 'tasks')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.tasks')); ?>">Tasks</a></li>
        <li class="tab col <?php echo e(strpos($link, 'todo')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.todo')); ?>">To Do</a></li>
       
        <li class="tab col <?php echo e(strpos($link, 'notes')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.notes')); ?>">Notes</a></li>
        <li class="tab col <?php echo e(strpos($link, 'performance')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.performance')); ?>">Performance</a></li>
        <li class="tab col <?php echo e(strpos($link, 'projects')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.projects')); ?>">Projects</a></li>
        
        <li class="tab col <?php echo e(strpos($link, 'emails')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.emails')); ?>">Emails</a></li>
        <li class="tab col <?php echo e(strpos($link, 'salary')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.salary')); ?>">Salary</a></li>
       
        <li class="tab col <?php echo e(strpos($link, 'chat')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.chat')); ?>">Chat</a></li>
        <li class="tab col <?php echo e(strpos($link, 'discussion')?'aione-active':''); ?>""><a href="<?php echo e(Route('account.discussion')); ?>">Discussion</a></li>
       
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

