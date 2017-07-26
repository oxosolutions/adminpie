<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Notes',
    'add_new' => '+ Add Notes'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.notes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<script type="text/javascript">
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
	.materialize-textarea:focus{
		border-bottom: 1px solid #a1a1a1 !important;
	}
	 #notes ul,li{
	  list-style:none;
	}
	 #notes  ul{
	  overflow:hidden;
	 
	}
	 #notes  ul li a{
	  text-decoration:none;
	  color:#000;
	  background:#ffc;
	  display:block;
	  height:10em;
	  width:15.97em;
	  padding:1em;
	  -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
	  -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
	  box-shadow: 5px 5px 7px rgba(33,33,33,.7);
	  -moz-transition:-moz-transform .15s linear;
	  -o-transition:-o-transform .15s linear;
	  -webkit-transition:-webkit-transform .15s linear;
	}
	 #notes  ul li{
	  margin:10px;
	  float:left;
	}
	 #notes  ul li h2{
	  font-size:140%;
	  font-weight:bold;
	  padding-bottom:10px;
	}
	h2{
		margin: 0px !important
	}

</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>