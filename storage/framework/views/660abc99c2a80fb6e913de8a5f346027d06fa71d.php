<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Salary',
); 
    $id = "";
    if(!empty($salary['payscale'])){
        $payscale = json_decode($salary->payscale,true);
    }
?> 
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
    .crop{
        width: 100%;
        height: 140px;
        overflow: hidden;
    }
    .crop img {
        width: auto;
        height: 250px;
        margin: -65px 0 -30px -30px;
    }
</style>
<?php if(Session::has('error')): ?>
   
<?php else: ?>

<div class="aione-border p-20 mv-100">
    
    <div class="ar">
        <div class="ac l60">
            <div class="crop">
                <img src="http://oxoitsolutions.com/wp-content/uploads/sites/30/2017/09/oxo_solutions.png" >                
            </div>
            <div class="font-weight-700  font-size-16 line-height-24">
                OXO IT Solutions Private Limited
            </div>
            <div class="line-height-24">
                #158, Rani Ka Bagh,
                Near Shivaji Park,
                Amritsar, 143001
            </div>
                        
        </div>
        <div class="ac l40">
            <div class="font-weight-700  font-size-16 line-height-24 p-10">
                Employee Detail
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Name</span>
                    <span class="aione-float-right"><?php echo e($salary->user_detail->name); ?></span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Designation</span>
                    <span class="aione-float-right"><?php echo e(@$designation_name); ?></span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Employee ID</span>
                    <span class="aione-float-right"><?php echo e($salary->employee_id); ?></span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Address</span>
                    
                    <span class="aione-float-right">
                    <?php if(!empty($salary->user_detail->metas->where('key','permanent_address')->first())): ?>
                    <?php echo e(@$salary->user_detail->metas->where('key','permanent_address')->first()->value); ?>

                    <?php endif; ?>
                    </span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700  ">PAN Number</span>
                    
                    <span class="aione-float-right">AUK3394L</span>
                </li>
            </ul>
        </div>

    </div>
    <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Payment
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Basic Pay</span>
                    <span class="aione-float-right"><?php echo e($payscale['basic_pay']); ?></span>
                </li>
            <?php if(!empty($payscale['ta'])): ?>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">TA</span>
                    <span class="aione-float-right"><?php echo e($payscale['ta']); ?></span>
                </li>
            <?php endif; ?>  
            <?php if(!empty($payscale['da'])): ?>      
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">DA</span>
                    <span class="aione-float-right"><?php echo e($payscale['da']); ?></span>
                </li>
            <?php endif; ?>
            <?php if(!empty($payscale['hra'])): ?>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">HRA</span>
                    <span class="aione-float-right"><?php echo e($payscale['hra']); ?></span>
                </li>
            <?php endif; ?>
                <li class=" p-10 aione-border-bottom">
                    <span class="font-weight-700  ">Other Allowences</span>
                    
                    <span class="aione-float-right"><?php echo e(@number_format($salary['over_time'], 2, '.',',')); ?></span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 ">Bonus</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
            </ul>
           
        </div>
        <div class="ac l50">
            <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Deductions
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
               
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">Loss of Pay</span>
                    <span class="aione-float-right"><?php echo e(number_format($salary['short_hours'], 2,".",",")); ?></span>
                </li>
                
                
            </ul>
            
        </div>
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700  font-size-18">Gross Salary</span>
                    
                <span class="aione-float-right font-size-18"><?php echo e(number_format(($salary['salary'] + $salary['over_time']) , 2 ,"." ,",")); ?></span>
            </div>
        </div>
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700  font-size-18">Net Deduction</span>
                    
                <span class="aione-float-right font-size-18"><?php echo e(number_format($salary['short_hours'],2,'.',',')); ?></span>
            </div>    
        </div>
            
    </div>
     <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
         <div class="ac l50">
            <div class="font-weight-700  font-size-16 line-height-24 p-10">
                Year to date
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">Taxable Gross Pay</span>
                    <span class="aione-float-right">992283</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700  ">Income tax</span>
                    <span class="aione-float-right">36445</span>
                    
                </li>
                
            </ul>
        </div>
        <div class="ac l50">
            <div class="font-weight-700  font-size-16 line-height-24 p-10">
                This Period
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">Gross Salary</span>
                    <span class="aione-float-right"><?php echo e(number_format(($salary['salary'] + $salary['over_time']) , 2 ,"." ,",")); ?></span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700  ">Net Deduction</span>
                    <span class="aione-float-right"><?php echo e(number_format($salary['short_hours'],2,'.',',')); ?></span>
                </li>
                
            </ul>
        </div>
    </div>
    <div class="ar">
        <div class="ac l50">
          
        </div>
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700  font-size-18">Net Salary</span>
                    
                <span class="aione-float-right font-size-18"><?php echo e(number_format($salary['salary'],2,'.',',')); ?></span>
            </div>    
        </div>
            
    </div>
</div>







<?php endif; ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>