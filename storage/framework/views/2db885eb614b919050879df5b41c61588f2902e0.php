<?php $__env->startSection('content'); ?>
<?php if(@$history != null): ?>
	
<?php endif; ?>
<style type="text/css">

	.handson-table-button{
		margin-bottom: 10px;
		height: 36px
	}
	.handson-table-button > li > a{
		    line-height: 28px;
    border: 1px solid #CCCCCC;
    color: #282828;
    display: inline-block;
    padding: 0 16px;
    border-radius: 3px;
    background-color: #f9f9f9;
    font-size: 16px;
	}
	.handson-table-button > li > a > i{
		 vertical-align: bottom;
   		 line-height: 28px;
   		  color: #282828;
   		  font-size: 16px
	}
	
	.handson-table-button > li > a:hover{
		border-color: #999
	}
	.handson-table-button > li{
		float: left;
		    margin-right: 8px;
	}
	.handson-table-button > li > .aione-options{
		display: none;
		    height: 147px;
    width: 160px;
    border: 1px solid #e8e8e8;
    position: absolute;
    z-index: 999999;
    background-color: white;
        box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12),0 3px 1px -2px rgba(0,0,0,.2);
	}
	.handson-table-button > li.active > .aione-options{
		display: block;
	}
	.table-wrapper{
		width: 100%;overflow-x: scroll;overflow-y: scroll;max-height: 500px;margin-bottom: 20px
	}
/*	td{
		    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 150px;
    overflow: hidden;
	}*/
	.custom-option-menu{
		    width: 300px;
    position: absolute;
    right: 0;
    top: -60px;
    border-bottom: none !important;
	}
	.aione-nav.horizontal > ul > li > .export:hover{
		background-color:#0277bd;

	}
	.aione-nav.horizontal > ul > li > .clone:hover{
		background-color:#00acc1;

	}
