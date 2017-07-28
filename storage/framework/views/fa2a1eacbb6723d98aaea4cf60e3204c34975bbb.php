<?php $__currentLoopData = $userList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<div class="card-panel shadow white z-depth-1 hoverable project"  >
    <div class="row valign-wrapper">
        <div class="col s7">
            <div class="row valign-wrapper">
                <div class="col">
                    <div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
                        <?php echo e(ucfirst($value->name[0])); ?>

                    </div>  
                </div>
                <input type="hidden" value="<?php echo e($value->id); ?>" class="id" >
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="shift_token" >
                <div class="col" style="padding-left: 10px">
                    <div style="font-weight: 500;" class=""><?php echo e($value->name); ?></div>
                    <div class="project-description"></div>
                    <div class="aione-list-options">
                        <a style="padding-right:10px" href="<?php echo e(route('user.get',$value->id)); ?>"  class="edit" data-toggle="popover" title="Click here to update this Module">Edit</a>
                        <a href="" style="padding-right:10px">View</a>
                        <a style="padding-right:10px;color: red" href="javascript:;" onclick="return confirm('Are you sure?')"  class="delete" data-toggle="popover" title="Click here to delete this Module">Delete</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col s3">
            
        </div>
        <div class="col s2 right-align">
           
        </div>  
    </div>
    
</div>
<style type="text/css">
    .aione-list-options{
        position: absolute;
        font-size: 12px;
        display: none;
        margin-top:-3px;
    }
    .card-panel:hover .aione-list-options{
        display: block
    }
</style>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>