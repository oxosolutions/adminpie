<?php $__env->startSection('content'); ?>
 <?php 
      if(!empty($filled_data))
          {
              if(isset($filled_data['module'])){
                $moduleFilled = $filled_data['module']->keyBy('permisson_id')->toArray();
                $submoduleFilled = $filled_data['submodule']->keyBy('permisson_id')->toArray();
                $routeFilled = $filled_data['route']->keyBy('permisson_id')->toArray();
              }
               if(isset($filled_data['widget'])){
                $widgetFilled = $filled_data['widget']->keyBy('permisson_id')->toArray();

               }
          }
     ?>

<div class="row">

    <div class="card" style="padding: 10px;margin-top: 0px;margin-bottom: 14px">
        <h5>Permissions for:<strong><?php echo e($role_data[0]['name']); ?> </strong></h5>
    </div>


    <div class="card section-1"  style="margin: 0px;margin-bottom: 14px">
      <?php echo Form::open(['route'=>'save.role_permisson']); ?>

        <input type="hidden" name="role_id" value="<?php echo e($role_data[0]['id']); ?>">

        <ul style="margin: 0px">
            <li>
               <div class="row" style="background-color: #24425C;padding: 15px 10px;color: white;font-weight: bold">
                   <div class="col l10">Widgets</div>
                   <div class="col l2 center-align">Permisson</div>
               </div> 
            </li>
          <?php $__currentLoopData = $widget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widgetKey =>$widgetVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li>
                <div class="row" style="padding: 15px 10px">
                  <div class="col l10 " style="text-transform: capitalize;">
                    <?php echo e($widgetVal->title); ?>

                  </div>
                  <div class="col l2 center-align">
                  <input type="hidden" name="widget[<?php echo e($widgetVal->id); ?>][permisson_type]" value="widget">
                  <input type="hidden" name="widget[<?php echo e($widgetVal->id); ?>][permisson_id]" value="<?php echo e($widgetVal->id); ?>" >
                  <?php if(!empty($widgetFilled[$widgetVal->id]['permisson']) && $widgetFilled[$widgetVal->id]['permisson']=='on' ): ?>
                      <input checked="checked" name='widget[<?php echo e($widgetVal->id); ?>][permisson]' type="checkbox" class="filled-in" id="filled-in-box_<?php echo e($loop->iteration); ?>"  />
                      <label for="filled-in-box_<?php echo e($loop->iteration); ?>"></label>
                  <?php else: ?>
                    <input name='widget[<?php echo e($widgetVal->id); ?>][permisson]' type="checkbox" class="filled-in" id="filled-in-box_<?php echo e($loop->iteration); ?>"  />
                    <label for="filled-in-box_<?php echo e($loop->iteration); ?>"></label>
                  <?php endif; ?>
                  </div> 
                </div>
            </li>
            <div class="divider"></div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php echo Form::submit('Save Widget Permisson', ['class' => 'btn btn-primary blue','style' => 'margin:14px;float:right']); ?>

        <div style="clear: both">
            
        </div>
      <?php echo Form::close(); ?>


    </div>

    <div class="card" id="assign_role" style="margin: 0px;margin-bottom: 14px">
      <?php echo Form::open(['route'=>'save.role_permisson']); ?>

        <input type="hidden" name="role_id" value="<?php echo e($role_data[0]['id']); ?>">
        <ul style="margin: 0px" class="collapsible" data-collapsible="accordion">
            <li>
               <div class="row" style="background-color: #24425C;padding: 15px 10px;color: white;font-weight: bold">
                   <div class="col l3">Modules</div>
                   <div class="col l3">Sub-Module</div>
                   <div class="col l3">Route</div>
                   <div class="col l2">Permission</div>
              </div> 
            </li>
     
       <?php $__currentLoopData = $module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moduleKey => $moduleVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
        
            <div class="col l12 collapsible-header" style="padding: 3px 0px">
                 <?php echo e($moduleVal->name); ?>

                <input type="hidden" name="moduleRoute[<?php echo e($moduleVal->id); ?>][permisson_type]" value="module">
                <input type="hidden" name="moduleRoute[<?php echo e($moduleVal->id); ?>][permisson_id]" value="<?php echo e($moduleVal->id); ?>">
                
                <?php if(!empty($moduleFilled[$moduleVal->id]['permisson'])): ?>
                
                    <input checked="checked" name='moduleRoute[<?php echo e($moduleVal->id); ?>][permisson]' type="checkbox" class="filled-in checkAll" id="filled-in-box-module<?php echo e($loop->iteration); ?>" />
                <?php else: ?>
                    <input  name='moduleRoute[<?php echo e($moduleVal->id); ?>][permisson]' type="checkbox" class="filled-in checkAll" id="filled-in-box-module<?php echo e($loop->iteration); ?>"  />
                <?php endif; ?>
                <label for="filled-in-box-module<?php echo e($loop->iteration); ?>" style="margin-left: 20px;float: left"></label>
                <i class="material-icons" style="float: right;margin-right: 6px">expand_less</i>     
                <div style="clear: both"></div>
            </div>
            <div class="collapsible-body">
              <?php $__currentLoopData = $moduleVal['subModule']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subModuleKey =>$subModuleVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col l9 offset-l3"  style="padding: 10px"> <?php echo e($subModuleVal->name); ?> 
                <?php if(!empty($subModuleVal->sub_module_route)): ?>
                    <input type="hidden" name="subModuleRoute[<?php echo e($subModuleVal->id); ?>][permisson_type]" value="submodule">
                    <input type="hidden" name="subModuleRoute[<?php echo e($subModuleVal->id); ?>][permisson_id]" value="<?php echo e($subModuleVal->id); ?>">
                   <?php if(!empty($submoduleFilled[$subModuleVal->id]['permisson'])): ?>
                      <input checked="checked" name='subModuleRoute[<?php echo e($subModuleVal->id); ?>][permisson]' type="checkbox" class="filled-in" id="filled-in-box-sub-module<?php echo e($subModuleVal->id); ?>"  />
                    <?php else: ?>
                     <input  name='subModuleRoute[<?php echo e($subModuleVal->id); ?>][permisson]' type="checkbox" class="filled-in" id="filled-in-box-sub-module<?php echo e($subModuleVal->id); ?>"  />
                    <?php endif; ?>
                    <label for="filled-in-box-sub-module<?php echo e($subModuleVal->id); ?>" style="float: right"></label>
                  <?php endif; ?>
              </div>
                    

              <?php $__currentLoopData = $subModuleVal['moduleRoute']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routeKey => $routeVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                  <div class="col l6 offset-l6"  style="padding:10px" > <?php echo e($routeVal->route_name); ?> 
                    <?php if(!empty($subModuleVal->sub_module_route)): ?>
                        <input type="hidden" name="subModuleMultiRoute[<?php echo e($routeVal->id); ?>][permisson_type]" value="route">
                        <input type="hidden" name="subModuleMultiRoute[<?php echo e($routeVal->id); ?>][permisson_id]" value="<?php echo e($routeVal->id); ?>">
                       <?php if(!empty($routeFilled[$routeVal->id]['permisson'])): ?>
                        <input checked="checked" name='subModuleMultiRoute[<?php echo e($routeVal->id); ?>][permisson]' type="checkbox" class="filled-in" id="filled-in-box-sub-module-multi-<?php echo e(str_slug($routeVal->route_name)); ?>-<?php echo e($loop->iteration); ?>"  />
                        <?php else: ?>
                            <input  name='subModuleMultiRoute[<?php echo e($routeVal->id); ?>][permisson]' type="checkbox" class="filled-in" id="filled-in-box-sub-module-multi-<?php echo e(str_slug($routeVal->route_name)); ?>-<?php echo e($loop->iteration); ?>"  />
                        <?php endif; ?>
                        <label for="filled-in-box-sub-module-multi-<?php echo e(str_slug($routeVal->route_name)); ?>-<?php echo e($loop->iteration); ?>" style="float: right"></label>
                    <?php endif; ?>
                  </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
                
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              <div style="clear: both"></div>
            </div>
              
          </li>
          <div style="clear: both"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
                      <?php echo Form::submit('Save Role Permisson', ['class' => 'btn btn-primary blue','style' => 'margin:14px;float:right']); ?>

                      <div style="clear: both"></div>
        <?php echo Form::close(); ?>


    </div>
</div>
<style type="text/css">
    #assign_role >  ul > li:first-child{
        background-color: #24425C;
        color: white;       
        font-weight: bold;
    }
    #assign_role >  ul > li{
         padding: 15px 10px;
    }
    .collapsible [type="checkbox"].filled-in:not(:checked)+label:after{
        top:50% !important;
    }
    .collapsible [type="checkbox"].filled-in:checked+label:before{
        top:50% !important;
    }
    .collapsible [type="checkbox"].filled-in:checked+label:after{
        top:50% !important;
    }
     .collapsible li.active i {
      
      transform: rotate(180deg);
    }
    .page-content{
            padding-top: 118px;
    }
    .section-1 [type="checkbox"]+label{
        height: 15px !important;
    }
    .collapsible{
        border: none;
        box-shadow: none;
    }
</style>
<script type="text/javascript">
$('.checkAll').on('click',function(){
    if($(this).is(':checked')){
        $(this).parents('.collapsible-header').siblings().find('input[type="checkbox"]').prop('checked','checked');
        }else{        
             $(this).parents('.collapsible-header').siblings().find('input[type="checkbox"]').prop('checked','');
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>