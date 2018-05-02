<?php $__env->startSection('content'); ?>
<?php 

if(!empty($filled_data)){
  if(isset($filled_data['module'])){
    $moduleFilled = $filled_data['module']->keyBy('permisson_id')->toArray();
    $submoduleFilled = $filled_data['submodule']->keyBy('permisson_id')->toArray();
    $routeFilled = $filled_data['route']->keyBy('permisson_id')->toArray();
  }
  if(isset($filled_data['widget'])){
    $widgetFilled = $filled_data['widget']->keyBy('permisson_id')->toArray();
  }
}

$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Role Permissions <span>'.$role_data[0]['name'].'</span>',
  'add_new' => ''
); 

 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  


  

    <div class="ar">
        <div class="ac l70">

            <div class="aione-border p-10">
                <?php echo Form::open(['route'=>'save.role_permisson']); ?>

                <input type="hidden" name="role_id" value="<?php echo e($role_data[0]['id']); ?>">
                <h5 class="aione-border-bottom mb-10 pb-10">Role Permissions</h5>
                <div class="aione-collapsible">
                    <?php $__currentLoopData = $module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moduleKey => $moduleVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                    <input type="hidden" name="moduleRoute[<?php echo e($moduleVal->id); ?>][permisson_type]" value="module">
                    <input type="hidden" name="moduleRoute[<?php echo e($moduleVal->id); ?>][permisson_id]" value="<?php echo e($moduleVal->id); ?>">
                    <div class="aione-item">
                        <div class="aione-item-header">
                            <?php echo e(@$moduleVal->name); ?>

                        </div>
                        <div class="aione-item-content p-10">
                          <div class="aione-border p-15 mb-10 bg-grey bg-lighten-4 module-permissions">
                            <label class="light-blue darken-2" For="filled-in-box-module<?php echo e($loop->iteration); ?>"><?php echo e(@$moduleVal->name); ?></label>
                            <?php if(!empty($moduleFilled[$moduleVal->id]['permisson'])): ?>
                                <input checked="checked" name='moduleRoute[<?php echo e($moduleVal->id); ?>][permisson]' type="checkbox" class="filled-in checkAll aione-float-right" id="filled-in-box-module<?php echo e($loop->iteration); ?>" />
                            <?php else: ?>
                                <input  name='moduleRoute[<?php echo e($moduleVal->id); ?>][permisson]' type="checkbox" class="filled-in checkAll aione-float-right" id="filled-in-box-module<?php echo e($loop->iteration); ?>"  />
                            <?php endif; ?>
                          </div>

                            <ul>
                                <?php $__currentLoopData = $moduleVal['subModule']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subModuleKey =>$subModuleVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="aione-border mb-10">
                                    <div class="aione-border-bottom p-10 ">
                                        <div class="ar">
                                            <div class="ac l90">
                                                 <label for="filled-in-box-sub-module<?php echo e($subModuleVal->id); ?>"><?php echo e($subModuleVal->name); ?></label>      
                                            </div>
                                            <div class="ac l10">
                                                <?php if(!empty($subModuleVal->sub_module_route)): ?>
                                                    <input type="hidden" name="subModuleRoute[<?php echo e($subModuleVal->id); ?>][permisson_type]" value="submodule">
                                                    <input type="hidden" name="subModuleRoute[<?php echo e($subModuleVal->id); ?>][permisson_id]" value="<?php echo e($subModuleVal->id); ?>">
                                                    <?php if(!empty($submoduleFilled[$subModuleVal->id]['permisson'])): ?>
                                                        <input checked="checked" name='subModuleRoute[<?php echo e($subModuleVal->id); ?>][permisson]' type="checkbox" class="filled-in aione-float-right" id="filled-in-box-sub-module<?php echo e($subModuleVal->id); ?>"  />
                                                    <?php else: ?>
                                                        <input  name='subModuleRoute[<?php echo e($subModuleVal->id); ?>][permisson]' type="checkbox" class="filled-in aione-float-right" id="filled-in-box-sub-module<?php echo e($subModuleVal->id); ?>"  />
                                                    <?php endif; ?>
                                                    <label for="filled-in-box-sub-module<?php echo e($subModuleVal->id); ?>" style="float: right"></label>
                                                <?php endif; ?>        
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="">
                                        <?php $__currentLoopData = $subModuleVal['moduleRoute']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routeKey => $routeVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <div class="aione-border p-10 m-10 mb-5 widget-checkbox-label">
                                            <div class="ar">
                                                <div class="ac l90">
                                                     <label for="filled-in-box-sub-module-multi-<?php echo e(str_slug($routeVal->route_name)); ?>-<?php echo e($loop->iteration); ?>"> <?php echo e($routeVal->route_name); ?></label>      
                                                </div>
                                                <div class="ac l10">
                                                    <?php if(!empty($subModuleVal->sub_module_route)): ?>
                                                        <input type="hidden" name="subModuleMultiRoute[<?php echo e($routeVal->id); ?>][permisson_type]" value="route">
                                                        <input type="hidden" name="subModuleMultiRoute[<?php echo e($routeVal->id); ?>][permisson_id]" value="<?php echo e($routeVal->id); ?>">
                                                        <?php if(!empty($routeFilled[$routeVal->id]['permisson'])): ?>
                                                            <input checked="checked" name='subModuleMultiRoute[<?php echo e($routeVal->id); ?>][permisson]' type="checkbox" class="filled-in aione-float-right" id="filled-in-box-sub-module-multi-<?php echo e(str_slug($routeVal->route_name)); ?>-<?php echo e($loop->iteration); ?>"  />
                                                        <?php else: ?>
                                                            <input  name='subModuleMultiRoute[<?php echo e($routeVal->id); ?>][permisson]' type="checkbox" class="filled-in aione-float-right" id="filled-in-box-sub-module-multi-<?php echo e(str_slug($routeVal->route_name)); ?>-<?php echo e($loop->iteration); ?>"  />
                                                        <?php endif; ?>
                                                        <label for="filled-in-box-sub-module-multi-<?php echo e(str_slug($routeVal->route_name)); ?>-<?php echo e($loop->iteration); ?>" style="float: right"></label>
                                                    <?php endif; ?>  
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    </div>  
                                        
                                </li>
                               
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>   
                <?php echo Form::submit('Save Role Permisson'); ?>

                <?php echo Form::close(); ?>

            </div>
        </div>
        <div class="ac l30">
            <div class="aione-border p-10 mb-10">
                <?php echo Form::open(['route'=>'save.role_permisson']); ?>

                    <input type="hidden" name="role_id" value="<?php echo e($role_data[0]['id']); ?>">
                    <h5 class="aione-border-bottom mb-10 pb-10">Widget Permissions</h5>
                    <ul>
                        <?php $__currentLoopData = $widget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widgetKey =>$widgetVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="widget[<?php echo e($widgetVal->id); ?>][permisson_type]" value="widget">
                            <input type="hidden" name="widget[<?php echo e($widgetVal->id); ?>][permisson_id]" value="<?php echo e($widgetVal->id); ?>" >
                            <li class="aione-border-bottom p-10 mb-10 widget-checkbox-label">
                                
                                <div class="ar">
                                    <div class="ac l90">
                                         <label For="check_<?php echo e($loop->iteration); ?>"><?php echo e($widgetVal->title); ?></label>      
                                    </div>
                                    <div class="ac l10">
                                        <?php if(!empty($widgetFilled[$widgetVal->id]['permisson']) && $widgetFilled[$widgetVal->id]['permisson']=='on' ): ?>
                                            <input checked="checked" id="check_<?php echo e($loop->iteration); ?>" name='widget[<?php echo e($widgetVal->id); ?>][permisson]' type="checkbox" name="" class="aione-float-right ">    
                                        <?php else: ?>
                                            <input id="check_<?php echo e($loop->iteration); ?>" type="checkbox" name='widget[<?php echo e($widgetVal->id); ?>][permisson]' class="aione-float-right "> 
                                        <?php endif; ?>    
                                    </div>
                                    
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                    </ul>
                     <?php echo Form::submit('Save Widget Permissions', ['class' => 'aione-button ']); ?>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
    
   
  
  <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
$('.module-permissions .checkAll').on('click',function(){
    if($(this).is(':checked')){
      $(this).parent().parent().find('input[type="checkbox"]').prop('checked','checked');
    }else{        
      $(this).parent().parent().find('input[type="checkbox"]').prop('checked','');
    }
});
</script>








  <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>