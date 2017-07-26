<?php $__env->startSection('content'); ?>
	<?php 
	$page_title_data = array(
	  'show_page_title' => 'yes',
	  'show_add_new_button' => 'no',
	  'show_navigation' => 'yes',
	  'page_title' => 'Modules Style',
	  'add_new' => ''
	); 
	 ?>
	<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<ul class="collapsible" data-collapsible="accordion">
			    <li>
			      	<div class="collapsible-header">Name of module</div>
			      	<div class="collapsible-body">
			      		<div class="row">
			      			<div class="col l6">
			      				<textarea></textarea>
			      			</div>
			      			<div class="col l6">
			      				<textarea></textarea>
			      			</div>
			      			<div class="col l6">
			      				colorpicker
			      			</div>
			      			<div class="col l6">
			      				iconpicker
			      			</div>
			      		</div>
			      	</div>
			    </li>
			    <li>
			      	<div class="collapsible-header">Name of module</div>
			      	<div class="collapsible-body">
			      		<div class="row">
			      			<div class="col l6">
			      				<div style="margin-left: 5px">
			      					Write Javascript code here
			      				</div>
			      				<div id="editor-js" style="height: 200px;margin: 5px 10px">
									
								</div>
			      			</div>
			      			<div class="col l6">
			      				<div style="margin-left: 5px">
			      					Write css code here
			      				</div>
			      				<div id="editor-css" style="height: 200px;margin: 5px 10px">
									
								</div>
			      			</div>
			      			<div class="col l6">
			      				colorpicker
			      			</div>
			      			<div class="col l6">
			      				iconpicker
			      			</div>
			      		</div>
			      	</div>
			    </li>
			    <li>
			      	<div class="collapsible-header">Name of module</div>
			      	<div class="collapsible-body">
			      		<div class="row">
			      			<div class="col l6">
			      				<textarea></textarea>
			      			</div>
			      			<div class="col l6">
			      				<textarea></textarea>
			      			</div>
			      			<div class="col l6">
			      				colorpicker
			      			</div>
			      			<div class="col l6">
			      				iconpicker
			      			</div>
			      		</div>
			      	</div>
			    </li>
			   
		  	</ul>
		<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
		var editorJs = ace.edit("editor-js");
		editorJs.setTheme("ace/theme/monokai");
		editorJs.getSession().setMode("ace/mode/javascript");
		var editorCss = ace.edit("editor-css");
		editorCss.setTheme("ace/theme/monokai");
		editorCss.getSession().setMode("ace/mode/javascript");
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>