<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Android Application Changelog',
	'add_new' => 'Download',
	'route' => 'download.android'
); 
	$post_meta = get_global_post_meta('android-application-changelog',true);
	$custom_css = $post_meta['css_code'];
	$custom_js = $post_meta['js_code'];
  
?>	

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.mobile-application.android._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo @get_global_post('android-application-changelog',true)->content; ?>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
	<?php echo $custom_css; ?>

</style>
<script type="text/javascript">
	<?php echo $custom_js; ?>

</script>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>