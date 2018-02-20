<div class="list-container">
    <nav id="aione_nav" class="aione-nav light vertical">
        <div class="aione-nav-background"></div>
        <ul id="aione_menu" class="aione-menu sortable">
            <li class="aione-nav-item level0 unsortable">
                <a href="<?php echo e(route('list.module')); ?>">
                    <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-list"></i></span>
                    <span class="nav-item-text">
                        All Modules
                    </span>                      
                </a>
            </li>
            <?php $__currentLoopData = $listModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="aione-nav-item level0 <?php echo e(($v->subModule->isNotEmpty())?'has-children':''); ?> <?php echo e((@$v->id == @request()->route()->parameters()['id'])?'nav-item-current' :''); ?>">
                    <input type="hidden" value="<?php echo e($v->id); ?>" class="module_id" >
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="shift_token" >
                    <a href="<?php echo e(route('list.module',['id'=>$v->id])); ?>" >
                        <?php if(!empty($v->icon)): ?>
                        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa <?php echo e($v->icon); ?>">
                            </i></span>
                        <?php endif; ?>
                        <span class="nav-item-text">
                            <?php echo e($v->name); ?>

                        </span>
                        <?php if($v->subModule->isNotEmpty()): ?>
                            <span class="nav-item-arrow"></span>
                        <?php endif; ?>
                    </a>
                    <?php if($v->subModule->isNotEmpty()): ?>
                        <ul class="side-bar-submenu">
                            <?php $__currentLoopData = $v->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subModule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="aione-nav-item level1 <?php echo e(($subModule->id == @request()->route()->parameters()['subModule'])?'nav-item-current' :''); ?>    ">
                                
                                    <a href="<?php echo e(route('list.module',['id'=> @$v->id, 'subModule' => $subModule->id])); ?>">
                                        <span class="nav-item-icon"><?php echo e($subModule->id); ?></span>
                                        <span class="nav-item-text"><?php echo e($subModule->name); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>   
                </li>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
</div>