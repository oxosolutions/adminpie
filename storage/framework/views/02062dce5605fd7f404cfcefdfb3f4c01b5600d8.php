<?php if(Auth::guard('admin')->check() == true): ?>
	<?php
		$layout = 'admin.layouts.main';
	?>
<?php else: ?>
	<?php
		$layout = 'layouts.main';
	?>
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<?php
	$link=$_SERVER['REQUEST_URI']; 
 	$url =explode('/',$link);
	$url = end($url);
		
?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Maps',
	'route' => 'add.map'
);
if(Auth::guard('admin')->check() != true){
	if($url != 'g'){
		$page_title_data['add_new'] = '+ Add Map';
		// $page_title_data['route'] = 'add.map';
	}
}else{
	$page_title_data['add_new'] = '+ Add Map';
}

?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php if(!Auth::guard('admin')->check()): ?>

<?php endif; ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>