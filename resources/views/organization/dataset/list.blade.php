@extends('layouts.main')
@section('content')
	
<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col l3  pl-7" style="float: right;margin-bottom: 14PX;">
			
				<a id="add_new" href="#" class="btn add-new display-form-button" >
					Create Dataset
				</a>
				<div id="add_new_wrapper" class="add-new-wrapper add-form ">
					{!! Form::open(['route'=>'save.dataset' , 'class'=> 'form-horizontal','method' => 'post'])!!}

						<div class="row no-margin-bottom">
							
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Dataset Name
								</div>
								<div class="col l12">
									<input type="text" name="dataset_name" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
									@if ($errors->has('dataset_name'))
	                                    <span class="help-block" style="color: red;">
	                                        <strong>{{ $errors->first('dataset_name') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Description
								</div>
								<div class="col l12">
									 <textarea id="textarea1" name="dataset_description" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea>
									 @if ($errors->has('dataset_description'))
	                                    <span class="help-block" style="color: red;">
	                                        <strong>{{ $errors->first('dataset_description') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>
							{{-- <div class="row">
								<div class="col l12" style="line-height: 30px">
									Import Source
								</div>
								<div class="col l12">
									<div class="col l12">
										<input name="group1" type="radio" id="test1" />
								    	<label for="test1">File Upload</label>    
									</div>
									<div class="col l12">
										<input name="group1" type="radio" id="test2" />
								     	<label for="test2">URL</label>
									</div>
									<div class="col l12">
										<input name="group1" type="radio" id="test3" />
								    	<label for="test3">File on server</label>    
									</div>
									<div class="col l12">
										<input name="group1" type="radio" id="test4" />
								     	<label for="test4">Import from survey</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Select CSV / XLSX / SQL File
								</div>
								<div class="col l12">
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
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Enter File URL
								</div>
								<div class="col l12">
									<input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Enter File Path
								</div>
								<div class="col l12">
									<input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Enter File URL
								</div>
								<div class="col l12">
									<input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Import from survey
								</div>
								<div class="col l12">
									<select>
										<option value="" disabled selected>Choose your option</option>
										<option value="1">Option 1</option>
										<option value="2">Option 2</option>
										<option value="3">Option 3</option>
								    </select>
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Add, Replace or Append?
								</div>
								<div class="col l12">
									<select>
										<option value="" disabled selected>Choose your option</option>
										<option value="1">Option 1</option>
										<option value="2">Option 2</option>
										<option value="3">Option 3</option>
								    </select>
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Table to replace or append to:
								</div>
								<div class="col l12">
									<select>
										<option value="" disabled selected>Choose your option</option>
										<option value="1">Option 1</option>
										<option value="2">Option 2</option>
										<option value="3">Option 3</option>
								    </select>
								</div>
							</div>
							
	 --}}
							<div class="col s12 m6 l12 aione-field-wrapper">
								<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save
									<i class="material-icons right">save</i>
								</button>
							</div>
						</div>
					{!!Form::close()!!}

				</div>
				
			
		</div>
	</div>
	<div class="row">
		@include('common.list.datalist')
	</div>
</div>

<script type="text/javascript">
		$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});
		$(document).ready(function(){
			$('#test1').change(function(){
alert("chamnges");
			});
		});
</script>
<style type="text/css">
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
</style>
@endsection