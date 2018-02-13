<?php if(Auth::guard('admin')->check() == true): ?>
	<?php 
        $route_slug = '';
		$layout = 'admin.layouts.main';
		$route = 'create.sections';
		$routeDelSec = 'del.section';
		$routeListField = 'list.field';
	 ?>
<?php else: ?>
	<?php 
        $route_slug = 'org.';
		$layout = 'layouts.main';
		$route = 'org.create.sections';
		$routeDelSec = 'org.del.section';
		$routeListField = 'org.list.field';
	 ?>
<?php endif; ?>
<?php 
	$section_id = ""; 
 ?>

<?php $__env->startSection('content'); ?>
<?php 
    @$title = $form->form_title;
 ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Form <span>'.@$title.'</span>',
  'add_new' => '+ Apply leave'
); 
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(!empty($error)): ?>
 <?php echo $__env->make('organization.survey._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="aione-message warning">
        <?php echo e($error); ?>

     </div>

<?php elseif(!@$permission): ?>
        <div>
            <div class="access-denied">Access Denied</div>
            <div class="permission">You do not have permission!</div>
        </div>
<?php else: ?>
    
    <?php if($form->type == 'survey'): ?>
        <?php echo $__env->make('organization.survey._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('admin.formbuilder._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

    

        <div class="module-wrapper">
            <div class="list-container">
                <nav id="aione_nav" class="aione-nav light vertical">
                    <div class="aione-nav-background"></div>
                    <ul id="sortable" class="aione-menu">
                        <li class="aione-nav-item level0 unsortable <?php echo e((Request::input('sections') == 'all' || empty(Request::input()))?'nav-item-current':''); ?>">
                            <a href="<?php echo e(Request::url()); ?>?sections=all" id="all_list">
                                <span class="nav-item-icon"><i class="fa fa-bars"></i></span>
                                <span class="nav-item-text">
                                    All Sections
                                </span>
                            </a>
                        </li>
                    <?php  $index = 1; ?>
    				<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    					<?php 
    						$section_id = $section->id;	
    					 ?>
                        <li class="aione-nav-item level0 has-children <?php echo e((Request::input('sections') == $section->id)?'nav-item-current':''); ?>" section-id=<?php echo e($section->id); ?>>
                            <a href="<?php echo e(Request::url()); ?>?sections=<?php echo e($section->id); ?>">
                                <span class="nav-item-icon"><i class="fa fa-terminal"></i></span>
                                <span class="nav-item-text">
                                    <?php echo e($section->section_name); ?>

                                </span>
                                <span class="nav-item-arrow"></span>
                            </a>
                            <ul class="side-bar-submenu">
                           <?php $__currentLoopData = $section->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="aione-nav-item level1 unsortable <?php echo e((Request::input('field') == $fields->id)?'nav-item-current':''); ?>">
                                    <a href="<?php echo e(Request::url()); ?>?sections=<?php echo e($section->id); ?>&field=<?php echo e($fields->id); ?>">
                                        <span class="nav-item-icon">P</span>
                                        <span class="nav-item-text"> <?php echo e($fields->field_title); ?> (<?php echo e($fields->field_type); ?>)</span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </nav>
            </div>
            <div class="Detail-container">
                <?php 
                    $section_id = request()->input('sections');
                    $sectionFormData = [];
                    $data = [];
                 ?>
                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($value->id == $section_id): ?>
                        <?php 
                            $sectionFormData[$key] = $value;   
                         ?>
                    <?php endif; ?>    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $sectionFormData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $value->sectionMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                            $data[$v->key] = $v->value;
                         ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        $data['section_name'] = $value->section_name;
                        $data['section_slug'] = $value->section_slug;
                        $data['section_description'] = $value->section_description;
                     ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
                <?php if(!Request::has('field')): ?>

                    <?php if(Request::has('sections') && Request::input('sections') != 'all'): ?>
                        <?php echo Form::model($data,['route'=>[$route_slug.'section.update',request()->form_id]]); ?>

                            <input type="hidden" name="section_id" value="<?php echo e(Request::input('sections')); ?>" />
                            <div class="row no-margin-bottom">
                                
                                <?php echo FormGenerator::GenerateForm('form_generator_section_edit'); ?>

                                <?php if(@$errors->has()): ?>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kay => $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="color: red"><?php echo e($err); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                              

                            </div>
                        <?php echo Form::close(); ?>

                    <?php endif; ?>

                    <?php if((Request::has('sections') && Request::input('sections') == 'all') || empty(Request::input())): ?>
                        <?php echo Form::model($form,['class' => 'form' ,'route' => 'org.update.form']); ?>

                            <input type="hidden" name="id" value="<?php echo e($form->id); ?>">
                            <?php echo FormGenerator::GenerateForm('edit_form_form'); ?>

                        <?php echo Form::close(); ?>


                        <?php echo Form::open(['route'=>[$route , request()->form_id] , 'class'=> 'form-horizontal','method' => 'post']); ?>

                            <div class="add-section">
                              
                                <?php echo FormGenerator::GenerateForm('add_section_form'); ?> 
                                <div class="clear"></div>
                                <?php if($errors->has('name')): ?>
                                    <span style="color: red;"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php echo Form::close(); ?>

                    <?php endif; ?>
                    <?php if(Request::has('sections') && Request::input('sections') != 'all'): ?>
                        <?php echo Form::open(['route'=>[$route_slug.'create.field',request()->form_id,Request::input('sections')],'class'=>'add-field-mini-form']); ?>

                                <?php echo FormGenerator::GenerateForm('add_field_from_section'); ?>  
                                <?php echo Form::hidden('type',$form->type); ?>

                        <?php echo Form::close(); ?>

                    <?php endif; ?>

                    <ul class="collection aione-form-section-border" id="sortable-fields">
                        
                        <?php if((Request::has('sections') && Request::input('sections') == 'all') || empty(Request::input())): ?>
                            <div id="aione_form_section_header" class="aione-form-section-header">
                                <div class="aione-row">
                                    <h3 class="aione-form-section-title aione-align-center">Sections</h3>
                                    <h4 class="aione-form-section-description aione-align-center">List of all sections in this form.</h4>
                                </div> <!-- .aione-row -->
                            </div>
                            <?php if($sections->count() > 0): ?>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <li class="collection-item section_id" section_id="<?php echo e($section->id); ?>">
                                        <a href="<?php echo e(Request::url()); ?>?sections=<?php echo e($section->id); ?>"><?php echo e($section->section_name); ?> (<?php echo e($section->section_slug); ?>)</a>
                                        <div class="item-options">
                                            <a href="<?php echo e(route($route_slug.'section.delete',$section->id)); ?>" class="delete-field confirm-delete">
                                                <i class="material-icons dp48 del red">clear</i>

                                            </a>
                                            

                                             <a href="<?php echo e(route($route_slug.'section.clone',$section->id)); ?>" class="delete-field">
                                                <i class="fa fa-clone"></i>
                                            </a>
                                            
                                            <a href="javascript:;" class="arrow-upward">
                                                <i class=" material-icons dp48 green">arrow_upward</i>   
                                            </a>
                                            
                                            <a href="javascript:;" class="arrow-downward">
                                                <i class=" material-icons dp48 orange">arrow_downward</i>    
                                            </a>
                                            <a href="javascript:;" class="move" section-id="<?php echo e($section->id); ?>" data-target="list-forms">
                                                <i class=" material-icons dp48 blue">forward</i>    
                                            </a>
                                        </div>
                                       
                                        <div id="list-forms" class="modal modal-fixed-footer" style="overflow-y: hidden;">
                                            <div class="modal-header">
                                                <h5>Select form where you want to move this section</h5>  
                                                <a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
                                            </div>
                                             <?php echo Form::open([ 'method' => 'POST', 'route' =>$route_slug.'section.move' ,'class' => 'form-horizontal']); ?>

                                            <div class="modal-content">
                                                 <?php echo Form::select('move_to',listForms(),null,['class'=>' browser-default ','id'=>'input_','placeholder'=>'Select form']); ?>

                                                    <input type="hidden" name="sectionId" value="">
                                                 <?php echo FormGenerator::GenerateField('want_to'); ?>

                                                  
                                            </div>
                                            <div class="modal-footer">
                                               
                                                <button class="btn blue " type="submit" name="action">Proceed
                                                </button>
                                            </div>
                                            <?php echo Form::close(); ?>  
                                        </div>
                                        <script type="text/javascript">
                                            $('#list-forms').modal({
                                                 dismissible: true
                                            });
                                        </script>
                                        
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="aione-message warning">
                                    <?php echo e(__('forms.no_section_available')); ?>

                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(Request::has('sections') && Request::input('sections') != 'all'): ?>
                            <div id="aione_form_section_header" class="aione-form-section-header">
                                <div class="aione-row">
                                    <h3 class="aione-form-section-title aione-align-left ">Fields</h3>
                                    <h4 class="aione-form-section-description aione-align-left">List of all fields in this section</h4>
                                </div> <!-- .aione-row -->
                            </div>
                            <?php 
                                $fields = $sections->where('id',Request::input('sections'))->first()->fields;
                                $firstField = @$fields->toArray()[0]['id'];
                             ?>

                            <?php if($fields->count() > 0): ?>
                                <?php $__currentLoopData = $sections->where('id',Request::input('sections'))->first()->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="collection-item field_id" field_id="<?php echo e($field->id); ?>">
                                        <?php if($form->type == 'survey'): ?>
                                            <?php 
                                                $question_id = '';
                                                $questionID = $field->fieldMeta->where('key','question_id')->first();
                                                if($questionID != null){
                                                    $question_id = $questionID->value;
                                                }
                                             ?>
                                            <span class="question-id"><?php echo e($question_id); ?></span>
                                        <?php endif; ?>
                                       
                                        <a href="<?php echo e(Request::url()); ?>?sections=<?php echo e(Request::input('sections')); ?>&field=<?php echo e($field->id); ?>">
                                            <?php echo e($field->field_title); ?> (<?php echo e($field->field_slug); ?>)
                                        </a>
                                         <div class="item-options">
                                            <a href="<?php echo e(route($route_slug.'field.delete',$field->id)); ?>" class="delete-field confirm-delete" >
                                                <i class="material-icons dp48 del red">clear</i>

                                            </a>
                                           

                                            <a href="<?php echo e(route($route_slug.'field.clone',$field->id)); ?>" class="delete-field">
                                                <i class="fa fa-clone"></i>
                                            </a>

                                          
                                            <?php if(Auth::guard('admin')->check()): ?>                                                
                                                <?php 
                                                    $down = 'field.down.sort';
                                                    $up = 'field.up.sort';
                                                 ?>
                                            <?php else: ?>   
                                                <?php 
                                                    $down = 'org.field.down.sort';
                                                    $up = 'org.field.up.sort';
                                                 ?>
                                            <?php endif; ?>
                                                <?php if($field->id != $firstField): ?>
                                                    <a href="<?php echo e(route($up,$field->id)); ?>" class="arrow-upward">
                                                        <i class=" material-icons dp48 green">arrow_upward</i>    
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(route($down,$field->id)); ?>" class="arrow-downward">
                                                    <i class=" material-icons dp48 orange">arrow_downward</i>    
                                                </a>

                                            <a href="javascript:;" class="move field_move" field_id="<?php echo e($field->id); ?>" data-target="sections-list">
                                                <i class=" material-icons dp48 blue">forward</i>    
                                            </a>
                                        </div>
                                        <div id="sections-list" class="modal modal-fixed-footer" style="overflow-y: hidden;">
                                            <div class="modal-header">
                                                <h5>Destination</h5>  
                                                <a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
                                            </div>
                                            <?php if(Auth::guard('admin')->check()): ?>
                                                <?php 
                                                    $route = 'field.move';
                                                 ?>
                                            <?php else: ?>   
                                                <?php 
                                                    $route = 'org.field.move';
                                                 ?>
                                            <?php endif; ?>
                                            <?php 
                                                $sectionData = '';
                                             ?>
                                             <?php echo Form::open([ 'method' => 'POST', 'route' =>[$route,$field->id] ,'class' => 'form-horizontal']); ?>

                                            <div class="modal-content">
                                                    Select Form
                                                <?php echo Form::select('move_to_form',listForms(),null,['class'=>' browser-default form-list','id'=>'input_','placeholder'=>'Select form']); ?>

                                                    Select Section
                                                    
                                                
                                                <input type="hidden" name="field_id">
                                                <select name="move_to_section" class="browser-default section-list">
                                                    <option>Select Section</option>
                                                </select>
                                                 <?php echo FormGenerator::GenerateField('want_to'); ?>

                                                  
                                            </div>

                                            <script type="text/javascript">
                                                $(document).unbind("change").on('change','.form-list',function(e){
                                                    e.stopPropagation();
                                                    var formId = $(this).val();
                                                    $.ajax({
                                                        url:route()+'/section',
                                                        type:'post',
                                                        data:{_token:$('input[name=_token]').val(),formId:formId},
                                                        success:function(res){
                                                             $('#section_name').remove();
                                                            $.each(res,function(i,v){
                                                               
                                                                $('.section-list').append('<option id="section_name" value="'+i+'">'+v+'</option>');
                                                            });
                                                        }
                                                    });
                                                });
                                                $(document).unbind('click').on('click','.field_move',function(){
                                                    var field_id = $(this).attr('field_id');
                                                    $('input[name=field_id]').val(field_id);
                                                });
                                            </script>
                                            <div class="modal-footer">
                                                <button class="btn blue " type="submit" name="action">Proceed
                                                </button>
                                            </div>
                                            <?php echo Form::close(); ?>  
                                        </div>
                                        <script type="text/javascript">
                                            $('#sections-list').modal({
                                                 dismissible: true
                                            });
                                        </script>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="aione-message warning">
                                    <?php echo e(__('forms.no_fields_available')); ?>

                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
                <?php if(Session::has('null_order')): ?>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            Materialize.toast(<?php echo e(Session::get('null_order')); ?> ,6000);
                        });
                    </script>
                <?php endif; ?>
                <?php if(Request::has('field') && Request::input('field') != ''): ?>
                    
                    <?php if($form->type == 'survey'): ?>
                        <?php echo $__env->make('admin.formbuilder._fields_survey', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('admin.formbuilder._field',['sections'=>$sections], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div style="clear: both;padding:20px">

            </div>
            
        </div>
    <?php endif; ?>
    <style type="text/css">
        .permission{
            font-size: 20px;
            font-weight: 500;
            color: #999;
        }
        .access-denied{
            font-size: 40px;
            font-weight: 200;
        }
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
                padding: 15px;
                border: 1px solid #e8e8e8
        }
        .Detail-container .collection .collection-item{
            border: 1px solid #e8e8e8;
               margin-bottom: 10px;
            position: relative;
                padding: 10px;
        }
        .Detail-container .collection .collection-item:last-child{
            margin-bottom: 0px
        }
         .Detail-container .collection .collection-item a{
            color: #666;
         }
        .Detail-container .collection .collection-item .item-options{
            display: inline-block;
            float: right;
        }
        .Detail-container .collection .collection-item .question-id{
            position: absolute;
            top: -15px;
            padding: 3px 22px;
            background-color: #e8e8e8;
            font-size: 13px;

        }
   
          .Detail-container .collection .collection-item .delete-field,
          .Detail-container .collection .collection-item .arrow-upward,
          .Detail-container .collection .collection-item .arrow-downward,
          .Detail-container .collection .collection-item .move{
            float: right;
            font-size: 16px;
            color: #757575;
            cursor: pointer;
            display: none
         }
         .Detail-container .collection .collection-item:hover .delete-field,
         .Detail-container .collection .collection-item:hover .arrow-upward,
         .Detail-container .collection .collection-item:hover .arrow-downward,
         .Detail-container .collection .collection-item:hover .move{
            display: block;
         }
         .Detail-container .collection .collection-item:first-child:hover .arrow-upward{
            display: none
         }
         .Detail-container .collection .collection-item:last-child:hover .arrow-downward{
            display: none
         }
         .subtitle{
                
   
            font-weight: 500;
            display: inline-block;

         }
        /*.add-section > button {
            float: right;
        }
        .add-section > span{
            float: right;
            width: 200px
        }*/
       /* .add-section .add-field-form > div,
        .add-section .add-field-form > button{
            float: left;
            width: 23%;
            margin: 0px 10px 0px 0px;
        }*/

    </style>
 
    <script type="text/javascript">

        $(document).on('click','.confirm-delete',function(e){
            e.preventDefault();
            var href = $(this).attr("href");
            swal({   
                title: "Are you sure?",   
                text: "You will not be able to recover this!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it!",   
                closeOnConfirm: false 
            }, 
            function(){
                window.location = href;
               swal("Deleted!", "Your Section/field has been deleted.", "success"); 
           });
        })

        $('#sortable-fields').sortable({
            stop: function(){
                if($(this).find('li').attr('section_id')){
                    var ids = [];
                    $('#sortable-fields > .section_id').each(function(){
                        if($(this).attr('section_id') != undefined){
                            ids.push($(this).attr('section_id'));
                        }
                    });
                    $.ajax({
                        url : route()+'/section/sort',
                        type : 'post',
                        data : {id : ids , _token : $('input[name=_token]').val() },
                        success : function(){
                            Materialize.toast('sorted successfully',4000);
                        }
                    });
               }else{
                    var field_order = [];
                    $('#sortable-fields > .field_id').each(function(){
                        if($(this).attr('field_id') != undefined){
                            field_order.push($(this).attr('field_id'));
                        }
                    });
                    $.ajax({
                        url : route()+'/field/sort',
                        type : 'get',
                        data : {data : field_order , _token : $('input[name=_token]').val() },
                        success : function(){
                            Materialize.toast('sorted successfully',4000);
                        }
                    });
               }
            }
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

            // $('.input1').iconpicker(".input1");

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
       

        $( function() {
            $( "#sortable" ).sortable({
                axis: "y",
                items: "li:not(.unsortable)",
                update : function(){
                    var ids = [];
                    $('#sortable > li').each(function(){
                        if($(this).attr('section-id') != undefined){
                            ids.push($(this).attr('section-id'));
                        }
                    });
                    console.log(ids);
                    $.ajax({
                        url : route()+'/section/sort',
                        type : 'post',
                        data : {id : ids , _token : $('input[name=_token]').val() },
                        success : function(){

                        }
                    })
                }
            });
            $( "#sortable" ).disableSelection();
        });
        $(document).on('click','.move',function(){
            $('input[name=sectionId]').val($(this).attr('section-id'));
        });
        $(document).on('click','.arrow-downward',function(){
            var field_id = $(this).parents('.collection-item').attr('field-id');
            $.ajax({
                url : route()+'/field/sort',
                type : 'post',
                data : {field_id : field_id , _token : $('input[name=_token]').val()},
                success : function(res){

                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>