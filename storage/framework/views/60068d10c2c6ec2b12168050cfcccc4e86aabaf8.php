<?php $__env->startSection('content'); ?>
<style type="text/css">
    .project-details > div{
        padding-right: 14px !important;
    }
    .project-details .card{
        padding: 10px;

    }
    .project-details .card .project-logo{
        width: 50px;
        margin: 10px auto;
        line-height: 50px;
        border-radius: 50%;
        color: white
    }
    .project-details .card >div {
        margin-bottom: 10px;
    }
    .project-details .card > .headline{
       border-bottom: 1px solid #e8e8e8;
       padding-bottom: 10px;
    }
    .project-details .card > .headline > h6{
        display: inline-block;
    }
    .project-details .card > .headline > .edit{
      float: right
    }
    .project-details .card > .list >div{
        margin-bottom: 10px
    }
    .project-details .members-list img{
        float: left;
        height: 30px;
        width: 30px;
        border-radius: 50%;
    }
    .project-details .members-list span{
        float: left;
        line-height: 30px;
        padding-left: 10px;
    }
</style>
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

    <?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="row project-details">
        <div class="col l2 center-align "  >

            <div class="card ">
                
                <div class="blue project-logo"  >
                   <?php echo e(@ucwords(substr($model->name,0,2))); ?> 
                </div>
                <div class="p-15">
                    <?php echo e(@ucfirst($model->name)); ?> <?php echo e(@ucfirst($model->name)); ?> <?php echo e(@ucfirst($model->name)); ?>

                </div>
            </div>
            <div class="card row" >
                <div class="col s12 m12 l12 headline" >
                    <h6 >Tasks</h6>
                </div>
                <div class="col l12 list">
                    <div class="col s12 m12 l12 pv-5 "><strong>276</strong><span class="grey-text pl-7">Total tasks</span></div>
                    <div class="col s12 m12 l12 pv-5"><strong>178</strong><span class="grey-text pl-7">Tasks left</span></div>
                    <div class="col s12 m12 l12 pv-5"> <strong>98</strong><span class="grey-text pl-7">Tasks completed</span></div>
                    <div class="col s12 m12 l12 pv-5"><a href="">Create a new task</a></div>
                    <strong>OR</strong>
                    <div class="col s12 m12 l12 pv-5"><a >Track task</a></div>
                </div>
            </div>
        </div>
        <div class="col l8 " >
            <div class="card">  
                <div class="col s12 m12 l12 headline" >
                    <h6 >Project Details</h6>
                    <a href="#modal3" class="edit">Edit</a>
                    <?php echo Form::model($model,['route'=>['update.project',$model->id],'method'=>'POST']); ?>

                   
                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Project detail','button_title'=>'Save','section'=>'prosec3']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                     <?php echo Form::close(); ?>

                </div>
                <div class="list row">
                    <div class="col s12 m12  l12" >
                        <div class=" col l3">
                            Project Name
                        </div>
                        <div class=" col l9">
                            <?php echo e($model->name); ?>

                        </div>
                    </div>
                    <div class="col s12 m12  l12"  >
                        <div class=" col l3">
                            Description
                        </div>
                        <div class=" col l9">
                            <?php echo e(@$model->description); ?>

                        </div>
                    </div>
                    <div class="col s12 m12  l12"  >
                        <div class=" col l3">
                            Location
                        </div>
                        <div class=" col l9">
                            <?php echo e(@$model->location); ?>

                        </div>
                    </div>
                    <div class="col s12 m12 l12 "  >
                        <div class=" col l3">
                            Start Date
                        </div>
                        <div class=" col l9">
                            <?php echo e(@$model->start_date); ?>

                        </div>
                    </div>
                    <div class="col s12 m12 l12"  >
                        <div class=" col l3">
                            End Date
                        </div>
                        <div class=" col l9">
                            <?php echo e(@$model->end_date); ?>

                        </div>
                    </div>
                    <div class="col s12 m12 l12"  >
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
        <div class="col l2 " >
            <div class="card row" >
                 <div class="col s12 m12 l12 headline" >
                    <h6 >Teams</h6>
                </div>
                <div class="col l12 members-list">
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
                        <?php
                            if($model->teams != null){
                                $model->teams = array_map('intval', $model->teams);
                            }
                        ?>
                    </div>
                    <div class=" waves-effect" style="width: 100%;padding:5px">
                        <img src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>" alt="Contact Person">
                        <span>Sgs Sandhu</span>
                    </div>
                    <div class=" waves-effect" style="width: 100%;padding:5px">
                        <img src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>" alt="Contact Person">
                        <span>Sgs Sandhu</span>
                    </div>
                    <div class=" waves-effect" style="width: 100%;padding:5px">
                        <img src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>" alt="Contact Person">
                        <span>Sgs Sandhu</span>
                    </div>
                  
                </div>
            </div>
            <div class="card row" >
                <div class="col s12 m12 l12 headline" >
                    <h6 >Users</h6>
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
                        <a href="#modal2" >Assign another team</a>
                        <?php echo Form::model($model,['route'=>['update.team',$model->id]]); ?>

                            <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'prosec4']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
                
            </div>
            <div class="card row" >
                <div class="col s12 m12 l12 headline" >
                    <h6 >Clients</h6>
                </div>
                <div class="col s12 m12 l12">
                    <div class="col l12 pv-5 ">
                        <div class="chip">
                            <img src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>" alt="Contact Person">
                            Ashish Joshi
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <div class="card row">
                <div class="col s12 m12 l12 headline" >
                    <h6 >More</h6>
                </div>
                <div class="col s12 m12 l12 list" >
                     <div class="col s12 m12 l12 pv-5 "><strong>9</strong><a href="<?php echo e(route('documentation.project',$model->id)); ?>"><span class="grey-text pl-7">Documentations</span></a></div>
                     <div class="col s12 m12 l12 pv-5"><strong>7</strong><a href="<?php echo e(route('notes.project',$model->id)); ?>"><span class="grey-text pl-7">Notes</span></a></div>
                     <div class="col s12 m12 l12 pv-5"> <strong>98</strong><a href="<?php echo e(route('credentials.project',$model->id)); ?>"><span class="grey-text pl-7">Credenatials</span></a></div>
                     <div class="col s12 m12 l12 pv-5"> <strong>8</strong><a href="<?php echo e(route('attachment.project',$model->id)); ?>"><span class="grey-text pl-7">Attachments</span></a></div>
                </div>
                
            </div>
        </div>
    </div>
        

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    $(document).ready(function(){
      $('#modal1').modal();
      $('#modal2').modal(); 
      $('#modal3').modal();
       });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>