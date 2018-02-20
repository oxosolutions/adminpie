<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'yes',
'show_navigation' => 'yes',
'page_title' => 'Leaves',
'add_new' => '+ Apply leave'
); 

$till_year = date('Y') +2;
$today = date('Y-m-d');

$leaving_date = get_current_user_meta('date_of_leaving');
if($leaving_date!=false){
   if(date('Y-m-d',strtotime($leaving_date)) < $today){
      unset($page_title_data['add_new']);
   }
   $till_year = date('Y',strtotime($leaving_date));
}

//dd($data, $current_used_leave);

$range = range(1970, $till_year);
$value = array_map( function($a){
   $next_year = $a + 1;
   return 'April '.$a.' to March '.$next_year; 
}, $range);
$years = array_combine($range, $value);
if(!empty($error)){
   unset($page_title_data['add_new']);
}  
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(Session::has('sucessful')): ?>
<div class="aione-message success" >
   <?php echo e(Session::get('sucessful')); ?> 
</div>
<?php endif; ?>
<?php if(Session::has('errorss')): ?>
   <?php 

      $errorss = Session::get('errorss');
    ?>
   <?php if(empty($errorss['from']) &&  empty($errorss['to'])): ?>
      <?php $__currentLoopData = $errorss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="aione-message error" >  <?php echo e(e($value)); ?> 
            </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
   <?php endif; ?>
   <?php if(!empty($errorss['from'])): ?>
      <?php $__currentLoopData = $errorss['from']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="aione-message error" >   <?php echo e(e($value)); ?>

            </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>
   <?php if(!empty($errorss['to'])): ?>
      <?php $__currentLoopData = $errorss['to']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="aione-message error" >   <?php echo e(e($value)); ?>

            </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>
<?php endif; ?>

<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

   <?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php if(!empty($error)): ?>
   <div class="aione-message warning">
      <?php echo e($error); ?>   
   </div>
   
   <?php else: ?>
   <?php echo Form::open(['route'=>'store.employeeleave' , 'class'=> 'form-horizontal','method' => 'post']); ?>

               <input type="hidden" name="apply_by" value="employee">
               <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Apply Leave','button_title'=>'Save leave','section'=>'accleasec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo Form::close(); ?>

   <div class="ar">
      <div class="ac l75">
         <div class="aione-border mb-25">
            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
               Leaves List   
            </div>
            <div class="p-10">
               <div class="aione-table">
                  <table>
                     <thead>
                        <tr>
                           <th>Leave Reason</th>
                           <th>No. of days</th>
                           <th>Period</th>
                           <th>Status</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(!empty($data->toArray())): ?>
                           <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                 <td><?php echo e($val->reason_of_leave); ?></td>
                                 <td>
                                    <?php if($total = collect([$val->from_leave_count,$val->to_leave_count])->sum()): ?>
                                    <?php echo e($total); ?> Days
                                    <?php else: ?>
                                    <?php echo e($val->total_days); ?> Days
                                    <?php endif; ?>
                                 </td>
                                 <td><?php echo e($val->from); ?> to <?php echo e($val->to); ?> </td>
                                 <td>
                                    <?php if($val->status ==1): ?>
                                       <span class="green">Approved</span>
                                    <?php elseif($val->status ==3): ?>
                                       <span class="red">Denied</span>
                                    <?php elseif($val->status ==0): ?>
                                       <span class="orange">Pending</span>
                                    <?php endif; ?>  
                                 </td>
                              </tr>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <div class="ac l25">
         <div class="aione-border mb-25">
            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
               Session   
            </div>
            <div class="p-10">
              <?php echo Form::open(['route'=>'account.leaves']); ?>

                  <?php echo Form::select('year',$years,$filter_year,['class'=>'browser-default mb-10']); ?>

                  <?php echo Form::submit('Search',['style'=>'width:100%']); ?>

                  <?php echo Form::close(); ?>

            </div>
         </div>
         <div class="aione-border mb-25">
            <div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
               Leave rule for you   
            </div>
            <div class="p-10">
              <?php if(!empty($current_used_leave)): ?>
               
               <?php $__currentLoopData = $current_used_leave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="aione-table">
                     <table>
                        <thead>
                           <tr>
                              <th colspan="2" class="aione-align-center">Title:-<?php echo e(@$val['name']); ?></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Assigend</td>
                              <td> <?php if(!empty($val['valid_for']) && $val['valid_for']=='monthly'): ?>
                              <?php echo e(12*$val['number_of_day']); ?>

                              <?php else: ?>
                              <?php echo e(@$val['number_of_day']); ?>

                              <?php endif; ?></td>
                           </tr>
                           <tr>
                              <td>Used</td>
                              <td><?php echo e($val['used_leave']); ?></td>
                           </tr>
                           <tr>
                              <td>Left</td>
                              <td><?php if(!empty($val['valid_for']) && $val['valid_for']=='monthly'): ?>
                              <?php echo e(12*$val['number_of_day'] - $val['used_leave']); ?>

                              <?php else: ?>
                              <?php echo e($val['number_of_day'] - $val['used_leave']); ?>

                              <?php endif; ?></td>
                           </tr>
                           <tr>
                              <td>Valid for</td>
                              <td><?php echo e(@$val['valid_for']); ?></td>
                           </tr>
                           <tr>
                              <td>Apply Before</td>
                              <td><?php echo e(@$val['apply_before']); ?> days</td>
                           </tr>
                           <tr>
                              <td>Minimum saction leave</td>
                              <td><?php echo e(@$val['minimum_saction_leave']); ?></td>
                           </tr>
                           <tr>
                              <td>Maximum saction leave</td>
                              <td><?php echo e(@$val['maximum_saction_leave']); ?></td>
                           </tr>
                           <tr>
                              <td>Carry Forward</td>
                              <td> <?php if(@$val['carry_forward']==true): ?>
                           Yes
                           <?php else: ?>
                           No
                           <?php endif; ?></td>
                           </tr>
                        </tbody>
                           
                     </table>
                  </div>
                 
                   
                  
                    
                
              
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>


   
   <?php endif; ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
   $(".datepicker").pickadate({
      selectMonths:true,
      selectYear:15,
      min: new Date(new Date().getFullYear(),new Date().getMonth(),new Date().getDate())
   });
   
</script>
<style type="text/css">
   .title-card{
   padding:10px;
   }
   .card{
   margin: 0px;margin-bottom: 10px
   }
   .mb-0{
   margin-bottom: 0px;
   }
   .p-10{
   padding: 10px
   }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>