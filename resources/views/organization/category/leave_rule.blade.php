@extends('layouts.main')
@section('content')
	<div class="row">
	{!! Form::open(['route']) !!}
		<div class="row"  style="padding-bottom: 15px">
			<div class="col l7">
				No of Leaves
			</div>
			<div class="col l5">
				<div class="row">
					<div class="col l6 pr-7">
						<input type="text" name="number_of_day" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
					</div>
					<div class="col l6 pl-7">

					{!! Form::select('valid_for',['monthly'=>'Monthly', 'yearly'=>'Yearly'],null,['placeHolder'=>"Valid For"])!!}
						{{-- <select>
							<option value="" disabled selected>Choose your option</option>
							<option value="yearly">Yearly</option>
							<option value="month">Month</option>
							
					    </select> --}}
					</div>
				</div>
			</div>
		</div>	
		<div class="row" style="padding-bottom: 15px">
			<div class="col l7">
				No of day before apply
			</div>
			<div class="col l5">
				<div class="row">
					<div class="col l6 pr-7">
						<input type="text" name="apply_before" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
					</div>
					{{-- <div class="col l6 pl-7">
						<select>
							<option value="" disabled selected>Choose your option</option>
							<option value="yearly">Yearly</option>
							<option value="month">Month</option>
							
					    </select>
					</div> --}}
				</div>
			</div>
		</div>
		{{-- <div class="row" style="padding-bottom: 15px">
			<div class="col l7">
				Applicable department
			</div>
			<div class="col l5">
				<div class="row">
					<div class="col l6 pr-7">
						<input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
					</div>
					<div class="col l6 pl-7">
						<select>
							<option value="" disabled selected>Choose your option</option>
							<option value="yearly">Yearly</option>
							<option value="month">Month</option>
							
					    </select>
					</div>
				</div>
			</div>
		</div> --}}
		<div class="row" style="padding-bottom: 15px">
			<div class="col l7">
			Applicable	Designation
			</div>
			<div class="col l5">
				<div class="row">
					
					<div class="col l6 pl-7">
					{!! Form::select('desination',['all'=>"All" , "1"=>"Project Manager" , "2"=>"Team Lead"])!!}
						{{-- <select>
							<option value="" disabled selected>Choose your option</option>
							<option value="all">all</option>
							<option value="">Month</option>
							
					    </select> --}}
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="padding-bottom: 15px">
			<div class="col l7">
				Applicable Users
			</div>
			<div class="col l5">
				<div class="row">
					{{-- <div class="col l6 pr-7">
						<input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
					</div> --}}
					<div class="col l6 pl-7">
						{!! Form::select('user',['all'=>"All" , "1"=>"Project Manager" , "2"=>"Team Lead"])!!}

					</div>
				</div>
			</div>
		</div>

		<div class="row" style="padding-bottom: 15px">
		{!! Form::submit('submit')!!}
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
	</style>
@endsection