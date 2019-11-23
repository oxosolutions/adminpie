<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Roles',
  'add_new' => '+ Add Role'
); 
?>
  <?php if(!$errors->isEmpty()): ?>
    <script type="text/javascript">
      window.onload = function(){
        $('#add_new_model').modal('open');
      }
    </script>
  <?php endif; ?>
  
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
     
         <?php echo Form::open(['route' => 'role.store', 'files'=>true]); ?>

            
            <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Role','button_title'=>'Save','form'=>'organization_add_role_form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php echo Form::close(); ?>

     
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     
      
   
<script type="text/javascript">
 
  // $(document).on('click','#delete_role',function(){
  //   var role_id = $(this).attr('role-id');
  //   $(this).parents('.options').find('input[name=role_id]').val(role_id);
  //   if(role_id == 1 || role_id == 2 || role_id == 3){
  //     $('#change_role').modal('open');
  //   }

  // });
  $(document).on('click','#delete_role',function(){
    var role_id = $(this).attr('role-id');
    $.ajax({
      url : route()+'/role/delete',
      type : 'POST',
      data : {role_id : role_id , _token : $('.shift_token').val()},
      success : function(res){
        console.log(res);
      }
    });
  });
 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>