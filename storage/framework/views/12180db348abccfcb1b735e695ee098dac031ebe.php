<?php 
	$model = new App\Http\Controllers\Organization\visualization\VisualisationController(new \Illuminate\Http\Request);
    $request = new \Illuminate\Http\Request();
    // $request->replace(['id'=>'21']);
 ?>

<?php echo $__env->make('organization.widgets.includes.widget-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
        
		

        

         <!-- Real Code -->


		
    
    

<?php echo $__env->make('organization.widgets.includes.widget-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>-