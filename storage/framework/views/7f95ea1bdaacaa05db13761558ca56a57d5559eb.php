 <?php echo Form::model($model,['route'=>'save.chart.settings']); ?>

<?php echo Form::hidden('chart_id',$request->chartid); ?>

<?php echo Form::hidden('visual_id',$request->visualid); ?>

<div class="form">
	<div class="aione-accordion">
		<div class="aione-item active">
			<div class="aione-item-header">
				General
				
			</div>
			<div class="aione-item-content aione-form-field-border">
				<?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(in_array($chart_type,$value->chartType)): ?>
						<?php if($value->isArray == 'false'): ?>
							<div class="field-wrapper">
								<div class="label field-label">
									<label><strong><?php echo e($value->label); ?></strong></label>
								</div>
								<div class="field">
									<?php if($value->type != 'select'): ?>

										<?php echo Form::{$value->type}('chart_settings['.$key.']',null); ?>

									<?php else: ?>
										<?php echo Form::{$value->type}('chart_settings['.$key.']',$value->options,null,['placeholder'=>'Select Value']); ?>

									<?php endif; ?>
								</div>
							</div>
									
										
							
							
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
			
	</div>
	
	<?php $__currentLoopData = $jsonData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(in_array($chart_type,$value->chartType)): ?>
			<?php if($value->isArray == 'true'): ?>
				<?php 
					$fieldName = [];
					unset($value->chartType);
					unset($value->isArray);
					$fieldName[] = $key;
				 ?>
				<?php echo $__env->make('organization.visualization.recursive-chart-settings',['jsonData'=>$value,'key'=>$key,'fieldName'=>$fieldName], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<input type="submit" name="submit" value="Save Settings" />
<?php echo Form::close(); ?>

<style type="text/css">
	.settings-collapsable{
		width: 99%;
		border: 1px solid #CCC;
	}

	.arrow{
		float: right;
		margin-top: -2.3%;
		margin-right: 0.8%;
	}

	.arrow-up {
	  width: 0; 
	  height: 0; 
	  border-left: 8px solid transparent;
	  border-right: 8px solid transparent;
	  
	  border-bottom: 10px solid black;
	}

	.arrow-down {
	  width: 0; 
	  height: 0; 
	  border-left: 8px solid transparent;
	  border-right: 8px solid transparent;
	  
	  border-top: 10px solid #000;
	}

	.arrow-right {
	  width: 0; 
	  height: 0; 
	  border-top: 60px solid transparent;
	  border-bottom: 60px solid transparent;
	  
	  border-left: 60px solid #000;
	}

	.arrow-left {
	  width: 0; 
	  height: 0; 
	  border-top: 10px solid transparent;
	  border-bottom: 10px solid transparent; 
	  
	  border-right:10px solid #000; 
	}
	.collapsable-content{
		padding: 1%;
		height: auto;
		display: none;
	}
	.settings-collapsable-header{
		width: 96.9%;
		border: 1px solid #ccc;
		padding-left: 1%;
		background: #e5e5e5;
		background: -moz-linear-gradient(top, #e5e5e5 6%, #ffffff 100%);
		background: -webkit-linear-gradient(top, #e5e5e5 6%,#ffffff 100%);
		background: linear-gradient(to bottom, #e5e5e5 6%,#ffffff 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5e5e5', endColorstr='#ffffff',GradientType=0 );
		cursor: pointer;
		height: 35px;
		padding-top: 2%;
		padding-right: 2%;
	}
	.collapse-arrow{
		float: right;
		content: 
	}
	hr {
	    margin: 20px 0;
	    border: 1px solid #CCC;
	    opacity: 0.5;
	}
	.form{
		width:100%;
		margin: 0 auto;
		border: 1px solid 1px;
		font-family: arial;
		font-size: 14px;
	}
	.form input,select{
		width: 100%;
		height: 30px;
	}
	.label{
		width: 100%;
		margin-bottom: 0.5%;
		font-weight: 400;
	}
	.form .fields{
		margin-bottom: 1.5%;
	}
	.row{
		width: 100%;
		height: auto;
		position: relative;
	}

	.col{
		float: left;
	}

	.col-md-6{
		width: 50%;
		height: auto;
	}

	.col-md-12{
		width: 100%;
		height: auto;
	}
	.aione-accordion .aione-item.active .aione-item-header,
.aione-collapsible .aione-item.active .aione-item-header {
  background-color: #f2f2f2
}
</style>
<script type="text/javascript" src="<?php echo e(asset('js/jquery-2.2.3.min.js')); ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.settings-collapsable-header').click(function(){
			var elem = $(this).parent('.settings-collapsable');
			if(elem.find('.arrow').hasClass('arrow-down')){
				elem.find('.arrow').removeClass('arrow-down');
				elem.find('.arrow').addClass('arrow-up');
				elem.addClass('active');
			}else{
				elem.find('.arrow').removeClass('arrow-up');
				elem.find('.arrow').addClass('arrow-down');
				elem.removeClass('active');
			}
			$('.collapsable-content').each(function(index){
				/*if(!$this.is(':nth-child('+index+')')){
					$('.collapsable-content').slideUp(300);
				}*/
			});
			elem.find('.collapsable-content:first').slideToggle(300);
		});
	});
</script>
