<div id="<?php echo e($data['modal_id']); ?>" class="modal modal-fixed-footer">
	<div class="modal-header white-text  blue darken-1" ">
		<div class="row" style="padding:15px 10px">
			<div class="col l7 left-align">
				<h5 style="margin:0px"><?php echo e(@$data['heading']); ?></h5>	
			</div>
			<div class="col l5 right-align">
				<a href="javascript:;" class="closeDialog white-text" ><i class="fa fa-close"></i></a>
			</div>
				
		</div>
		
	</div>
	<div class="modal-content" style="padding: 30px;">
		<?php if(isset($data['section'])): ?>
			<?php echo FormGenerator::GenerateSection($data['section'],['type'=>'inset']); ?>

		<?php endif; ?>
		<?php if(isset($data['group'])): ?>
			<?php echo FormGenerator::GenerateGroup($data['group'],['type'=>'inset']); ?>

		<?php endif; ?>
	</div>
	<div class="modal-footer">
		<button class="btn blue" type="submit" name="action"><?php echo e(@$data['button_title']); ?>

		</button>
	</div>	
</div>
<script type="text/javascript">

	$(document).ready(function(){
 			$('#<?php echo e($data['modal_id']); ?>').modal(); 
	 })
</script>