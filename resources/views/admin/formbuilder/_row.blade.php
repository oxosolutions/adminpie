<div >
  <div class="row form-row option-trigger" style="background-color: #fff;padding: 15px 10px">

    <div class="col l2">
      <div style="float: left;background-color: grey;text-align: center;width: 42px;margin-top: -11px;margin-bottom: -11px;line-height: 67px;" class="handle">
        <a href="">
          <i class="fa fa-arrows" style="color: white"></i>
        </a>
      </div>
      <span style="border:1px solid #e8e8e8;line-height: 46px;width: 34px;margin: 0 auto;margin-left:10px;border-radius: 50%;padding:10px 15px;" class="row-count">1</span>
      <div style="clear: both">
          
      </div>
    </div>
    <div class="col l4">
      <div class="row">
        <div class="col l12 field-label">
          Field Label
        </div>
        <div class="" style="font-size: 12px;height: 0px">
          <span class="options">
            <a href="javascript:void(0)" class="edit-fields" style="border:0px !important;padding: 0px">Edit </a>|
            <a href="javascript:void(0)">View </a>|
            <a href="javascript:void(0)" class="delete-row">Delete </a>
          </span>
        </div>
      </div>
    </div>
    <div class="col l4 field-name-text">Test</div>
    <div class="col l2 field-type">abc</div>

  </div>
  <div class="fields-list" style="display: none">
    <div colspan=100% style="padding: 0px;">
       <div>
        <div class="fields_list active-field">
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5 " style="padding:20px">
                <span class="field-title">Field Label*</span><br>
                <span class="field-description">This is the name which will appear on the EDIT page</span>
            </div>
            <div class="col l8 form-group"  style="padding: 10px">
                 <input type="text" name="label[]" class="form-control field-label-input">
            </div>
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field Name*</span><br>
                <span class="field-description">Single word, no spaces, underscore and dashes allowed</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input type="text" name="fieldname[]" class="form-control field-name">
            </div>
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding: 30px 20px">
                <span class="field-title" style="line-height: 36px">Field Type*</span>         
            </div>
            <div class="col l8 input-field" style="padding:10px">
                <select name="type[]" class="field_type">
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
            <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                <span class="field-title">Field Instructions</span><br>
                <span class="field-description">Instructions for authors. Shown when submitting data</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                {{-- <textarea class="form-control" rows="3" name="instruction[]"></textarea> --}}
                <textarea id="textarea1" class="materialize-textarea" name="instruction[]"></textarea>
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                <span class="field-title">Field Description</span><br>
                <span class="field-description">Field Description</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                {{-- <textarea class="form-control" rows="3" name="question_desc[]"></textarea> --}}
                <textarea id="textarea2" class="materialize-textarea" name="field_desc[]"></textarea>
            </div>  
        </div>
         <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
            <span class="field-title">Field Order</span><br>
                <span class="field-description">Question Order be in number [0-9]</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input type="text" name="field_order[]" class="form-control field-label-input">
            </div>
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
            <span class="field-title">Media</span><br>
                <span class="field-description">Media mp3</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input type="text" name="media[]" class="form-control field-label-input">
            </div>
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
            <span class="field-title">Pattern</span><br>
                <span class="field-description">Pattern</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input type="text" name="pattern[]" class="form-control field-label-input">
            </div>
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
            <span class="field-title">Extra Options</span><br>
                <span class="field-description">Extra Options</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input type="text" name="extra_options[]" class="form-control field-label-input">
            </div>
        </div>
         <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
            <span class="field-title">Validation</span><br>
                <span class="field-description">validations</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input type="text" name="validation[]" class="form-control field-label-input">
            </div>
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                <span class="field-title">Required?</span><br>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                {{-- <input type="radio" name="required[]" value="1"> yes

                <input type="radio" name="required[]" value="0"> no --}}
                <p>
                  <input name="group1" type="radio" id="test1" name="required[]" />
                  <label for="test1">Yes</label>
                </p>
                <p>
                  <input name="group1" type="radio" id="test2" name="required[]" />
                  <label for="test2">No</label>
                </p>
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Placeholder Text</span><br>
                <span class="field-description">Appears within the input</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                <input type="text" name="placeholder[]" class="form-control">
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Formatting</span><br>
                <span class="field-description">Affects value on front end</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                {{--  <select class="select form-control type" name="format[]">

                    <option value="No Formatting" selected="selected">No Formatting</option>
                    <option value="text" selected="selected">Convert HTML into tags</option>


                </select> --}}
                <select name="format[]">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="No Formatting">No Formatting</option>
                  <option value="text">Convert HTML into tags</option>
                  
                </select>
                 
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                <span class="field-title">Conditional Logic</span><br>

            </div>
            <div class="col l8 form-group" style="padding:5px">
                <p>
                  <input name="group2" type="radio" id="test4" name="conditional[]" />
                  <label for="test4">Yes</label>
                </p>
                <p>
                  <input name="group2" type="radio" id="test5" name="conditional[]" />
                  <label for="test5">No</label>
                </p>
            </div>  
        </div>
        <div class="row field_row choices" style="display: none;">
            <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                <span class="field-title">Choices</span><br>
                <span class="field-description">Enter each choice on a new line.<br>For more control, you may specify both a value and label like this:<br>red : Red<br>blue : Blue</span>
            </div>
            <div class="col l8 form-group" style="padding:5px">
                <div class="col l12 form-group choice-option">
                   <button style="width:150px;" class="add_field_option Normal btn btn-block btn-success" type="button">
                   Add Option
                   </button><br>
                   <div class="field_choices">
                     
                   </div>
                </div>
               
            </div>  
        </div>
        <div class="row field_row number" style="display: none;">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Minimum Value</span><br>
                <span class="field-description">Add the Minimum Value</span>
            </div>
            <div class="col l8 form-group" style="padding:5px">
                <input type="number" name="minimum[]" class="form-control">
            </div>  
        </div>
        <div class="row field_row number" style="display: none;">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Maximum Value</span><br>
                <span class="field-description">Add the Maximum Value</span>

            </div>
            <div class="col l8 form-group" style="padding:5px">
                <input type="number" name="maximum[]" class="form-control">
            </div>  
        </div>
        <div class="row field_row choice" style="display: none;">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
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
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Message</span><br>
                <span class="field-description">eg. Show extra content</span> 
            </div>
            <div class="col l8 form-group" style="padding:5px">
                <input type="text" class="form-control" name="message[]">
            </div>  
        </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
    $('select').material_select();
  });
</script>