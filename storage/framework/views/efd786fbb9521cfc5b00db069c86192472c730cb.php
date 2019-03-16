	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>Admin Panel | Admin Pie | OXO Solutions</title>


		
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="<?php echo e(asset('css/ocrm.css')); ?>" rel="stylesheet"  media="screen,projection"/>
	<link rel="stylesheet" href="<?php echo e(asset('css/spectrum.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/simple-iconpicker.min.css')); ?>">
    
	<script src="<?php echo e(asset('assets/js/moment.min.js')); ?>"></script>
    <script  src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="<?php echo e(asset('assets/js/fullcalendar.min.js')); ?>"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
    <script  src="<?php echo e(asset('js/common.js?')); ?><?php echo rand(4524,28282); ?>"></script>

	<script  src="https://www.appelsiini.net/download/jquery.jeditable.js"></script>
	<script  src="<?php echo e(asset('js/spectrum.js')); ?>"></script>
	<script  src="<?php echo e(asset('js/simple-iconpicker.min.js')); ?>"></script>
	<script  src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
	<link rel="stylesheet" href="<?php echo e(asset('bower_components/sweetalert/dist/sweetalert.css')); ?>">

    <script src="<?php echo e(asset('bower_components/sweetalert/dist/sweetalert.min.js')); ?>"></script>

    <script  src="<?php echo e(asset('bower_components/jquery-form-validator/form-validator/jquery.form-validator.js')); ?>"></script>
    <!-- Select 2 -->
	<script  src="<?php echo e(asset('bower_components/select2/dist/js/select2.js')); ?>"></script>

		<!-- OWL Carausel -->
	<link rel="stylesheet" href="<?php echo e(asset('bower_components/owl.carousel/dist/assets/owl.carousel.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('bower_components/owl.carousel/dist/assets/owl.theme.default.min.css')); ?>">
	<script src="<?php echo e(asset('bower_components/owl.carousel/dist/owl.carousel.min.js')); ?>"></script>

	<!-- load emmet code and snippets compiled for browser -->
	<script  src="<?php echo e(asset('bower_components/ace-builds/src-min/ace.js')); ?>"></script>
	<!-- load emmet code and snippets compiled for browser -->
	<script  src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
	<script  src="<?php echo e(asset('bower_components/ace-builds/src-min/ext-emmet.js')); ?>"></script>

	
	<!-- Global stylesheets -->
	<link rel="stylesheet" href="<?php echo e(asset('assets/css/aione.css?ref='.rand(1111,9999))); ?>">


	
	<script >
        function route(){
        	if('<?php echo e(Request::route()->getPrefix()); ?>' != ''){
        		return '<?php echo e(url('/').stripslashes(Request::route()->getPrefix())); ?>';
        	}else{
        		return '<?php echo e(url('/')); ?>';
        	}
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
				        	<script  src="<?php echo e(asset('js/pages/'.$iVal.'.js')); ?>?ref=<?php echo e(rand(8899,9999)); ?>"></script>
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

	
