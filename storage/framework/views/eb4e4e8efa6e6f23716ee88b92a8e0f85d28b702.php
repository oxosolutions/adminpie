<?php $__env->startSection('content'); ?>
<?php echo $__env->make('organization.profile._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="row" style="border:1px solid #e8e8e8;margin-top: 55px;padding: 80px 250px">
		
		<div class="row" >
			<div class="row" style="padding:10px 14px">
				<div class="col l3" style="line-height: 30px">
					Current Password
				</div>
				<div class="col l9">
					<input type="password" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			<div class="row pv-10" style="padding-left:14px;padding-right: 14px ">
				<div class="col l3" style="line-height: 30px">
					New Password
				</div>
				<div class="col l9">
					<input type="password" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			<div class="row pv-10" style="padding-left:14px;padding-right: 14px ">
				<div class="col l3" style="line-height: 30px">
					Confirm Password
				</div>
				<div class="col l9">
					<input type="password" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
		</div>
		<div class="row right-align" style="padding-right:15px" >
			<a href="" class="btn blue">Save</a>
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
	</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>