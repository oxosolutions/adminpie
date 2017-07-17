<?php $__env->startSection('content'); ?>
<div class="col s12 content-section background-design valign-wrapper" style="padding-left: 0px;">
    <?php 
        $url = $_SERVER['REQUEST_URI'];
        $string = explode('/',$url);
     ?>
    <div class="col s12 m6 l6 valign-center">
        <div class="row valign-wrapper">
            <div class="col l6">
                 <?php if(isset($string[2])): ?>
                    <h5 style="margin: 0px;"><?php echo e(ucfirst($string[2])); ?></h5>
                <?php else: ?>
                    <h5 style="margin: 0px;"><?php echo e(ucfirst($string[1])); ?></h5>
                <?php endif; ?>
            </div>
               
            <div class="col l6">
                <a id="add_new" href="#modal1" class="btn-flat waves-effect waves-light-blue" style="border: 1px solid #a8a8a8;">
                    Add Designation
                </a>
                <div id="modal1" class="modal modal-fixed-footer">
                <?php if(@$newData == 'undefined' || @$newData == '' || @$newData == null): ?>
                    <?php echo Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>

                <?php else: ?>
                    <?php echo Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>

                    <input type="hidden" name="id" value="<?php echo e($id); ?>">
                <?php endif; ?>
                    <div class="modal-header white-text" style="background-color: rgb(2,136,209)">
                        <div class="row" style="padding:15px 10px">
                            <div class="col l7">
                                <h5 style="margin:0px">Add designation</h5> 
                            </div>
                            <div class="col l5 right-align">
                                <a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
                            </div>
                                
                        </div>
                        
                    </div>
                    <div class="modal-content" style="background-color: white">
                        
                        <?php echo FormGenerator::GenerateField('designation',['type' => 'inset']); ?>

                    </div>
                    <div class="modal-footer">
                        
                        <button class="btn blue" type="submit">Save Designation
                                    <i class="material-icons right">save</i>
                                </button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>   
        </div>
    </div>
    <div class="col s12 m6 l6 right-align " style="padding-right: 10px">
        <ul class="aione-breadcrumb">
            <?php $__currentLoopData = $string; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($crumb != "" || $crumb != null): ?>
                    <li><a href="<?php echo e($crumb); ?>"><?php echo e(ucfirst($crumb)); ?></a>  </li>
                <?php endif; ?>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<div>
    <?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col l12">
    	<div class="card" style="padding:0px 14px;">
    		<div class="col l12 valign-wrapper" style="padding:5px 0px;">
    			<div class="col l1 valign-wrapper">
					<img src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>" class="activity-avatar">  				
    			</div>
    			<div class="col l9">
    				<a href="">Rahul Sharma</a>
    				<span>Creates a new project</span>
    				<a href="">Smaartframework</a>
    			</div>
    			<div class=" col l2 grey-text">
    				<i class="fa fa-clock-o" aria-hidden="true" style="padding:0px 14px;"	></i>2 Seconds ago
    			</div>
    			
    		</div>
    		<div class="col l12 divider">
    			
    		</div>
    		<div class="col l12 valign-wrapper" style="padding:5px 0px;">
    			<div class="col l1 valign-wrapper">
					<img src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>" class="activity-avatar">  				
    			</div>
    			<div class="col l9">
    				<a href="">Paljinder Singh</a>
    				<span>Posted a task on </span>
    				<a href="">Smaartframework</a>
    			</div>
    			<div class=" col l2 grey-text">
    				<i class="fa fa-clock-o" aria-hidden="true" style="padding:0px 14px;"></i>1 Hour ago
    			</div>
    			
    		</div>
    		<div class="col l12 divider">
    			
    		</div>
    		<div class="col l12 valign-wrapper" style="padding:5px 0px;">
    			<div class="col l1 valign-wrapper ">
					<img src="<?php echo e(asset('assets/images/sgs_sandhu.jpg')); ?>" class="activity-avatar">  				
    			</div>
    			<div class="col l9">
    				<a href="">Sandeep Singh</a>
    				<span>assign to a task</span>
    				<a href="">Issue in front end</a>
    			</div>
    			<div class=" col l2 grey-text">
    				<i class="fa fa-clock-o" aria-hidden="true" style="padding:0px 14px;"></i>2 Hour ago
    			</div>
    			
    		</div>
    		<div style="clear: both;">
    				
    		</div>
    	</div>
    </div>

</div>
<style type="text/css">
	.activity-avatar{
		border-radius: 50%;
		width: 40px;
	}
	.ph-14{
		padding:0px 14px !important;
	}
	.pv-5{
		padding:5px 0px !important;
	}
</style>
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>