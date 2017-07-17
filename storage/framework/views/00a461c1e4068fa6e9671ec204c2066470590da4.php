<?php $__env->startSection('content'); ?>
<?php 
   $option ="";
    $data = App\Model\Admin\GlobalModule::getRouteListArray();
//     foreach ($data as $key => $value) {
//     $option .="<option value='$key'>$value</option>";
// }

$opt_route_for =['read'=>'Read', 'write'=>'Write', 'delete'=>'Delete'];
                            
 ?>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.remove_row',function(e){
      $(this).parent().remove();
    });
      
  });

/*$(document).ready(function() {
    $('select').material_select();
  });*/

  // function apnd_row()
  // {

  //  // $("#content").clone().appendTo("#apnd");
  //  var res="";
  //   $.ajax({
  //     url:route()+"/module/add_route_row",
  //     type:'GET',
  //     success: function(res){
  //       //data = $("#content").html();
  //       console.log(res);

  //           $("#apnd").append('<div >'+res+'</div>');
  //           $('select').material_select();
  //     }
  //   });
  // }

// $('body').on('click','.fa-trash',function(){
//     $(this).parents('.appended-div').hide();
// });
</script>
    <div class="card" style="margin-top: 0px;padding: 10px">
        <?php echo Form::open(['route' => ['edit.module',request()->route()->parameters()['id']]]); ?>


        <div class="col s12 m2 l12 aione-field-wrapper">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo e($module->name); ?>" class="no-margin-bottom aione-field" >
        </div>
        <div class="col s12 m2 l12 aione-field-wrapper">
            <label>Route</label>
            <?php echo Form::select('route',App\Model\Admin\GlobalModule::getRouteListArray(),$module->route, ['class'=>'form-control sel browser-default','placeholder'=>'url ']); ?>

        </div>
     
        <div class="row">
          <div class="col l6" style="margin-top: 14px">
            <label style="font-size: 14px !important; margin-top: 2% !important;">Sub-Module Details</label>   
          </div>
          <div class="col l6" style="margin-top: 14px;">
            <a href="javascript:void(0)" class="btn blue add-submodule" style="font-size: 15px;float: right">Add Sub-Module Details</a>    
          </div>
        </div>
        
        <div id="sortable" class="repeat-submodule">
            <?php $__currentLoopData = $module->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $submodule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="background-color:white;width: 100%; border: 1px dotted #CCC; margin-top: 1%; padding-left: 2%; padding-right: 2%; padding-bottom: 2%;" class="row sub-div">
                    <a href="javascript:void(0)" style="float: right; margin-top: 0.5%;" class="delete-submodule"><i class="fa fa-close"></i></a>
                    <div class="col s12 m2 l12 aione-field-wrapper">
                        <div class="row">
                            <div class="col l6">
                                <label>Sub Module name</label>
                                <input type="hidden" name="submodule[<?php echo e($loop->index); ?>][submodule_id]" value="<?php echo e($submodule->id); ?>" placeholder="Enter sub-module name" />          

                                <input type="text" name="submodule[<?php echo e($loop->index); ?>][submodule_name]" value="<?php echo e($submodule->name); ?>" placeholder="Enter sub-module name" />          
                            </div>
                            <div class="col l6">
                                 <label>Sub Module Route</label>
                                <?php echo Form::select('submodule['.$loop->index.'][sub_module_route]',App\Model\Admin\GlobalModule::getRouteListArray(),$submodule->sub_module_route, ['class'=>'form-control sel browser-default','placeholder'=>'url ']); ?>

                                <input type="hidden" name="submoduleNumber" value="<?php echo e($loop->index); ?>" />
                            </div>
                            
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col l6">
                            Routes For Permission
                        </div>
                        <div class="col l6 right-align">
                            <a href="" class="btn green add-route-permission">add</a>
                        </div>
                    </div>
                    <div class="repeat_route_permission">
                        <?php $__currentLoopData = $submodule->moduleRoute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routeKey => $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row repeat-sub-row">
                                <div class="col s12 m2 l12 aione-field-wrapper" style="border: 1px solid #e8e8e8;padding: 14px; margin-top: 1%;">

                                    <div class="row valign-wrapper">
                                        <div class="col l5 pr-7">
                                            <label>Route name</label>
                                            <input type="hidden" name="submodule[<?php echo e($loop->parent->index); ?>][route_id][]" value="<?php echo e($route->id); ?>" placeholder="Enter route name" />
                                            <input type="text" name="submodule[<?php echo e($loop->parent->index); ?>][perm_route_name][]" value="<?php echo e($route->route_name); ?>" placeholder="Enter route name" />
                                        </div>
                                        <div class="col l6 pl-7 pr-7">
                                            <label>Route</label>
                                            <?php echo Form::select('submodule['.$loop->parent->index.'][perm_route][]',App\Model\Admin\GlobalModule::getRouteListArray(),$route->route, ['class'=>'form-control sel browser-default','placeholder'=>'url ']); ?>

                                        </div>
                                        <div class="col l1 pl-7">
                                            <a href="" class="  delete-reoute-permission"><i class="fa fa-close"></i></a>
                                        </div>
                                    </div>

                                </div>
                               
                                <hr class="style2">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    
               </div>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </div>

        <div class="row" style="padding: 10px 0px">
            <div class="col l6">
                 <?php echo Form::submit('Save Module', ['class' => 'btn btn-primary']); ?>

            </div>
            
        </div>

     

        <?php echo Form::close(); ?>

          <div class="row">
            
          </div>
    </div>

<style type="text/css">
    .aione-setting-field:focus{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
    .select-dropdown{
        margin-bottom: 0px !important;
        border: 1px solid #a8a8a8 !important;
        
    }
    .select-wrapper input.select-dropdown{
        height: 30px;
        line-height: 30px;
    }
    .display-block{
        display: block !important;
    }
    .select-wrapper{
    	
    }
    .select-dropdown{
    }
</style>
<script type="text/javascript">
    $(function(){
        $('.add-submodule').click(function(){
            $.ajax({
                url: route()+'singlemodule',
                type: 'GET',
                data: {moduleCount: $('.sub-div').length},
                success: function(result){
                    $('.repeat-submodule').append(result);
                    $('select').material_select();
                } 
            });
        });
        $('body').on('click','.delete-submodule', function(){
            if($('.sub-div').length > 1){
                $(this).parent('.sub-div').remove(); 
            }
        });
        $('body').on('click','.add-route-permission', function(e){
            var elem = $(this);
            e.preventDefault();
            $.ajax({
                url: route()+'single/route/permission',
                type: 'GET',
                data: {routeCount: elem.parents('.sub-div').find('input[name=submoduleNumber]').val()},
                success: function(result){
                    elem.parents('.sub-div').find('.repeat_route_permission').append(result);
                    $('select').material_select();
                } 
            });
        });
        $('body').
        on('click','.delete-reoute-permission', function(e){
            e.preventDefault();
            if($('.repeat-sub-row').length > 1){
                $(this).parents('.repeat-sub-row').remove();
            }
        });
    });
      $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
          });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>