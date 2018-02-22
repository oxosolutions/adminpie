<?php $__env->startSection('content'); ?>
<?php 
// dump($data);
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset API',
	'add_new' => 'All Ticket',
	'route' => 'add.ticket'
);
 ?> 
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/nestable.css')); ?>">
    <style type="text/css">
        /*===============================================
          Nestable
        ================================================= */
        .nestable-lists:before,
        .nestable-lists:after {
          content: " ";
          display: table;
        }
        .nestable-lists:after {
          clear: both;
        }
        .nestable-lists:before,
        .nestable-lists:after {
          content: " ";
          display: table;
        }
        .nestable-lists:after {
          clear: both;
        }
        /*nestable*/
        .dd {
          max-width: 100%;
        }
        /* Item heading */
        .dd-handle {
          display: block;
          height: auto;
          cursor: pointer;
          margin: 7px 0;
          padding: 10px 14px;
          color: #777;
          font-size: 15px;
          font-weight: 600;
          text-decoration: none;
          border-radius: 2px;
          border: 1px solid #ddd;
          background-color: #f2f2f2;
        }
        /* heading hover */
        .dd-handle:hover {
          color: #333;
          background: #ededed;
        }
        .dd-handle:hover + .dd-content {
          border-color: #f9d58b;
        }
        .dd-item > button {
          margin: 7px 0;
        }
        /* item content */
        .dd-content {
          margin-top: -5px;
          padding: 10px;
          border: 1px solid #ddd;
          border-top: 0;
          background: #fafafa;
        }
        .dd-list .dd-list {
          padding-top: 5px;
          padding-bottom: 5px;
        }
        /* heading/content - dragged */
        .dd-empty {
          background: #f8f8f8;
        }
        .dd-item.dd-info > button,
        .dd-item.dd-primary > button {
          color: #FFF;
        }
        .dd-item.dd-primary .dd-handle {
          color: #FFF;
          background-color: #4a89dc !important;
          border-color: #4a89dc !important;
        }
        .dd-item.dd-info .dd-handle {
          color: #FFF;
          background-color: #3bafda !important;
          border-color: #3bafda !important;
        }
            .editor{
            position: absolute;
            top: 0;
            bottom: 0;
            left:0;
            width: 100%;
            border-right: 1px solid #e8e8e8
        }
        /*.preview{
            position: absolute;
            top: 0;
            bottom: 0;
            right:0;
            width: 50%;
        }*/
        .ace_content{
            background: linear-gradient( to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0.05) 50%, rgba(0, 0, 0, 0.05) );
            ba

    </style>
    <div id="error">
      
    </div>
	<div>
		
		<div class="ar wrapper">
            <div class="ac l25 p-10 fbox columns-box" id="origin" >
                <div class="aione-border">
                    <div class="bg-grey bg-lighten-3 p-15 font-size-18 aione-border-bottom">
                        Select Dataset Columns
                    </div>
                    <div class="p-10">
                        <?php $__currentLoopData = $data['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-10 aione-border mb-10 display-inline-block column-click" data-column="<?php echo e($key); ?>" data-alias="<?php echo e($val); ?>" style="cursor: pointer">
                                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($val); ?>">
                                <?php echo e($val); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-10 aione-border mb-10 display-inline-block blank-click" style="cursor: pointer">
                            <input type="hidden" name="blank" value="blank">
                            Blank
                        </div>
                    </div>
                </div>
                        
            </div>
			<div class="ac l75  p-10 pr-10 " >
                <div class="aione-border">
                    <div class="bg-grey bg-lighten-3 p-15 font-size-18 aione-border-bottom">
                        Design API Structure
                    </div>
                    <div class="p-10">
                        <?php if(isset($data['meta_fields'])): ?>
                            <div class="p-10 pr-10 " >
                                <div class="dd mb35" id="nestable">
                                    <ol class="dd-list" id="api-columns">
                                        <?php $__currentLoopData = $data['meta_fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mKey => $mVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($mVal['blank'])): ?>
                                                <li class="dd-item"  data-blank="blank" data-id="<?php echo e($mVal['id']); ?>">
                                            <?php else: ?> 
                                                <li class="dd-item" data-id="<?php echo e($mVal['id']); ?>">
                                            <?php endif; ?>
                                                    <a href="javascript:;"><i class="fa fa-trash removeColumn" style="color:#757575;float:right;cursor:pointer;font-size:18px;padding-left:10px;line-height:42px;width:42px;" data-key="column_4" data-value="Designation"></i></a>
                                                    <div class="dd-handle">
                                                        <?php if(isset($data['columns'][$mVal['id']])): ?>
                                                            <?php echo e($data['columns'][$mVal['id']]); ?>

                                                        <?php else: ?> 
                                                            <?php echo e($mVal['id']); ?>

                                                        <?php endif; ?>
                                                        <span class="text-success pull-right fs11 fw600" style="font-size:10px;"><?php echo e($mVal['id']); ?></span>
                                                    </div>
                                                    <?php if(isset($mVal['children'])): ?>
                                                        <?php $__currentLoopData = $mVal['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nKey => $nValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <ol class="dd-list">
                                                                <li class="dd-item" data-id="<?php echo e($nValue['id']); ?>">
                                                                    <a href="javascript:;"><i class="fa fa-trash removeColumn" style="color:#757575;float:right;cursor:pointer;font-size:18px;padding-left:10px;line-height:42px;width:42px;" data-key="column_2" data-value="Employee Name"></i></a>
                                                                    <div class="dd-handle"> <?php echo e($data['columns'][$nValue['id']]); ?>

                                            
                                                                        <span class="text-success pull-right fs11 fw600" style="font-size:10px;"><?php echo e($nValue['id']); ?></span>
                                                                    </div>
                                        
                                                                </li>
                                                            </ol>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ol>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php echo $__env->make('organization.dataset.api-builder', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>

        				<div>
        					<?php echo Form::submit('Submit',['class'=>'submit-json']); ?>		
        				</div>
                    </div>
                </div>
        				
			</div>
				
			
			
		</div>
	
		
	</div>
	
	<div class="m-10 mb-20 aione-border link">
        <div class="bg-grey bg-lighten-3 p-15 font-size-16 aione-border-bottom">
            Api Link
        </div>
        <div class="p-10">
            <?php if(!empty($data['link'])): ?>
                <a href="<?php echo e($data['link']); ?>"><?php echo e($data['link']); ?></a>
            <?php endif; ?>
        </div>
    		
	</div>
	<div class="ar " >
       
        <div class="ac l100">
            <div class="aione-border">
                <div class="bg-grey bg-lighten-3 p-15 font-size-16 aione-border-bottom">
                    Output ( Pretty )
                </div>
                <div class="p-10" style="position: relative;min-height: 300px;max-height: auto">
                    <pre id="editor" class="editor data-view" >
<?php if(isset($data['res'])): ?>
<?php echo e(json_encode(json_decode($data['res']->content()),JSON_PRETTY_PRINT)); ?>

<?php endif; ?>
<?php if(isset($data['response'])): ?>
<?php echo e(json_encode(json_decode($data['response']->content()),JSON_PRETTY_PRINT)); ?>

<?php endif; ?>        
                    </pre>
                </div>

            </div>
		      
	</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="p-10 tooltip-input" style="position: absolute;display: none">
        <i class="fa fa-close aione-float-right p-5"></i>
        <div id="aione_form_wrapper_70" class="aione-form-wrapper aione-form-theme-light aione-form-label-position- aione-form-style-   ">
            <div id="aione_form_section_97" class="aione-form-section non-repeater">
                <div id="field_email" class="field field-type-email">
                    <input type="text" name="blank_text">
                </div>
            </div>
        </div>
        
        <button type="submit" class="add-blank" style="width: 100%;">Add New</button>
    </div>
    <script src="<?php echo e(asset('js/jquery.nestable.js')); ?>"></script>

	<script type="text/javascript">
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/chrome");
        editor.getSession().setMode("ace/mode/lucene");
        editor.setReadOnly(true);
        $('#nestable').nestable({
                group: 1
        }).on('change', function(e){
           var list = e.length ? e : $(e.target);
           window.data = list.nestable('serialize');
            // var output = list.data('output');
            // console.log(output);
        });

        $('.submit-json').click(function(){
            console.log(window.data);
            $.ajax({
                type: 'POST',
                url: route()+'/dataset/api/'+<?php echo e(request()->id); ?>,
                data: {'data': JSON.stringify(window.data), '_token':'<?php echo e(csrf_token()); ?>' },
                success: function(result){
                    console.log(result.error);
                    $("#error").html("");
                    if(result.error){
                      $("#error").html(result.error);
                    }
                    try{
                        var json = JSON.stringify(JSON.parse(result.response),null,4);
                        // $('.data-view').html(json);
                        editor.setValue(json);
                    }
                    catch(e){
                        console.log('error'); 
                    }
                    
                                    
                    $('.link').html('Api Link :- <a href='+result.link+' >'+ result.link+'</a>');

                }
            });
        });

        /*var updateOutput = function(e) {
            
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };*/

        $('body').on('click','.column-click', function(){
            var html = `
                    <li class="dd-item" data-id="`+$(this).data('column')+`">
                        <a href="javascript:;"><i class="fa fa-trash removeColumn" style="color:#757575;float:right;cursor:pointer;font-size:18px;padding-left:10px;line-height:42px;width:42px;" data-key="`+$(this).data('column')+`" data-value="`+$(this).data('alias')+`"></i></a>
                        <div class="dd-handle">`+$(this).data('alias')+`
                            
                            <span class="text-success pull-right fs11 fw600" style="font-size:10px;">`+$(this).data('column')+`</span>
                        </div>
                        
                    </li>
            `;
            $('#api-columns').append(html); 
            $(this).remove();
        });


        $('body').on('click','.removeColumn',function(e){
            var key = $(this).data('key');
            var value = $(this).data('value');
            
            window.keyValue = {};
            getChildsLi($(this).parent().parent('li'));
            var html = `
                    <div class="p-10 aione-border mb-10 display-inline-block column-click" data-column="`+key+`" data-alias="`+value+`" style="cursor: pointer">
                        <input type="hidden" name="`+key+`" value="`+value+`">
                        `+value+`
                    </div>`;
            $('.columns-box').prepend(html);
            $.each(keyValue, function(key,val){
                 var html = `
                    <div class="p-10 aione-border mb-10 display-inline-block column-click" data-column="`+key+`" data-alias="`+val+`" style="cursor: pointer">
                        <input type="hidden" name="`+key+`" value="`+val+`">
                        `+val+`
                    </div>`;
                $('.columns-box').prepend(html);
            });
            $(this).parent().parent('li').remove();
        });

        function getChildsLi(elem){
            elem.find('li').each(function(){
                if($(this).find('li').length >= 1){
                    window.keyValue[$(this).find('i').data('key')] = $(this).find('i').data('value');
                    getChildsLi($(this));
                }else{
                    window.keyValue[$(this).find('i').data('key')] = $(this).find('i').data('value');
                }
            });
        }

        $('.blank-click').click(function(e){
            e.stopPropagation();
            var left = e.pageX;
            var top = e.pageY;
            $('.tooltip-input').find('input').val('');
            $('.tooltip-input').css({
                'display':'block',
                'left': (left-300)+'px',
                'top': (top)+'px',
                'box-shadow': '0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)',
                'background-color': '#FFF'
            }).show();

             /*var html = `
                    <li class="dd-item" data-id="1">
                        <div class="dd-handle">Click to edit</div>
                    </li>
            `;
            $('#api-columns').append(html); */
        });
        $('.add-blank').click(function(){
            var inputVal = $('input[name=blank_text]').val();
            var replace_space = inputVal.replace(/ /g,"_");
            var html = `
                    <li class="dd-item" data-id="`+replace_space+`" data-blank="blank">
                        <a href="javascript:;"><i class="fa fa-trash removeColumn" style="color:#757575;float:right;cursor:pointer;font-size:18px;padding-left:10px;line-height:42px;width:42px;"></i></a>
                        <div class="dd-handle">`+replace_space+`<span></span></div>
                    </li>
            `;
            $('#api-columns').append(html);
            $('.tooltip-input').hide();
        });
        $('.fa-close').click(function(){
            $('.tooltip-input').hide();
        });



		/*$(".draggable").draggable({ cursor: "crosshair", revert: "invalid"});
			$("#drop").droppable({ accept: ".draggable", 
           	drop: function(event, ui) {
                    console.log("drop");
                   $(this).removeClass("border").removeClass("over");
             var dropped = ui.draggable;
            var droppedOn = $(this);
 			$("#drop draggable ")

            $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);      
             
             
                }, 
          over: function(event, elem) {
                  $(this).addClass("over");
                   console.log("over");
          }
                ,
                  out: function(event, elem) {
                    $(this).removeClass("over");
                  }
                     });
            $("#drop").sortable();

            $("#origin").droppable({ accept: ".draggable", drop: function(event, ui) {
                    console.log("drop");
                   $(this).removeClass("border").removeClass("over");
             var dropped = ui.draggable;
            var droppedOn = $(this);
            $(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);      
             
             
                }});*/
	</script>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>