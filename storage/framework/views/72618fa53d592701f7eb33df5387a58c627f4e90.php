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
    .aione-button:hover i{
        color: #454545 !important;
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
                            <div class="ac l100">
                                <?php echo Form::selectRange('year', 2015,2030, @$data['year'], ['id'=>'input_group_id', 'class'=>'browser-default select-year']); ?>        
                            </div>
                            <div class="loading display-none line-height-40 font-weight-800 font-size-18">
                                Loading...
                            </div>
                          
                        </div>
                    <?php echo Form::close(); ?>

                    <script type="text/javascript">
                        $(document).on('change','.select-year',function(){
                            $('.loading').show();
                            this.form.submit();

                        })
                    </script>
                </div>
            
            </div>
        </div>
       

        
        
    </div>
    <div>
    	<div class="ar mb-100">
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
        		<div class="ac l25 aione-align-center mb-20" style="position: relative;">
        			<div class="bg-grey bg-darken-3 font-size-18  white p-15">
        				<i class="ion-calendar mr-10"></i><?php echo e($month[$i]); ?>, <?php echo e($data['year']); ?>

        			</div>
        			<div class="aione-border-left aione-border-right aione-border-bottom pv-10  border-grey border-lighten-2 bg-grey bg-lighten-4">
        				<div class="font-size-20 pv-20 line-height-60 font-weight-300 green ar">
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
                                <div class="ac l50">
                                    <div class="line-height-10 font-size-15 grey darken-1 font-weight-700">
                                        STATUS
                                    </div>
                                    <div class="">
                                        <span class="display-inline pv-5 ph-10 white bg-orange  font-size-14" style="border-radius: 10px;">
                                            <?php echo e($attendance_status); ?></span>
                                    </div>
                                                                        
                                </div>
                            <?php else: ?>
                                <div class="ac l50">
                                    <div class="line-height-10 font-size-15 grey darken-1 font-weight-700">
                                        STATUS
                                    </div>
                                    <div class="">
                                        <span class="display-inline pv-5 ph-10 white bg-red bg-lighten-2 font-size-14" style="border-radius: 10px;">
                                            Not Mark
                                        </span>
                                    </div>                                    
                                </div>
                            <?php endif; ?>
                            <?php if(isset($data[$j])): ?>
                                <div class="ac l50 aione-border-left border-grey border-lighten-2">
                                    <div class="line-height-10 font-size-15 grey darken-1 font-weight-700">
                                        LOCK STATUS
                                    </div>
                                    <div class="">
                                        <?php if($data[$j]['lock_status']==1): ?>
                                            <span class="display-inline pv-5 ph-10 white bg-green bg-lighten-2 font-size-14" style="border-radius: 10px;">
                                                Locked
                                            </span>
                                        <?php else: ?>
                                            <span class="display-inline pv-5 ph-10 white bg-green bg-lighten-2 font-size-14" style="border-radius: 10px;">
                                                Un-Locked
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="ac l50 aione-border-left border-grey border-lighten-2">
                                    <div class="line-height-10 font-size-15 grey darken-1 font-weight-700">
                                        LOCK STATUS
                                    </div>
                                    <div class="">
                                        <span class="display-inline pv-5 ph-10 white bg-red bg-lighten-2 font-size-14" style="border-radius: 10px;">
                                            Un-Locked
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
        				</div>
        				<div>
        					<a href="<?php echo e(route('list.attendance',['year'=>$data['year'],'month'=>$j])); ?>" class="aione-button  circle aione-shadow " title="View Attendance">
                                <i class="fa fa-tv grey lighten-1 line-height-36"></i>
                            </a>
                            <a href="<?php echo e(route('hr.attendance',['year'=>$data['year'],'month'=>$j])); ?>" class="aione-button  circle aione-shadow " title="Edit Attendance" >
                                <i class="fa fa-pencil grey lighten-1  line-height-36"></i>
                            </a>
                            <a href="<?php echo e(route('import.form.attendance',['year'=>$data['year'],'month'=>$j])); ?>" class="aione-button  circle aione-shadow " title="Import Attendance" >
                                <i class="fa fa-sign-in grey lighten-1  line-height-36"></i>
                            </a>
                            <a href="<?php echo e(route('hr.attendance',['year'=>$data['year'],'month'=>$j])); ?>" class="aione-button  circle aione-shadow " title="Mark Attendance" >
                                <i class="fa fa-table grey lighten-1 line-height-36"></i>
                            </a>
                            <?php if(@$data[$j]['lock_status'] == 0 &&  @$data[$j]['lock_status'] == null): ?>
                                <a href="<?php echo e(route('ajax.lock.attendance',['year'=>$data['year'],'month'=>$j,'lock_status'=>'false'])); ?>" class="aione-button  circle aione-shadow " title="Lock Attendance">
                                    <i class="fa fa-unlock grey lighten-1 line-height-36"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('ajax.lock.attendance',['year'=>$data['year'],'month'=>$j,'lock_status'=>'true'])); ?>" class="aione-button bg-red circle aione-shadow " title="Lock Attendance">
                                    <i class="fa fa-lock white lighten-1 line-height-36"></i>
                                </a>
                            <?php endif; ?>
        				</div>
        			</div>
        		</div>    
            <?php endfor; ?>
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