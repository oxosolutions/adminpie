<?php 
	$id = Request::fullUrl();
	$array = explode('/', $id);
	end($array);
	$key = key($array);
	unset($array[$key]);
	$url = implode('/',$array);
 ?>
<div id="<?php echo e($data['modal_id']); ?>" class="modal modal-fixed-footer" style="overflow-y: hidden;">
	<div class="modal-header">
		<h5><?php echo e(@$data['heading']); ?></h5>	
		<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
	</div>
	<div class="modal-content">
		<?php if(isset($data['section'])): ?>
			<?php echo FormGenerator::GenerateSection($data['section'],['type'=>'inset'],'','admin'); ?>

		<?php endif; ?>
		<?php if(isset($data['form'])): ?>
			<?php echo FormGenerator::GenerateForm($data['form'],['type'=>'inset'],'','admin'); ?>

		<?php endif; ?>
		<?php if(isset($data['group'])): ?>
			<?php echo FormGenerator::GenerateGroup($data['group'],['type'=>'inset'],'','admin'); ?>

		<?php endif; ?>
	</div>
	<div class="modal-footer">
		<button class=" <?php echo e(@$data['class']); ?>" type="submit" name="action"><?php echo e(@$data['button_title']); ?>

		</button>
	</div>	
</div>
<style type="text/css">
	.modal-content > div{
		margin-bottom: 50px
	}
</style>
<script type="text/javascript">

	$(document).ready(function(){
		$('#<?php echo e($data['modal_id']); ?>').modal({
			 dismissible: true
		});
		$('.close-model-button').click(function(){
			$("#<?php echo e($data['modal_id']); ?>").modal('close');
		});
		
		$('#modal_edit #closemodal').click(function(){
			var array = [];
			$.each(window.location.href.split('/'),function (index, val) {
				array.push(val);
			});
			var new_route = array.slice(0,-1);
				// var last_val = array[array.length - 1];
				// console.log(typeof(last_val));
				window.location.replace(new_route.join('/'));
		});
		$(document).on('click','#add_designation_button',function(){
			$('.modal').find('input').val("");
			$('.modal').find('textbox').val("");
			$('.error-red').hide();
		});
	});
	function close(){
		alert('hello');
	}

</script>