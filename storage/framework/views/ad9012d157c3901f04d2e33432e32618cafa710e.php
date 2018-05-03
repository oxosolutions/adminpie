<?php 

	// if(@$settings != null){
	// 	$login_theme = @$settings->where('key' , 'login_theme')->first();
	// 	$login_style = @$settings->where('key' , 'login_style')->first();
	// 	$Site_title = @$settings->where('key' , 'title')->first();
	// 	$Site_tagline = @$settings->where('key' , 'tagline')->first();
	// 	$bg_image = @$settings->where('key' , 'bg_image')->first();
	// 	$login_footer_content = @$settings->where('key' , 'login_footer_content')->first();
	// 	$login_theme = get_organization_meta('login_theme');
	// }

$login_theme = get_organization_meta('login_theme');
$login_style = get_organization_meta('login_style');
$Site_title = get_organization_meta('title');
$Site_tagline = get_organization_meta('tagline');
$bg_image = get_organization_meta('bg_image');
$login_footer_content = get_organization_meta('login_footer_content');
$login_theme = get_organization_meta('login_theme');

 ?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title><?php echo e(@$Site_title); ?></title>

	<!-- Global stylesheets --> 
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/login.css?ref='.rand(544,44))); ?>">
	

	<?php if(@$bg_image): ?>	
		<style type="text/css">
			.login-background, .login-theme-darlic .login-background{
				background: url( <?php echo e(asset($bg_image)); ?> );
			}
		</style>
	<?php endif; ?>
	
</head>
<body>
	<div id="aione_wrapper" class="aione-wrapper aione-layout-wide no-header no-sidebar login-theme-<?php echo e(@$login_theme); ?> login-style-<?php echo e(@$login_style); ?> 11">
		<div class="aione-row">
			<div id="aione_main" class="aione-main">
				<div class="aione-row">
					<div id="aione_content" class="aione-content">
						<div class="aione-row">
							<div class="login-background">
							</div>
							<div class="login-wrapper" >
								<div class="aione-row" >
									<div class="login-desc">
										<div class="" style="padding: 30px;">
                                            <div class="login-site-title">

                                            	Welcome to <?php echo e(@$Site_title); ?>


                                            </div>
                                            <div class="site-description">
                                            	<?php echo e(@$Site_tagline); ?>

                                            </div>
                                        </div>
									</div>
									<div class="login-form">
										<?php echo $__env->make('common.auth-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
										<?php echo $__env->yieldContent('content'); ?>	
									</div>
								</div>
							</div>
							<div class="login-footer" >
								<div class="aione-row" >
									<?php echo @$login_footer_content; ?>

								</div> 
							</div>
						</div><!-- .aione-row -->
					</div><!-- #aione_content -->
					<div class="clear"></div><!-- .clear -->
				</div><!-- .aione-row -->
			</div><!-- #aione_main -->
			<div class="clear"></div><!-- .clear -->
		</div><!-- .aione-row -->
	</div><!-- #aione_wrapper -->

</body>
</html>