</style>
<?php

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => __('organization/datasets.dataset_view_page_title_text').'<span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	);
    if($dataset_type != null && $dataset_type == 'continues'){
        $page_title_data['add_new'] = 'Refresh List';
        $page_title_data['route'] = ['refresh.dataset',request()->id];
    }
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(!empty($dataset)): ?>
        <div style="position: relative;">
        <nav id="aione_nav" class="aione-nav horizontal light custom-option-menu">
            <div class="aione-nav-background"></div>
            <ul id="aione_menu" class="aione-menu custom-aione-menu">
                
            
            </ul>
            <div class="aione-nav-toggle">
                <a href="#" class="nav-toggle "></a>
            </div>
            <div class="clear"></div>
        </nav>
        <div id="example2" style="width: 100%; font-size: 14px;">
            
        </div>
        <a href="javascript:;" class="btn blue save_dataset" style="margin-top: 3%; display: none;"><?php echo e(__('organization/datasets.update_dataset')); ?></a> 


        
        <div class="aione-table" >
        <div class="aione-float-right">
            
            

        </div>
        
        
        

        <?php if(@request()->route()->parameters['action'] == 'rivisions'): ?>
            <?php

                $headers = (array) $tableheaders;

                $history_data = (array) $history->toArray();

                array_unshift($history_data, $headers);

                $history_records = array();
                foreach ($history_data as $column_key => $columns) {
                    foreach ($columns as $row => $record) {
                        $history_records[$row][$column_key] = $record;
                    }
                    unset($history_records['id']);
                    unset($history_records['status']);
                    unset($history_records['parent']);
                }

            ?>

            <div class="aione-table" style="margin-bottom: 20px">

                <table class="compact dataset-table" >
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $history_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key == 0): ?>
                                    <th> Column </th>
                                <?php else: ?>
                                    <th> Revision_<?php echo e($key); ?> </th>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $history_records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_key => $column_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                    <td>
                                        <?php echo e($column_value); ?>

                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    
        <?php if(@request()->route()->parameters['action'] == 'view'): ?>
            <div class="aione-table" style="margin-bottom: 20px">
                <table class="compact">
                    <thead>
                        <tr>
                            <td><?php echo e(__('organization/datasets.key')); ?></td>
                            <td><?php echo e(__('organization/datasets.value')); ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tableheaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!in_array($k,['id','status','parent'])): ?>
                                <tr>
                                    <td width="400px"><?php echo e($rows); ?></td>
                                    <td><?php echo e($viewrecords->{$k}); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if(@request()->route()->parameters['action'] == 'edit'): ?>
            <form action="<?php echo e(route('dataset.update')); ?>" method="POST" class="aione-table">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="dataset_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
                <table class="compact">
                    <thead>
                        <tr>
                            <td><?php echo e(__('organization/datasets.key')); ?></td>
                            <td><?php echo e(__('organization/datasets.value')); ?></td>
                        </tr>
                    </thead>
                    <tbody>
                            
                        <?php $__currentLoopData = $tableheaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!in_array($k,['id','status','parent'])): ?>
                                <tr>
                                    <td width="400px"><?php echo e($rows); ?></td>
                                    <td>
                                        <div id="field_<?php echo e($k); ?>" class="field-wrapper field-wrapper-<?php echo e($k); ?> field-wrapper-type-text ">
                                            <div id="field_<?php echo e($k); ?>" class="field field-type-text" style="padding: 0">
                                                <input type="text" value="<?php echo e($viewrecords->{$k}); ?>" name="<?php echo e($k); ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <input type="hidden" value="<?php echo e($viewrecords->{$k}); ?>" name="<?php echo e($k); ?>" />
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
                <input type="submit" name="update_data" value="<?php echo e(__('organization/datasets.update_record')); ?>" />
            </form>
        <?php endif; ?>
        <div>
            <table class="compact">
                <thead class="hidden header-row">
                    <tr>
                        <td><?php echo e(__('organization/datasets.key')); ?></td>
                        <td><?php echo e(__('organization/datasets.value')); ?></td>
                    </tr>
                </thead>
                <tbody class="addNewDatasetRow">
                    
                </tbody>

            </table>
                    <button class="AddNewDatasetRowButton hidden " ><?php echo e(__('organization/datasets.update_dataset')); ?></button>

        </div>
        <button class="addRow aione-button aione-float-right mv-10" ><?php echo e(__('organization/datasets.add_row')); ?></button>
        <?php if(!empty($tableheaders)): ?>
            <div class="mv-10 line-height-32"><?php echo e(__('organization/datasets.view_dataset_pagination_text',['count'=>$records->firstItem(),'last'=>$records->lastItem(),'total'=>$records->total()])); ?></div>
            <div style="" class="table-wrapper">
                <table class="compact dataset-table" >
                    <thead>
                        <tr>
                            <th>
                                <?php echo e(__('organization/datasets.action')); ?>

                            </th>
                            <?php $__currentLoopData = $tableheaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!in_array($k,['id','status','parent'])): ?>
                                    <th>
                                        <?php echo e($header); ?>

                                    </th>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($records)): ?>
                            <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('view.dataset',['id'=>$dataset->id,'action'=>'view','record_id'=>$rows->id])); ?>"><i class="fa fa-eye"></i></a>
                                        <a href="<?php echo e(route('view.dataset',['id'=>$dataset->id,'action'=>'edit','record_id'=>$rows->id])); ?>"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo e(route('delete.record',['id'=>$dataset->id,'record_id'=>$rows->id])); ?>" class="delete-row"><i class="fa fa-trash " style="color: red"></i></a>
                                        <a href="<?php echo e(route('view.dataset',['id'=>$dataset->id,'action'=>'rivisions','record_id'=>$rows->id])); ?>"><i class="fa fa-history"></i></a>
                                         <script type="text/javascript">
                                                $(document).on('click','.delete-row',function(e){
                                                    e.preventDefault();
                                                    var href = $(this).attr("href");

                                                    swal({   
                                                        title: "<?php echo e(__('organization/datasets.delete_row_swal_title')); ?>",   
                                                        text: "<?php echo e(__('organization/datasets.delete_row_swal_text')); ?>",   
                                                        type: "warning",   
                                                        showCancelButton: true,   
                                                        confirmButtonColor: "#DD6B55",   
                                                        confirmButtonText: "<?php echo e(__('organization/datasets.delete_row_swal_confirm_button_text')); ?>",   
                                                        closeOnConfirm: false 
                                                    }, 
                                                    function(){
                                                    window.location = href;
                                                       swal("<?php echo e(__('organization/datasets.deleted')); ?>", "<?php echo e(__('organization/datasets.success_text')); ?>", "<?php echo e(__('organization/datasets.success')); ?>"); 
                                                   });
                                                })
                                            </script>
                                    </td>
                                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!in_array($key,['id','status','parent'])): ?>
                                            <td class="aione-tooltip" title="<?php echo e($value); ?>">
                                                <span class="truncate">
                                                    <?php echo e($value); ?>  
                                                </span>
                                                
                                            </td>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div>
                <button class="update-dataset hidden"><?php echo e(__('organization/datasets.update_dataset')); ?></button>
            </div>
        <?php endif; ?>

        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="hidden" name="dataset_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
    </div>
    <?php echo e($records->render()); ?>

    <?php else: ?>
        <div class="aione-message warning">
            <i class="fa fa-info-circle" style="font-size: 20px;"></i><?php echo e(__('organization/datasets.dataset_table_not_found')); ?> 
        </div>
    <?php endif; ?>

