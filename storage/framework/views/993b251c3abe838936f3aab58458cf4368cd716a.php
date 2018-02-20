<?php 
	$is_page = 0;
	if(request()->route()->uri == "page/{slug}"){
		$is_page = 1;
	}

	$design_settings = get_design_settings();
	$design_settings = json_decode(json_encode($design_settings),true);
	if(request()->route()->uri == "page/{slug}"){
		$post_slug = request()->route()->parameters();
		$post = get_post($post_slug,false,true);
		$meta = get_post_meta($post_slug,false,true);

		if(@$meta != null && @$meta != ''){
			foreach($meta as $key => $value){
				if(@$design_settings != null && @$design_settings != ''){
					if($value != '' && $value != null){
						$design_settings[$key] = $value;
					}
				}
			}
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('layouts.themes.theme-corporate.includes._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>
	<div id="aione_wrapper" class="aione-wrapper layout-header-top aione-layout-wide aione-theme-corporate">
		<div class="wrapper">
			
			<?php if(@$design_settings['show_header'] == 1): ?>
				<?php echo $__env->make('layouts.themes.theme-corporate.includes._header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>
			<div id="aione_main" class="aione-main fullwidth">
				<div class="wrapper">
					<?php if(@$design_settings['show_slider'] == 1): ?>
						<?php echo $__env->make('layouts.themes.theme-docs.includes._slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
					<?php if(@$design_settings['show_page_title'] == 1): ?>
						<?php echo $__env->make('layouts.themes.theme-docs.includes._pagetitle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
					<div id="aione_content" class="aione-content">
						<div class="wrapper">
							<div id="aione_page_content" class="aione-page-content">
								<div class="wrapper">

									<?php echo $__env->yieldContent('content'); ?>
              						<div class="clear"></div><!-- .clear -->

								</div>
							</div>
						</div><!-- .wrapper -->
					</div><!-- .aione-content -->
					<?php if(@$design_settings['show_footer_widgets'] == 1): ?>
						<?php echo $__env->make('layouts.themes.theme-corporate.includes._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
					<?php if(@$design_settings['show_copyright'] == 1): ?>
						<?php echo $__env->make('layouts.themes.theme-corporate.includes._copyright', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
				</div><!-- .wrapper -->
			</div><!-- .aione-main -->

		</div><!-- .wrapper -->
	</div><!-- .aione-wrapper -->
	<script type="text/javascript">
		<?php echo @$meta['js_code']; ?>

	</script>
	<script type="text/javascript">
		<?php echo @$design_settings['js_code']; ?>

	</script>
	<style type="text/css">
		.aione-footer.dark{
			background-color: #23282d;
		}
		.aione-footer {
		    margin: 0;
		    border-top: none;
		}
		.aione-copyright{
			border-top:none;
		}
	</style>

</body>
</html>