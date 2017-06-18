<?php $__env->startSection('content'); ?>
<div class="row">
	<?php echo Form::open(['route'=>'meta.category' ,	'class'=> 'form-horizontal', 'method' => 'post']); ?>

	<?php echo Form::hidden('id',$data['id']); ?>


		<div class="row"  style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				Name
			</div>
			<div class="col l9">
				
				<?php echo Form::text('name',@$data['cat']['name'],['class'=>"aione-setting-field","style"=>"border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px"]); ?>

			</div>
		</div>	
		<div class="row"  style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				Description
			</div>
			<div class="col l9">
				
				 
				 <?php echo Form::textarea('description',@$data['cat']['description'],['class'=>"materialize-textarea","id"=>"textarea1","style"=>"border:1px solid #a8a8a8;margin-bottom: 0px"]); ?>

			</div>
		</div>	

		<div class="row"  style="padding-bottom: 15px">
			<div class="col l3" style="line-height: 30px">
				No of Leaves 
			</div>
			<div class="col l9">
				
			    <div class="col l6 pr-7">
					<?php echo Form::text('number_of_day',@$data['data']['number_of_day'],['class'=>"aione-setting-field","style"=>"border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px"]); ?>

				</div>
				<div class="col l6 pl-7">

					<?php echo Form::select('valid_for',['monthly'=>'Monthly', 'yearly'=>'Yearly'],@$data['data']['valid_for'],['placeHolder'=>"Valid For"]); ?>

				</div>
			</div>
		</div>	
		<div class="row" style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				No of day before apply
				<?php echo e(@$data['apply_before']); ?>

			</div>
			<div class="col l9">
				
				<?php echo Form::text('apply_before',@$data['data']['apply_before'],['class'=>"aione-setting-field","style"=>"border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px"]); ?>

			</div>
		</div>
		
		<div class="row" style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				Applicable	Designation
			</div>
			<div class="col l9">
				<?php echo e(Form::select('designation[]',$data['designationData'],@json_decode($data['data']['designation']),array('multiple'=>'multiple', 'placeHolder'=>"Select Designation"))); ?>

			</div>
		</div>
		<div class="row" style="padding-bottom: 15px">
			<div class="col l3" style="line-height: 30px">
				Applicable Users
			</div>
			<div class="col l9">
				<?php echo e(Form::select('user',$data['userData'],@json_encode($data['data']['user']),array('multiple'=>'multiple','name'=>'user[]', 'placeHolder'=>"Select User"))); ?>

			</div>
		</div>

		<div class="row" style="padding-bottom: 15px">
		<?php echo Form::submit('submit',['class'=>'btn blue white-text']); ?>

		</div>


	</div>
	
	<style type="text/css">
		.aione-setting-field:focus{
			border-bottom: 1px solid #a8a8a8 !important;
			box-shadow: none !important;
		}
		.select-dropdown{
			margin-bottom: 0px !important;
		    border: 1px solid #a8a8a8 !important;
		    
		}
		.select-wrapper input.select-dropdown{
			height: 30px;
	    	line-height: 30px;
		}

	.pv-10{
		padding:10px 0px
	}
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
	.datepicker{
		margin-bottom: 0px !important
	}
	.level{
		margin: 0px !important;
	}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>