<?php $__env->startSection('content'); ?>
<?php 
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Task :',
    'add_new' => '+ Add Tasks'
);
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <div class="ar">
        <div class="ac l65 aione-table">
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                     Task Details
                     <button class="aione-button aione-float-right font-size-14 " data-target="edit-task-modal"  style="margin-top: -6px">Edit</button>
                     <?php echo Form::model(@$task,['route'=>['update.tasks',request()->id],'method'=>'post','files'=>true]); ?>

                     <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'edit-task-modal','heading'=>'Edit Task','button_title'=>'Save','section'=>'tassec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                     <?php echo Form::close(); ?>

                </div>
                <div class="p-10 ">
                    <div class="font-weight-600 line-height-30 font-size-18">
                        <?php echo e($task->title); ?>    
                    </div>
                   
                    <div class="line-height-26 mb-15" style="text-align: justify;">
                        <?php echo e($task->description); ?> 
                    </div>
                 
                    <table>
                        <tbody>
                            <tr>
                                <td>Due Date</td>
                                <td><?php echo e($task->end_date); ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo e($task->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td>
                                    <?php echo e(user_id_to_name($task->created_by)); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Priority</td>
                                <td>

                                    <span class="red">
                                        <?php echo e(ucWords($task->priority)); ?>    
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                  
                                    <span class="dropdown">
                                      <button id="status_button"><?php echo e(call_model('Tasks','getStatus',$task->status)); ?></button>
                                      <label>
                                        <input type="checkbox">
                                        <ul>
                                          <li onclick="updateStatus(0,<?php echo e($task->id); ?>)">Pending</li>
                                          <li onclick="updateStatus(1,<?php echo e($task->id); ?>)">In progress</li>
                                          <li onclick="updateStatus(2,<?php echo e($task->id); ?>)">Completed</li>
                                        </ul>
                                      </label>
                                    </span>

                                    
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    
            </div>

            <div class="aione-border mb-20  ">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18 ">
                     Comments 
                </div>
                <div class="p-10">
                    <?php if($task['comments'] != null && !$task['comments']->isEmpty()): ?>
                        <?php $__currentLoopData = $task['comments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="aione-border-bottom pt-10">
                                <div class="ar ">
                                    <div class="ac l50 font-weight-700 font-size-16">
                                        <?php echo e(user_id_to_name($comment->user_id)); ?>

                                    </div>
                                    <div class="ac l50 aione-align-right font-size-13">
                                        <?php echo e($comment->created_at->diffForHumans()); ?>

                                    </div>
                                </div>    
                                <div class="p-10 grey">
                                    <?php echo e($comment->comment); ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    
                    <?php echo Form::open(['route'=>'post.comment']); ?>

                        <div>
                            <?php echo Form::textarea('comment',null,['rows'=>'5']); ?>

                            <?php echo Form::hidden('type','task'); ?>

                            <?php echo Form::hidden('target_id',request()->id); ?>

                            <?php echo Form::hidden('user_id',get_user()->id); ?>

                            <?php echo Form::submit('Post Comment',['class'=>'mt-10 aione-float-right']); ?>

                        </div>
                    <?php echo Form::close(); ?>

                </div>
                    
            </div>

           
        </div>
        <div class="ac l35">
              
             <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assigned Users
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
                            <tr>
                                <td>
                                    Ashish
                                </td>
                                <td>
                                    <a href="">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
             <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Attachments
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-image"  style="margin-top: -6px">+ Add</button>
                    <?php echo Form::open(['route'=>['upload.task.attachment',request()->id],'method'=>'post','files'=>true]); ?>

                    <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add-image','heading'=>'Add Image','button_title'=>'Upload ','form'=>'add-task-attachments-form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo Form::close(); ?>

                </div>
                
                <div class="p-10 ar">
                        <?php $__currentLoopData = $task->attachment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                                $exploded = explode('.',$file);
                                $countIndex = count($exploded)-1;
                             ?>
                            <div class="ac l50 aione-align-center mb-20">
                                <span class="aione-border display-inline-block width-100 image-wrapper" style="width: 100%">
                                    <?php if(in_array($exploded[$countIndex],['jpg','jpeg','png','gif'])): ?>
                                        <img src="<?php echo e(url('/').'/'.upload_path('tasks_attachment').'/'.$file); ?>" class="mr-20" style="height: 100px">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/images/file-icon.png')); ?>" class="mr-20" style="height: 100px">
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('remove.task.attachment',['id'=>$task->id,'index'=>$key])); ?>" class="delete-sweet-alert">
                                        <i class="fa fa-trash"></i>    
                                    </a>
                                    <a href="<?php echo e(url('/').'/'.upload_path('tasks_attachment').'/'.$file); ?>" target="_blank">
                                        <i class="fa fa-download"></i>    
                                    </a>
                                    
                                </span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    /****************************************************************/
    /**                     Drop Down Button                      ***/
    /****************************************************************/

    .dropdown {
      position: relative;
      display: inline-block;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      font-size: 14px;
    }

    .dropdown > a, .dropdown > button {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      font-size: 14px;
      background-color: white;
      border: 1px solid #ccc;
      padding: 6px 20px 6px 10px;
      border-radius: 4px;
      display: inline-block;
      color: black;
      text-decoration: none;
    }

    .dropdown > a:before, .dropdown > button:before {
      position: absolute;
      right: 7px;
      top: 17px;
      content: ' ';
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 5px solid black;
    }

    .dropdown input[type=checkbox] {
      position: absolute;
      display: block;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      margin: 0px;
      opacity: 0;
    }

    .dropdown input[type=checkbox]:checked {
      position: fixed;
      z-index:+0;
      top: 0px; left: 0px; 
      right: 0px; bottom: 0px;
    }

    .dropdown ul {
      position: absolute;
      top: 18px;
      border: 1px solid #ccc;
      border-radius: 3px;
      left: 0px;
      list-style: none;
      padding: 4px 0px;
      display: none;
      background-color: white;
      box-shadow: 0 3px 6px rgba(0,0,0,.175);
    }

    .dropdown input[type=checkbox]:checked + ul {
      display: block;
    }

    .dropdown ul li {
      display: block;
      padding: 6px 20px;
      white-space: nowrap;
      min-width: 100px;
    }

    .dropdown ul li:hover {
      background-color: #F5F5F5;
      cursor: pointer;
    }

    .dropdown ul li a {
      text-decoration: none;
      display: block;
      color: black
    }

    .dropdown .divider {
      height: 1px;
      margin: 9px 0;
      overflow: hidden;
      background-color: #e5e5e5;
      font-size: 1px;
      padding: 0;

    }


</style>
<script type="text/javascript">
    let status,task_id;
    function updateStatus(status,task_id){
        console.log(status+task_id);
        $.ajax({
           type:'POST',
           url:route()+'/task/status/update',
           data: {_token: '<?php echo e(csrf_token()); ?>',task_id: task_id, status: status},
           success: function(result){
                console.log(result);
                if (status == 0) {
                    $('#status_button').text('Pending');    
                } 
                if (status == 1) {
                    $('#status_button').text('In progress');
                } 
                if (status == 2) {
                    $('#status_button').text('Completed');
                }
                 Materialize.toast('Successfully Updated', 3000)
                
           } 
        });
    }
</script>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>