<?php $__env->startSection('content'); ?>
<?php 
	// $isEmployee = App\Model\Organization\Employee::where('user_id' , $model->id)->first();
	$id = get_user_id();

 ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' =>  __('organization/profile.profile_picture_page_title_text'),
	'add_new' => ''
); 
 ?>
<style type="text/css">
	button.my-btn:hover{
		background-color: #757575;
		color: white
	}
</style>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('organization.my-profile._profile_tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="ar">
			<div class="ac l30 m30 s100">
				<div>
	          		<img class="aione-border border-grey-lighten-4 p-10" src="<?php echo e(asset(@get_profile_picture($id,'medium'))); ?>" >
	        	</div>
	         	<div class="ac s100 m33 l100  bg-red darken-1 aione-align-center p-0">
	            	<a class="white p-14 display-block" href="<?php echo e(route('profile.picture.delete',$id)); ?>"><?php echo e(__('organization/profile.remove_image')); ?></a>
	         	</div>
			</div>
			<div class="ac l70 m70 s100  ">
				<div class="aione-border  aione-align-center" style="min-height: 350px;max-height: 350px">
					<div class="aione-border-bottom">
						<h5 class="line-height-30"><?php echo e(__('organization/profile.change_profile_picture')); ?></h5>
					</div>
					<?php echo Form::open(['route'=>'profile.picture' , 'class'=> 'form-horizontal','method' => 'post', 'files' => true,'id'=>'form1']); ?>

						<div class="abc ph-100 pt-100" >
						   	<input type="hidden" name="user_id" value="<?php echo e($id); ?>">
							<input style="" type="file" name="aione-dp" class="image_file_input">
							<input style="" type="submit" name="submit" value="<?php echo e(__('organization/profile.add_profile_picture')); ?>" class="submit display-none">
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
		</div>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
		$(document).on('click','.my-btn',function() {
			$('input[name=aione-dp]').click();
		})
		$(".image_file_input").change(function() {
			$('.submit').click();
		})	
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>