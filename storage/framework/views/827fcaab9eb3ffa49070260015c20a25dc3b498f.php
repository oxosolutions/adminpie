<?php if(!empty($filters)): ?>
<?php if(isset($meta['enable_filters']) && $meta['enable_filters'] == 1): ?>

<!--==============================-->
<style type="text/css">
	.aione-visual-filter{
		width: 30%;
		
	}
	.aione-content-main{
		width: 69%;
		float: left
	}
	.aione-section-title{
		background: #efefef;
	    padding: 6px;
	    font-size: 20px;
	    text-align: center
	}
	.aione-section-title ul{
		display: inline-block;
		width: 100%
	}
	.aione-section-title ul li{
		float: left;
		width: 33%;
	}
	.modal-content ul{
		display: inline-block;
		width: 100%;
		padding:10px;
	}
	.modal-content ul li{
		float: left;
		width: 33%
	}
	.modal-content header{
		text-align: center;
	}
	.modal-content footer{
		text-align: right;
	}
	.aione-theme-arcane .aione-topbar{
		padding:0px;
	}
	.aione-topbar-item{
		top:2px;
	}
	.aione-filter-label{
		float: left
	}
	.multiple-select-dropdown{
		width: 323px;
	}
	.aione-topbar-header{
		height: 108px;
	}
	.aione-sidebar-position-left{
		float: left;
	}
	.aione-sidebar-position-right{
		float: right;
	}
</style>
<div id="aione_sidebar_<?php echo e($visualization_id); ?>" class="mb-10 aione-sidebar-position-<?php echo e($meta['filter_position']); ?> aione-visual-filter" >


		<div class="chart-filters aione-border" >
			
			<div class="font-size-20 bg-grey bg-lighten-4 p-10 " >
				Filters
			</div>
			
			<div class=" p-10 survey-chart-filters hideDiv">
				<form method="POST" action="">
					<?php echo Form::token(); ?>

					<?php 
						$multidrop = 0;
						$singledrop = 0;
						$range = 0;
					 ?>
					<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($value['column_type'] == 'mdropdown'): ?>
							
							<div id="aione_form_wrapper_296" class="aione-form-wrapper aione-form-theme- aione-form-label-position- aione-form-style-   ">
							    <div class="aione-row">
							        <div id="aione_form_content" class="aione-form-content">
							            <div class="aione-row aione-">
							                <div id="aione_form_section_617" class="aione-form-section non-repeater">
							                    <div class="aione-row">
							                        <div id="aione_form_section_content" class="aione-form-section-content">
							                            <div class="aione-row ar">
							                                <div id="field_3132" data-conditions="0" data-field-type="multi_select" class="field-wrapper ac field-wrapper-ajksdasjdhajksd field-wrapper-type-multi_select ">
							                                    <div id="field_label_ajksdasjdhajksd" class="field-label">
							                                        <label for="input_ajksdasjdhajksd">
							                                            <h4 class="field-title" id="<?php echo e(ucfirst($value['column_name'])); ?>">
							                                                <?php echo e(ucfirst($value['column_name'])); ?>

							                                            </h4>
							                                        </label>
							                                    </div>
							                                    <!-- field label-->
							                                    <div id="field_ajksdasjdhajksd" class="field field-type-multi_select">
							                                        <input type="hidden" name="ajksdasjdhajksd">
							                                        <select class="ajksdasjdhajksd browser-default  select2-hidden-accessible" id="input_ajksdasjdhajksd" multiple="" name='mdropdown[<?php echo e($multidrop); ?>][<?php echo e($key); ?>][]' tabindex="-1" aria-hidden="true">
							                                        	<?php $__currentLoopData = $value['column_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																			<option value="<?php echo e($option); ?>"
																			<?php if(isset($value['selected_value']) && in_array($option, $value['selected_value'])): ?>
																				selected="selected"
																			<?php endif; ?>
																			><?php echo e($option); ?></option>
																		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							                                        </select>
							                                        <div class="field-actions">
							                                            <a hraf="#" class="aione-form-multiselect-all aione-action-link">Select All</a>
							                                            / 
							                                            <a href="#" class="aione-form-multiselect-none aione-action-link">Select None</a>
							                                        </div>
							                                    </div>
							                                    <!-- field -->
							                                </div>
							                                <!-- field wrapper -->
							                            </div>
							                            <!-- .aione-row -->
							                        </div>
							                        <!-- .aione-form-content -->
							                    </div>
							                    <!-- .aione-row -->
							                </div>
							                <!-- .aione-form-section -->
							            </div>
							            <!-- .aione-row -->
							        </div>
							        <!-- .aione-form-content -->
							        <textarea class="form_conditions" id="form_296" style="display: none;">{"3132":{"field_slug":"ajksdasjdhajksd","field_id":3132,"field_title":"askdhjasjkd","field_conditions":[]}}</textarea>
							    </div>
							    <!-- .aione-row -->
							</div>

							
							<?php 
								$multidrop++;
							 ?>
						<?php endif; ?>
						<?php if($value['column_type'] == 'dropdown'): ?>
							<div class="row">
								<div class="">
									<label><?php echo e(ucfirst($value['column_name'])); ?></label>
									<select name='dropdown[<?php echo e($singledrop); ?>][<?php echo e($key); ?>][]' class="browser-default">
										<option value="">All</option>
										<?php $__currentLoopData = $value['column_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($option); ?>" 
											<?php if(isset($value['selected_value']) && in_array($option, $value['selected_value'])): ?>
												selected="selected"
											<?php endif; ?>
											><?php echo e($option); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
									</select>
								</div>
							</div>
							<div class="divider"></div>
							<?php 
								$singledrop++;
							 ?>
						<?php endif; ?>
						<?php if($value['column_type'] == 'range'): ?>
							<div class="row"">
								<div class="">
									<label style="width: 100%"><?php echo e(ucfirst($value['column_name'])); ?></label>
									<input type="range[]"  name="range[<?php echo e($range); ?>][<?php echo e($key); ?>]" data-slider-min="<?php echo e($value['column_min']); ?>" data-slider-max="<?php echo e($value['column_max']); ?>" data-slider-step="1" data-slider-value="[<?php echo e($value['column_min']); ?>,<?php echo e($value['column_max']); ?>]" class="aione-range-slider" />
								</div>
							</div>
							<?php 
								$range++;
							 ?>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div class="chats-filter-button">
						<button name="downloadData" type="submit" value="downloadData" class="aione-button" style="">Download Data</button>
						
						<button type="submit" name="applyFilter" class="aione-button aione-float-right" value="Apply Filters">Apply Filters</button>
						<div class="clear">
							
						</div>
					</div>
					
				</form>
			</div>
		</div>



</div> <!-- aione_sidebar -->
<?php endif; ?>
<?php endif; ?>
