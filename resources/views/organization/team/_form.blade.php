{{-- <div class="form-group">
{!!Form::label('title', 'Enter Project Title:', ['class' => 'col-lg-3 control-label']) !!}
	<div class="col-lg-9">
	{!!Form::text('name',null,['class' => 'form-control'])!!}
 --}}	

{{-- <label class="col-lg-3 control-label">Enter Project Title:</label> --}}
{{-- <input type="text" name="name" class="form-control" placeholder="Enter Project Title"> --}}
	
{{-- 
	</div>
</div>
<div class="form-group">
{!! Form::label('desc','Enter Description:')!!}
	<label class="col-lg-3 control-label">Enter Description:</label>
	<div class="col-lg-9">
		<textarea name="description" rows="5"  cols="5" class="form-control" placeholder="Short Project Description"></textarea>
	</div>
</div>
 --}}
{!! FormGenerator::GenerateForm('team') !!}



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
<script type="text/javascript">
	 $('.chips').material_chip();
 
  $('.chips-placeholder').material_chip({
    placeholder: 'Enter a tag',
    secondaryPlaceholder: '+Tag',
  });
      
</script>