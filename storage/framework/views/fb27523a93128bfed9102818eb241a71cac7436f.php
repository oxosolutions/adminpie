<?php $__env->startSection('content'); ?>
<?php 
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Tasks',
    'add_new' => '+ Add Tasks'
); 
    $Tasks = 'App\Model\Organization\Tasks';
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if($errors->any()): ?>
        <script type="text/javascript">
          window.onload = function(){
            $('#add_new_model').modal('open');
          }
        </script>
      <?php endif; ?>
	   <?php if(request()->project_id != null): ?>
        
        <?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       

       <?php endif; ?>
        <div class="ph-15 mb-10">
            <div class="aione-border  pt-10">
                <?php echo FormGenerator::GenerateForm('project-task-filter-form'); ?>           
            </div>
        </div>
        <div class="ar" id="task_container">
            <div class="ac l33 ">
                <div class="aione-border" >
                    <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                        Pending          
                        <span class="aione-float-right count"></span>   

                    </h5>
                    <div class="p-10 task-list" id="pending" style="min-height: 400px;max-height: 400px;overflow: auto;">
                        <?php $__currentLoopData = $tasks->where('status',0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="aione-shadow task  mb-15 p-10 priority-<?php echo e($task->priority); ?>" data-target="edit_task" taskid="<?php echo e($task->id); ?>">
                                <div class="truncate font-size-16 font-weight-700 line-height-22">
                                    <a class="grey darken-1" href="<?php echo e(route('view.tasks',$task->id)); ?>"> <?php echo e($task->title); ?> </a>
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Assign To : <?php echo e(call_model('Tasks','generateUsersList',$task)); ?>

                                </div>
                                <div class="line-height-22 grey truncate">
                                    Due : <?php echo e(call_model('Tasks','generateDaysLeft',$task)); ?> left | By : <?php echo e(user_id_to_name($task->created_by)); ?> | 28 comments
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>    
                </div>
            </div>
            <div class="ac l33 ">
                <div class="aione-border" >
                    <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                        In progress           
                        <span class="aione-float-right count"></span>   

                    </h5>  
                    <div class="p-10 task-list" style="min-height: 400px;max-height: 400px;overflow: auto" id="in_progress">
                          
                        <?php $__currentLoopData = $tasks->where('status',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="aione-shadow task  mb-15 p-10 priority-<?php echo e($task->priority); ?>" data-target="edit_task" taskid="<?php echo e($task->id); ?>">
                                <div class="truncate font-size-16 font-weight-700 line-height-22">
                                    <a class="grey darken-1" href="<?php echo e(route('view.tasks',$task->id)); ?>"><?php echo e($task->title); ?></a>
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Assign To : <?php echo e(call_model('Tasks','generateUsersList',$task)); ?>

                                </div>
                                <div class="line-height-22 grey truncate">
                                    Due : <?php echo e(call_model('Tasks','generateDaysLeft',$task)); ?> left | By : <?php echo e(user_id_to_name($task->created_by)); ?> | 28 comments
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>     
                </div>
            </div>
            <div class="ac l33 ">
                <div class="aione-border" id="task_container">
                    <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                        Completed   
                        <span class="aione-float-right count"></span>   
                    </h5> 
                    <div class="p-10 task-list" id="completed" style="min-height: 400px;max-height: 400px;overflow: auto">
                       <?php $__currentLoopData = $tasks->where('status',2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="aione-shadow task  mb-15 p-10 priority-<?php echo e($task->priority); ?>" data-target="edit_task" taskid="<?php echo e($task->id); ?>">
                                <div class="truncate font-size-16 font-weight-700 line-height-22">
                                    <a class="grey darken-1" href="<?php echo e(route('view.tasks',$task->id)); ?>"><?php echo e($task->title); ?></a>
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Assign To : <?php echo e(call_model('Tasks','generateUsersList',$task)); ?>

                                </div>
                                <div class="line-height-22 grey truncate">
                                    Due : <?php echo e(call_model('Tasks','generateDaysLeft',$task)); ?> left | By : <?php echo e(user_id_to_name($task->created_by)); ?> | 28 comments
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>      
                </div>
            </div>
        </div>
	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo Form::model(@$project,['route'=>'create.tasks','files'=>true]); ?>

        <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Task','button_title'=>'Save','section'=>'tassec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::close(); ?>

    <style type="text/css">
        .priority-high,
        .priority-medium,
        .priority-low{
            position: relative;
            cursor: move;
            background: white
            
        }
        .priority-high:before,
        .priority-medium:before,
        .priority-low:before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            border-top: 12px solid;
            border-right: 12px solid transparent
        }
        .priority-high:before{
            border-top-color: red;
        }
        .priority-medium:before{
            border-top-color: green;
        }
        .priority-low:before{
            border-top-color: yellow;
        }
    </style>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/Sortable.js')); ?>"></script>
    <script type="text/javascript">
        count();
        [].forEach.call(document.getElementById('task_container').getElementsByClassName('task-list'), function (el){
            Sortable.create(el, {
                group: 'tasks',
                animation: 150,
                draggable: ".task",
                onAdd: function (evt/**Event*/){
                    count();
                    console.log(evt);
                    var dropedIn = evt.to.attributes.id.nodeValue;
                    var taskID = evt.clone.attributes.taskid.nodeValue;
                    console.log(dropedIn,taskID);
                    switch(dropedIn){
                        case'in_progress':
                            updateStatus(taskID,1);
                        break;
                        case'completed':
                            updateStatus(taskID,2);
                        break;
                        case'pending':
                            updateStatus(taskID,0);
                        break;
                    }
                    var item = evt.item; 
                }
            });
        });
        function updateStatus(task_id, status){
            $.ajax({
               type:'POST',
               url:route()+'/task/status/update',
               data: {_token: '<?php echo e(csrf_token()); ?>',task_id: task_id, status: status},
               success: function(result){
                    console.log(result);
               } 
            });
        }
        function count(){
            $('.task-list').each(
              function() {
                $(this).parents('.aione-border').find('.count').text($('.task', $(this)).length);
              }
            );    
        }
    </script>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>