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

    <?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="ar">
        <div class="ac l65 aione-table">
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                     Project Details
                     <button class="aione-button aione-float-right font-size-14 " data-target="edit-project-details"  style="margin-top: -6px">Edit</button>
                     <?php echo Form::model(@$model,['route'=>['update.project.details',request()->id],'method'=>'post']); ?>

                     <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'edit-project-details','heading'=>'Edit Project Details','button_title'=>'Save ','form'=>'edit-project-details-form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                     <?php echo Form::close(); ?>

                </div>
                <div class="p-10 ">
                    <div class="font-weight-600 line-height-30 font-size-18">
                        <?php echo e($model->name); ?>    
                    </div>
                    <div class="line-height-30 font-size-13 ">
                        <span class="bg-green white p-2 ph-5">
                          <?php echo e(App\Model\Organization\ProjectCategory::find($model->category)->name); ?>      
                        </span>
                    </div>
                    <div class="line-height-26 mb-15" style="text-align: justify;">
                        <?php echo e($model->description); ?>

                    </div>
                    <div class="line-height-30 mb-20 font-size-13 ">
                        <i class="fa fa-tags"></i>
                        <?php 
                            $tags = explode(',',$model->tags);
                         ?>
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class=" mr-5 bg-light-blue bg-darken-2 white p-2 ph-10 posi" style="border-radius: 4px">
                            <?php echo e($tag); ?>    
                        </span>
                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td>End Date</td>
                                <td><?php echo e($model->end_date); ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo e($model->start_date); ?></td>
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td>
                                <?php echo e(App\Model\Group\GroupUsers::find($model->created_by)->name); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Priority</td>
                                <td>
                                    <?php if($model->priority == 'high'): ?>
                                        <span class="red">
                                            High    
                                        </span>
                                    <?php endif; ?>
                                    <?php if($model->priority == 'medium'): ?>
                                        <span class="blue">
                                            Medium    
                                        </span>
                                    <?php endif; ?>
                                    <?php if($model->priority == 'low'): ?>
                                        <span class="green">
                                            Low         
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?php echo e(ucWords(str_replace('_',' ',$model->status))); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    
            </div>
            <div class="aione-border">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Attachments
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-image"  style="margin-top: -6px">+ Add</button>
                    <?php echo Form::open(['route'=>['upload.project.attachments',request()->id],'method'=>'post','files'=>true]); ?>

                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add-image','heading'=>'Add Image','button_title'=>'Upload ','form'=>'add-attachments-form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo Form::close(); ?>

                </div>
                
                <div class="p-10 ar">
                    <?php if($model->attachments != null): ?>
                        <?php $__currentLoopData = $model->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                                $exploded = explode('.',$attachment->file);
                                $countIndex = count($exploded)-1;
                             ?>
                            <div class="ac l25 aione-align-center mb-20">
                                <span class="aione-border display-inline-block width-100 image-wrapper" style="width: 100%">
                                    <?php if(in_array($exploded[$countIndex],['jpg','jpeg','png','gif'])): ?>
                                        <img src="<?php echo e(url('/').'/'.upload_path('project_attachments').'/'.$attachment->file); ?>" class="mr-20" style="height: 100px">   
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/images/file-icon.png')); ?>" class="mr-20" style="height: 100px">
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('delete.project.attachment',['attachment_index'=>$key,'id'=>request()->id])); ?>" class="delete-sweet-alert">
                                        <i class="fa fa-trash"></i>    
                                    </a>
                                    <a href="<?php echo e(url('/').'/'.upload_path('project_attachments').'/'.$attachment->file); ?>" target="_blank">
                                        <i class="fa fa-download"></i>    
                                    </a>
                                    
                                    <div class="bg-white p-5 aione-border-top truncate aione-tooltip" title="<?php echo e($attachment->name); ?>">
                                        <?php echo e($attachment->name); ?>

                                    </div>
                                </span>
                                
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                    
            </div>
        </div>
        <div class="ac l35">
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assign Teams
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-team" style="margin-top: -6px">+ Add</button>
                    <?php echo Form::model(@$model,['route'=>['assign.project.team',request()->id]]); ?>

                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add-team','heading'=>'Add Team','button_title'=>'Save ','form'=>'assign-team-form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo Form::close(); ?>

                </div>
                <div class=" aione-table">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Members</th>
                                
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($model->assigned_team != null): ?>
                                <?php $__currentLoopData = $model->assigned_team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $team_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $members = 0;
                                        $teamModel = App\Model\Organization\Team::find($team_id);
                                        if($teamModel->member_ids != '' && $teamModel->member_ids != null){
                                            $members = count(json_decode(@$teamModel->member_ids));
                                        }
                                     ?>
                                    <tr>
                                        <td><?php echo e($teamModel->title); ?></td>
                                        <td><?php echo e($members); ?></td>
                                        
                                        <td>
                                            <a href="<?php echo e(route('remove.project.team',['project_id'=>request()->id,'index_id'=>$key])); ?>" class="delete-sweet-alert">Remove</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>          
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assign Users
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-user" style="margin-top: -6px">+ Add</button>
                    <?php echo Form::model(@$model,['route'=>['assign.project.user',request()->id]]); ?>

                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add-user','heading'=>'Add User','button_title'=>'Save ','form'=>'assign-user-form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo Form::close(); ?>

                </div>
                <div class="aione-table">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($model->assigned_user != null): ?>
                                <?php $__currentLoopData = $model->assigned_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(ucwords(user_id_to_name($user_id))); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('remove.assigned.user',['user_index'=>$key,'project_id'=>request()->id])); ?>"  class="delete-sweet-alert">Remove</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>          
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assign Clients
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-client" style="margin-top: -6px">+ Add</button>
                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add-client','heading'=>'Add Client','button_title'=>'Save ','form'=>'assign-client-form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="aione-table">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Dao</td>
                                
                                <td>
                                    <a href="">Remove</a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>          
        </div>
    </div>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.confirm-alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
    .image-wrapper{
        position: relative;

    }
    .image-wrapper .fa-trash,
    .image-wrapper .fa-download{
        position: absolute;
        top: 5px;
        right: 5px;
        display: none;
        cursor: pointer;
    }
    .image-wrapper .fa-download{
        top: 7px;
        right: 30px
    }
    .image-wrapper:hover .fa-trash,
    .image-wrapper:hover .fa-download{
        display: block;
    }
</style>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>