<?php 
				$id = Request::fullUrl();
				$array = explode('/', $id);
				end($array);
				$key = key($array);
				unset($array[$key]);
				$url = implode('/',$array);
			 ?>
<div id="<?php echo e($data['modal_id']); ?>" class="modal modal-fixed-footer">
	<div class="modal-header white-text  blue darken-1" ">
		<div class="row" style="padding:15px 10px">
			<div class="col l7 left-align">
				<h5 style="margin:0px"><?php echo e(@$data['heading']); ?></h5>	
			</div>
			<div class="col l5 right-align">
				<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
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
	})
	function close(){
		alert('hello');
	}

</script>