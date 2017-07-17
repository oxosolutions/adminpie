@extends('layouts.main')
@section('content')

<style type="text/css">
	.add-field-icon{
	  color: #7A9BBE;
    padding: 6px;
    margin-left: 10px;
	}
	.add-field-icon i{
		transform: rotate(272deg);
	}
	.add-field-desc{ 
		font-family: Comic Sans MS, sans-serif !important;
		color: #7A9BBE;
    font-size: 12px;
		height: 13px;
		line-height: 1em;
		text-shadow: 0 1px 0 #FFFFFF;
	}
	.add-field-content button{
	  float: right;
  	margin-right: 13px;
	}
  .field-title {
    font-weight: 700;
  }
  .field-description {
    font-size: 12px;
    color: #696969;
  }
  input{
    margin-bottom: 0px !important;
  }
  
  .wrapper{
	  background-color:#f2f2f2;
	  
	  min-height:400px;
  }
</style>

<div class="wrapper">

</div>

<!-- main-content-->
<div class="card" style="margin-top: 0px;">
	<div class="content-wrapper">
		<section class="section-header">
			<div class="" style="padding: 10px 5px;">
				Create Surrvey
			</div>
			<div>
				<table class="bordered centered" style="background-color: transparent;">
            <thead>
              <tr class=" grey lighten-3">
                <th style="width: 100px;">Field Order</th>
                <th class="left-align">Field Label</th>
                <th>Field Name </th>
                <th>Field Type</th>
              </tr>
            </thead>
				    <tbody class="form-rows">
				    	
              <tr>
                <td><div style="border:1px solid #e8e8e8;line-height: 34px;width: 34px;margin: 0 auto;border-radius: 50%">1</div></td>
                <td>
                  <div class="row option-trigger">
                    <div class="col l12">
                      Field Label
                    </div>
                    <div class="" style="font-size: 12px;height: 0px">
                      <span class="options">
                        <a href="">Edit </a>|
                        <a href="">View </a>|
                        <a href="">Delete </a>
                      </span>
                    </div>
                  </div>
                </td>

                <td>Test</td>
                <td>abc</td>
                
                
              </tr>

              <tr>
                <td><div style="border:1px solid #e8e8e8;line-height: 34px;width: 34px;margin: 0 auto;border-radius: 50%">1</div></td>
                <td>
                  <div class="row option-trigger">
                    <div class="col l12">
                      Field Label
                    </div>
                    <div class="" style="font-size: 12px;height: 0px">
                      <span class="options">
                        <a href="">Edit </a>|
                        <a href="">View </a>|
                        <a href="">Delete </a>
                      </span>
                    </div>
                  </div>
                </td>
                <td>Test</td>
                <td>abc</td>

              </tr>
              <tr>
                <td colspan=100% style="padding: 0px">
                   <div>
                    <div class="fields_list active-field">
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2 " style="padding:10px">
                        <span class="field-title">Field Label*</span><br>
                            <span class="field-description">This is the name which will appear on the EDIT page</span>
                        </div>
                        <div class="col l8 form-group"  style="padding: 5px">
                             <input type="text" name="ques[]" class="form-control field-label-input">
                        </div>
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Field Name*</span><br>
                            <span class="field-description">Single word, no spaces, underscore and dashes allowed</span>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                             <input type="text" name="fieldname[]" class="form-control field-name">
                        </div>
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title" style="line-height: 36px">Field Type*</span>         
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                           <select id="type" class="select form-control type" name="type[]">
                                <optgroup label="Basic">
                                    <option value="" selected="selected">Select Type</option>
                                    <option value="text" selected="selected">Text</option>
                                    <option value="textarea">Text Area</option>
                                    <option value="number">Number</option>
                                    <option value="email">Email</option>
                                    <option value="password">Password</option>
                                </optgroup>
                                <optgroup label="Content">
                                    <option value="image">Image</option>
                                    <option value="file">File</option>
                                </optgroup>
                                <optgroup label="Choice">
                                    <option value="select">Select</option>
                                    <option value="multi_select">Multi Select</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio Button</option>
                                </optgroup>
                            </select>
                        </div>  
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px;mi">
                            <span class="field-title">Field Instructions</span><br>
                            <span class="field-description">Instructions for authors. Shown when submitting data</span> 
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <textarea class="materialize-textarea" rows="3" name="instruction[]"></textarea>
                        </div>  
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Field Description</span><br>
                            <span class="field-description">Field Description</span> 
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <textarea class="form-control" rows="3" name="question_desc[]"></textarea>
                        </div>  
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                        <span class="field-title">Field Order</span><br>
                            <span class="field-description">Question Order be in number [0-9]</span>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                             <input type="text" name="question_order[]" class="form-control field-label-input">
                        </div>
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                        <span class="field-title">Media</span><br>
                            <span class="field-description">Media mp3</span>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                             <input type="text" name="media[]" class="form-control field-label-input">
                        </div>
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                        <span class="field-title">Pattern</span><br>
                            <span class="field-description">Pattern</span>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                             <input type="text" name="pattern[]" class="form-control field-label-input">
                        </div>
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                        <span class="field-title">Extra Options</span><br>
                            <span class="field-description">Extra Options</span>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                             <input type="text" name="extra_options[]" class="form-control field-label-input">
                        </div>
                    </div>
                     <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                        <span class="field-title">Validation</span><br>
                            <span class="field-description">validations</span>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                             <input type="text" name="validation[]" class="form-control field-label-input">
                        </div>
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Required?</span><br>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <input type="radio" name="required[]" value="1"> yes
                            <input type="radio" name="required[]" value="0"> no
                        </div>  
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Placeholder Text</span><br>
                            <span class="field-description">Appears within the input</span> 
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <input type="text" name="placeholder[]" class="form-control">
                        </div>  
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Formatting</span><br>
                            <span class="field-description">Affects value on front end</span> 
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                             <select class="select form-control type" name="format[]">

                                <option value="No Formatting" selected="selected">No Formatting</option>
                                <option value="text" selected="selected">Convert HTML into tags</option>


                            </select>
                        </div>  
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Conditional Logic</span><br>

                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <input type="radio" name="conditional_logic[]" value="yes"> yes
                            <input type="radio" name="conditional_logic[]" value="no"> no
                        </div>  
                    </div>
                    <div class="row field_row number" style="display: none;">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Minimum Value</span><br>
                            <span class="field-description">Add the Minimum Value</span>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <input type="number" name="minimum[]" class="form-control">
                        </div>  
                    </div>
                    <div class="row field_row number" style="display: none;">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Maximum Value</span><br>
                            <span class="field-description">Add the Maximum Value</span>

                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <input type="number" name="maximum[]" class="form-control">
                        </div>  
                    </div>
                    <div class="row field_row choice" style="display: none;">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Choices</span><br>
                            <span class="field-description">Enter each choice on a new line.<br>For more control, you may specify both a value and label like this:<br>red : Red<br>blue : Blue</span><br>
                        </div>
                        <div class="col l8 form-group choice-option">
                            <button style="width:150px;" class="add_field_option Normal btn btn-block btn-success">
                                            Add Option
                            </button><br>

                        </div>  
                    </div>
                    <div class="row field_row">
                        <div class="col l4 left-align grey lighten-2" style="padding:10px">
                            <span class="field-title">Message</span><br>
                            <span class="field-description">eg. Show extra content</span> 
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <input type="text" class="form-control" name="message[]">
                        </div>  
                    </div>

                    </div>
                  </div>
                </td>
              </tr>
              
				  	</tbody>

				</table>
         
			</div>
			<div>
				<p>No fields. Click the + Add Field button to create your first field. </p>
			</div>
			<div class="row" style="background-color: #EAF2FA;padding: 9px;">
				<div class="col l10">
					<span class="add-field-icon"><i class="fa fa-share" aria-hidden="true"></i></span>
					<span class="add-field-desc">Drag and drop to reorder</span>
				</div>
				<div class="col l2 add-field-content">
					<button class="btn add-row">Add Field</button>
				</div>
			</div>
      <div class="row">
        <div class="col l12" style="margin: 15px">
          <button class=" btn">Save survey</button>  
        </div>
        
      </div>
		</section>
	</div>
</div>
<style type="text/css">
  .options{
    display: none;
   position: absolute;
   margin: 0 auto;
   margin-top: 20px;
   left: 21%;
  }
  .option-trigger:hover .options{
    display: block;
  }
</style>
@endsection
