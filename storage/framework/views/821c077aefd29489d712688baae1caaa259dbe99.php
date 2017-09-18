
<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Dashboard',
	'add_new' => '+ Add Dashboard'
	); 
 ?>
<style type="text/css">
	.aione-widgets{
		position: relative;
		display: block;
	}
	.aione-widgets .aione-widget{
		float: left;
	    width: 23%;
	    min-height: 160px;
	    padding: 0;
	    margin: 0 2% 2% 0;
	    position: relative;
	    color: #666666;
	}
	/*
	.aione-widgets .aione-widget:before{
		content: "";
		display: block;
		padding-top: 100%; 	
	}
	*/
	.aione-widgets:after {
		content:"";
		display: block;
		width: 100%;
		height: 1px;
		clear: both; 
	}
	.aione-widgets .aione-widget .aione-widget-background{
		position: absolute;
		top:0;
		right: 0;
		bottom: 0;
		left: 0;
	}
	.aione-widgets .aione-widget .aione-overlay:before{
		content:"";
		position: absolute;
		top:0;
		right: 0;
		bottom: 0;
		left: 0;
		
	}
	.aione-overlay.light-1:before{ background-color: rgba(255,255,255,0.1); }
	.aione-overlay.light-2:before{ background-color: rgba(255,255,255,0.2); }
	.aione-overlay.light-3:before{ background-color: rgba(255,255,255,0.3); }
	.aione-overlay.light-4:before{ background-color: rgba(255,255,255,0.4); }
	.aione-overlay.light-5:before{ background-color: rgba(255,255,255,0.5); }
	.aione-overlay.light-6:before{ background-color: rgba(255,255,255,0.6); }
	.aione-overlay.light-7:before{ background-color: rgba(255,255,255,0.7); }
	.aione-overlay.light-8:before{ background-color: rgba(255,255,255,0.8); }
	.aione-overlay.light-9:before{ background-color: rgba(255,255,255,0.9); }
	.aione-overlay.light-10:before{ background-color: rgba(255,255,255,1); }

	.aione-overlay.dark-1:before{ background-color: rgba(0,0,0,0.1); }
	.aione-overlay.dark-2:before{ background-color: rgba(0,0,0,0.2); }
	.aione-overlay.dark-3:before{ background-color: rgba(0,0,0,0.3); }
	.aione-overlay.dark-4:before{ background-color: rgba(0,0,0,0.4); }
	.aione-overlay.dark-5:before{ background-color: rgba(0,0,0,0.5); }
	.aione-overlay.dark-6:before{ background-color: rgba(0,0,0,0.6); }
	.aione-overlay.dark-7:before{ background-color: rgba(0,0,0,0.7); }
	.aione-overlay.dark-8:before{ background-color: rgba(0,0,0,0.8); }
	.aione-overlay.dark-9:before{ background-color: rgba(0,0,0,0.9); }
	.aione-overlay.dark-10:before{ background-color: rgba(0,0,0,1); }

	.aione-widgets .aione-widget .aione-widget-header{
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-handle{
		float: left;
		opacity: 0;
		width: 30px;
	    height: 30px;
	    line-height: 30px;
	    z-index: 9;
	    position: relative;
		-webkit-transition: all 300ms ease-in-out;
	    -moz-transition: all 300ms ease-in-out;
	    -o-transition: all 300ms ease-in-out;
	    transition: all 300ms ease-in-out;
	}
	.aione-widgets .aione-widget:hover .aione-widget-header .aione-widget-handle{
		opacity: 1;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-handle .aione-icon{
	    cursor: move;
	    line-height: 30px;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-title{
		float: left;
		display:none;
	}
	.aione-widgets .aione-widget.hide-title .aione-widget-header .aione-widget-title{
		display:none;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions{
		float: right;
		opacity: 0;
		-webkit-transition: all 300ms ease-in-out;
	    -moz-transition: all 300ms ease-in-out;
	    -o-transition: all 300ms ease-in-out;
	    transition: all 300ms ease-in-out;
	}
	.aione-widgets .aione-widget:hover .aione-widget-header .aione-widget-actions{
		opacity: 1;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn{
		position: relative;
	    right: auto;
	    bottom: auto;
	    padding: 0;
	    margin: 0;

	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn .btn-floating {
	    width: 30px;
	    height: 30px;
	    line-height: 30px;
	    background-color: transparent;
	    box-shadow: none;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.active .btn-floating {
		background-color: #F44336;
	    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12), 0 3px 1px -2px rgba(0,0,0,.2);
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn .aione-actions-handle .aione-icon{
	    color: #F44336;
	    font-size: 30px;
	    line-height: 30px;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.active .aione-actions-handle .aione-icon{
		color:#ffffff;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn .btn-floating .aione-icon{
		font-size: 24px;
		line-height: 30px;
	}

	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.horizontal ul {
	    text-align: right;
	    right: 34px;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.horizontal ul li {
	    margin:0;
	}
	/*
	.aione-widgets .aione-widget .aione-widget-content {
	    position: absolute;
	    top: 0;
	    right: 0;
	    bottom: 0;
	    left: 0;
	}
	*/
	.aione-widgets .aione-widget .aione-widget-footer{
		display:none;
	}
	.aione-widgets .aione-widget .aione-widget-content .aione-widget-error{
	    color: #F44336;
	    text-align: center;
	    height: 100%;
	    font-size: 16px;
	    line-height: 1.3;
	    padding: 20px 10px;
	}
	.aione-widgets .aione-widget .aione-widget-title{
		color: #F44336;
	    text-align: center;
	    height: 30px;
	    font-size: 17px;
	    line-height: 30px;
	    padding: 0 30px;
	    margin: 0;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    overflow: hidden;
	    border-bottom: 1px solid #e8e8e8;
	}
	.aione-widget-content-wrapper{
		padding: 12px;
	}
	#aione_widget_add_new .field{
		margin-bottom: 0;
	}
	#aione_widget_add_new .aione-button{
		margin: 0;
		padding: 0 20px;
	}
	.dashboard-actions.fixed-action-btn.horizontal{
	    right: 10px;
	    bottom: auto;
	    top: 47px;
	    padding: 0;
	    margin: 0;
	}
	.dashboard-actions.fixed-action-btn.horizontal ul{
	    right: 44px;
	}
	.dashboard-actions.fixed-action-btn.horizontal ul li {
	    margin: 0 10px 0 0;
	}

	.aione-flip {
		width: 100%;
	    height: 160px;
	    position: relative;
	    margin: 0;
	    -webkit-perspective: 800;
	    -moz-perspective: 800;
	    perspective: 800;
	}
	.aione-flip.flipped .aione-card {
	    -webkit-transform: rotatey(-180deg);
	       -moz-transform: rotatey(-180deg);
	            transform: rotatey(-180deg);
	}
	.aione-flip .aione-card{
	    width: 100%;
	    height: 100%;
	    -webkit-transform-style: preserve-3d;
	       -moz-transform-style: preserve-3d;
	            transform-style: preserve-3d;
	    -webkit-transition: 0.5s;
	       -moz-transition: 0.5s;
	            transition: 0.5s;
	}
	.aione-flip .aione-card .aione-card-face {
	    width: 100%;
	    height: 100%;
	    position: absolute;
	    z-index: 2;
	    cursor: pointer;
	    -webkit-backface-visibility: hidden ;
	       -moz-backface-visibility: hidden ;
	            backface-visibility: hidden ;
	}
	.aione-flip .aione-card .aione-card-face.front {
	    z-index: 1;
	}
	.aione-flip .aione-card .aione-card-face.back {
	    -webkit-transform: rotatey(-180deg);
	       -moz-transform: rotatey(-180deg);
	            transform: rotatey(-180deg);
	}

	.aione-hero-text {
	    display: block;
	    text-align: center;
	    font-size: 80px;
	    font-weight: 400;
	    line-height: 1.3;
	    color: #168dc5;
	}

	.aione-recent-items{
		margin: 0 10px;
	}
	.aione-recent-items li{
		padding: 4px 10px;
	    display: block;
	}
	.aione-recent-items li:nth-child(even){
		background-color: #f2f2f2; 
	}
	.aione-recent-items li:last-child{
		border-bottom: none;
	}
	.aione-recent-items li .item-action{
		display: block;
		float: right;
	}
	.aione-shadow{
		box-shadow: 1px 1px 8px rgba(0,0,0,0.15);
	}
</style>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.dashboard._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="aione-dashboard">
	
	<div class="aione-dashboard-welcome-message">
		<?php 
			$admin_dashboard_welcome_message = App\Model\Organization\OrganizationSetting::getSettings('admin_dashboard_welcome_message');
		 ?>

		<?php echo $admin_dashboard_welcome_message; ?>

		
	</div>
    <div class="aione-widgets">
    	<?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget_key => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    		<?php 
				$widget_id = $widget['id'];
				$widget_key = $widget['slug'];
				$widget_title = $widget['title'];
			 ?>

	    	<div id="aione_widget_<?php echo e($widget_key); ?>" class="aione-widget aione-widget-<?php echo e($widget_key); ?> aione-widget-id-<?php echo e($widget_id); ?>">
	    		<div class="aione-widget-header">
	    			<div class="aione-widget-handle"><a class="aione-widget-drag aione-tooltip" title="Sort Widget"><i class="aione-icon material-icons">menu</i></a></div>
	    			<div class="aione-widget-title"><?php echo e($widget_title); ?></div>
	    			<div class="aione-widget-actions">
	    			<input type="hidden" name="slug" value="<?php echo e(request()->route()->parameters()['id']); ?>">
	    			<input type="hidden" name="widget_id" value="<?php echo e($widget_id); ?>">
	    			<input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
	    				<div class="fixed-action-btn horizontal click-to-toggle">
							<a class="btn-floating aione-actions-handle">
								<i class="aione-icon material-icons">more_horiz</i>
							</a>
							<ul> 
								<li><a class="btn-floating red aione-widget-delete aione-tooltip aione-delete-confirmation" href="#" title="Delete Widget"><i class="aione-icon material-icons">close</i></a></li>
								<!--
								<li><a class="btn-floating yellow darken-1 aione-widget-collapse  aione-tooltip"  title="Minimize Widget"><i class="aione-icon material-icons">launch</i></a></li>
								<li><a class="btn-floating blue"  title="XYZ Widget"><i class="aione-icon material-icons  aione-tooltip">attach_file</i></a></li>
								-->
							</ul>
						</div>
	    			</div>
	    		</div>
	    		<?php if(View::exists('organization.widgets.'.$widget_key)): ?>
    				<?php echo $__env->make('organization.widgets.'.$widget_key, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    			<?php else: ?> 
    				<div class="aione-widget-error">
    					<?php echo e(__('messages.widget_view_misssing')); ?>

    				</div>
    			<?php endif; ?>
	    	</div> <!-- .aione-widget -->

    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    	<?php if(!empty($listWidgets)): ?>
    	<div id="aione_widget_add_new" class="aione-widget aione-widget-add-new">
    		<div class="aione-widget-content aione-shadow">
				<div class="aione-widget-title">Add New Widget</div>
	    		<div class="aione-widget-content-wrapper">
	    		<?php echo e(Form::open(['method' => 'post' , 'route' => 'update.dashboard.widget' ])); ?>

	    			<?php echo csrf_field(); ?>

	    			<input type="hidden" name="slug" value="<?php echo e(@Request()->route()->parameters()['id']); ?>" class="slug-parameter">
	    			<div class="field select field-type-select">
						<?php echo Form::select('widget[]',@$listWidgets,null,["class"=>"no-margin-bottom aione-field browser-default" , 'placeholder'=> 'Select Widget','field_placeholder']); ?>

						<span class="error-red"></span>
					</div>
					<button class="aione-button" type="submit" name="action">Add</button>
				<?php echo e(Form::close()); ?>

				</div>
			</div>
    	</div> <!-- .aione-widget -->
    	<?php endif; ?>

    </div> <!-- .aione-widgets -->
</div> <!-- .aione-dashboard -->

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if($current_dashboard != null): ?>
		<?php 
		$model_data = [];
		$current_data = $dashboards[$current_dashboard];
		$model_data['title'] = $current_data['title'];
		$model_data['description'] = $current_data['description'];
		 ?>
		<?php echo Form::model($model_data ,['route' => 'update.edit.dashboard' ,'method' => 'POST']); ?>

			<input type="hidden" name="old_slug" value="<?php echo e($current_data['slug']); ?>">
			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'edit-dashboard','heading'=>'Edit Dashboard','button_title'=>'Save Data','section'=>'edit_dashboard']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	<?php endif; ?>
<script type="text/javascript">

	$(document).ready(function() {

		/*****************************************************
		/*  Header Right Menu Toggles
		/*****************************************************/
		$( ".aione-flip" ).click(function() {
		  $(this).toggleClass('flipped')
		});	

	});

	$(document).on('click','.edit-dashboard',function(){
	 	
	 	var tabSlug = $('.slug-parameter').val();
	 	$.ajax({
	      		url : route()+'edit/dashboards',
	      		type : "POST",
	      		data : {
	      			slug : tabSlug,
	      			_token : $("#token").val()
	      		},
	      		success : function (res) {
	      			if(res == 'true'){
	      			}
	      			 $('#edit-dashboard').modal('open');
	      			 $('#edit-dashboard').find('input[name=title]').val(res.title);
	      			 $('#edit-dashboard').find('textarea[name=description]').val(res.description);
	      			 $('#edit-dashboard').find('input[name=slug]').val(res.slug);
	      			console.log(res);
	      		}
	      	});
	 });
	  $(document).on('click','#edit-dashboard button[type=submit]',function(){

	 	var updated_data = {title : $('#edit-dashboard input[name=title]').val(),
							 	description : $('#edit-dashboard textarea[name=description]').val(),
							 	slug : $('#edit-dashboard input[name=slug]').val(),
							 	old_slug : $('.slug-parameter').val()
							 }
	 	
	 	$.ajax({
	      		url : route()+'update/dashboards',
	      		type : "POST",
	      		data : {
	      			data : updated_data,
	      			_token : $("#token").val()
	      		},
	      		success : function (res) {
	    			// window.location.href=route()+"dashboard";
	      			
	      		}
	      	});
	 });
</script> 

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>