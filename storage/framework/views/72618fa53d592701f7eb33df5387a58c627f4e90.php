<?php $__env->startSection('content'); ?>
<style type="text/css">
        .special-btn{
    color: #039be5 !important;
    background: none !important;
    padding: 0 !important;
    margin: 0 !important;
    font-size: 15px !important;
    }
    .aione-tooltip:before{
        width: auto !important;
        white-space: pre !important;
    }
</style>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Attendance',
	'add_new' => '+ Add Designation'
);
    $month = [1=>'January', 'February' , 'March' ,'April', 'May', 'June' , 'July', 'August', 'September', 'October', 'November','December'];
 ?> 
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.attendance._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div>
        <div class="aione-border mb-15">
            <div class="aione-border-bottom bg-grey bg-lighten-3 p-10 font-size-18">
                Filters
            </div>
            <div class="p-10">
                
                <div id="field_label_group_id" class="field-label">
                    <label for="input_group_id">
                        <h4 class="field-title" id="Select Group ID">Select year</h4>
                    </label>
                </div><!-- field label-->
                <div id="field_group_id" class="field field-type-select">
                    <?php echo Form::open(['route'=>'lists.attendance']); ?>

                        <div class="ar">
                            <div class="ac l80">
                                <?php echo Form::selectRange('year', 2015,2030, @$data['year'], ['id'=>'input_group_id', 'class'=>'browser-default']); ?>        
                            </div>
                            <div class="ac l20">
                                <?php echo Form::submit('Submit',['style'=>'width:100%']); ?>        
                            </div>
                        </div>
                        
                        
                    <?php echo Form::close(); ?>

                </div>
            
            </div>
        </div>
       

        <div class=" aione-table">
            <table>
                <thead>
                    <tr>
                        <th>Months</th>
                        <th>Lock/Unlock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1; $i<=12; $i++): ?>
                    <?php if(strlen($i)==1): ?>
                        <?php 
                        $j = '0'.$i;
                         ?>
                        <?php else: ?>
                         <?php 
                        $j = $i;
                         ?>

                    <?php endif; ?>
                    <tr>
                        <td><?php echo e($month[$i]); ?></td>
                        <td>
                            <?php if(isset($data[$j])): ?>
                             <?php echo Form::open(['route'=>'ajax.lock.attendance']); ?>

                                <input type="hidden" name="year" value="<?php echo e($data['year']); ?>">
                                <input type="hidden" name="month" value="<?php echo e($j); ?>">
                                    <?php if($data[$j]['lock_status']==0): ?>
                                        
                                        <?php echo Form::submit('Unlock',['name'=>'unlock','class'=>'special-btn','style'=>'color:orange !important']); ?>


                                    <?php else: ?> 
                                        <?php echo Form::submit('Locked',['name'=>'lock','class'=>'special-btn','style'=>'color:green !important']); ?>

                                    <?php endif; ?>
                                    
                              <?php echo Form::close(); ?>

                                <?php else: ?>
                                    <span class="red">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(isset($data[$j])): ?>
                                    <?php if($data[$j]['attendance_status']==0): ?>
                                        <?php 
                                           $attendance_status ='Partially';
                                         ?>
                                    <?php else: ?>
                                        <?php 
                                           $attendance_status ='Complete';
                                         ?>
                                    <?php endif; ?>
                                    <?php echo e($attendance_status); ?>

                            <?php else: ?>
                            Not Mark
                            <?php endif; ?>
                        </td>
                        <td style="width: 25%">
                            <?php echo Form::open(['route'=>'list.attendance','class'=>'display-inline']); ?>

                                <input type="hidden" name="year" value="<?php echo e($data['year']); ?>">
                                <input type="hidden" name="month" value="<?php echo e($j); ?>">
                                <?php echo Form::submit('view',['class'=>'special-btn']); ?>

                            <?php echo Form::close(); ?>

                            <?php if(isset($data[$j])): ?>
                            <a href="">
                                 
                                <?php echo Form::open(['route'=>'hr.attendance' ,'class'=>'display-inline']); ?>

                                <input type="hidden" name="year" value="<?php echo e($data['year']); ?>">
                                <input type="hidden" name="month" value="<?php echo e($j); ?>">
                                <input type="hidden" name="date" value="1">
                                <?php echo Form::submit('edit',['class'=>'special-btn']); ?>

                            <?php echo Form::close(); ?>

                            </a>
                           
                            <?php else: ?>
                                -
                            <?php endif; ?>
                            |
                             <a href="<?php echo e(route('import.form.attendance',['year'=>$data['year'],'month'=>$j])); ?>">import</a>
                             |
                            <?php echo Form::open(['route'=>'hr.attendance','class'=>'display-inline']); ?>

                                <input type="hidden" name="year" value="<?php echo e($data['year']); ?>">
                                <input type="hidden" name="month" value="<?php echo e($j); ?>">
                                <input type="hidden" name="date" value="1">
                                <?php echo Form::submit('Mark attendace',['class'=>'special-btn']); ?>

                            <?php echo Form::close(); ?>

                        </td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
             
        </div>
        <div id="main">

        </div>
    </div>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    function view_attendance(month){
        year = $("#input_group_id").val();
        window.location.replace(route()+'/atendance/'+year+'/'+month);
    }

    function import_attendance(month){
        year = $("#input_group_id").val();
        alert(year, month);
         window.location.replace(route()+'/attendance/import/'+year+'/'+month);//+);
    }
</script>	
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>