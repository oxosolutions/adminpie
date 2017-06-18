	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title> AdminPie</title>

	<!-- Global stylesheets -->
	
    
   
	<link href="<?php echo e(asset('assets/css/materialize.min.css')); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="<?php echo e(asset('assets/css/materialize.clockpicker.css')); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo e(asset('css/ocrm.css?ref='.rand(544,44))); ?>" type="text/css" rel="stylesheet"  media="screen,projection"/>
    <link href="<?php echo e(asset('assets/css/fullcalendar.min.css')); ?>" rel='stylesheet' />
	<link href="<?php echo e(asset('assets/css/fullcalendar.print.min.css')); ?>" rel='stylesheet' media='print' />
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('bower_components/sweetalert/dist/sweetalert.css')); ?>">
    
	<script src="<?php echo e(asset('assets/js/moment.min.js')); ?>"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="<?php echo e(asset('assets/js/fullcalendar.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/materialize.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/materialize.clockpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/sweetalert/dist/sweetalert.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/common.js?')); ?>?ref=<?php echo e(rand(8899,9999)); ?>"></script>
   
    
	<script type="text/javascript" src="http://www.appelsiini.net/download/jquery.jeditable.js"></script>
	
	<script type="text/javascript">
        function route(){
            return '<?php echo e(url('/')."/".Request::route()->getPrefix()); ?>';
        }

        function csrf(){

            return '<?php echo e(csrf_token()); ?>';
        }

    </script>
	<?php if(@$plugins): ?>
	    <?php $__currentLoopData = @$plugins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    	<?php if($key == 'js'): ?>
	    		<?php $__currentLoopData = @$plugin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ikey => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				    <?php if(is_array($file) && $ikey == 'custom'): ?>
						<?php $__currentLoopData = @$file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iKey => $iVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				        	<script type="text/javascript" src="<?php echo e(asset('js/pages/'.$iVal.'.js')); ?>?ref=<?php echo e(rand(8899,9999)); ?>"></script>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    <?php else: ?>
				        <?php echo $__env->make('components.plugins.js.'.$file, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				    <?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php elseif($key == 'css'): ?>
				<?php $__currentLoopData = @$plugin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				    <?php if(is_array($file) && $key == 'custom'): ?>
						<?php $__currentLoopData = @$file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iKey => $iVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<link href="<?php echo e(asset('css/pages/'.$iVal.'.css')); ?>?ref=<?php echo e(rand(8899,9999)); ?>" rel="stylesheet" type="text/css" >
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    <?php else: ?>
				        <?php echo $__env->make('components.plugins.css.'.$file, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				    <?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

	
