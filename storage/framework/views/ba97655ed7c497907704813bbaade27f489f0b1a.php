<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Modules',
  'add_new' => '+ Add Module'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="module-wrapper" >
        <?php 
        $permission['permission']= [];
        $index = 0;
        if(@$moduleData != null){
            foreach(@$moduleData->subModule as $key => $submodule){
                foreach(@$submodule->moduleRoute as $routeKey => $route){

                    $permission['permission'][$index]['routes'] = $route->route;
                    $permission['permission'][$index]['route_name'] = $route->route_name;
                    $index++;
                }
            }
        }
         ?>
        <?php echo $__env->make('admin.module._sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="Detail-container">
			<!-- http://admin.adminpie.com/modules/{id} -->
	        <?php if(@$subModuleData == null): ?>
              
                <?php if(@$moduleData != null): ?>
                 	<?php echo Form::model($moduleData,['route' => 'edit.module' , 'method' => 'post']); ?>

                <?php else: ?>
                    <?php echo Form::open(['route' => 'edit.module' , 'method' => 'post']); ?>

                <?php endif; ?>
                <?php if(@$moduleData != null): ?>
	                    <div id="" class="aione-tabs-wrapper">
	                        <nav class="aione-nav aione-nav-horizontal">
	                            <ul class="aione-tabs">
	                                <li class="aione-tab active">
	                                    <a href="#aione_modules_settings">
	                                        <span class="nav-item-text">Settings</span>
	                                    </a>
	                                </li>
	                                <li class="aione-tab ">
	                                    <a href="#aione_modules_custom_css">
	                                        <span class="nav-item-text">Customize</span>
	                                    </a>
	                                </li>
	                           
	                            </ul>
	                        </nav>
	                        <div class="aione-tabs-content-wrapper">
	                            <div id="aione_modules_settings" class="aione-tab-content active">
	                                <div class="row">
	                               
	                                    <?php echo Form::hidden('color', @$moduleData->color ,['class' => 'color_picker']); ?>


	                                    <?php echo Form::hidden('icon', @$moduleData->icon,['class' => 'font-awesome-text']); ?>                     

	                                    <input type="hidden" name="modules_id" value="<?php echo e(@request()->route()->parameters()['id']); ?>">              
	                                    <?php echo FormGenerator::GenerateForm('module_setting_form'); ?>

	                                </div>
	                            </div>
	                            <div id="aione_modules_custom_css" class="aione-tab-content">
	                              
	                                <?php echo FormGenerator::GenerateForm('custom_code'); ?>

	                              
	                            </div>
	                           
	                       
	                            <div class="clear"></div>
	                        </div>

	                    </div>
               		<?php echo Form::close(); ?>

                    <?php echo Form::open(['route' => 'sub.module.save' , 'method' => 'post']); ?>

                        <input type="hidden" name="module_id" value="<?php echo e(@request()->route()->parameters()['id']); ?>">
                        <?php echo FormGenerator::GenerateForm('add_submodule_form'); ?>

                    <?php echo Form::close(); ?>

                        <?php endif; ?>
                

                <ul class="collection">
                    <?php if(@$moduleData->subModule != null): ?>
                    <?php $__currentLoopData = $moduleData->subModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="collection-item">
                            <a href="<?php echo e(route('list.module',['id'=>@request()->route()->parameters()['id'],'subModule'=>$value->id])); ?>"><?php echo e($value->name); ?></a>
                            <a href="<?php echo e(route('subModule.delete',['id'=>$value->id])); ?>" class="secondary-content delete-submodule">
                                <i class="arrow-delete material-icons dp48">delete</i>
                            </a>
                           
                            <a href="<?php echo e(route('sub.module.sort.down',['subModule'=>$value->id,'id'=> @request()->route()->parameters()['id']])); ?>" class="secondary-content">
                                <i class="arrow-downward material-icons dp48">arrow_downward</i>
                            </a>
                            <a href="<?php echo e(route('sub.module.sort.up',['subModule'=>$value->id,'id'=> @request()->route()->parameters()['id']])); ?>" class="secondary-content">
                                <i class="arrow-upward material-icons dp48">arrow_upward</i>
                            </a>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
                    
		        
			<?php endif; ?>
			<!-- http://admin.adminpie.com/modules/{id}/{submodule} -->
            <?php if(@$subModuleData != null): ?>
               
                <div id="" class="aione-tabs-wrapper">
                    <nav class="aione-nav aione-nav-horizontal">
                        <ul class="aione-tabs">
                            <li class="aione-tab active">
                                <a href="#aione_modules_settings">
                                    <span class="nav-item-text">Settings</span>
                                </a>
                            </li>
                            <li class="aione-tab ">
                                <a href="#aione_modules_custom_css">
                                    <span class="nav-item-text">Customize</span>
                                </a>
                            </li>
                            <li class="aione-tab ">
                                <a href="#aione_modules_permissions">
                                    <span class="nav-item-text">Permissions</span>
                                </a>
                            </li>
                          
                        </ul>
                    </nav>
                    <div class="aione-tabs-content-wrapper">
                        
                        <div id="aione_modules_settings" class="aione-tab-content active">
                         
                           <?php echo Form::model($subModuleData,['route' => 'save.style.module' , 'method' => 'post']); ?>

                                <div class="row">
                                 
                                    <input type="hidden" name="sub_modules_id" value="<?php echo e(@request()->route()->parameters()['subModule']); ?>">  
                                    <?php echo FormGenerator::GenerateSection('submodule_settings'); ?>

                                  
                                </div>
                           
                             <?php echo Form::close(); ?>    
                          
                        </div>
                        <div id="aione_modules_custom_css" class="aione-tab-content">
	                        <?php echo Form::model($subModuleData,['route' => 'save.style.module' , 'method' => 'post']); ?>  
                                <input type="hidden" name="sub_modules_id" value="<?php echo e(@request()->route()->parameters()['subModule']); ?>">      
							    <?php echo FormGenerator::GenerateForm('custom_code'); ?>

	                        <?php echo Form::close(); ?>       
					    </div>
	                    
                        <div id="aione_modules_permissions" class="aione-tab-content">
                                  
                            <!-- permission div starts -->
                           
                            <!-- permission div ends -->
                            
                            <!--new permission div starts -->
                            <?php if($permission != null): ?>
                                    <?php echo e(dump($permission)); ?>

                                <?php echo Form::model($permission,['route' => 'edit.subModule','method' => 'POST']); ?>

                            <?php else: ?>
                                <?php echo Form::open(['route' => 'edit.subModule','method' => 'POST']); ?>

                            <?php endif; ?>
                                    <?php echo Form::model(@$route,['route' => 'edit.subModule','method' => 'POST']); ?>


                                     <input type="hidden" name="subModule_id" value="<?php echo e(@request()->route()->parameters()['subModule']); ?>" placeholder="Enter route name" />
                                        <?php echo FormGenerator::GenerateSection('permission',[],$permission); ?>

                                                
                                    <input type="submit" value="Save Permission">
                                <?php echo Form::close(); ?>

                            <!--new permission div ends -->
                                  
                        </div>
                    </div>
                           
                </div>
            <?php endif; ?>

			
			<!-- http://admin.adminpie.com/modules -->
            <?php if(@$subModuleData == null && @$moduleData == null): ?>
                <?php echo Form::open(['route' => 'module.save' , 'method' => 'post']); ?>

                 
                	<?php echo FormGenerator::GenerateForm('add_module_form'); ?>

                <?php echo Form::close(); ?>

                <ul class="collection">
                    <?php $__currentLoopData = $listModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="collection-item" style="position: relative;">

                            <a href="<?php echo e(route('list.module',['id'=>$val->id])); ?>"><?php echo e($val->name); ?></a> 
                             <div style="display: inline-block;float: right;right: 140px;"> 
                                <?php if($val->status == 0): ?>
                                    <a href="<?php echo e(route('status.module',['id'=>$val->id])); ?>">Activate</a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('status.module',['id'=>$val->id])); ?>">Deactivate</a>
                                <?php endif; ?>
                                <label class="switch" for="input_">
                                    <span class="handle"></span>
                                </label>
                             </div>
                            <a href="<?php echo e(route('module.delete',['id'=>$val->id])); ?>" class="secondary-content delete-module">
                                <i class="arrow-delete material-icons dp48">delete</i>
                            </a>
                            <script type="text/javascript">
                                $(document).on('click','.delete-module',function(e){
                                    e.preventDefault();
                                    var href = $(this).attr("href");
                                    swal({   
                                        title: "Are you sure?",   
                                        text: "You will not be able to recover this imaginary file!",   
                                        type: "warning",   
                                        showCancelButton: true,   
                                        confirmButtonColor: "#DD6B55",   
                                        confirmButtonText: "Yes, delete it!",   
                                        closeOnConfirm: false 
                                    }, 
                                    function(){
                                    window.location = href;
                                       swal("Deleted!", "Your Module has been deleted.", "success"); 
                                   });
                                })
                            </script>
                            <a href="<?php echo e(route('module.sort.down',['id'=>$val->id])); ?>" class="secondary-content">
                                <i class="arrow-downward material-icons dp48">arrow_downward</i>
                            </a>
                            <a href="<?php echo e(route('module.sort.up',['id'=>$val->id])); ?>" class="secondary-content">     <i class="arrow-upward material-icons dp48">arrow_upward</i>
                            </a>
                           
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
			<?php endif; ?>
        </div>
        <div class="clear"></div>
    </div>
    <style type="text/css">
           .module-wrapper > .list-container{
            float: left;
            width: 25%;
            border: 1px solid #e8e8e8;
            height: 100%;
            padding: 10px;
        }
        .module-wrapper > .Detail-container{
            float: right;
            width: 74%;
            border: 1px solid #e8e8e8;
            padding: 10px;
           
        }
        .list-modules > li > div,.list-sub-modules > li{
            border: 1px solid #e8e8e8;
            padding:10px 5px;
            margin-bottom: 5px;
            box-shadow: 1px 1px 1px 1px #F2F1F1;
            background-color: white;
        }
        .list-modules > li > div > .del,.list-sub-modules > li > .del{
            float: right;
            color: #757575;
            font-size: 18px;
            cursor: pointer;
        }
        .list-modules > li > div > .arrow{
            float: left;
            color: #757575;
            font-size: 18px;
            transform: rotate(270deg);
            cursor: pointer;
        }
        .list-sub-modules > li{
            margin-left: 10px;
             transition: opacity 1s ease-out;
        }
        .list-active .list-sub-modules{
            display: block;
            
        }
        .list-sub-modules{
            display: none;
        }
       .module-wrapper .editor{
            height: 200px;margin: 5px 10px
        }
       
       
        .module-wrapper .btn.blue{
            float: right;
           
            margin: 10px;
        }
        .aione-nav-item .material-icons{
            position: absolute;
            top: -10px;
            right: -10px;
            border: 3px solid white;
            line-height: 14px;
            height: 20px;
            background-color: red;
            font-size: 14px;
            border-radius: 50%;
            cursor: pointer;
            display: none;
        }
        .aione-nav-item:hover .material-icons{
            display: block
        }
        .Detail-container .secondary-content{
            margin-left: 14px;
        }
        .add-module > button {
            float: right;
        }
        .add-module > span{
            float: right;
            width: 200px
        }
        .collection .collection-item .material-icons{
            display: none
        }
         .collection .collection-item:hover .material-icons{
            display: block
        }
        .sp-replacer{
           border:none;
           background-color:transparent;
           padding:0;
           margin:0;
           display: block;
        }
        .sp-preview {
           width: 45px;
           height: 45px;
          
           overflow:hidden;
           border: none;
           margin-right: 0;
        }
        .sp-dd{
           display:none;
        }
    </style>
    <script type="text/javascript">
     $(document).ready(function () {

         $('body').on('click','.add-route-permission', function(e){
            var result = '<div class="row repeat-sub-row"> <div class="col s12 m2 l12 aione-field-wrapper" style="border: 1px solid #e8e8e8;padding: 14px; margin-top: 1%;"> <div class="row valign-wrapper"> <div class="col l5 pr-7"> <label>Route name</label><input type="hidden" name="subModule_id" value="<?php echo e(@request()->route()->parameters()['subModule']); ?>" placeholder="Enter route name" /> <input type="text" name="route_name[]" value="" placeholder="Enter route name" /> </div> <div class="col l6 pl-7 pr-7"> <label>Route</label> <?php echo Form::select('routes[]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control sel browser-default','placeholder'=>'url ']); ?> </div> <div class="col l1 pl-7"> <a href="" class=" delete-reoute-permission"><i class="fa fa-close"></i></a> </div> </div> </div> <hr class="style2"> </div>';
            
            var elem = $(this);
            e.preventDefault();
            // $.ajax({
            //     url: route()+'single/route/permission',
            //     type: 'GET',
            //     data: {routeCount: elem.parents('.sub-div').find('input[name=submoduleNumber]').val()},
            //     success: function(result){
                    elem.parents('.sub-div').find('.repeat_route_permission').append(result);
                    $('select').material_select();
            //     } 
            // });
        });

        // $('.collection').on('click','.arrow-upward',function(e){
        //     var module_id = [];
        //       var sort_id = [];
        //     e.preventDefault();
        //     var current = $(this).parents('.collection-item');
        //     current.prev().before(current);
            
        //     $('.module_id').each(function($v){
        //         module_id.push($(this).val());
        //     });
        //     $('.ui-sortable-handle').each(function($v){
        //         sort_id.push($(this).attr('id'));
        //     });

        //     $.ajax({
        //         url: route()+'/sort/module',
        //         type: 'POST',
        //         data: {module_id : module_id , sort_id : sort_id  , _token : $('.shift_token').val()},
        //         success:function(){
        //           console.log()
        //         }
        //     });
        // });
        // $('.collection').on('click','.arrow-downward',function(e){
        //     var module_id = [];
        //       var sort_id = [];
        //     e.preventDefault();
        //     var current = $(this).parents('.collection-item');
        //     current.next().after(current);

        //     $('.module_id').each(function($v){
        //         module_id.push($(this).val());
        //     });
        //     $('.ui-sortable-handle').each(function($v){
        //         sort_id.push($(this).attr('id'));
        //     });

        //     $.ajax({
        //         url: route()+'/sort/module',
        //         type: 'POST',
        //         data: {module_id : module_id , sort_id : sort_id  , _token : $('.shift_token').val()},
        //         success:function(){
        //           console.log()
        //         }
        //     });
        // });
        
        $('.sortable').sortable({
            axis: 'y',
            items: "li:not(.unsortable)",
            update: function (event, ui) {
              var module_id = [];
              var sort_id = [];
              var data = $(this).sortable('serialize');

              $('.module_id').each(function($v){
                module_id.push($(this).val());
              });
              $('.ui-sortable-handle').each(function($v){
                sort_id.push($(this).attr('id'));
              });

              $.ajax({
                url: route()+'/sort/module',
                type: 'POST',
                data: {module_id : module_id , sort_id : sort_id  , _token : $('.shift_token').val()},
                success:function(){
                  console.log()
                }
            });
          }
        });

    });

        // $("#custom").spectrum({
        //     color: '#000',
        //     showAlpha: true,
        // });
        $("#custom").spectrum({
            color: "#168dc5",
            flat: false,
            showInput: true,
            showInitial: true,
            allowEmpty: true,
            showAlpha: true,
            disabled: false,
            localStorageKey: "save-color",
            showPalette: true,
            showPaletteOnly: false,
            togglePaletteOnly: true,
            showSelectionPalette: true,
            clickoutFiresChange: true,
            cancelText: "Cancel",
            chooseText: "Select",
            togglePaletteMoreText: "More",
            togglePaletteLessText: "Less",
            containerClassName: "Class1",
            replacerClassName: "Class2",
            preferredFormat: "Class3",
            maxSelectionSize: 5,
            palette: [
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"],
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"],
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"],
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"],
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"] 
                ],
            selectionPalette: ['#168dc5']
        });
        $(document).ready(function(){
            $(document).on('click','.list-modules .arrow',function(){ 
                if($(this).parents('li').hasClass('list-active')){
                    $(this).parents('li').removeClass('list-active');
                }else{
                    $(this).parents('li').addClass('list-active');
                    $(this).parents('li').siblings().removeClass('list-active');    
                }
                
            });
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