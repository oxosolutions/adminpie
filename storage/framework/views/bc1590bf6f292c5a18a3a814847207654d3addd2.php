<div class="form-group">
<input type="hidden" name="project_id" value="<?php echo e($id); ?>">
<input type="hidden" name="type" value="project_info">

						<?php echo Form::label('type', 'Project Type:', ['class' => 'col-lg-3 control-label']);; ?>

							<div class="col-lg-9">
							<?php echo Form::select('project_type',['e-commerce'=>'E Commerence', 'portfolio'=>'portfolio'],null,['class' => 'form-control','placeholder'=>'Select Project type']); ?>

								
							</div>
						</div>
						<div class="form-group">
						<?php echo Form::label('language', 'Programming Language:', ['class' => 'col-lg-3 control-label']);; ?>

							<div class="col-lg-9">
							<?php echo Form::select('Programming_Language',['dot_net'=>'.Net', 'php'=>'PHP'],null,['class' => 'form-control','placeholder'=>'Select Programming Language']); ?>

								
							</div>
						</div>
						<div class="form-group">
						<?php echo Form::label('dev_with', 'Develop with:', ['class' => 'col-lg-3 control-label']);; ?>

							<div class="col-lg-9">
							<?php echo Form::select('develop_with',['core'=>'core', 'cms'=>'CMS', 'MVC'=>'MVC Framework'],null,['class' => 'form-control' ,'placeholder'=>'Select Develop With']); ?>

								
							</div>
						</div>
						<div class="form-group">
						<?php echo Form::label('framework', 'Framework list:', ['class' => 'col-lg-3 control-label']);; ?>

							<div class="col-lg-9">
							<?php echo Form::select('framework',['zend'=>'zend', 'laravel'=>'laravel'],null,['class' => 'form-control' ,'placeholder'=>'Select Framework']); ?>

								
							</div>
						</div>
						<div class="form-group">
						<?php echo Form::label('cms', 'Cms list:', ['class' => 'col-lg-3 control-label']);; ?>

							<div class="col-lg-9">
							<?php echo Form::select('cms',['worpress'=>'Word-press', 'shopify'=>'Shopify'],null,['class' => 'form-control' ,'placeholder'=>'Select Cms']); ?>

								
							</div>
						</div>