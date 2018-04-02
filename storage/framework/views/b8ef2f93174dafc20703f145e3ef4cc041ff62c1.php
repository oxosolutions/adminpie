<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Internal Server Error</title>
	<meta name="keywords" content="AdminPie,404, page not found">
	<meta name="description" content="AdminPie 404 page not found">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
   	<!-- Main CSS
   	================================================== -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/aione.css?ref='.rand(1111,9999))); ?>">


	<!-- Google web font
   ================================================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	
<style type="text/css">
abbr,address,article,aside,audio,b,blockquote,body,canvas,caption,cite,code,dd,del,details,dfn,div,dl,dt,em,fieldset,figcaption,figure,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,html,i,iframe,img,ins,kbd,label,legend,li,mark,menu,nav,object,ol,p,pre,q,samp,section,small,span,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,ul,var,video {
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: 0 0;
}

body {
    line-height: 1;
	background:#f2f2f2;
	
}

* {
    box-sizing: border-box;
}

html {
   
    font-size: 16px;
    font-family: 'Open Sans',sans-serif;
    color: #757575;
}
.aione-error-title{
	font-size: 30px;
	line-height: 2;
}
.aione-error-desc{
	line-height: 1.5
}
.aione-wrapper{
	padding: 10%
}
.error-content{
	display: none;
}
</style>
	
</head>
<body>
<div id="aione_wrapper" class="aione-wrapper">
	
	<div class="ar">
		<div class="ac l60 error-detail-wrapper">
			<div class="aione-error-title">
				Something went wrong!
			</div>
			<div class="aione-error-desc">
				You have experienced Internal Server Error. This might happen due to many reasons. You should try again.
			</div>
			<div style="padding: 30px 0">
				<button onclick="window.location.href='<?php echo e(url()->previous()); ?>'"><i class="fa fa-arrow-left" style="margin-right: 16px"></i>Go Back	</button>
				<button class="show-details" style="background-color: transparent;border: 1px solid;color: #454545">View Error Details</button>
			</div>
			<div>
				
					

			</div>
		</div>
		<div class="ac l40">
			<img src="<?php echo e(asset('assets/images/robot-msg-error.png')); ?>" width="300">
			
			
		</div>
	</div>

	<div class="ar" style="background-color: white">
		<div class="error-header" style="border-bottom: 3px solid #DF8220">
			<p style="font-weight: 300;padding: 20px"><span style="color:#0073AA;font-weight: 500">Error: </span><code style="font-size: 14px"><?php echo e($exception->getMessage()); ?></code></p>

		</div>
		<div class="error-content" style="padding: 20px">
			<code>ERROR CODE : [ <?php echo e($exception->getCode()); ?> ]</code><br>
			<?php 

				$filePath = explode('/',$exception->getFile());
				$count = count($filePath);
			 ?>
			<code>ERROR LOCATION : [ <?php echo e($filePath[$count-3].'/'.$filePath[$count-2].'/'.$filePath[$count-1]); ?> on <b>line: <?php echo e($exception->getLine()); ?></b> ]</code>

		</div>
		
		<?php $__currentLoopData = $exception->getTrace(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<div class="error-content" style="padding: 15px; border-top:1px solid #CCC; ">
				<?php 
					$class = explode('\\',@$trace['class']);
					$class = $class[count($class)-1];
					$file = explode('/',@$trace['file']);
					$file = $file[count($file)-1];
				 ?>
				<code>at <span style="color: red; font-weight: 100;"><?php echo e($class); ?>-><b><?php echo e($trace['function']); ?></b></span>()</code><br>
				
				<code>in <b><?php echo e(@$file); ?></b> (line <?php echo e(@$trace['line']); ?>)</code>

			</div>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
	</div>
	





    	
   
	
</div>
<script type="text/javascript">
	$(document).ready(function() {
		
		$('.show-details').click(function(){
			console.log('abc');	
			$('.error-content').slideToggle();
		})
	})
</script>

</body>
</html>