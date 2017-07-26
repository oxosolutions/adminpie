@extends('layouts.main')
@section('content')

	<div class="row" style="border:1px solid #e8e8e8;">
		
		<div class="row" style="margin-top: 50px">
			<div class="row" style="padding:10px 14px">
				<div class="col l3" style="line-height: 30px">
					Name
				</div>
				<div class="col l9">
					<input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			<div class="row pv-10" style="padding-left:14px;padding-right: 14px ">
				<div class="col l3" style="line-height: 30px">
					About Me
				</div>
				<div class="col l9">
					<input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
		</div>
		<div class="row right-align" style="padding-bottom: 15px;padding-right: 15px">
			<a href="" class="btn blue">Update Info</a>
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
@endsection