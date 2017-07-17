<?php 
    $team = [];
    $usersName = [];
    $index= 0;
 ?>
<?php if(@$model): ?>
    <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <?php 
        $assign = json_decode($value->assign_to);
        $teamData = App\Model\Organization\Team::getTeamById($assign->team);
        $prioritySelect = $value->priority;
         ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<style type="text/css">
    .display-none{
        display: none;
    }
</style>
<div class="progress">
  <div class="indeterminate"></div>
</div>
<div style="background-color: rgba(0, 0, 0, 0.5);height: 100vh;width: 100%;position: fixed;top: 0;left: 0;z-index: 99999;display: none;">
	<div class="preloader-wrapper active" style="position: relative;top: 50%;left: 50%">
	    <div class="spinner-layer spinner-red-only">
		    <div class="circle-clipper left">
		        <div class="circle"></div>
		    </div><div class="gap-patch">
		        <div class="circle"></div>
		    </div><div class="circle-clipper right">
		        <div class="circle"></div>
		    </div>
		</div>
	</div>	
</div> 
<div class="col l12 main-div">
    <div class="card">
       <div class="input-field col s4">
            <select class="filter_priority">
              <option value="" disabled selected>Priority Filter</option>
              <option value="low">Low</option>
              <option  value="medium">Medium</option>
              <option  value="high">High</option>
            </select>
            <label>Priority Filter</label>
        </div>
            <?php if(array_key_exists('id',request()->route()->parameters())): ?>
                <div class="input-field col s4 ">
                    <?php echo Form::select('assign_to',App\Model\Organization\Employee::employees(),null,["class"=>"no-margin-bottom aione-field Employee_filter" , 'placeholder'=>'Employee Filter']); ?>

                    <label>Employee Filter</label>
                  </div>
            <?php else: ?>

            <?php endif; ?>
          
            <?php if(array_key_exists('id',request()->route()->parameters())): ?>

            <?php else: ?>
                <div class="input-field col s4 ">
                <?php echo Form::select('projects_list',App\Model\Organization\Project::projectList(),null,["class"=>"no-margin-bottom aione-field project_filter","placeholder"=>"Select Project"]); ?>

              </div>
            <?php endif; ?>
        <div>
            <div class="row">
               
                <div id="test1" class="col s12 p-15">
                	<div class="row">
                        <div class="task-list col l4 center-align" id="pending" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                            <h6>Pending <span style="float: right;padding: 5px 8px;background: red;border-radius: 100%;color: white;" class="pending-count"></span></h6> 
                        </div>
                        <div class="task-list col l4 center-align " id="inProgress" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                            <h6>In Progress <span style="float: right;padding: 5px 8px;background: blue;border-radius: 100%;color: white;" class="working-count"></span></h6>
                        </div>
                        <div class="task-list col l4 center-align" id="completed" style="border-bottom: 1px solid #e8e8e8;">
                            <h6>Completed <span style="float: right;padding: 5px 8px;background: green;border-radius: 100%;color: white;" class="complete-count"></span></h6>
                        </div>
                    </div>
   					 
                    <?php if(@$model): ?>
                        <div class="row task-font" >
                            <ul id="sortable1" status="pending" class="col l4 droptrue" style="min-height: 400px">
                                <?php $__currentLoopData = @$model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($tasks->status == 0): ?> 
                                        <li class="ui-state-default col l12">
                                           <div class=" col l12 pr-7 pending" id="pending">    
                                                <div class="card p-10" >
                                                    <div class="col l12 pl-5" >
                                                        <div class="row">
                                                            <div class="col l7">
                                                                <h6 class=""><?php echo e($tasks->title); ?></h6>
                                                            </div>
                                                            <div class="col l5" class="tooltipped" data-position="top" data-tooltip="I am tooltip">
                                                                <div class="team "> 
                                                                <?php 
                                                                    $count_team = count(json_decode($tasks->assign_to)->team);
                                                                 ?>
                                                                    <?php $__currentLoopData = @json_decode($tasks->assign_to)->team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php 
                                                                            $teamData = App\Model\Organization\Team::getTeamById($value);
                                                                         ?>
                                                                            <?php $__currentLoopData = @$teamData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $teamVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                                <div style="float: right;border: 1px solid #ededed;background-color: #ededed;border-radius: 100%;overflow: hidden;margin-right: 20px">
                                                                                    
                                                                                    <a style="display:block;padding: 8px 14px" href="<?php echo e(route('info.team',['id'=>$teamVal->id])); ?>" class="tooltipped" data-position="top" data-tooltip="I am tooltip">
                                                                                         <?php echo e($teamVal->title[0]); ?>

                                                                                    </a>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                                                    
                                                                </div>
                                                                <div class="<?php echo e(($count_team == 1)?'display-none':''); ?>" style="position: absolute;right:8px;top: 18px">
                                                                    <?php 
                                                                       echo '+ '.($count_team - 1);
                                                                     ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="col l12 mt-10">
                                                        <div class=" col l3">
                                                            <?php if($tasks->priority == 'low'): ?>
                                                                <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                            <?php elseif($tasks->priority == "medium"): ?>
                                                                <i class="fa fa-circle-o yellow-text" aria-hidden="true"></i>
                                                            <?php elseif($tasks->priority == "high"): ?>
                                                                <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                                            <?php endif; ?>
                                                                <?php echo e(ucfirst($tasks->priority)); ?>

                                                        </div>
                                                        <div class=" col l5 users">
                                                           
                                                        <?php 
                                                            $count_user = count(json_decode($tasks->assign_to)->user);
                                                         ?>
                                                            <?php $__currentLoopData = @json_decode($tasks->assign_to)->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php 
                                                                    $userData = App\Model\Organization\User::getTeamById(@$value);
                                                                 ?>
                                                                <?php $__currentLoopData = @$userData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $userVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                    <div class="users_list">
                                                                         <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                         
                                                                         <a href="<?php echo e(route('info.user',[$userVal->id])); ?>"><?php echo e($userVal->name); ?></a>
                                                                         
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            
                                                            <input type="hidden" name="id" class="task_id" value="<?php echo e($tasks->id); ?>">
                                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                        </div>
                                                        <div class="<?php echo e(($count_user == 1)?'display-none':''); ?>">
                                                            <?php 
                                                                echo '+ '.($count_user - 1);
                                                             ?>
                                                        </div>
                                                        <div class="col l4 right-align" style="float:right">
                                                        <?php 
                                                            $selectedArray = null;
                                                            if(array_key_exists('id',request()->route()->parameters)){
                                                                $selectedArray[] = request()->route()->parameters['id'];
                                                            }
                                                         ?>
                                                            <?php if($selectedArray == null): ?>
                                                                <a href="<?php echo e(route('edit.task',['id'=>$tasks->id])); ?>"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                            <?php else: ?>
                                                                <a href="<?php echo e(route('edit.tasks',['id'=>$tasks->id])); ?>"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>

                                                            <?php endif; ?>
                                                            <div id="modal1" class="modal modal-fixed-footer">
                                                                <div class="modal-header white-text  blue darken-1" ">
                                                                <div class="row" style="padding:15px 10px">
                                                                    <div class="col l7 left-align">
                                                                        <h5 style="margin:0px">Edit Task</h5>   
                                                                    </div>
                                                                    <div class="col l5 right-align">
                                                                        <a href="javascript:;" class="closeDialog white-text" ><i class="fa fa-close"></i></a>
                                                                    </div>
                                                                        
                                                                </div>
                                                                    
                                                                </div>
                                                                
                                                                    <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                                                                        <input type="hidden" name="_token" class="token" value="<?php echo e(csrf_token()); ?>">
                                                                        <input type="hidden" name="task_id" value="<?php echo e($tasks->id); ?>">
                                                                       <div class="col s12 m2 l12 aione-field-wrapper">
                                                                             <?php echo Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title']); ?>

                                                                        </div>
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px']); ?>

                                                                        </div>
                                                                            <?php if($usersName != null): ?>
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    <?php echo Form::text('assign_to',array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly']); ?>

                                                                                    <input type="hidden" value="<?php echo e(array_map('intval',json_decode($tasks->assign_to)->user)); ?>" name="assign_to" />
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    <?php echo Form::select('assign_to',App\Model\Organization\Employee::employees(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple']); ?>

                                                                                </div>
                                                                            <?php endif; ?>
                                                                           
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::select('team',App\Model\Organization\Team::teamsList(),array_map('intval',json_decode($tasks->assign_to)->team),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Team to assign this task','multiple']); ?>

                                                                            </div>
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                            <?php echo Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'],$tasks->priority,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority']); ?>

                                                                        </div>
                                                                       
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                            <?php echo Form::select('projects_list',App\Model\Organization\Project::projectList(),$tasks->project_id,["class"=>"no-margin-bottom aione-field","placeholder"=>"Select Project"]); ?>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                          <div class="preloader-wrapper small active" style="margin-right: 20px;margin-top: 5px">
                                                                            <div class="spinner-layer spinner-blue-only">
                                                                              <div class="circle-clipper left">
                                                                                <div class="circle"></div>
                                                                              </div><div class="gap-patch">
                                                                                <div class="circle"></div>
                                                                              </div><div class="circle-clipper right">
                                                                                <div class="circle"></div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
            

                                                                        <a href="javascript:;" class="btn blue taskUpdate" name="action">update
                                                                        </a>
                                                                    </div> 
                                                                
                                                            </div>
                                                            <i class="fa fa-comment fa-lg mr-5" style="position: relative;" aria-hidden="true"></i>
                                                            
                                                            <a href="javascript:;" class="deleteTask"><i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                    <div style="clear: both">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="clear: both">
                                                
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                        
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <ul id="sortable2" status="in-progress" class="col l4 droptrue"  style="min-height: 400px">
                                <?php $__currentLoopData = @$model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($tasks->status == 2): ?> 
                                        <li class="ui-state-default col l12">
                                           <div class=" col l12 pr-7 pending" id="pending">    
                                                <div class="card p-10" >
                                                    <div class="col l12 pl-5" >
                                                        <h6 class="col l8"><?php echo e($tasks->title); ?></h6>
                                                        <div class="team"> 
                                                        <?php 
                                                            $count_team = count(json_decode($tasks->assign_to)->team);
                                                         ?>
                                                            <?php $__currentLoopData = @json_decode($tasks->assign_to)->team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php 
                                                                    $teamData = App\Model\Organization\Team::getTeamById($value);
                                                                 ?>
                                                                    <?php $__currentLoopData = @$teamData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $teamVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                        <div style="float: right;border: 1px solid #ededed;background-color: #ededed;border-radius: 100%;overflow: hidden;">
                                                                            
                                                                            <a style="display:block;padding: 8px 14px" href="<?php echo e(route('info.team',['id'=>$teamVal->id])); ?>">
                                                                                 <?php echo e($teamVal->title[0]); ?>

                                                                            </a>
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                           
                                                        </div>
                                                         <div class="<?php echo e(($count_team == 1)?'display-none':''); ?>">
                                                                <?php 
                                                                    echo '+ '.($count_team - 1);
                                                                 ?>
                                                            </div>
                                                    </div>
                                                    <div class="col l12 mt-10">
                                                        <div class=" col l3">
                                                            <?php if($tasks->priority == 'low'): ?>
                                                                <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                            <?php elseif($tasks->priority == "medium"): ?>
                                                                <i class="fa fa-circle-o yellow-text" aria-hidden="true"></i>
                                                            <?php elseif($tasks->priority == "high"): ?>
                                                                <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                                            <?php endif; ?>
                                                                <?php echo e(ucfirst($tasks->priority)); ?>

                                                        </div>
                                                        <div class=" col l5 users">
                                                           
                                                        <?php 
                                                            $count_user = count(json_decode($tasks->assign_to)->user);
                                                         ?>
                                                            <?php $__currentLoopData = @json_decode($tasks->assign_to)->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php 
                                                                    $userData = App\Model\Organization\User::getTeamById(@$value);
                                                                 ?>
                                                                <?php $__currentLoopData = @$userData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $userVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                    <div class="users_list">
                                                                         <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                         
                                                                         <a href="<?php echo e(route('info.user',[$userVal->id])); ?>"><?php echo e($userVal->name); ?></a>
                                                                         
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            
                                                            <input type="hidden" name="id" class="task_id" value="<?php echo e($tasks->id); ?>">
                                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                        </div>
                                                        <div class="<?php echo e(($count_user == 1)?'display-none':''); ?>">
                                                                <?php 
                                                                    echo '+ '.($count_user - 1);
                                                                 ?>
                                                            </div>
                                                        <div class="col l4 right-align" style="float:right">
                                                            <a href="<?php echo e(route('edit.tasks',['id'=>$tasks->id])); ?>"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                            <div id="modal1" class="modal modal-fixed-footer">
                                                                <div class="modal-header white-text  blue darken-1" ">
                                                                <div class="row" style="padding:15px 10px">
                                                                    <div class="col l7 left-align">
                                                                        <h5 style="margin:0px">Edit Task</h5>   
                                                                    </div>
                                                                    <div class="col l5 right-align">
                                                                        <a href="javascript:;" class="closeDialog white-text" ><i class="fa fa-close"></i></a>
                                                                    </div>
                                                                        
                                                                </div>
                                                                    
                                                                </div>
                                                                
                                                                    <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                                                                        <input type="hidden" name="_token" class="token" value="<?php echo e(csrf_token()); ?>">
                                                                        <input type="hidden" name="task_id" value="<?php echo e($tasks->id); ?>">
                                                                       <div class="col s12 m2 l12 aione-field-wrapper">
                                                                             <?php echo Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title']); ?>

                                                                        </div>
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px']); ?>

                                                                        </div>
                                                                            <?php if($usersName != null): ?>
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    <?php echo Form::text('assign_to',array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly']); ?>

                                                                                    <input type="hidden" value="<?php echo e(array_map('intval',json_decode($tasks->assign_to)->user)); ?>" name="assign_to" />
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    <?php echo Form::select('assign_to',App\Model\Organization\Employee::employees(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple']); ?>

                                                                                </div>
                                                                            <?php endif; ?>
                                                                           
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::select('team',App\Model\Organization\Team::teamsList(),array_map('intval',json_decode($tasks->assign_to)->team),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Team to assign this task','multiple']); ?>

                                                                            </div>
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                            <?php echo Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'],$tasks->priority,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority']); ?>

                                                                        </div>
                                                                       
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                            <?php echo Form::select('projects_list',App\Model\Organization\Project::projectList(),$tasks->project_id,["class"=>"no-margin-bottom aione-field","placeholder"=>"Select Project"]); ?>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                          <div class="preloader-wrapper small active" style="margin-right: 20px;margin-top: 5px">
                                                                            <div class="spinner-layer spinner-blue-only">
                                                                              <div class="circle-clipper left">
                                                                                <div class="circle"></div>
                                                                              </div><div class="gap-patch">
                                                                                <div class="circle"></div>
                                                                              </div><div class="circle-clipper right">
                                                                                <div class="circle"></div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
            

                                                                        <a href="javascript:;" class="btn blue taskUpdate" name="action">update
                                                                        </a>
                                                                    </div> 
                                                                
                                                            </div>
                                                            <i class="fa fa-comment fa-lg mr-5" style="position: relative;" aria-hidden="true"></i>
                                                            
                                                            <a href="javascript:;" class="deleteTask"><i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                    <div style="clear: both">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="clear: both">
                                                
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                        
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <ul id="sortable3" status="complete" class="col l4 droptrue"  style="min-height: 400px">
                               <?php $__currentLoopData = @$model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($tasks->status == 1): ?> 
                                        <li class="ui-state-default col l12">
                                           <div class=" col l12 pr-7 pending" id="pending">    
                                                <div class="card p-10" >
                                                    <div class="col l12 pl-5" >
                                                        <h6 class="col l8"><?php echo e($tasks->title); ?></h6>
                                                        <div class="team"> 
                                                        <?php 
                                                            $count_team = count(json_decode($tasks->assign_to)->team);
                                                         ?>
                                                            <?php $__currentLoopData = @json_decode($tasks->assign_to)->team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php 
                                                                    $teamData = App\Model\Organization\Team::getTeamById($value);
                                                                 ?>
                                                                    <?php $__currentLoopData = @$teamData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $teamVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                        <div style="float: right;border: 1px solid #ededed;background-color: #ededed;border-radius: 100%;overflow: hidden;">
                                                                            
                                                                            <a style="display:block;padding: 8px 14px" href="<?php echo e(route('info.team',['id'=>$teamVal->id])); ?>">
                                                                                 <?php echo e($teamVal->title[0]); ?>

                                                                            </a>
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                           
                                                        </div>
                                                         <div class="<?php echo e(($count_team == 1)?'display-none':''); ?>">
                                                                <?php 
                                                                    echo '+ '.($count_team - 1);
                                                                 ?>
                                                            </div>
                                                    </div>
                                                    <div class="col l12 mt-10">
                                                        <div class=" col l3">
                                                            <?php if($tasks->priority == 'low'): ?>
                                                                <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                            <?php elseif($tasks->priority == "medium"): ?>
                                                                <i class="fa fa-circle-o yellow-text" aria-hidden="true"></i>
                                                            <?php elseif($tasks->priority == "high"): ?>
                                                                <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                                            <?php endif; ?>
                                                                <?php echo e(ucfirst($tasks->priority)); ?>

                                                        </div>
                                                        <div class=" col l5 users">
                                                           
                                                        <?php 
                                                            $count_user = count(json_decode($tasks->assign_to)->user);
                                                         ?>
                                                            <?php $__currentLoopData = @json_decode($tasks->assign_to)->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php 
                                                                    $userData = App\Model\Organization\User::getTeamById(@$value);
                                                                 ?>
                                                                <?php $__currentLoopData = @$userData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $userVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                    <div class="users_list">
                                                                         <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                         
                                                                         <a href="<?php echo e(route('info.user',[$userVal->id])); ?>"><?php echo e($userVal->name); ?></a>
                                                                         
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            
                                                            <input type="hidden" name="id" class="task_id" value="<?php echo e($tasks->id); ?>">
                                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                        </div>
                                                        <div class="<?php echo e(($count_user == 1)?'display-none':''); ?>">
                                                                <?php 
                                                                    echo '+ '.($count_user - 1);
                                                                 ?>
                                                            </div>
                                                        <div class="col l4 right-align" style="float:right">
                                                            <a href="<?php echo e(route('edit.tasks',['id'=>$tasks->id])); ?>"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                            <div id="modal1" class="modal modal-fixed-footer">
                                                                <div class="modal-header white-text  blue darken-1" ">
                                                                <div class="row" style="padding:15px 10px">
                                                                    <div class="col l7 left-align">
                                                                        <h5 style="margin:0px">Edit Task</h5>   
                                                                    </div>
                                                                    <div class="col l5 right-align">
                                                                        <a href="javascript:;" class="closeDialog white-text" ><i class="fa fa-close"></i></a>
                                                                    </div>
                                                                        
                                                                </div>
                                                                    
                                                                </div>
                                                                
                                                                    <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                                                                        <input type="hidden" name="_token" class="token" value="<?php echo e(csrf_token()); ?>">
                                                                        <input type="hidden" name="task_id" value="<?php echo e($tasks->id); ?>">
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                             <?php echo Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title']); ?>

                                                                        </div>
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px']); ?>

                                                                        </div>
                                                                            <?php if($usersName != null): ?>
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    <?php echo Form::text('assign_to',array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly']); ?>

                                                                                    <input type="hidden" value="<?php echo e(array_map('intval',json_decode($tasks->assign_to)->user)); ?>" name="assign_to" />
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    <?php echo Form::select('assign_to',App\Model\Organization\Employee::employees(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple']); ?>

                                                                                </div>
                                                                            <?php endif; ?>
                                                                           
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::select('team',App\Model\Organization\Team::teamsList(),array_map('intval',json_decode($tasks->assign_to)->team),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Team to assign this task','multiple']); ?>

                                                                            </div>
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                            <?php echo Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'],$tasks->priority,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority']); ?>

                                                                        </div>
                                                                       
                                                                        <div class="col s12 m2 l12 aione-field-wrapper">
                                                                            <?php echo Form::select('projects_list',App\Model\Organization\Project::projectList(),$tasks->project_id,["class"=>"no-margin-bottom aione-field","placeholder"=>"Select Project"]); ?>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                          <div class="preloader-wrapper small active" style="margin-right: 20px;margin-top: 5px">
                                                                            <div class="spinner-layer spinner-blue-only">
                                                                              <div class="circle-clipper left">
                                                                                <div class="circle"></div>
                                                                              </div><div class="gap-patch">
                                                                                <div class="circle"></div>
                                                                              </div><div class="circle-clipper right">
                                                                                <div class="circle"></div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
            

                                                                        <a href="javascript:;" class="btn blue taskUpdate" name="action">update
                                                                        </a>
                                                                    </div> 
                                                                
                                                            </div>
                                                            <i class="fa fa-comment fa-lg mr-5" style="position: relative;" aria-hidden="true"></i>
                                                            
                                                            <a href="javascript:;" class="deleteTask"><i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                    <div style="clear: both">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="clear: both">
                                                
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                        
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="empty-row">No Data Found</div>
                    <?php endif; ?>
               
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .empty-row{
        width: 100%;
        padding: 44px;
        border: 4px dashed #ededed;
        margin-top: 16px;
        color: #ededed;
        font-size: 45px;
        text-align: center;
    }
    .fa-comment:after{
        content: '12';
        background-color: red;
        color: white;
        font-size: 10px;
        font-weight: 900;
        padding: 2px;
        border-radius: 6px;
        position: absolute;
        right: -5px;
        bottom: 5px;
    }
</style>
 <?php if($usersName != null): ?>
<div class="col s12 m2 l12 aione-field-wrapper">
    <?php echo Form::text('assign_to',array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly']); ?>

    <input type="hidden" value="<?php echo e(array_map('intval',json_decode($tasks->assign_to)->user)); ?>" name="assign_to" />
</div>
<?php else: ?>
<div class="col s12 m2 l12 aione-field-wrapper">
    <?php echo Form::select('assign_to',App\Model\Organization\Employee::employees(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple']); ?>

</div>
<?php endif; ?>