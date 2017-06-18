
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Project Info</h6>
			<div class="heading-elements">
				<ul class="icons-list">
	        		<li><a data-action="collapse"></a></li>
	        		<li><a data-action="reload"></a></li>
	        		<li><a data-action="close"></a></li>
	        	</ul>
	    	</div>
		</div>
		<div class="panel-body">
			<div class="tabbable">
				<ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-justified">
					<li class="active"><a href="#info" data-toggle="tab">Project Info</a></li>
					<li ><a href="#doc" data-toggle="tab">Project Documents</a></li>
					<li><a href="#team" data-toggle="tab">Team</a></li>
					<li><a href="#module" data-toggle="tab">Project Moduels </a></li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Confidential <span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="#payment" data-toggle="tab">Payments</a></li>
							<li><a href="#aggreement" data-toggle="tab">Agreement Documents</a></li>
						</ul>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="info">
							<?php echo Form::model($model,['route'=>'save.project_meta', 'class'=> 'form-horizontal','method' => 'post']); ?>

							<div class="row">
								<div class="col-md-12 ">
									<div class="panel panel-flat">

										<div class="panel-body">
											<?php echo $__env->make('organization.project.info._form_project_info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Submit Project Info <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php echo Form::close(); ?>


						
					</div>

					<div class="tab-pane" id="doc">
					
						<?php echo Form::model($model,['route'=>'save.project_meta', 'class'=> 'form-horizontal','method' => 'post' , 'files'=>true]); ?>

							<div class="row">
								<div class="col-md-12 ">
									<div class="panel panel-flat">

										<div class="panel-body">
											<?php echo $__env->make('organization.project.info._form_documents_info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Submit Document Info <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php echo Form::close(); ?>

					</div> 
					<div class="tab-pane" id="team">
						<?php echo Form::model($model,['route'=>'save.project_meta', 'class'=> 'form-horizontal','method' => 'post']); ?>

							<div class="row">
								<div class="col-md-12 ">
									<div class="panel panel-flat">

										<div class="panel-body">
											<?php echo $__env->make('organization.project.info._form_team_info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Submit Project Info <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php echo Form::close(); ?>

					</div>
					<div class="tab-pane" id="module">
					<h1>tab4</h1>
						<?php echo Form::model($model,['route'=>'save.project_meta', 'class'=> 'form-horizontal','method' => 'post']); ?>

							<div class="row">
								<div class="col-md-12 ">
									<div class="panel panel-flat">

										<div class="panel-body">
											<?php echo $__env->make('organization.project.info._form_team_info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Submit Project Info <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>

						<?php echo Form::close(); ?>

					</div>
					<div class="tab-pane" id="payment">
					<h1>payment</h1>
					</div>

					<div class="tab-pane" id="aggreement">
					<h1>aggreement</h1>
						DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
					</div>

					
				</div>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>