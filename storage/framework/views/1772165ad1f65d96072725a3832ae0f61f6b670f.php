
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

  <?php if($errors->any()): ?>
    <script type="text/javascript">
      window.onload = function(){
        $('#add_new_model').modal('open');
      }
    </script>
  <?php endif; ?>
  <?php if(@$data): ?>
    <?php $__currentLoopData = @$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php 
        $model = ['name' => $value['name'],'id' => $value['id']];
       ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <script type="text/javascript">
      window.onload = function(){
        $('#modal_edit').modal('open');
      }
    </script>
  <?php endif; ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(@$newData == 'undefined' || @$newData == '' || @$newData == null): ?>
		<?php echo Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>


	<?php endif; ?>
	<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Designation','button_title'=>'Save Designation','section'=>'titlesection']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	 <?php echo Form::close(); ?>

	<?php if(@$model): ?>
		<?php echo Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			<input type="hidden" name="id" value="<?php echo e($data["data"]->id); ?>">
			<a href="#modal_edit" style="display: none" id="modal-edit"></a>
			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit designation','button_title'=>'update Designation','section'=>'titlesection']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	<?php endif; ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(Session::has('success-update')): ?>
    <script type="text/javascript">Materialize.toast('updated Successfully' , 4000)</script>
<?php endif; ?>
<style type="text/css">
  	.modal-footer a{
  		font-size: 13px;
        margin: 8px;
        display: inline-block;
  	}
  	.modal-footer .save{
  		color: white;background-color: #2196f3;
        border-color: #2196f3;
        padding: 8px 12px;
        border-radius: 3px;
        cursor: pointer;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
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