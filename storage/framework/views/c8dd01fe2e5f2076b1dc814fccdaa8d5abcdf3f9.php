<?php $__env->startSection('content'); ?>
<?php 
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Tasks',
    'add_new' => '+ Add Task'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<div class="row">
		<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row">
			<!-- <a href="#modal11" class="btn-flat">Add task</a> -->
			<div id="add_new_model" class="modal modal-fixed-footer">
                <div class="modal-header white-text  blue darken-1" ">
                    <div class="row" style="padding:15px 10px">
                        <div class="col l7 left-align">
                            <h5 style="margin:0px">Add Task</h5>   
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
                <?php echo Form::open(['route'=>'create.tasks','method'=>'POST','files'=>true]); ?>

                    <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                       <div class="col s12 m2 l12 aione-field-wrapper">
                             <?php echo Form::text('title',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title']); ?>

                        </div>
                        <div class="col s12 m2 l12 aione-field-wrapper">
                                <?php echo Form::textarea('description',null,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px']); ?>

                        </div>
                            <?php if($selectedArray == null): ?>
                                <div class="col s12 m2 l12 aione-field-wrapper">
                                    <?php echo Form::text('assign_to[]',@App\Model\Organization\Employee::employees()[Auth::guard('org')->user()->id],["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly']); ?>

                                    <input type="hidden" value="<?php echo e(Auth::guard('org')->user()->id); ?>" name="assign_to[]" />
                                </div>
                            <?php else: ?>
                                <div class="col s12 m2 l12 aione-field-wrapper">
                                    <?php echo Form::select('assign_to[]',App\Model\Organization\Employee::employees(),$selectedArray,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task']); ?>

                                    <input type="hidden" name="assign_to" value="<?php echo e($selectedArray); ?>">
                                </div>
                            <?php endif; ?>
                        <div class="col s12 m2 l12 aione-field-wrapper">
                            <?php echo Form::select('priority',['low'=>'Low','medium'=>'Medium','high'=>'High'],null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority']); ?>

                        </div>
                        <div class="col s12 m2 l12 aione-field-wrapper">
                                <?php echo Form::date('due_date', null,['placeholder'=>'Select Due Date','class'=>'datepicker']); ?>

                        </div>
                        <div class="col s12 m2 l12 aione-field-wrapper" style="margin-bottom: 10px">

                            <div class="row">
                                <div class="col l3">Select file</div>
                                <div class="col l9">
                                    <?php echo Form::file('browse_attachment',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Select File']); ?>

                                </div>
                            </div>
                             
                        </div>
                         <div class="col s12 m2 l12 aione-field-wrapper">
                            <?php echo Form::select('projects_list',App\Model\Organization\Project::projectList(),null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Project']); ?>

                        </div>
                        <div class="col s12 m2 l12 aione-field-wrapper">
                            <?php echo Form::select('team[]',App\Model\Organization\Team::teamsList(),null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Team to assign this task','multiple']); ?>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn blue" type="submit">update
                        </button>
                    </div> 
                <?php echo Form::close(); ?> 
            </div>
            
			<?php echo $__env->make('common.tasks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="append-data">

            </div>
		</div>
	</div>
	<style type="text/css">
		.options{
		position: absolute;
		font-size: 14px;
		display: none;
		margin-top:-3px;
	}
	.hover-me:hover .options{
		display: block
	}
    .progress{
        position: absolute;
        z-index: 999;
        width: 700px;
        top: 60%;
        left: 30%;
        display: none;
    }
	.task-font{
        font-size: 13px !important;padding-top: 10px !important;
    }
    .mt-10{
        margin-top: 10px !important;
    }
    .mr-5{
        margin-right: 5px !important;
    }
    .pl-5{
        padding-left: 5px !important;
    }
    .img-avatar{
        width: 40px !important;float: right !important;
    }
    .pt-10{
        padding-top: 10px;
    }
    .empty-box-text{
        font-size: 20px;
        font-weight: 700;
        color:#d8d8d8;
        text-align: center;
        
    }
    .projects-logo{
        
        background-color: #000;margin: 10%;

    }
     .p-15{
        padding: 15px !important;
    }
    .pv-5{
        padding: 5px 0px !important; 
    }
     .p-15{
        padding: 15px !important;
    }
    .mb-14{
    	margin-bottom: 14px !important;
    }
    .optional{

    }
    .p-10{
        padding: 10px !important;
    }
	</style>
    <script type="text/javascript">

        $(document).ready(function(){
                $('#add_new_model').modal(); 
         });
        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>