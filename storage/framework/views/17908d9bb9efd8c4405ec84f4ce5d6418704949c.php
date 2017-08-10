<div>
	
	<div>
		<div class="row">
			<div class="col l12">
				<h5><?php echo e(@$options['title']); ?></h5>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				<?php echo e(@$options['details']); ?>

			</div>
		</div>
		<div class="row pv-10" >
			<?php $__currentLoopData = $collection->section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="row">
						<h5><?php echo e($section->section_name); ?></h5> 
					</div>
						<?php echo FormGenerator::GenerateSection($section->section_slug, $options,$model, $formFrom); ?>

				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<div class="row right-align pv-10"  >
			<button type="submit" class="btn">save</button>
			<a class="btn grey darken-2">reset to default</a>
		</div>
	</div>
</div>
<style type="text/css">
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
<script type="text/javascript">
	  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
</script>