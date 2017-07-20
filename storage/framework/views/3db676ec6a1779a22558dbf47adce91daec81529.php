<?php $__env->startSection('content'); ?>
	<div class="card" style="margin-top: 0px;padding: 14px;">
		<?php echo Form::open(['route'=>'upload.dataset','files'=>true]); ?>

		<div class="row no-margin-bottom">
							
			<div class="row mb-10">
				<div class="col l3" style="line-height: 30px">
					Dataset Name
				</div>
				<div class="col l9">
					
					 <?php echo Form::text('datasetName',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']); ?>

				</div>
			</div>
			<div class="row mb-10">
				<div class="col l3" style="line-height: 30px">
					Import Source
				</div>
				<div class="col l9">
					<div class="col l12">

						
						<?php echo Form::radio('import_source','file',true,['id' => 'test1' ]); ?>


				    	<label for="test1">File Upload</label>    
					</div>
					<div class="col l12">
						
						<?php echo Form::radio('import_source','url',false,['id' => 'test2' ]); ?>


				     	<label for="test2">URL</label>
					</div>
					<div class="col l12">
						
						<?php echo Form::radio('import_source','file_on_server',false,['id' => 'test3' ]); ?>

				    	<label for="test3">File on server</label>    
					</div>
					<div class="col l12">
						
						<?php echo Form::radio('import_source','import_from_survey',false,['id' => 'test4' ]); ?>

				     	<label for="test4">Import from survey</label>
					</div>
				</div>
			</div>
			<div class="row mb-10 box file">
				<div class="col l3" style="line-height: 30px">
					Select CSV / XLSX / SQL File
				</div>
				<div class="col l9">
					<div class="file-field input-field" style="margin-top: 0px">
						<div class="btn">
							<span>File</span>
							<?php echo Form::file('file'); ?>

						</div>
						<div class="file-path-wrapper">
							
							<?php echo Form::text('path',null,['class' => 'file-path validate' ]); ?>

						</div>
					</div>
				</div>
			</div>
			<div class="row mb-10 box url">
				<div class="col l3" style="line-height: 30px">
					Enter File URL
				</div>
				<div class="col l9">
					
					<?php echo Form::text('url',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']); ?>

				</div>
			</div>
			<div class="row mb-10 box file_on_server">
				<div class="col l3" style="line-height: 30px">
					Enter File Path
				</div>
				<div class="col l9">
					
					<?php echo Form::text('file_path',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']); ?>

				</div>
			</div>
			<div class="row mb-10 box import_from_survey">
				<div class="col l3" style="line-height: 30px">
					Import from survey
				</div>
				<div class="col l9">
					<?php echo Form::select('survey',['Option 1','Option 2','Option 3'],null,['placeholder'=>'Select Survey']); ?>

				</div>
			</div>
			<div class="row mb-10 box2">
				<div class="col l3" style="line-height: 30px">
					Add, Replace or Append?
				</div>
				<div class="col l9">
					<select class="action_type" name="add_replace">
						<option value="new">Add New</option>
						<option value="append">Append</option>
						<option value="replace">Replace</option>
				    </select>
				</div>
			</div>
			<div class="row mb-10 box2">
				<div class="col l3" style="line-height: 30px">
					Table to replace or append to:
				</div>
				<div class="col l9">
					<?php echo Form::select('replace_or_append',App\Model\Organization\Dataset::datasetList(),null,['placeholder'=>'Select Dataset','class'=>'datasets_list','disabled'=>'disabled']); ?>

				</div>
			</div>
			

			<div class="col s12 m6 l12 aione-field-wrapper">
				<button class="btn blue" type="submit">Import
					
				</button>
			</div>
		</div>
		<?php echo Form::close(); ?>

	</div>
	<style type="text/css">
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	textarea{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.btn{
		background-color: #0288D1;
	}
	.select-dropdown{
		margin-bottom: 0px !important;
	    border: 1px solid #a8a8a8 !important;
	    
	}
	.select-wrapper input.select-dropdown{
		height: 30px;
    	line-height: 30px;
	}
	.file-path{
		margin-bottom: 0px !important
	}
	.mb-10{
		margin-bottom:15px !important; 
	}
	</style>
	<script type="text/javascript">
		$(".url,.file_on_server,.import_from_survey").hide();
		$(document).ready(function(){
		    $('input[type="radio"]').click(function(){
		        var inputValue = $(this).attr("value");
		        if(inputValue == 'import_from_survey'){
		        	$(".box2").hide();
		        }else{
		        	$(".box2").show();
		        }
		        var targetBox = $("." + inputValue);
		        $(".box").not(targetBox).hide();
		        $(targetBox).show();
		    });
		    $('.action_type').change(function(){
		    	if($(this).val() == 'append' || $(this).val() == 'replace'){
		    		$('.datasets_list').prop('disabled',false);
		    		$('select').material_select();
		    	}else{
		    		$('.datasets_list').prop('disabled',true);
		    		$('select').material_select();
		    	}
		    });
		});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>