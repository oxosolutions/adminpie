<?php 
	$ArrayData = App\Model\Organization\Dataset::getDatasetTableData(request()->route()->parameters()['id']);
    if($ArrayData != false){
        $records = $ArrayData['records'];
        $headers = $ArrayData['headers'];
        $lastCount = count($headers);
        unset($headers[$lastCount-1]);
        unset($headers[$lastCount-2]);
        
        $newArray = [];

        foreach($records as $rKey => $rValue){
            $lastCount = count($rValue);
            unset($rValue[$lastCount-1]);
            unset($rValue[$lastCount-2]);
            $newArray[] = $rValue;
        }
        $records = $newArray;
        if(empty($records)){
            $tempArray = [];
            $index = 0;
            foreach($headers as $header){
                if($index == 0){
                    $tempArray[] = $ArrayData['firstRecord']+1;
                }else{
                    $tempArray[] = "";
                }
                $index++;
            }
            $records[] = $tempArray;
        }
        @$tableheaders->id = 'id';
    }
 ?>

<?php $__env->startSection('content'); ?>

<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Edit <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if($ArrayData != false): ?>
        <div class="ar  mb-20">
            <div class="ac l50 m50 s100">
                <?php echo Form::model($dataset,['route'=>['update.dataset.details',$dataset->id]]); ?>

                    <?php echo FormGenerator::GenerateForm('edit_dataset_form'); ?>

                <?php echo Form::close(); ?>       
            </div>
            <div class="ac l50 m50 s100">
                <?php echo Form::open(['route'=>['create.column',request()->route()->parameters()['id']]]); ?>

        
                    <?php echo FormGenerator::GenerateForm('create_column_dataset'); ?>

                
                <?php echo Form::close(); ?>         
            </div>
        </div>
        
    
    <div id="example2" style="width: 100%; font-size: 14px;">
        
    </div>  
    <?php echo $ArrayData['tableRecords']->render(); ?>

    <a href="javascript:;" class="btn blue save_dataset" style="margin-top: 3%; display: none;">Update Dataset</a> 
<script type="text/javascript">
    window.changedDataRecords = [];
    var
        hiddenData = <?php echo json_encode($records); ?>,
        container = document.getElementById('example2'),
        hot2;

      hot2 = new Handsontable(container, {
        data: hiddenData,
        colHeaders: true,
        contextMenu: true,
        rowHeaders: true,
        modifyColWidth: 1000,
        manualColumnResize: true,
        manualRowResize: true,
        colHeaders: <?php echo json_encode($headers); ?>,
        // columns: [{readOnly: true}],
        minSpareRows: 1,
        contextMenu: ['row_above','row_below','---------','col_right','---------','remove_row','remove_row','---------','undo','redo','---------','make_read_only','alignment'],
        afterChange: function(changes, source){
            if(source == 'edit'){
                //console.log(changes[0]);
                var tableData = hot2.getData();
                if(tableData[changes[0][0]][0] == null){
                    var newId = tableData[changes[0][0]-1][0];
                    hot2.setDataAtCell(changes[0][0], 0, parseInt(newId)+1);
                }
                var status = false;
                var record = $.grep(changedDataRecords,function(value,key){
                    if(value[0] == hot2.getData()[changes[0][0]][0]){
                        status = true; 
                        changedDataRecords[key] = hot2.getData()[changes[0][0]];                
                    }
                });
                if(status == false){
                    changedDataRecords.push(hot2.getData()[changes[0][0]]);
                }
                //console.log(changedDataRecords);
                $('.save_dataset').fadeIn(200);
            }
        }
        /*afterCreateRow: function(index,amount){
            console.log(index);
        }*/
      });

      hot2.updateSettings({
        afterCreateCol: function(index, amount){
            // console.log(hot2.getColHeader(index))
            $('#modal1').modal('open');
            console.log(index);
        }
      });

      hot2.updateSettings({
            cells: function(row, col, prop){
                var cellProperties = {};
                if(col == 0){
                    cellProperties.readOnly = true;
                }
                return cellProperties;
            }
      });
      $(document).ready(function(){
   
        $('.modal').modal();
        $('.save_dataset').click(function(){
            $.ajax({
                type:'POST',
                url: '<?php echo e(url('dataset/update')); ?>/<?php echo e(request()->route()->parameters()['id']); ?>',
                data: { '_token': '<?php echo e(csrf_token()); ?>','records': changedDataRecords },
                success: function(result){
                    $('.save_dataset').fadeOut(200);
                }
            });
        });
        // $('#field_3091')
      });
      $('.handson-table-button > li > a').click(function(e){
        e.preventDefault();
        $(this).parent().toggleClass('active');
        $(this).parent().siblings().removeClass('active');
      });
      //to open modal
        //$('#modal1').modal('open');

</script>



    <style type="text/css">
        #field_3091,#field_3092, #field_3093, #field_3094, #field_3095,#field_3096{
            display: none;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#field_3090 input').click(function(){
                if($(this).val() == 'static_value'){
                    $('#field_3091').show();
                    $('#field_3092, #field_3093, #field_3094, #field_3095, #field_3096').hide();
                }else if($(this).val() == 'value_with_refrence'){
                    $('#field_3091, #field_3096').hide();
                    $('#field_3092, #field_3093, #field_3094, #field_3095').show();
                }else if($(this).val() == 'formula'){
                    $('#field_3096').show();
                    $('#field_3092, #field_3093, #field_3094, #field_3095').hide();
                }
            });

            // dataset/columns
            $('#field_3093 select').change(function(){
                $.ajax({
                    type:'GET',
                    url: route()+'/dataset/columns',
                    data: {dataset:$(this).val()},
                    success: function(result){
                        $('#field_3094 select').html(result);
                        $('#field_3095 select').html(result);
                    }
                });
            });
        });
    </script>

    <?php else: ?>
        <div class="aione-message warning">
            <i class="fa fa-info-circle" style="font-size: 20px;"></i> Dataset table not found!
        </div>
    <?php endif; ?>


	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>