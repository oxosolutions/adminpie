<?php
    $from = 'admin';
    $layout = 'admin.layouts.main';
    $route = 'admin.update.page';
?>




<?php $__env->startSection('content'); ?>
	<style type="text/css">
		.page-widgets > .boxed{
			border:1px solid #e8e8e8;
			margin-bottom: 15px;
		}
		.page-widgets > .boxed > .header{
			background-color: #e8e8e8;
			padding:10px;
		}
		.page-widgets > .boxed > .header > i{
			float: right;
			color: #757575
		}
		.page-widgets > .boxed > .content{
			padding: 10px
		} 
		.page-widgets > .boxed > .content > .tags > span{
			background-color: #e8e8e8;
			padding: 5px;
			color:#676767;
			border-radius: 2px;
			display: inline-block;
			margin: 0 5px 5px 0;
		}
		.page-widgets > .boxed > .content > .tags > span > i{
			margin-left: 5px
		}
	</style>
	
	<?php
	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Edit Page',
	    'add_new' => '+ Add Media'
	); 
	?>
	<style type="text/css">
		textarea[name=content] , textarea[name=html_viewer]{
			height: 380px;
		}
		textarea[name=html_viewer]{
			position: absolute;
		}
	</style> 
	<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(!Session::has('error')): ?>
		<?php echo $__env->make('admin.pages._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::model($page,['route' => $route , 'method' => 'post']); ?>

			<div class="aione-row" style="position: relative;">
				<div style="position: absolute;right: 0;top: -60px">
					

					<a href="<?php echo e(route('admin.page.view' ,$page->id )); ?>" class="aione-button aione-button-small aione-button-light aione-button-square add-new-button" style="line-height: 40px">Preview</a>
					<button type="submit" style="display: inline-block;line-height: 18px;margin-left: 10px">Update</button>
				</div>
				<div class="l6" style="width: 75%;float: left;padding-right:15px ">
					

					<?php echo FormGenerator::GenerateForm('edit_page_form'); ?>

				</div>
				<div class="l6 page-widgets" style="width: 25%;float: left">
					<input type="hidden" name="id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
					
					
				
					
					
					<?php echo FormGenerator::GenerateForm('page_options_form'); ?>

					
				</div>
			</div>
			<button type="submit">Save</button>
		<?php echo Form::close(); ?>

	<?php endif; ?>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<script type="text/javascript">
			$(document).on('click','#input_add',function(){
				var tag = $(this).parents('.field-wrapper').prev().find('.input-tag').val();
				$('#input_tag').val('');
				$(this).parents('.field-wrapper').next().append('<span>'+tag+'<i class="fa fa-close"></i></span>');
			})
		</script>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			// $('.html_preview').hide();
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>