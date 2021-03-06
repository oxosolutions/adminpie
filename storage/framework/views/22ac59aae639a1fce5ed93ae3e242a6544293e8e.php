<?php if(Auth::guard('admin')->check() == true): ?>
  <?php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.store.page';
  ?>
<?php else: ?>
  <?php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'store.page';
  ?>
<?php endif; ?>



<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'yes',
'show_navigation' => 'yes',
'page_title' => 'Pages',
'add_new' => '+ Add Page'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="page_token">
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::open(['route'=>$route , 'class'=> 'form-horizontal','method' => 'post']); ?>

  <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Page','button_title'=>'Save','form'=>'add_page_form']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
<script type="text/javascript">
/**
 * @param    {[none]}
 * @uses      {[change stats of page]}
 * @return  {[type]}
 */
 $(document).on('change', '.pageStatus',function(e){
      e.preventDefault();
      var postedData = {};
      postedData['id']        	= $(this).parents('.switch').find('input[name=id]').val();
      postedData['status']      = $(this).prop('checked');
      postedData['_token']      = $('.page_token').val();
      var from = '<?php echo e($from); ?>';
      if(from == 'admin'){
        var url = 'page/status/update'
      }else{
        var  url = 'pages/status/update'
      }
      $.ajax({
        url:route()+'/'+url,
        type:'POST',
        data:postedData,
        success: function(res){
          if(res == 'true'){
          	Materialize.toast('Status Changed', 4000000);
          }
        }
      });
      $('.editable h5 ,.editable p').removeClass('edit-fields');
    });

	$('.add-new').off().click(function(e){
		e.preventDefault();
		$('.add-new-wrapper').toggleClass('active');
		$('.fade-background').fadeToggle(300);
	});
	
	$('.fade-background').click(function(){
		$('.fade-background').fadeToggle(300);
		$('.add-new-wrapper').toggleClass('active');
	});
</script>
<style type="text/css">
   .toast{
        top: 10px;
        left: 80px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>