<?php $__env->startSection('content'); ?>
<?php 
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Project Details',
    'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">
    <?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col l2  pr-7 center-align " style="margin-top: 14px" >

        <div class="card col m6 l12" style="padding: 20px;">
            
            <div class="blue project-logo" style="text-transform: uppercase;" >
               <?php echo e(@ucwords(substr($model->name,0,2))); ?> 
            </div>
            <div class="p-15">
                <?php echo e(@ucfirst($model->name)); ?>

            </div>
        </div>
        <div class="card col m6 l12" style="padding: 20px 10px;margin-top: 14px !important">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <h6 style="margin-top: 0px;">Tasks</h6>
            </div>
            <div class="col l12">
                <div class="col s12 m12 l12 pv-5 "><strong>276</strong><span class="grey-text pl-7">Total tasks</span></div>
                <div class="col s12 m12 l12 pv-5"><strong>178</strong><span class="grey-text pl-7">Tasks left</span></div>
                <div class="col s12 m12 l12 pv-5"> <strong>98</strong><span class="grey-text pl-7">Tasks completed</span></div>
                <div class="col s12 m12 l12 pv-5"><a href="">Create a new task</a></div>
                <strong>OR</strong>
                <div class="col s12 m12 l12 pv-5"><a >Track task</a></div>
            </div>
            <div style="clear: both">
                

            </div>
        </div>
      

    </div>



    <div class="col l8 pl-7 pr-7" style="margin-top: 14px">
        <div class="card">
           
            <div>
                <div class="row">
                   
                    <div id="test1" class="col s12 p-15">
                       
                        <div class="row">
                            <div class="col s12 m12  l12" style="border-bottom: 1px solid #e8e8e8;">
                                <div class="col l6">
                                    <h5 style="margin-top: 0px;">Project Details</h5>
                                </div>
                                <div class="col l6 right-align" >
                                    <a href="#modal3" class="btn">Edit</a>
                                    <?php echo Form::model($model,['route'=>['update.project',$model->id],'method'=>'POST']); ?>

                                   
                                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Project detail','button_title'=>'Save','section'=>'prosec3']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                     <?php echo Form::close(); ?>

                                </div>
                                    
                            </div>

                            <div class="col s12 m12  l12" style="margin-top: 10px">
                                <div class=" col l3">
                                    Project Name
                                </div>
                                <div class=" col l9">
                                    <?php echo e($model->name); ?>

                                </div>
                            </div>
                            <div class="col s12 m12  l12"  style="margin-top: 10px">
                                <div class=" col l3">
                                    Description
                                </div>
                                <div class=" col l9">
                                    <?php echo e(@$model->description); ?>

                                </div>
                            </div>
                            <div class="col s12 m12  l12"  style="margin-top: 10px">
                                <div class=" col l3">
                                    Location
                                </div>
                                <div class=" col l9">
                                    <?php echo e(@$model->location); ?>

                                </div>
                            </div>
                            <div class="col s12 m12 l12 "  style="margin-top: 10px">
                                <div class=" col l3">
                                    Start Date
                                </div>
                                <div class=" col l9">
                                    <?php echo e(@$model->start_date); ?>

                                </div>
                            </div>
                            <div class="col s12 m12 l12"  style="margin-top: 10px">
                                <div class=" col l3">
                                    End Date
                                </div>
                                <div class=" col l9">
                                    <?php echo e(@$model->end_date); ?>

                                </div>
                            </div>
                            <div class="col s12 m12 l12"  style="margin-top: 10px">
                                <div class=" col l3">
                                    Added By
                                </div>
                                <div class=" col l9">
                                    <div class="col l6">
                                        <?php echo e(@$model->added_by); ?>

                                    </div>
                                    <div class="col l6 right-align grey-text">
                                        2 hours ago 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col l2  pl-7" style="margin-top: 14px">
        
        <div class="card" style="margin-bottom: 10px !important;">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <span>Team assigned</span>
            </div>
            <div class="col l12">
                <?php if($model->teams != null): ?>
                    <?php $__currentLoopData = @$model->teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                           $team =  App\Model\Organization\Team::find($value);
                         ?>
                        <div class="col s10 m10 l10 p-10 grey-text fs-13"><?php echo e($team ->title); ?></span></div>
                        <div class="col s2 m2 l2 p-10"> <strong><?php echo e(count(json_decode($team->member_ids))); ?></strong></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="col s12 m12 l12 pv-5">
                  
                </div>
                 
                
                <div class="col s12 m12 l12 pv-5">
                    <?php
                        if($model->teams != null){
                            $model->teams = array_map('intval', $model->teams);
                        }
                    ?>
                    
                    
                </div>
            </div>
            <div style="clear: both">  
            </div>
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <span">Users assigned</span>
            </div>
            <div class="col l12">
                <?php if($model->users != null): ?>
                    <?php $__currentLoopData = @$model->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                           $users =  App\Model\Organization\User::with('metas')->find($value);
                         ?>
                           
                        <div class="col s12 m12 l12 pv-5 "><?php echo e($users ->name); ?></span></div>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="col s12 m12 l12 pv-5">
                  
                </div>
                 
                
                <div class="col s12 m12 l12 pv-5">
                    <?php
                        if($model->teams != null){
                            $model->teams = array_map('intval', $model->teams);
                        }
                        if($model->users != null){
                            $model->users = array_map('intval', $model->teams);
                        }
                    ?>
                    <a href="#modal2" style="font-size: 10px">Assign another team</a>
                    <?php echo Form::model($model,['route'=>['update.team',$model->id]]); ?>

                        <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'prosec4']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo Form::close(); ?>

                </div>
            </div>
            <div style="clear: both">
                
            </div>
        </div>
        <div class="card p-15" style="margin-bottom: 10px !important;">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <h6 style="margin-top: 0px;">Users assigned</h6>
            </div>
            <div class="col l12">
                <?php if($model->users != null): ?>
                    <?php $__currentLoopData = @$model->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                           $users =  App\Model\Organization\User::find($value);
                         ?>
                        <div class="col s12 m12 l12 pv-5 "><?php echo e($users ->name); ?></span></div>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="col s12 m12 l12 pv-5">
                  
                </div>
                 
                
                <div class="col s12 m12 l12 pv-5">
                    <?php
                        if($model->teams != null){
                            $model->teams = array_map('intval', $model->teams);
                        }
                    ?>
                    <a href="#modal2" style="font-size: 10px">Assign another team</a>
                    <?php echo Form::model($model,['route'=>['update.team',$model->id]]); ?>

                        <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'prosec4']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo Form::close(); ?>

                </div>
            </div>
            <div style="clear: both">
                
            </div>
        </div>
        <div class="card p-15"  style="margin-bottom: 10px !important;">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <h6 style="margin-top: 0px;">Client</h6>
            </div>
            <div class="col s12 m12 l12">
                <div class="col l12 pv-5 ">
                    <div class="chip">
                        <img src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>" alt="Contact Person">
                        Ashish Joshi
                    </div>
                </div>
                
            </div>
            <div style="clear: both">
                
            </div>
        </div>
        <div class="card p-15"  style="margin-bottom: 10px !important;">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <h6 style="margin-top: 0px;">More</h6>
            </div>
            <div class="col s12 m12 l12">
                <div class="col s12 m12 l12 pv-5 ">
                     <div class="col s12 m12 l12 pv-5 "><strong>9</strong><span class="grey-text pl-7">Documentations</span></div>
                     <div class="col s12 m12 l12 pv-5"><strong>7</strong><span class="grey-text pl-7">Notes</span></div>
                     <div class="col s12 m12 l12 pv-5"> <strong>98</strong><span class="grey-text pl-7">Credenatials</span></div>
                     <div class="col s12 m12 l12 pv-5"> <strong>8</strong><span class="grey-text pl-7">Attachments</span></div>
                </div>
            </div>
            <div style="clear: both">
                
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style type="text/css">
    .card{
        margin: 0px !important;
    }
    .projects-logo{
        
        background-color: #000;margin: 10%;

    }
    .tabs{
        height: 32px !important;
    }
    .tabs .tab{
        line-height: 32px !important;
        
    }
    .tabs .tab a{
        font-size: 10px !important;color: rgb(33, 150, 243) !important;
    }
    .active{
        background-color: #fff !important;
    }
    .p-15{
        padding: 15px !important;
    }
    .pv-5{
        padding: 5px 0px !important; 
    }
    .project-logo{
        color: white;width: 70px;margin: 0 auto; line-height: 70px;font-size: 24px;border-radius: 50%
    }
    .tabs .tab a{
        padding:0 12px;
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
    .select-wrapper .dropdown-content{
        max-height: 300px !important
    }
    .fs-13{
        font-size:13px;
    }
    .p-10{
        padding: 10px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
      $('#modal1').modal();
      $('#modal2').modal(); 
      $('#modal3').modal();
       });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>