<?php $__env->startSection('content'); ?>

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
        .module-wrapper .sp-preview{
            height: 40px;
            width: 40px;
        }
        .module-wrapper .sp-dd{
            padding: 2px 6px;
            height: 40px;
            line-height: 40px;
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
        /*******************************/
         .Detail-container .collection{
            border: none;
        }
        .Detail-container .collection .collection-item{
            border: 1px solid #e8e8e8;
            margin-bottom: 5px;
        }
   
          .Detail-container .collection .collection-item .delete-field,.arrow-downward,.arrow-upward{
            float: right;
            font-size: 16px;
            color: #757575;
            cursor: pointer;
            display: none
         }
         .Detail-container .collection .collection-item:hover .delete-field{
            display: block;
         }
         .Detail-container .collection .collection-item:hover .arrow-downward{
            display: block;
         }
         .Detail-container .collection .collection-item:hover .arrow-upward{
            display: block;
         }
         .add-section > button {
            float: right;
        }
        .add-section > span{
            float: right;
            width: 200px
        }
</style>
<?php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Widgets',
    'add_new' => '+ Add Widget',
    'route' => 'create.widget'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
    <div class="module-wrapper">
        <div class="list-container">
            <nav id="aione_nav" class="aione-nav light vertical">
                <div class="aione-nav-background"></div>
                <ul id="aione_menu" class="aione-menu sortable">
                    <li class="aione-nav-item level0 unsortable ">
                        <a href="<?php echo e(route('index.widget')); ?>">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-list">
                                </i></span>
                            <span class="nav-item-text">
                                List Widgets
                            </span>
                            
                        </a>
                        <ul id="sortable_submenu" class="side-bar-submenu">
                          
                        </ul>
                       
                    </li>
                    <?php if(!empty($data)): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $ids = [];
                                
                            ?>
                            <?php $__currentLoopData = $val->widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $widgets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $ids[] = $widgets->id;

                                ?> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="aione-nav-item level0 has-children <?php echo e((in_array(@request()->route()->parameters()['id'],$ids))?'nav-item-selected':''); ?> ">

                                <input type="hidden" name="id" class="id" value="<?php echo e($val->id); ?>">
                                <input type="hidden" name="orderBy" class="orderBy" value="<?php echo e($val->order); ?>">
                                <a href="#">
                                    <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa <?php echo e($val->icon); ?>">
                                        </i></span>
                                    <span class="nav-item-text">
                                        <?php echo e($val->name); ?>

                                    </span>
                                    <span class="nav-item-arrow"></span>
                                </a>
                                <ul id="sortable_submenu" class="side-bar-submenu">
                                
                                    <?php $__currentLoopData = $val->widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $widgets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="aione-nav-item level1 <?php echo e(($widgets->id == @request()->route()->parameters()['id'])?'active-state' :''); ?>  ">
                                            <a href="<?php echo e(route('index.widget',['id'=>$widgets->id])); ?>">
                                                <span class="nav-item-icon"><?php echo e($widgets->id); ?></span>
                                                <span class="nav-item-text"><?php echo e($widgets->title); ?></span>
                                            </a>
                                        </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>    
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <div class="Detail-container">
            <?php if($widgetData == null): ?>
                <ul class="collection">
                    <?php if(!empty($data)): ?>
                        <?php
                            $check_id = 0;
                        ?>
                       
                        <?php $__currentLoopData = $listWidgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <li class="collection-item">
                                
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="token" >
                                <input type="hidden" name="id" class="id" value="<?php echo e($val->id); ?>">

                                <input type="checkbox" class="filled-in status-toggle" id="test<?php echo e($check_id); ?>" 
                                    <?php echo e(($val->status == '0'?'':'checked="checked"')); ?>/> 
                                <label for="test<?php echo e($check_id); ?>"> <?php echo e($val->title); ?></label>
                                
                                <a href="<?php echo e(route('delete.widget',['id'=>$val->id])); ?>" class="delete-field">
                                    <i class="material-icons dp48 del red">clear</i>
                                </a>
                                <script type="text/javascript">
                                    $(document).on('click','.delete-field',function(e){
                                        e.preventDefault();
                                        var href = $(this).attr("href");
                                        swal({   
                                            title: "Are you sure?",   
                                            text: "You will not be able to recover!",   
                                            type: "warning",   
                                            showCancelButton: true,   
                                            confirmButtonColor: "#DD6B55",   
                                            confirmButtonText: "Yes, delete it!",   
                                            closeOnConfirm: false 
                                        }, 
                                        function(){
                                            window.location = href;
                                           swal("Deleted!", "Your widget has been deleted.", "success"); 
                                       });
                                    })
                                </script>
                                <a href="<?php echo e(route('sort.down',['id'=>$val->id])); ?>" class="arrow-downward">
                                    <i class="material-icons dp48 orange">arrow_downward</i>
                                </a>
                                <a href="<?php echo e(route('sort.up',['id'=>$val->id])); ?>" class="arrow-upward">
                                    <i class="material-icons dp48 green">arrow_upward</i>
                                </a>
                            </li>
                            
                        <?php
                            $check_id++;
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            <?php else: ?>
                <div id="" class="aione-tabs-wrapper">
                    <nav class="aione-nav aione-nav-horizontal">
                        <ul class="aione-tabs ">
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
                            <?php echo Form::model($widgetData,['route' => 'edit.widget']); ?>

                           
                           <input type="hidden" name="id" class="id" value="<?php echo e($widgetData->id); ?>">
                            <div id="aione_modules_settings" class="aione-tab-content active">
                               
                                 

                                    
                                <?php echo FormGenerator::GenerateForm('add_edit_widget_form'); ?>

                            </div>

                            <div id="aione_modules_custom_css" class="aione-tab-content">
                                
                                 <?php echo FormGenerator::GenerateForm('custom_code'); ?>

                            </div>
                            <div id="aione_modules_custom_js" class="aione-tab-content">
                                
                            </div>
                          
                            <?php echo Form::close(); ?>

                        </div>
                </div>
                <script type="text/javascript">
                     var editorJs = ace.edit("editor-js");
                    editorJs.setTheme("ace/theme/monokai");
                    editorJs.getSession().setMode("ace/mode/javascript");
                    var editorCss = ace.edit("editor-css");
                    editorCss.setTheme("ace/theme/monokai");
                    editorCss.getSession().setMode("ace/mode/css");
                    // $("#custom").spectrum({
                    //     color: '#000',
                    //     showAlpha: true,
                    // });

                    editorJs.getSession().on("change", function () {
                        var code = editorJs.getValue();
                        $('input[name=js]').val(code);
                    });
                    editorCss.getSession().on("change", function () {
                        var code = editorCss.getValue();
                        $('input[name=css]').val(code);
                    });

                    if($('input[name=js]').val() != ""){
                        editorJs.setValue($('.editor-js').val());
                    } 
                    if($('input[name=css]').val() != ""){
                        editorCss.setValue($('.editor-css').val());
                    } 
                </script>
            <?php endif; ?>
            
        </div>
        <div style="clear: both;padding:20px">
            
        </div>
        
        
    </div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">


   //  $(document).ready(function(){
    


   //       $('.sortable').sortable({
   //          axis: 'y',
   //          items: "li:not(.unsortable)",
   //          update: function (event, ui) {
   //            var id = [];
   //            var orderBy = [];
   //            var data = $(this).sortable('serialize');

   //            $('.id').each(function($v){
   //              id.push($(this).val());
   //            });

   //            $('.orderBy').each(function($v){
   //              orderBy.push($(this).val());
   //            });

   //          $.ajax({
   //              url: route()+'/sort/widget',
   //              type: 'POST',
   //              data: {id : id,_token : $('input[name=_token]').val()},
   //              success:function(){
   //                console.log()
   //              }
   //          });
   //        }
   //      });
   // });

    $(document).on('change', '.status-toggle',function(e){
      // e.preventDefault();
      var postedData = {};
      postedData['id']        = $(this).parents('.collection-item').find('.id').val();
      postedData['status']      = $(this).prop('checked');
      postedData['_token']      = $('.collection-item').find('.token').val();

      $.ajax({
        url:route()+'/widget/status/update',
        type:'POST',
        data:postedData,
        success: function(res){
          console.log('data sent successfull');
        }
      });
      $('.editable h5 ,.editable p').removeClass('edit-fields');
    });


      



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>