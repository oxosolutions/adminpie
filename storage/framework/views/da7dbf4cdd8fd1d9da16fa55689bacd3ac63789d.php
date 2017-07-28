<?php 
	$ArrayData = App\Model\Organization\Dataset::getDatasetTableData(request()->route()->parameters()['id']);
	$records = $ArrayData['records'];
	$headers = $ArrayData['headers'];
	@$tableheaders->id = 'id';
 ?>

<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset: name of dataset',
	'add_new' => '+ Add Role'
	); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::open(['route'=>['create.column',request()->route()->parameters()['id']]]); ?>

		<div class="row">
			<div class="col s12 m2 l3 aione-field-wrapper">
				 <?php echo Form::text('column_name',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Column Name']); ?>

			</div>
			<div class="col s12 m2 l3 aione-field-wrapper">
				 <?php echo Form::select('after_column',$tableheaders,null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter After Column']); ?>

			</div>
			<div class="col s12 m2 l3">
				<button class="btn blue">Create Column</button>
			</div>
		</div>
	<?php echo Form::close(); ?>

	<div id="example2" style="width: 100%; font-size: 14px;">
		
	</div>
	<a href="javascript:;" class="btn blue save_dataset" style="margin-top: 3%; display: none;">Update Dataset</a> 
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-header white-text  blue darken-1" ">
		<div class="row" style="padding:15px 10px;margin: 0px">
			<div class="col l7 left-align">
				<h5 style="margin:0px">Column Name</h5>	
			</div>
			<div class="col l5 right-align">
				<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
			</div>	
		</div>
	</div>
    <div class="modal-content">
    	<div class="col s12 m2 l12 aione-field-wrapper">
			 <?php echo Form::text('column_name',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Column Name']); ?>

		</div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Save</a>
    </div>
</div>

<?php echo $ArrayData['tableRecords']->render(); ?>

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
	    		changedDataRecords.push(hot2.getData()[changes[0][0]]);
	    		$('.save_dataset').fadeIn(200);
	    	}
	    }
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
	  });
	  //to open modal
	    //$('#modal1').modal('open');
</script>
<style type="text/css">
	.htMenu {
		font-size: 14px !important;
	}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>