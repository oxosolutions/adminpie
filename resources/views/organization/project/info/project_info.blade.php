@extends('layouts.main')
@section('content')
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
							{!! Form::model($model,['route'=>'save.project_meta', 'class'=> 'form-horizontal','method' => 'post'])!!}
							<div class="row">
								<div class="col-md-12 ">
									<div class="panel panel-flat">

										<div class="panel-body">
											@include ('organization.project.info._form_project_info')
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Submit Project Info <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>

							{!!Form::close()!!}

						
					</div>

					<div class="tab-pane" id="doc">
					
						{!! Form::model($model,['route'=>'save.project_meta', 'class'=> 'form-horizontal','method' => 'post' , 'files'=>true])!!}
							<div class="row">
								<div class="col-md-12 ">
									<div class="panel panel-flat">

										<div class="panel-body">
											@include ('organization.project.info._form_documents_info')
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Submit Document Info <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>

							{!!Form::close()!!}
					</div> 
					<div class="tab-pane" id="team">
						{!! Form::model($model,['route'=>'save.project_meta', 'class'=> 'form-horizontal','method' => 'post'])!!}
							<div class="row">
								<div class="col-md-12 ">
									<div class="panel panel-flat">

										<div class="panel-body">
											@include ('organization.project.info._form_team_info')
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Submit Project Info <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>

							{!!Form::close()!!}
					</div>
					<div class="tab-pane" id="module">
					<h1>tab4</h1>
						{!! Form::model($model,['route'=>'save.project_meta', 'class'=> 'form-horizontal','method' => 'post'])!!}
							<div class="row">
								<div class="col-md-12 ">
									<div class="panel panel-flat">

										<div class="panel-body">
											@include ('organization.project.info._form_team_info')
											<div class="text-right">
												<button type="submit" class="btn btn-primary">Submit Project Info <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>

						{!!Form::close()!!}
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
{{--<div class="form-group">
	<label class="col-lg-3 control-label">No of Employee:</label>
	<div class="col-lg-9">
		<input name="number_of_employee" type="number" class="form-control" placeholder="Enter Number of Employee working on project">
	</div>
</div>
<div class="form-group">
	<label class="col-lg-3 control-label">Project Start Date:</label>
	<div class="col-lg-9">
		<input name="start_at" type="text" class="form-control" placeholder="10-09-2017">
	</div>
</div>
<div class="form-group">
	<label class="col-lg-3 control-label">Project Deadline Date :</label>
	<div class="col-lg-9">
		<input name="end_at" type="text" class="form-control" placeholder="09-10-2017">
	</div>
</div>

<div class="form-group">
	<label class="col-lg-3 control-label">Progress:</label>
	<div class="col-lg-9">
		<input type="number" class="form-control" name="progress" placeholder="Enter Progress">
	</div>
</div>
 <div class="form-group">
	<label class="col-lg-3 control-label">Select your state:</label>
	<div class="col-lg-9">
		<select data-placeholder="Select your state" class="select form-control">
			<option></option>
			<optgroup label="Alaskan/Hawaiian Time Zone">
				<option value="AK">Alaska</option>
				<option value="HI">Hawaii</option>
			</optgroup>
			<optgroup label="Pacific Time Zone">
				<option value="CA">California</option>
				<option value="OR">Oregon</option>
				<option value="WA">Washington</option>
			</optgroup>
			<optgroup label="Mountain Time Zone">
				<option value="AZ">Arizona</option>
				<option value="CO">Colorado</option>
				<option value="WY">Wyoming</option>
			</optgroup>
			<optgroup label="Central Time Zone">
				<option value="AL">Alabama</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
			</optgroup>
			<optgroup label="Eastern Time Zone">
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="WV">West Virginia</option>
			</optgroup>
		</select>
	</div>
</div> --}}
@endsection()
