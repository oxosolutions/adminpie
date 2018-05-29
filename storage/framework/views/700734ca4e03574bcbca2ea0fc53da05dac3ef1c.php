<?php $__env->startSection('content'); ?>
<?php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Ticket ID <span>'.'114520110'.'</span>',
	'add_new' => '+ Add Feedback',
	'route' => 'add.feedback'
); 

?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="ar">
			<div class="ac l70 m70 s100 ">
				<div class="aione-border p-10">
					<h5 class="aione-border-bottom pb-10 light-blue darken-3"><?php echo e($model->subject); ?></h5>
					<div class="aione-border-bottom pv-10">
						<?php echo $model->description; ?>

					</div>
					<div class="aione-border-bottom pv-10">
                        <?php
                            $attachments = json_decode($model->attachment);
                        ?>
                        <?php if($attachments != null): ?>
                            <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $extension = File::extension($attachment);
                                ?>
        						<div class="aione-border border-orange display-inline-block border-size-4" style="max-height:100px;max-width: 100px ;overflow: hidden">
                                    <?php if(in_array($extension,['jpg','jpeg','png'])): ?>
                                        <img src="<?php echo e(asset(upload_path('support_ticket_attachments'))); ?>/<?php echo e($attachment); ?>" />
                                    <?php endif; ?>
                                    <a href="<?php echo e(asset(upload_path('support_ticket_attachments'))); ?>/<?php echo e($attachment); ?>">Download Attachment <?php echo e($loop->index+1); ?></a>
        						</div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
					</div>
                    <?php echo Form::open(['route'=>['post.ticket',request()->id],'files'=>true]); ?>

    					<div class="aione-border-bottom pv-10">
    						Attachments:-
    						<div class="mb-10">Reply to : <span class="font-weight-600">Sample Customer</span></div>
    						
                            <?php echo Form::textarea('comment',null,['style'=>'max-height: 160px;min-height: 160px;overflow-y: auto']); ?>

                            <?php if($errors->has('comment')): ?>
                                <span style="color: red;">
                                    <?php echo e($errors->first('comment')); ?>                                    
                                </span>
                            <?php endif; ?>
    						<div class="aione-border-bottom aione-border-right aione-border-left p-10 mb-10 border-darken-2">
                                <div class="mb-10">Attachments</div>
                                <?php echo Form::file('attachment[]',['multiple'=>'multiple']); ?>

    						</div>
    						<button class="aione-float-right" type="submit">Post Comment</button>
    						<div class="clear"></div>
    					</div>
                    <?php echo Form::close(); ?>

					<div class="pv-15">
                        
                        
                        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($model->user_id == $comment->user_id): ?>
                                <div class=" ar aione-border mb-20">
                                    <div class="ac l85 p-10 line-height-20 font-weight-400">
                                        <?php echo e($comment->comment); ?>

                                    </div>
                                    <div  class="ac l15 p-10 aione-align-center aione-border-left line-height-24">
                                        <img src="https://www.atomix.com.au/media/2015/06/atomix_user31.png" class="contact-avatar" style="">
                                        sample customer
                                        <span class="aione-align-center mb-5 grey lighten-1 ">10:35pm</span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class=" ar aione-border mb-20">
                                    <div  class="ac l15 p-10 aione-align-center aione-border-right line-height-24">
                                        <img src="http://fuse-angular-material.withinpixels.com/assets/images/avatars/Velazquez.jpg" class="contact-avatar" style="">
                                        Fabrizio Cedrone
                                        <span class="aione-align-center mb-5 grey lighten-1 ">10:35pm</span>
                                    </div>
                                    <div class="ac l85 p-10 line-height-20 font-weight-400">
                                        <?php echo e($comment->comment); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
    						

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


						
						<div class="aione-align-center">
							<a href="">View older conversation</a>
						</div>
					</div>
				</div>	
			</div>
			<div class="ac l30 m70 s100">                
                <?php echo Form::model(@$model,['route'=>['assign.ticket',request()->id]]); ?>

                    <?php if(is_admin()): ?>
        				<?php echo FormGenerator::GenerateForm('edit_support_ticket_form'); ?>

        				<button style="width: 100%">Save</button>
                    <?php endif; ?>
                <?php echo Form::close(); ?>

				<div class="aione-border p-10">
					<h5 class="aione-border-bottom pb-10 light-blue darken-3">Details</h5>
					<div class=" pv-10 line-height-24">
						Created By: <?php echo e(App\Model\Group\GroupUsers::find($model->user_id)->name); ?><br>
						Created date: <?php echo e($model->created_at->diffForHumans()); ?><br>
						Due Date: 12-18-2034<br>
						Status: Finished<br>

					</div>
				</div>
                <?php if(is_admin() || is_employee()): ?>
    				<div class="aione-border p-10">
    					<h5 class="aione-border-bottom pb-10 light-blue darken-3">Actions</h5>
    					<div class="pv-10 line-height-24">
    						<?php echo FormGenerator::GenerateForm('change_status_form'); ?>

    					</div>
    				</div>
                <?php endif; ?>
			</div>
		</div>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<style type="text/css">
			.contact-avatar{
		border-radius: 50%;width: 36px;
	}
	.valign-top{
		vertical-align: top
	}
		</style>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>