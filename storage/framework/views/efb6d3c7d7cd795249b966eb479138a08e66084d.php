<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Control Panel',
	'add_new' => ''
);
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('admin.control-panel._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo Form::select('method',get_all_defined_functions(),[],['class'=>'browser-default','placeholder'=>'Select Method']); ?>

        <?php echo FormGenerator::GenerateForm('method_test_params'); ?>

	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <div class="output_test">
        
    </div>
    <div class="aione-border" style="max-height: 400px;overflow-y: auto">
        <div class="bg-grey bg-lighten-4 p-10">
            Number of operations: <i class="total_operations"></i>
            <span class="aione-float-right green ml-20"><span class="font-weight-700">Success : <i class="total_success"></i> </span></span>
            <span class="aione-float-right red "><span class="font-weight-700">Failed : <i class="total_faild"></i> </span></span>
        </div>
        <div class="aione-border p-10">
            <ul class="aione-accordion errors-list">

                
               
            </ul>
        </div>
            
    </div>
        
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type=submit]').click(function(){
            var method = $('select[name=method]').val();
            var params = [];
            $('.function-parameters select').each(function(){
                params.push($(this).val());
            });

            $.ajax({
                type:'POST',
                url: route()+'/method/serve',
                data: {method: method,params:JSON.stringify(params),_token:'<?php echo e(csrf_token()); ?>',operations: JSON.stringify($('.operations').val()),
                        organization: $('.input_on_behalf_of_org').val()
                    },
                success: function(result){
                    $('.errors-list').html('');
                    var length = result.length;
                    console.log(result);
                    var success_count = 0;
                    var failed_count = 0;
                    if(length > 0){
                        for(var i = 0; i < length; i++){
                            if(result.result[i].status == 'success'){
                                var success = '<li class="aione-item mb-10"> <div class="aione-item-header bg-green bg-lighten-5 aione-border border-green"> <div class="display-inline-block"> Success </div> </div> <div class="aione-item-content aione-border-left aione-border-right aione-border-bottom border-green"> <div> <span class="font-weight-700">Parameters :</span> '+result.result[i].params+' </div> <div> <span class="font-weight-700">Output:</span> </div> <div> <pre>'+JSON.stringify(result.result[i].output,null,4)+'</pre> </div> </div></li>';
                                $('.errors-list').append(success);
                                success_count++;
                            }else{
                                var error = '<li class="aione-item mb-10"> <div class="aione-item-header bg-red bg-lighten-5 aione-border border-red"> <div class="display-inline-block"> Error:</div> <div class="display-inline-block ml-20"> '+result.result[i].message +' ('+result.result[i].error+') </div> </div> <div class="aione-item-content aione-border-left aione-border-right aione-border-bottom border-red"> <div> <span class="font-weight-700">Line:</span> '+result.result[i].line+' </div> <div> <span class="font-weight-700">Location :</span> '+result.result[i].file+' </div> <div> <span class="font-weight-700">Message:</span> '+result.result[i].message+'</div> <div> <span class="font-weight-700">Parameters :</span> '+result.result[i].params+' </div> <div> <span class="font-weight-700">status </span> </div> </div></li>';
                                $('.errors-list').append(error);
                                failed_count++;
                            }
                        }
                        $('.total_operations').html(length);
                        $('.total_success').html(success_count);
                        $('.total_faild').html(failed_count);
                    }
                } 
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>