<style type="text/css">
	.pagination li{
		padding-left: 5px;
		padding-right: 8px;
		padding-bottom: 10px;
	}
	.hidden{
		display: none
	}
	/*.custom-aione-menu{
		    float: right;
    position: absolute;
    right: 0;
    margin-top: -64px !important;
    margin-right: 20px !important;
	}*/
</style>
<script type="text/javascript">
	$(document).ready(function(){
		// $(document).on('click' , '.addRow' ,function(){
		// 	var headerCount = $('.dataset-table tr th').length;
		// 	$('.dataset-table tbody').prepend('<tr class="appended_row"></tr>');

		// 	for(var i=0; i <=headerCount-1 ; i++){
		// 		$('.appended_row:first').append('<td contenteditable="true"></td>');
		// 	}
		// 	$('.update-dataset').show();
		// 	$('.appended_row td:first').removeAttr('contenteditable');
		// });
		$(document).on('click' , '.addRow' ,function(){
			var th = [];
            var column = [];
			var countTh = $('.dataset-table').find('th').length;
			$.each($('.dataset-table').find('th'),function(value){
			th.push($(this).html());
			});
			th = th.slice(1);
            $(th).each(function(key , value){
                column.push(value.trim());
            });
			$(column).each(function(key , value){

                if(value != 'Revision_1' && value != 'Action'){
                        $('.addNewDatasetRow').append('<tr><td width="400px" class="label">'+value+'</td><td><input type="text" class="add-new-value" /></td></tr>');
                    }
            });
                $('.addRow').hide();
                $('.AddNewDatasetRowButton').show();
                $('.header-row').show();
		});

		$(document).on('click','.AddNewDatasetRowButton',function(){
			var data = [];
			$.each($(this).siblings('table').find('tr'),function(){
				if($(this).find('.label').html() != undefined || $(this).find('.add-new-value').val() != undefined){
					// console.log($(this).find('.label').html());
					data.push($(this).find('.add-new-value').val());
				}
			});

			$.ajax({
					url 	: route()+'/dataset/create/rows',
					type 	: "POST",
					data 	: { data : data , _token : $('input[name=_token]').val() , dataset_id : $('input[name=dataset_id]').val()},
					success : function(res){
						Materialize.toast('<?php echo e(__('organization/datasets.update_successfully')); ?>',4000);
						window.location.reload();
					}
				});
		// alert('rahul sir is working on dataset controller i will do this later -- sandeep');
		});
		$(document).on('click','.update-dataset',function(){
			var index = 0;
			var data = [];
			
				$('.update-dataset').parent().siblings('.table-wrapper').find('.appended_row').each(function($i){
					var tableRow = [];
					$(this).find('td').each(function(){
						tableRow.push($(this).html());
					});
					data.push( tableRow);
				});
			$.ajax({
					url 	: route()+'/dataset/create/rows',
					type 	: "POST",
					data 	: { data : data , _token : $('input[name=_token]').val() , dataset_id : $('input[name=dataset_id]').val()},
					success : function(res){
						Materialize.toast('<?php echo e(__('organization/datasets.update_successfully')); ?>',4000);
					}
				});
			// alert('rahul sir is working on dataset controller i will do this later -- sandeep');
		});		
	});
</script>
</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>