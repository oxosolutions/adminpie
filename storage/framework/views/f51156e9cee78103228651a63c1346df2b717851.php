<?php $__env->startSection('content'); ?>
	<div id="aione_page_header" class="aione-page-header">
		<div class="row">
			<div class="aione-page-title-container"> 
				<h3 class="aione-page-title">Test Global Functions</h3>
				
				<div class="clear"></div>
			</div> <!-- .aione-page-title-container -->
			
			<div class="clear"></div>
		</div> <!-- .row -->
	</div> <!-- #aione_page_header -->
	<div class="main-content">
	
	<h3 class="settings-title">get_organization_id()</h3>
	<pre  class="settings-meta">
		<?php echo e(get_organization_id()); ?>

	</pre>
	
	<h3 class="settings-title">get_user_id()</h3>
	<pre  class="settings-meta">
		<?php echo e(get_user_id()); ?>

	</pre>
	
	<h3 class="settings-title">get_profile_picture()</h3>
	<pre  class="settings-meta">
		<?php echo e(print_r(get_profile_picture())); ?>

	</pre>
	
	<h3 class="settings-title">delete_user_meta('user_profile_picture')</h3>
	<pre  class="settings-meta">It will delete user meta
	</pre>
	
	<h3 class="settings-title">upload_base_path()</h3>
	<pre  class="settings-meta">
		<?php echo e(upload_base_path()); ?>

	</pre>
	
	<h3 class="settings-title">upload_path()</h3>
	<pre  class="settings-meta">
		<p>upload_path()</p>
		<?php echo e(upload_path()); ?>

		<p>upload_path('user_profile_picture')</p>
		<?php echo e(upload_path('user_profile_picture')); ?>

		<p>upload_path('dataset_import_files')</p>
		<?php echo e(upload_path('dataset_import_files')); ?>

	</pre>
	<h3 class="settings-title">generate_filename()</h3>
	<pre  class="settings-meta">
		<p>generate_filename()</p>
		<?php echo e(generate_filename()); ?>

		<p>generate_filename(40,true)</p>
		<?php echo e(generate_filename(40,true)); ?>

		<p>generate_filename(40,false)</p>
		<?php echo e(generate_filename(40,false)); ?>

		<p>generate_filename(10,true)</p>
		<?php echo e(generate_filename(10,true)); ?>

		<p>generate_filename(10,false)</p>
		<?php echo e(generate_filename(10,false)); ?>

	</pre>
	
		
	</div>
<style type="text/css">
h3{
	margin: 20px 0 0 0;
    color: #03A9F4;
}
pre{
	padding: 20px 0;
    margin: 16px 0;
    border: 1px solid #e8e8e8;
    text-indent: 0px;
    background: #f8f8f8;
}
pre p{
	padding: 0 20px;
    color: #F44336;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>