<?php 
    $team = [];
    $usersName = [];
    $index= 0;
 ?>

<?php if($model): ?>
    <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <?php 
        $assign = json_decode($value->assign_to);
        $teamData = App\Model\Organization\Team::getTeamById($assign->team);
            // foreach($teamData as $key => $value2){
            //     $team[] = ""; 
            //     foreach($value2 as $key => $teamValue){

            //         $team['title'][] = $teamValue->title;
            //         $team['image'] = "";
            //         $index++;

            //     }

            // }

        // dd();
        //get team data for display in task
            
        //get users for display in tasks
            
            
                // foreach($userData as $key => $users){
                //     $usersName['name'] = $users->name;
                // }
            $prioritySelect = $value->priority;
         ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
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
              <option <?php echo e((@$prioritySelect == 'low')?'selected': ''); ?> value="low">Low</option>
              <option <?php echo e((@$prioritySelect == 'medium')?'selected': ''); ?> value="medium">Medium</option>
              <option <?php echo e((@$prioritySelect == 'high')?'selected': ''); ?> value="high">High</option>
            </select>
            <label>Materialize Select</label>
          </div>
          <div class="input-field col s4">
            <select class="filter_priority">
              <option value="" disabled selected>User Filter</option>
              <option value="low">ashish</option>
              <option value="medium">sandeep</option>
              <option value="high">rahul</option>
            </select>
            <label>Materialize Select</label>
          </div>
        <div>
            <div class="row">
               
                <div id="test1" class="col s12 p-15">
                	<div class="row">
                        <div class="task-list col l4 center-align" id="pending" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                            <h6>Pending <span style="float: right " class="pending-count"></span></h6> 
                        </div>
                        <div class="task-list col l4 center-align " id="inProgress" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                            <h6>In Progress <span style="float: right " class="working-count"></span></h6>
                        </div>
                        <div class="task-list col l4 center-align" id="completed" style="border-bottom: 1px solid #e8e8e8;">
                            <h6>Completed <span style="float: right " class="complete-count"></span></h6>
                        </div>
                    </div>
   					 
                    <div class="row task-font" >
                        <ul id="sortable1" status="pending" class="col l4 droptrue" style="min-height: 400px">
                            <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($tasks->status == 0): ?> 
                                    <li class="ui-state-default col l12">
                                       <div class=" col l12 pr-7 pending" id="pending">    
                                            <div class="card p-10" >
                                                <div class="col l12 pl-5" >
                                                    <h6 class="col l8"><?php echo e($tasks->title); ?></h6>
                                                    <?php $__currentLoopData = json_decode($tasks->assign_to)->team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php 
                                                            $teamData = App\Model\Organization\Team::getTeamById($value);
                                                         ?>
                                                            <?php $__currentLoopData = $teamData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $teamVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                            <div style="float: right;padding: 8px 14px;border: 1px solid #ededed;background-color: #ededed;border-radius: 100%;">
                                                                <?php echo e($teamVal->title[0]); ?>

                                                            </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        
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
                                                    <div class=" col l5">
                                                        <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                        <?php $__currentLoopData = json_decode($tasks->assign_to)->user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php 
                                                                $userData = App\Model\Organization\User::getTeamById(@$value);
                                                             ?>
                                                            <?php $__currentLoopData = $userData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $teamVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                <div style="float: right;padding: 8px 14px;border: 1px solid #ededed;background-color: #ededed;border-radius: 100%;">
                                                                    <?php echo e($teamVal->title[0]); ?>

                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <input type="hidden" name="id" class="task_id" value="<?php echo e($tasks->id); ?>">
                                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                    </div>

                                                    <div class="col l4 right-align">
                                                        <a href="#modal1"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
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
                                                                                <?php echo Form::text('assign_to',@$tasks->users->name,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly']); ?>

                                                                                <input type="hidden" value="<?php echo e(Auth::guard('org')->user()->id); ?>" name="assign_to" />
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::select('assign_to',App\Model\Organization\Employee::employees(),@$tasks->users->name,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task']); ?>

                                                                            </div>
                                                                        <?php endif; ?>
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
                                                        <i class="fa fa-comment fa-lg mr-5" aria-hidden="true"></i>
                                                        
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
                            <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($tasks->status == 2): ?> 
                                <li class="ui-state-default" >
                                   <div class=" col l12 pr-7 in-progress" id="in-progress" >    
                                        <div class="card p-10" >
                                            <div class="col l12 pl-5" >
                                                <h6 class="col l8"><?php echo e($tasks->title); ?></h6>
                                                <img class="circle col l4 right-align img-avatar" src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>">
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
                                                <div class=" col l5">
                                                    <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                    
                                                    <input type="hidden" name="id" value="<?php echo e($tasks->id); ?>">
                                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                </div>

                                                <div class="col l4 right-align">
                                                    <a href="#modal2"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                    <div id="modal2" class="modal modal-fixed-footer">
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
                                                            <?php 
                                                                $selectedArray = null;
                                                                if(array_key_exists('id',request()->route()->parameters)){
                                                                    $selectedArray[] = request()->route()->parameters['id'];
                                                                }
                                                             ?>
                                                            <!-- <?php echo Form::open(['route'=>'create.tasks','method'=>'POST','files'=>true]); ?> -->
                                                               <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                                                                    <input type="hidden" name="_token" class="token" value="<?php echo e(csrf_token()); ?>">
                                                                    <input type="hidden" name="task_id" value="<?php echo e($tasks->id); ?>">
                                                                   <div class="col s12 m2 l12 aione-field-wrapper">
                                                                         <?php echo Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title']); ?>

                                                                    </div>
                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                            <?php echo Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px']); ?>

                                                                    </div>
                                                                        <?php if($tasks->assign_to != null): ?>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::text('assign_to',@$tasks->users->name,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly']); ?>

                                                                                <input type="hidden" value="<?php echo e(Auth::guard('org')->user()->id); ?>" name="assign_to" />
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::select('assign_to',App\Model\Organization\Employee::employees(),$tasks->users->name,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task']); ?>

                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                        <?php echo Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'],$tasks->priority,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority']); ?>

                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                        <?php echo Form::select('projects_list',App\Model\Organization\Project::projectList(),$tasks->project_id,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Project']); ?>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="javascript:;" class="btn blue taskUpdate" name="action">update
                                                                    </a>
                                                                </div> 
                                                            <!-- <?php echo Form::close(); ?>  -->
                                                        </div>
                                                    <i class="fa fa-comment fa-lg mr-5" aria-hidden="true"></i>
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
                            <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($tasks->status == 1): ?> 
                                <li class="ui-state-default" >
                                   <div class=" col l12 pr-7 complete" id="complete" >    
                                        <div class="card p-10" >
                                            <div class="col l12 pl-5" >
                                                <h6 class="col l8"><?php echo e($tasks->title); ?></h6>
                                                <img class="circle col l4 right-align img-avatar" src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>">
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
                                                <div class=" col l5">
                                                    <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                    <?php echo e(ucfirst(@$tasks->users->name)); ?>

                                                    <input type="hidden" name="id" value="<?php echo e($tasks->id); ?>">
                                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                </div>

                                                <div class="col l4 right-align">
                                                    <a href="#modal3"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                    <div id="modal3" class="modal modal-fixed-footer">
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
                                                            <?php 
                                                                $selectedArray = null;
                                                                if(array_key_exists('id',request()->route()->parameters)){
                                                                    $selectedArray[] = request()->route()->parameters['id'];
                                                                }
                                                             ?>
                                                            
                                                                <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                                                                    <input type="hidden" name="_token" class="token" value="<?php echo e(csrf_token()); ?>">
                                                                    <input type="hidden" name="task_id" value="<?php echo e($tasks->id); ?>">
                                                                   <div class="col s12 m2 l12 aione-field-wrapper">
                                                                         <?php echo Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title']); ?>

                                                                    </div>
                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                            <?php echo Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px']); ?>

                                                                    </div>
                                                                        <?php if($tasks->assign_to != null): ?>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::text('assign_to',@$tasks->users->name,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly']); ?>

                                                                                <input type="hidden" value="<?php echo e(Auth::guard('org')->user()->id); ?>" name="assign_to" />
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                <?php echo Form::select('assign_to',App\Model\Organization\Employee::employees(),$tasks->users->name,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task']); ?>

                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                        <?php echo Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'],$tasks->priority,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority']); ?>

                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                        <?php echo Form::select('projects_list',App\Model\Organization\Project::projectList(),$tasks->project_id,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Project']); ?>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="javascript:;" class="btn blue taskUpdate" name="action">update
                                                                    </a>
                                                                </div> 
                                                            <!-- <?php echo Form::close(); ?>  -->
                                                    </div>
                                                    <i class="fa fa-comment fa-lg mr-5" aria-hidden="true"></i>
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
               
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
            $('.modal').modal();
    });
</script>