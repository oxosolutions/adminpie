@extends('admin.layouts.main')

@section('content')
<div>
	@include('admin.settings._tabs')
	<div>
		<div class="row">
			<div class="col l12">
				<h5>General</h5>
			</div>
		</div>
		<div class="row">
			<div class="col l12">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam bibendum erat urna, vitae malesuada ipsum mattis ac. Vivamus porttitor, enim at tempus consequat, diam nisl lacinia elit, id varius magna sapien vel neque.
			</div>
		</div>
		<div class="row pv-10" >
			<div class="row" style="padding:10px 0px">
				<div class="col l3" style="line-height: 30px">
					Text Field
				</div>
				<div class="col l9">
					<input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			
			<div class="row pv-10">
				<div class="col l3" style="line-height: 30px">
					Password
				</div>
				<div class="col l9">
					<input type="password" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			
			<div class="row pv-10">
				<div class="col l3" style="line-height: 30px">
					Email
				</div>
				<div class="col l9">
					<input type="email" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 30px">
					Text Area
				</div>
				<div class="col l9">
					{{-- <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
					 <textarea id="textarea1" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea>
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 30px">
					Dropdown 1
				</div>
				<div class="col l9">
					{{-- <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
					<select>
						<option value="" disabled selected>Choose your option</option>
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
				    </select>
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 30px">
					Dropdown 2
				</div>
				<div class="col l9">
					<select multiple>
						<option value="" disabled selected>Choose your option</option>
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
				    </select>
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 30px">
					Dropdown 2
				</div>
				<div class="col l9">
					<select multiple>
						<optgroup label="team 1">
							<option value="1">Option 1</option>
							<option value="2">Option 2</option>
						</optgroup>
						<optgroup label="team 2">
							<option value="3">Option 3</option>
							<option value="4">Option 4</option>
						</optgroup>
					</select>
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 25px">
					Radio
				</div>
				<div class="col l9">
					<div class="row">
						<div class="col l3">
							<input name="group1" type="radio" id="test1" />
					    	<label for="test1">Choice 1</label>    
						</div>
						<div class="col l3">
							<input name="group1" type="radio" id="test2" />
					     	<label for="test2">Choice 2</label>
						</div>
					</div>
					
				</div>
			</div>
			<div class="row pv-10" >
				<div class="col l3" style="line-height: 25px">
					check
				</div>
				<div class="col l9">
					<div class="row">
						<div class="col l3">
							<input type="checkbox" class="filled-in" id="filled-in-box"  />
     						<label for="filled-in-box">Filled in</label>
						</div>
						<div class="col l3">
							<input type="checkbox" class="filled-in" id="filled-in-box1"  />
     						<label for="filled-in-box1">Filled in</label>
						</div>
					</div>
					
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 22px">
					Toggle
				</div>
				<div class="col l9">
					<div class="row">
						<div class="col l3">
							<div class="switch">
							    <label>
							      
							      <input type="checkbox">
							      <span class="lever"></span>
							      
							    </label>
							</div>
						</div>
					
					</div>
					
				</div>
			</div>
			<div class="row pv-10" >
				<div class="col l3" style="line-height: 46px">
					File
				</div>
				<div class="col l9">
			
					<div class="file-field input-field" style="margin-top: 0px">
						<div class="btn">
							<span>File</span>
							<input type="file">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
					</div>
						
					
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 46px">
					File Multiple
				</div>
				<div class="col l9">
			
					<div class="file-field input-field" style="margin-top: 0px;">
					<div class="btn">
					<span>File</span>
					<input type="file" multiple>
					</div>
					<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files">
					</div>
					</div>
						
					
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 35px">
					Range
				</div>
				<div class="col l9">
			
					 <input type="range" id="test5" min="0" max="100" />
						
					
				</div>
			</div>
			<div class="row pv-10">
				<div class="col l3" style="line-height: 46px">
					Date Picker
				</div>
				<div class="col l9">
					 <input type="date" class="datepicker">
				</div>
			</div>
		</div>
		<div class="row right-align pv-10"  >
			<a class="btn">save</a>
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
@endsection