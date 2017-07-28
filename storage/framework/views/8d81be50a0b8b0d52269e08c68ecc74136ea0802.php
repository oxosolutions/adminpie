
<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Designations',
	'add_new' => '+ Add Designation'
); 
	$id = "";
	 ?>	

		<?php if(@$data): ?>
			<?php $__currentLoopData = @$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php 
					$newData = $v->name;
					$id = $v->id;
				 ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
				<script type="text/javascript">
				$(window).load(function(){
					document.getElementById('modal-edit').click();
				});
			</script>
		<?php endif; ?>
		<?php 
			@$model = ['name' => @$newData];
			
	 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(@$newData == 'undefined' || @$newData == '' || @$newData == null): ?>
		<?php echo Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>


	<?php endif; ?>
	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add designation','button_title'=>'Save Designation','section'=>'titlesection']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	 <?php echo Form::close(); ?>

	<?php if(@$model): ?>
		<?php echo Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			<input type="hidden" name="id" value="<?php echo e($id); ?>">
			<a href="#modal_edit" style="display: none" id="modal-edit"></a>
			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit designation','button_title'=>'update Designation','section'=>'titlesection']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	<?php endif; ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<a href="#" class="btn sign-in"></a>
	<?php echo $__env->make('common.confirm-alert',['message'=>'My Message','sub_message'=>'You clicked the button!...'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Modal Trigger -->
  <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
  	<div class="modal-header" style="padding: 15px;border-bottom: 1px solid #e8e8e8">
  		<h5 style="display: inline-block;">Heading Area</h5>
  		<i class="material-icons dp32" style="float: right">clear</i>
  	</div>
    <div class="modal-content scrollbar" id="style-2">
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
    </div>
    <div class="modal-footer">
    	<a href=""  >Cancel</a>
      	<a href="#!" class="save" >Save Changes</a>
    </div>
  </div>
  <script type="text/javascript">
  	 $(document).ready(function(){
	    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
	    $('.modal').modal();
	  });
         
  </script>
  <style type="text/css">
  	.modal-footer a{
  		font-size: 13px;margin: 8px;display: inline-block;
  	}
  	.modal-footer .save{
  		color: white;background-color: #2196f3;border-color: #2196f3;    padding: 8px 12px;    border-radius: 3px;    cursor: pointer;    font-weight: 400;    text-align: center;vertical-align: middle;
  	}
  	.modal{
  		    overflow-y: hidden;
  		    border-radius: 4px;
  	}
  	.modal-header i{
  		color: #a9a9a9;
  		cursor: pointer;
  	}
  	.modal-header i:hover{
  		color:#676767;
  	}
  

	#style-2::-webkit-scrollbar-thumb
	{
		border-radius: 5px;
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: #dcdcdc;
	}

  </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>