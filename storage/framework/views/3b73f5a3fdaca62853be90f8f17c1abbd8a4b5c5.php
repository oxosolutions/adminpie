<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Collaborate <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
); 
$id = "";
// dump($sections = $survey_data[0]['section']);
?> 
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.survey._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(!empty($error)): ?>

		<div class="aione-message warning">
            <?php echo e(__('survey.survey_not_exit')); ?>

        </div>
	<?php elseif(!@$permission): ?>
		<?php echo e(dump('You don\'t have permission!')); ?>

	<?php else: ?>
		<div class="share-wrapper">
			<div class="share-link">
				<div class="title">
					Share Link
				</div>
				<div class="body-wrapper">
					<div class="link-field">
						<?php echo FormGenerator::GenerateField('shareable_link',['default_value'=>route('embed.survey',$token)]); ?>

					</div>
					<div class="copy-button">
						<button id="copy_button" onclick="copyToClipboard('#input_shareable_link')"> Copy link</button>
					</div>
				</div>
				<div class="clear"></div>
			</div>
            <div class="share-link">
                <div class="title">
                    Embed Code
                </div>
                <div class="body-wrapper">
                    <div class="link-field">
                        <?php
                            $iFrameCode = '<iframe src="'.route('embed.survey',$token).'" width="1024" height="780" scrolling="no"></iframe>';
                        ?>
                        <?php echo FormGenerator::GenerateField('embed_code',['default_value'=>$iFrameCode]); ?>

                    </div>
                    <div class="copy-button">
                        <button id="copy_code_button" onclick="copyToClipboard('#input_embed_code')"> Copy Code</button>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
			<div class="share-user">
				
				<div class="title">
					How would you like to share this survey
				</div>
				<?php echo Form::open(['route'=>['save.shareto',request()->route()->parameters()['id']]]); ?>

				<?php
					$share_type = $survey['formsMeta']->where('key' , 'share_type');
					foreach ($share_type->toArray() as $key => $value) {
						$share_type_value = $value['value'];
					}
				?>
				<div class="body-wrapper">
					<div class="ar share_status" style="margin-bottom: 20px">
						<div class="ac l33">
							<input type="radio" id="only_me" name="group1" <?php echo e((@$share_type_value == 'only_me')?'checked="checked"':''); ?>>
							<label for="only_me">Private</label>
						</div>
						<div class="ac l33">
							<input type="radio" id="public" name="group1" <?php echo e((@$share_type_value == 'public')?'checked="checked"':''); ?>>
							<label for="public">Public</label>
						</div>
						<div class="ac l33">
							<input type="radio" id="specific" name="group1" <?php echo e((@$share_type_value == 'specific')?'checked="checked"':''); ?>>
							<label for="specific">Specific</label>
						</div>
						<input type="hidden" name="survey_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
						
					</div>
					
					<div class="specific_user_field">
						<div class="user-field">
							<?php echo FormGenerator::GenerateField('email_user_share'); ?>

							
						</div>
						<div class="share-button">
							<div><?php echo FormGenerator::GenerateField('user-share-edit-view',['default_value'=>['read_write'=>'Can Read/Write','read_only'=>'Can Read Only']]); ?></div>
							<div><button>Add User</button></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<?php echo Form::close(); ?>

				<div class="list-users">
					<table class="striped">
				        <thead>
							<tr>
								<th>Email</th>
								<th>Rights</th>
								<th>Remove</th>
							</tr>
				        </thead>

				        <tbody>
				        <?php if(!empty($collab)): ?>
							<?php $__currentLoopData = $collab; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($value->email); ?></td>
									<td>
										<?php
											$jsonDecoded = json_decode($value->access,true);
											if(is_array($jsonDecoded)){
												foreach($jsonDecoded as $k => $v){
										?>
												<span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;"><?php echo e(ucfirst($v)); ?></span>
										<?php
												}
											}
										?>
									</td>
									<td><a href="<?php echo e(route('survey.remove.shareto',$value->id)); ?>" style="color: #757575"><i class="material-icons dp48">clear</i></a></td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<style type="text/css">
		.share-wrapper{
			margin-top: 30px
		}
		.share-wrapper button{
			padding: 8px 12px;
		}
		.share-wrapper .share-link,
		.share-wrapper .share-user{
			border:1px solid #e8e8e8;
			padding:15px;
			position: relative;
			margin-bottom: 30px;
		}
		.share-wrapper .share-link .title,
		.share-wrapper .share-user .title{
			background-color: #e8e8e8;
			display: inline-block;
			padding:10px;
			position: absolute;
			top: -17px
		}
		.share-wrapper .share-link .body-wrapper,
		.share-wrapper .share-user .body-wrapper{
			padding: 20px 0px
		}
		.share-wrapper .share-link .body-wrapper .link-field,
		.share-wrapper .share-user .body-wrapper .user-field,
		.share-wrapper .share-link .body-wrapper .copy-button,
		.share-wrapper .share-user .body-wrapper .share-button,
		.share-wrapper .share-user .body-wrapper .share-button >div{
			float: left;
		}
		.share-wrapper .share-link .body-wrapper .link-field,
		.share-wrapper .share-user .body-wrapper .user-field{
			width: 75%;

		}
		.share-wrapper .share-link .body-wrapper .copy-button,
		.share-wrapper .share-user .body-wrapper .share-button{
			width: 25%;
		}
		.share-wrapper .share-user .body-wrapper .share-button >div{
			margin-left: 10px;
			width: 45%
		}
		.share-wrapper .share-user .list-users table thead{
			background-color: #454545;
			color: white
		}

	</style>
	<script type="text/javascript">
		document.getElementById("copy_button").addEventListener("click", function() {
            copyToClipboard(document.getElementById("input_shareable_link"));
           
        });
        document.getElementById("copy_code_button").addEventListener("click", function() {
		    copyToClipboard(document.getElementById("input_embed_code"));
		   
		});
		function copyToClipboard(elem) {
			var targetId = "_hiddenCopyText_";
		    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
		    var origSelectionStart, origSelectionEnd;
		    if (isInput) {
		        // can just use the original source element for the selection and copy
		        target = elem;
		        origSelectionStart = elem.selectionStart;
		        origSelectionEnd = elem.selectionEnd;
		    } else {
		        // must use a temporary form element for the selection and copy
		        target = document.getElementById(targetId);
		        if (!target) {
		            var target = document.createElement("textarea");
		            target.style.position = "absolute";
		            target.style.left = "-9999px";
		            target.style.top = "0";
		            target.id = targetId;
		            document.body.appendChild(target);
		        }
		        target.textContent = elem.textContent;
		    }
		    // select the content
		    var currentFocus = document.activeElement;
		    target.focus();
		    target.setSelectionRange(0, target.value.length);
		    
		    // copy the selection
		    var succeed;
		    try {
		    	  succeed = document.execCommand("copy");
		    } catch(e) {
		        succeed = false;
		    }
		    // restore original focus
		    if (currentFocus && typeof currentFocus.focus === "function") {
		        currentFocus.focus();
		    }
		    
		    if (isInput) {
		        // restore prior selection
		        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
		    } else {
		        // clear temporary content
		        target.textContent = "";
		    }
		    return succeed;
		}
		$(document).ready(function(){
			
			$('.specific_user_field , .list-users').hide();
				if($('.share_status').find('#specific').attr('checked')){
					$('.specific_user_field , .list-users').show();
				}
			$('body').on('change','.share_status input[type= radio]',function(){
				var share_status = $(this).attr('id');
				var survey_id = $('input[name=survey_id]').val();

					if(share_status == 'specific'){
						$('.specific_user_field , .list-users').show();
					}else{
						$('.specific_user_field , .list-users').hide();
					}

					$.ajax({
						url : route()+'/change/survey/status',
						type: 'get',
						data : {share_status : share_status , survey_id : survey_id },
						success : function(res){
							console.log(res);
							if(res.trim() == "Success"){
								Materialize.toast('Saved',4000);
							}else{
								Materialize.toast('Something went wrong',4000);
							}
						}
					});
			});
		});
	</script>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>