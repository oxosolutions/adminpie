<?php $__env->startSection('content'); ?>
<?php 
   $option ="";
    $data = App\Model\Admin\GlobalModule::getRouteListArray();


$opt_route_for =['read'=>'Read', 'write'=>'Write', 'delete'=>'Delete'];
                            
 ?>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.remove_row',function(e){
      $(this).parent().remove();
    });
  });
</script>
<?php 
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Edit Module',
    'add_new' => '+ Add Designation'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
   <?php if(@$module): ?>
                <?php echo Form::model($module,['route' => 'save.style.subModule' , 'method' => 'post']); ?> 
            <?php else: ?>
                <?php echo Form::open(['route' => 'save.style.subModule' , 'method' => 'post']); ?>

            <?php endif; ?>
            <div class="row">
                <div class="col l6">
                    <label>
                        Select a color
                    </label>
                    <div class="col l12">
                        
                        <input type="text" id="custom">
                        <?php echo Form::hidden('color', null,['class' => 'color_picker']); ?>

                    </div>
                </div>
                <div class="col l6">
                    <label>
                        Select an icon
                    </label>
                    <div class="col l12 aione-field-wrapper">
                        <input type="text" class="input1 input font-awesome" placeholder="Pick an icon" />  
                        
                        <?php echo Form::hidden('icon', null,['class' => 'font-awesome-text']); ?>                     
                        <input type="hidden" name="modules_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">                                  
                    </div>
                </div>
                                        <button class="btn blue save-settings" type="submit">Save Settings</button>

            </div>

    <?php echo Form::close(); ?>

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

         
    </div>
    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
    .howl-iconpicker .geticonval{
        width: 52px;
        height: 48px;
    }
    .howl-iconpicker-close{
        width: 260px;
    }
    .custom-code .editor{
        height: 200px;margin: 5px 10px
    }
    .sp-preview{
        width: 400px;
        height: 28px;
    }
    ..sp-replacer{
        display: block;
    }
    .custom-code .col{
        margin-bottom: 10px
    }
    button.save-settings{
        float: right;
    }
    input[type='color']{
         display: block;
         width: 98%;
         height: 48px;
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
        $("#custom").spectrum({
            color: '#000',
            showAlpha: true,
        });
        $(document).ready(function(){
            $('.input1').iconpicker(".input1");

            $('#custom').change(function(){
                $('.color_picker').val($("#custom").spectrum('get').toRgbString());             
            });
            $('.font-awesome').change(function(){
                $('.font-awesome-text').val($(this).val());
            });
            if($('input[name=icon]').val() != ""){
                $('.geticonval > i').each(function(){
                    if($(this).attr('class') == 'fa '+$('input[name=icon]').val()){
                        $(this).parent().addClass('geticonval selectedicon');
                        $('.font-awesome').val($('input[name=icon]').val());
                    }else{
                        console.log("not in class");
                    }
                });
            }
            if($('input[name=color]').val() != ""){
                $('.sp-preview-inner').css({'background-color': $('input[name=color]').val()});
            }
        });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>