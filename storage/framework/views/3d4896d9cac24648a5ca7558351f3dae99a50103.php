<?php $__env->startSection('content'); ?>
<style type="text/css">
	.indicater-wrapper{
		position: absolute;right: 0;bottom:0;left:0;font-size: 9px;cursor: pointer
	}
	.indicater-wrapper .indicater{
		width: 100%;height: 4px;position: relative;
	}
	.indicater-wrapper .percentage{
		position: absolute;min-height: 4px;left: 0;width: 30%
	}
	.indicater-wrapper .percentage-text{
		display: none;
		position: absolute;
		width: 100%
	}

	.indicater-wrapper.active .percentage-text{
		display: block;
		color: #676767
	}
	.indicater-wrapper.active .indicater{
		height: 15px;margin-top: 10px
	}
	.indicater-wrapper.active .percentage{
		min-height: 15px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.indicater-wrapper').click(function(){
			$(this).toggleClass('active');
		})
	})
</script>
<div class=" p-10" style="max-width: 1120px;margin: 0 auto;">
	<div class="aione-float-left pr-15	" style="width: 360px">
	
		<div>
		
			<div class="pv-15 ph-10 aione-border mb-10 bg-white " style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600 truncate " title="Basic detail section for personal information">Basic detail section for personal information</div>
				<div class="font-size-13 line-height-20">24 Question</div>
				<div class="indicater-wrapper" >
					
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width:50%">
							
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">30% completed</div>
					</div>
				</div>
				
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-white" style="position:relative;">
				<div class="font-size-20 light-blue darken-2 font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
			<div class="pv-15 ph-10 aione-border mb-10 bg-light-blue bg-darken-2" style="position:relative;">
				<div class="font-size-20 white font-weight-600">Section Name</div>
				<div class="font-size-13 line-height-20 white">24 Question</div>
					<div class="indicater-wrapper" >
					<div class="bg-light-blue bg-lighten-4 indicater">
						<div class="bg-light-blue bg-darken-2 percentage" style="width: 0%">
							
						</div>
						<div class="grey aione-align-center line-height-15 percentage-text">0% completed</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="aione-float-left " style="width: calc( 100% - 360px )">
		<div class="  bg-white">
			<div id="aione_form_wrapper_1" class="aione-form-wrapper aione-form-theme- aione-form-label-position- aione-form-style- aione-form-border  aione-form-section-border">
	<div class="aione-row">
				<div id="aione_form_content" class="aione-form-content">
			<div class="aione-row aione-">
							
								<div id="aione_form_section_1" class="aione-form-section non-repeater">
	<div class="aione-row">
	
				<div id="aione_form_section_header" class="aione-form-section-header">
			<div class="aione-row">
									<h3 class="aione-form-section-title aione-align-left">Basic Details</h3>
								
							</div> <!-- .aione-row -->
		</div> <!-- .aione-form-header -->
				<div id="aione_form_section_content" class="aione-form-section-content">
			<div class="aione-row ar">

													<div id="field_1" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
						<div id="field_label_name" class="field-label">

				<label for="input_name">
											<h4 class="field-title" id="Name">Name</h4>
														</label>

			</div><!-- field label-->
				

	<div id="field_name" class="field field-type-text">
	
					<input class="input-name" id="input_name" placeholder="" data-validation="" name="name" type="text"> 


							</div><!-- field -->
            
</div><!-- field wrapper -->
													<div id="field_2" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-email field-wrapper-type-text ">
						<div id="field_label_email" class="field-label">

				<label for="input_email">
											<h4 class="field-title" id="Email">Email</h4>
														</label>

			</div><!-- field label-->
				

	<div id="field_email" class="field field-type-text">
	
					<input class="input-email" id="input_email" placeholder="" data-validation="" name="email" type="text"> 


							</div><!-- field -->
            
</div><!-- field wrapper -->
													<div id="field_3" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-age field-wrapper-type-text ">
						<div id="field_label_age" class="field-label">

				<label for="input_age">
											<h4 class="field-title" id="Age">Age</h4>
														</label>

			</div><!-- field label-->
				

	<div id="field_age" class="field field-type-text">
	
					<input class="input-age" id="input_age" placeholder="" data-validation="" name="age" type="text"> 


							</div><!-- field -->
            
</div><!-- field wrapper -->
			
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

	</div> <!-- .aione-row -->
</div> <!-- .aione-form-section -->

							
								<div id="aione_form_section_2" class="aione-form-section non-repeater">
	<div class="aione-row">
	
				<div id="aione_form_section_header" class="aione-form-section-header">
			<div class="aione-row">
									<h3 class="aione-form-section-title aione-align-left">Enquery questions</h3>
								
							</div> <!-- .aione-row -->
		</div> <!-- .aione-form-header -->
				<div id="aione_form_section_content" class="aione-form-section-content">
			<div class="aione-row ar">

													<div id="field_4" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-rate-us field-wrapper-type-text ">
						<div id="field_label_rate-us" class="field-label">

				<label for="input_rate-us">
											<h4 class="field-title" id="Rate us (0 stands for low satisfaction and 5 stands for high satisfaction)">Rate us (0 stands for low satisfaction and 5 stands for high satisfaction)</h4>
														</label>

			</div><!-- field label-->
				

	<div id="field_rate-us" class="field field-type-text">
	
					<input class="input-rate-us" id="input_rate-us" placeholder="" data-validation=" " name="rate-us" type="text"> 


							</div><!-- field -->
            
</div><!-- field wrapper -->
			
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

	</div> <!-- .aione-row -->
</div> <!-- .aione-form-section -->

			
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

				<div id="aione_form_footer" class="aione-form-footer">
			<div class="aione-row">
			
							<input type="submit" class="aione-button" value="Submit">
										
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-footer -->
		
	<textarea class="form_conditions" id="form_1" style="display: none;">{"4":{"field_slug":"rate-us","field_id":4,"field_title":"Rate us (0 stands for low satisfaction and 5 stands for high satisfaction)","field_conditions":[]}}</textarea>
	</div> <!-- .aione-row -->
</div>
		</div>
	</div>
	<div class="clear">
		
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>