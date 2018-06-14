<?php if(Auth::guard('admin')->check() == true): ?>
  <?php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.update.page';
  ?>
<?php else: ?>
  <?php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'update.page';

  ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>

	
	
	
	<?php
	if(empty($page)){
		$title ="no data found";
	}else{
		$title = $page->title;
	}
	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Edit Page <span>'.$title.'</span>',
	    'add_new' => '+ Add Media'
	); 
	?>
	<style type="text/css">
		textarea[name=content] , textarea[name=html_viewer]{
			height: 380px;
		}
		textarea[name=html_viewer]{
			position: absolute;
		}
	</style> 
	<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<?php if(!Session::has('error')): ?>
		<?php echo $__env->make('organization.pages._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="aione-row" style="position: relative;">
            <div class="ac">
                <div class="aione-table">
                    <table class="compact">
                        <tr>
                            <th>Page Title</th>
                            <th>Slug</th>
                            <th>Version</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        <?php $__currentLoopData = $revisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $revision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($revision->title); ?></td>
                                <td><?php echo e($revision->slug); ?></td>
                                <td><?php echo e($revision->version); ?></td>
                                <td><?php echo e($revision->created_at->diffForhumans()); ?></td>
                                <td>
                                    <a href="<?php echo e(route('preview.revisions',$revision->id)); ?>" target="_blank">Preview </a>
                                    |
                                    <a href="<?php echo e(route('restore.page',['id'=>request()->id, 'restore_id'=>$revision->id])); ?>" onclick="return confirm('Are you sure to restore?')">Restore </a>
                                    |
                                    <a href="<?php echo e(route('delete.revision',$revision->id)); ?>" onclick="return confirm('Are you sure to delete this revision?')">Delete </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
<?php endif; ?>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<script type="text/javascript">
			$(document).on('click','.add',function(){
				var tag = $(this).parents('.field-wrapper').prev().find('.input-tag').val();
				$('#input_tag').val('');
				$(this).parents('.field-wrapper').next().append('<span>'+tag+'<i class="fa fa-close"></i></span>');
			})
		</script>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			// $('.html_preview').hide();
			$('input[name=mode]').change(function(){
				if($(this).val() == 'visual'){
					$('.field-wrapper-type-code').hide();
					$('.visual').removeClass('hidden');
				}else{
					$('.field-wrapper-type-code').show();
					$('.visual').addClass('hidden');
				}
			});
		});
	</script>
	
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>