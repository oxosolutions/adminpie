<div id="projects" class="projects list-view">
    <div class="row">
		<div class="col s12 m9 l12 pr-7" >
			
			<div class="list" id="notes">
				
			</div>
		</div>
		<!-- <div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#" class="btn add-new display-form-button">
				Add Note
			</a>
			<div id="add_new_wrapper" class="add-new-wrapper add-form " style="background-color: #ffc;">
				<div class="row no-margin-bottom" id="notes">	  
			    	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			        <input type="text" name="title" placeholder="Title ">
			        <textarea id="textarea1" class="materialize-textarea" style="border: 1px solid rgb(161, 161, 161);"></textarea>
					<div class="col s12 m6 l12 aione-field-wrapper">
						<button class="btn waves-effect blue save-note" type="submit">Save Note
							<i class="material-icons right">save</i>
						</button>
					</div>
				</div>
			</div>
		</div> -->
		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
		
		<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Notes','button_title'=>'Save','class'=>'save-note','section'=>'notsec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	</div>
</div>
<style type="text/css">
	#notes > ul > li .fa-times{
		display:none;
	}
	#notes > ul > li:hover .fa-times{
		display: block;
	}
</style>