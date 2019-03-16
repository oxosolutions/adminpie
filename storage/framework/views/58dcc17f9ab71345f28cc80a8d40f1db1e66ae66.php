	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <?php if(Auth::guard('group')->check()): ?>
        <?php
            $groupData = App\Model\Admin\GlobalGroup::where('id',Auth::guard('group')->user()->group_id)->first();
        ?>
        <title><?php echo e($groupData->name); ?></title>
    <?php elseif(Auth::guard('org')->check()): ?>
        <?php
            $site_title = App\Model\Organization\OrganizationSetting::getSettings('title');
        ?>
        <title><?php echo e($site_title); ?></title>
    <?php endif; ?>

	
	<link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    
    <link rel="stylesheet"  href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.css">
	
	
	

    
	

	
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="<?php echo e(asset('assets/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bower_components/jquery-form-validator/form-validator/jquery.form-validator.js')); ?>"></script>

    <!-- Select 2 -->
	<script  src="<?php echo e(asset('bower_components/select2/dist/js/select2.js')); ?>"></script>

	
    <script src="<?php echo e(asset('assets/js/fullcalendar.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
    
    <script src="<?php echo e(asset('bower_components/sweetalert/dist/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/common.js?')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui.min.js?')); ?>"></script>
    
 
	<script src="https://www.appelsiini.net/download/jquery.jeditable.js"></script>

	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/handsontable.full.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/removeRow/handsontable.removeRow.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/bootstrap/handsontable.bootstrap.css" />
	
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/handsontable.full.min.js"></script>
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/jqueryHandsontable.js"></script>
	<script src="https://cdn.jsdelivr.net/handsontable/0.31.2/plugins/removeRow/handsontable.removeRow.js"></script>

	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo e(asset('js/dropzone.js')); ?>"></script>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
	<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">

	<!-- OWL Carausel -->
	<link rel="stylesheet"  href="<?php echo e(asset('bower_components/owl.carousel/dist/assets/owl.carousel.min.css')); ?>">
	<link rel="stylesheet"  href="<?php echo e(asset('bower_components/owl.carousel/dist/assets/owl.theme.default.min.css')); ?>">
	<script src="<?php echo e(asset('bower_components/owl.carousel/dist/owl.carousel.min.js')); ?>"></script>

	<!-- load emmet code and snippets compiled for browser -->
	<script src="<?php echo e(asset('bower_components/ace-builds/src-min/ace.js')); ?>"></script>
	<!-- load emmet code and snippets compiled for browser -->
	<script src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
	<script src="<?php echo e(asset('bower_components/ace-builds/src-min/ext-emmet.js')); ?>"></script>
	

	<!-- Global stylesheets -->
	<link rel="stylesheet"  href="<?php echo e(asset('assets/css/aione.css?ref='.rand(1111,9999))); ?>">

	
	<script >
        <?php if(Request::route() != null): ?>
            function route(){
                if('<?php echo e(@Request::route()->getPrefix()); ?>' != ''){
                    return '<?php echo e(url('/')."/".@Request::route()->getPrefix()); ?>';
                }else{
                    return '<?php echo e(url('/')); ?>';
                }
            }
        <?php endif; ?>
        
        function csrf(){
            return '<?php echo e(csrf_token()); ?>';
        }
    </script>
    <script >
    	$(function(){
    		try{
    			$('#example').DataTable({
	    			processing: true,
                    dom: "flrtBp",
			      	serverSide: true,
			      	ajax: '<?php echo e(url('/')); ?>/hrm/employee/list',
			      	buttons: [
			                    {
			                        extend: 'excel',
			                        filename: 'Export',
			                        exportOptions: {
			                            columns: ':not(.actions)'
			                        }
			                    }
			                ],
				    columns: [
			            { data: 'user', name: 'user' },
			            { data: 'employee_id', name: 'employee_id' },
			            { data: 'name', name: 'name'},
			            { data: 'department', name: 'department' },
			            { data: 'designation', name: 'designation', searchable: true },
			            { data: 'email', name: 'email', searchable: true },
			            { data: 'created_at', name: 'created_at', searchable: true },
			            { data: 'status', name: 'status', orderable: false, searchable: false, "className": 'actions' },
				    ],
					"oLanguage": {
			            "sLengthMenu": "_MENU_",
			            "sSearch": ""
			        },
			        "aLengthMenu": [
			            [5, 10, 15, 20, 50, -1],
			            [5, 10, 15, 20, 50, "All"] // change per page values here
			        ],
			        search: {
					    "caseInsensitive": false
					},
					responsive: true,
					searchHighlight: true,

			        "iDisplayLength": 10    // set the initial value
	    		});
    		}catch(e){

    		}
    		
    		$('select[name=example_length]').addClass('browser-default');
    		$('input[type=search]').addClass('browser-default');
    	});
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
							<link href="<?php echo e(asset('css/pages/'.$iVal.'.css')); ?>?ref=<?php echo e(rand(8899,9999)); ?>" rel="stylesheet"  >
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    <?php else: ?>
				        <?php echo $__env->make('components.plugins.css.'.$file, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				    <?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
